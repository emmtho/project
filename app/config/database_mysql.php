<?php

return [
    // Set up details on how to connect to the database
    'dsn'     => "mysql:host=blu-ray.student.bth.se;dbname=emta14;",
    'username'        => 'emta14',
    'password'        => 'jO=6,5Bp',
    'driver_options'  => [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"],
    'table_prefix'    => "test_",

    // Display details on what happens
    'verbose' => false,

    // Throw a more verbose exception when failing to connect
    //'debug_connect' => 'true',
];
