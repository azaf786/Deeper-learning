<?php

require_once '../vendor/autoload.php';

//Whoops
$whoops = new \Whoops\Run();
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());
$whoops->register();

//Dotenv
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ );
$dotenv->load();

//Logger
$logger = new \Monolog\Logger('application');
$logger->pushHandler(
        new \Monolog\Handler\StreamHandler(
            'application.log',
            \Monolog\Logger::WARNING
    )
);


//DatABase Connection

$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];

try {
    $dbh = new PDO('mysql:dbname=project;host=mysql',
        $username,
        $password
    );
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

catch (PDOException $e){
    die('Error connecting to database: '.$e);
}
