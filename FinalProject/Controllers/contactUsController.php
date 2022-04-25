<?php
include_once '../Common/Functions.php';

function validateFormEntries($data)
{
    foreach ($data as $value) {
        $value = test_Input($value);
    }

    return $data;
}


function updateContactTenant($pdo, $firstName, $lastName, $email, $age, $contactNum, $city, $postalCode, $province, $moveCohousing, $rentAmount, $comments)
{
    $sqlQuery = "INSERT INTO contact_us (id, First_Name, Last_Name, Email, Age, Contact_Num, City, Postal_Code, Province, Move_Cohousing, RentAmount, Comments, Date_Message) "."VALUES(null, :First_Name, :Last_Name, :Email, :Age, :Contact_Num, :City, :Postal_Code, :Province, :Move_Cohousing, :RentAmount, :Comments, :date)";
    $pdoStmt = $pdo->prepare($sqlQuery);
    $dateAdded=(new DateTime())->format('Y-m-d G:i:s');
    $pdoStmt->execute(array(':First_Name' => $firstName, ':Last_Name' => $lastName, ':Email' => $email, ':Age' => $age, ':Contact_Num' => $contactNum, ':City' => $city,':Postal_Code'=>$postalCode, ':Province' => $province, ':Move_Cohousing' => $moveCohousing, ':RentAmount' => $rentAmount, ':Comments' => $comments, ':date'=>$dateAdded));
    $pdo = null;
}

function updateContactInvestor($pdo, $firstName, $lastName, $email, $age, $contactNum, $city,$postalCode, $province, $investor, $investAmount, $comments)
{

    $sqlQuery = "INSERT INTO contact_us (id, First_Name, Last_Name, Email, Age, Contact_Num, City, Postal_Code, Province, Investor, Invest_Amount, Comments, Date_Message) "."VALUES(null, :First_Name, :Last_Name, :Email, :Age, :Contact_Num, :City, :Postal_Code, :Province, :Investor, :Invest_Amount, :Comments, :date)";
    $pdoStmt = $pdo->prepare($sqlQuery);
    $dateAdded=(new DateTime())->format('Y-m-d G:i:s');

    $pdoStmt->execute(array(':First_Name' => $firstName, ':Last_Name' => $lastName, ':Email' => $email, ':Age' => $age, ':Contact_Num' => $contactNum, ':City' => $city, ':Postal_Code'=>$postalCode, ':Province' => $province, ':Investor' => $investor, ':Invest_Amount' => $investAmount, ':Comments' => $comments, ':date'=>$dateAdded));
    $pdo = null;

}

function updateContactShortStay($pdo, $firstName, $lastName, $email, $age, $contactNum, $city,$postalCode, $province,$short_Stay, $comments)
{

    $sqlQuery = "INSERT INTO contact_us (id, First_Name, Last_Name, Email, Age, Contact_Num, City, Postal_Code, Province,Visit_Short_Stay, Comments, Date_Message) "." VALUES(null, :First_Name, :Last_Name, :Email, :Age, :Contact_Num, :City, :Postal_Code, :Province, :Visit_Short_Stay, :Comments, :date)";
    $pdoStmt = $pdo->prepare($sqlQuery);
    $dateAdded=(new DateTime())->format('Y-m-d G:i:s');

    $pdoStmt->execute(array(':First_Name' => $firstName, ':Last_Name' => $lastName, ':Email' => $email, ':Age' => $age, ':Contact_Num' => $contactNum, ':City' => $city,':Postal_Code'=>$postalCode, ':Province' => $province,':Visit_Short_Stay'=>$short_Stay, ':Comments' => $comments, ':date'=>$dateAdded));
    $pdo = null;

}