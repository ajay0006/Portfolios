<?php

include_once 'functionsDashbord.php';

function checkUser($pdo, $userID)
{
    $sqlQuery = "SELECT * From users where userid = ?";
    $pdoStmt = $pdo->prepare($sqlQuery);
    $pdoStmt->execute([$userID]);
    $result = $pdoStmt->fetch();
    $pdo = null;
    return $result;
}
