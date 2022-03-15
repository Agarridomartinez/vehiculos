<?php

class Client
{
    public SoapClient $instance;

    public function __construct()
    {
        $params = array(
            'uri' => 'https://soap-automoviles.herokuapp.com/',
            'location' => 'https://soap-automoviles.herokuapp.com/service-automoviles-auth.php',
            'trace' => 1
        );

        $this->instance = new SoapClient(null, $params);

        $auth_params = new stdClass();
        $auth_params->username = 'ies';
        $auth_params->password = 'daw';

        $header_params = new SoapVar($auth_params, SOAP_ENC_OBJECT);
        $header =new SoapHeader('daw', 'authenticate', $header_params, false);

        $this->instance->__setSoapHeaders(array($header));
    }

    public function __call($name, $arguments)
    {
        return $this->instance->{$name}($arguments);
    }
}