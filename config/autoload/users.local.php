<?php
return array(
    // //Place it into main config folder ////
    'settings' => array(
        'BASE_URL' => 'http://salasituacional.ce.gov.br/sisdmazf', //http://example.com
        "EMAIL" => array(
            "SMTP_SENDER_TYPE" => "user",
            "SMTP_NAME" => "",
            "SMTP_HOST" => "",
            "SMTP_PORT" => "587",
            "SMTP_CONNECTION_CLASS" => "plain",
            "SMTP_USERNAME" => "",
            "SMTP_PASSWORD" => "",
            "SMTP_SSL" => "587",
            "BODY" => "Hello there!",
            "FROM" => "from@url.com",
            "TO" => "to@url.com",
            "MAIL_FROM_NICK_NAME" => "Nome",
            "SUBJECT" => "Assunto",
            "FROM_NICK_NAME" => "Nom de novo",
            'UPDATE_EMAIL_TEMPLATE' => true
        ),
        'FORGOT_PASSWORD_SUBJECT' => 'Email de redefinição de senha'
    ),
    'afterLoginURL' => 'home', //Change it where your application redirects after login
    'controllers' => array(
        'invokables' => array(
            'Users\Controller\User' => 'Users\Controller\UserController',
            'Grupos\Controller\Index' => 'Grupos\Controller\IndexController',
            'Home\Controller\Index' => 'Home\Controller\IndexController',
        )
    ),
    'whitelist' => array(
        '/sisdmazf/public/users',
        '/sisdmazf/public/users/index',
        '/sisdmazf/public/users/logout',
        '/sisdmazf/public/users/forgot-password',
        '/sisdmazf/public/users/reset-password',
        '/sisdmazf/public/users/password-reset-confirmation',
    ),
    
    'db' => array(
        'driver' => 'Pdo',
        'dsn'            => 'mysql:dbname=sisdma;hostname=localhost',
        'username'       => 'root',
        'password'       => '',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
);
