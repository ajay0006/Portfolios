<?php
include_once '../Models/User.php';
include_once '../Models/Contact.php';
include_once '../Models/Investor.php';
include_once '../Models/Tenant.php';
include_once '../Models/Visitors.php';

function getPdo(): PDO
{
    $serverName = "localhost";
    $userName = "TESTUSER";
    $password = "1234";


    $myPdo = new PDO("mysql:host=$serverName;dbname=aisharealestate", $userName, $password);
    $myPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $myPdo;

}
