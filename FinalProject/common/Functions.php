<?php
include_once '../Models/User.php';

function test_Input($data): string
{
    $data = trim($data);
    $data = stripslashes($data);
    return htmlspecialchars(stripslashes(trim($data)));
}

function getPdo(): PDO
{
    $serverName = "localhost";
    $userName = "TESTUSER";
    $password = "1234";


    $myPdo = new PDO("mysql:host=$serverName;dbname=aisharealestate", $userName, $password);
    $myPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $myPdo;

}

getPdo();

function HashPassword($password)
{
    return password_hash($password, PASSWORD_DEFAULT);
}
