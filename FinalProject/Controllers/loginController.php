<?php

include_once '../common/Functions.php';

function ValidateLoginPassword($password, &$passwordErr, &$passwordValue) {
    $password = test_input($password);

    if ($password == "" || empty($password)) {
        $passwordErr = "• Your Password cant be Blank! <br/>";
    } else {
        $passwordValue = $password;
    }
}

function ValidateLoginUserID($userID, &$userIDErr, &$userIDValue)
{
    // function that removes white spaces and invalid characters
    $loginID = test_input($userID);
    if (empty($loginID) || $loginID == "") {
        $userIDErr = "• The ID cannot be blank/empty. <br/>";
    } else {
        $userIDValue = $loginID;
        $userIDErr = "";
    }
}

function checkUser($pdo, $userID)
{
    $sqlQuery = "SELECT * From users where userid = ?";
    $pdoStmt = $pdo->prepare($sqlQuery);
    $pdoStmt->execute([$userID]);
    $result = $pdoStmt->fetch();
    $pdo = null;
    return $result;
}