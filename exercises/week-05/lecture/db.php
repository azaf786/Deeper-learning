<?php

$username = 'root';
$password = 'root';

try {
    $dbh = new PDO('mysql:dbname=lecture;host=mysql',
        $username,
        $password
    );
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 }

catch (PDOException $e){
    die('Error connecting to database: '.$e);
}