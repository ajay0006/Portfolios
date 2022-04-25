<?php
include_once '../Common/Functions.php';
// This is to test that the ability tyo add a user to the users table, if you guys want to add any names to the users table, just replace my name and pwd

function addUser($userId, $fName, $lName, $password)
{

    $pdo = getPDO();
    //Hash the password
    $passwordHashed = HashPassword($password);


    $sqlQuery = "INSERT INTO users VALUES( :id, :fname, :lname, :password,null)";
    $pdoStmt = $pdo->prepare($sqlQuery);
    $pdoStmt->execute(array(':id' => $userId, ':fname' => $fName, ':lname' => $lName, ':password' => $passwordHashed));
    $pdo = null;
}

$first_Name = "Aisha";
$last_Name = "ElSherbiny";
$userID = "aisha";
$password = "aisha";

$first_Name = test_Input($first_Name);
$last_Name = test_Input($last_Name);
$userID = test_Input($userID);
$password = test_Input($password);

if ($first_Name && $last_Name && $userID && $password != null)
{
    addUser($userID, $first_Name, $last_Name, $password);
}