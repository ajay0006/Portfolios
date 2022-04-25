<?php


include_once 'functionsDashbord.php';


function getCountVistors($pdo)
{
    $sqlQuery = "select count(id) from contact_us where Visit_Short_Stay is not null";
    $pdoStmt = $pdo->prepare($sqlQuery);
    $pdoStmt->execute();
    $result = $pdoStmt->fetch();
    $pdo = null;
    return $result;
}

function getCountInvestors($pdo)
{
    $sqlQuery = "select count(id) from contact_us where Investor is not null";
    $pdoStmt = $pdo->prepare($sqlQuery);
    $pdoStmt->execute();
    $result = $pdoStmt->fetch();
    $pdo = null;
    return $result;
}

function getCountRenters($pdo)
{
    $sqlQuery = "select count(id)from contact_us where Move_Cohousing is not null";
    $pdoStmt = $pdo->prepare($sqlQuery);
    $pdoStmt->execute();
    $result = $pdoStmt->fetch();
    $pdo = null;
    return $result;
}