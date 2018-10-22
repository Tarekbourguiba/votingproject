<?php
return array(
    'mode' => 'development',
    'debug' => true,
    'templates.path' => BASE_DIR.'/views',
    'pdo' => array(
        'default' => array(
            'dsn' => 'mysql:host=localhost;dbname=votingproject',
            'username' => 'root',
            'password' => '123456',
            'options' => array()
        ),
    ),
);
