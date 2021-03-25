<?php

require_once __DIR__ . '/../vendor/autoload.php';
use App\DataProvider\DatabaseProvider;
use App\DataProvider\DatabaseProvider\DataProvider;



//Whoops
$whoops = new \Whoops\Run();
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());
$whoops->register();

//Dotenv
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ );
$dotenv->load();

//Logger
$logger = new \Monolog\Logger('application');
$logger->pushHandler(
        new \Monolog\Handler\StreamHandler(
            'application.log',
            \Monolog\Logger::WARNING
    )
);

$dbProvider = new \App\DataProvider\DatabaseProvider2();

