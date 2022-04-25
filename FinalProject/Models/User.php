<?php
class User{

    private $userId;
    private $fName;
    private $lName;

    function __construct($userId, $fName, $lName)
    {
        $this->userId = $userId;
        $this->fName = $fName;
        $this->lName = $lName;
    }

    function getUserId(){
        return $this->userId;
    }

    function getFirstName(){
        return $this->fName;
    }

    function getLastName(){
        return $this->lName;
    }

}