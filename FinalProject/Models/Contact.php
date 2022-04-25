<?php

class Contact
{
    public $id;
    public $fName;
    public $lName;
    public $email;
    public $age;
    public $contactNum;
    public $city;
    public $postalCode;
    public $province;
    public $comment;

    /**
     * @param $id
     * @param $fName
     * @param $lName
     * @param $email
     * @param $age
     * @param $contactNum
     * @param $city
     * @param $postalCode
     * @param $province
     * @param $comment
     */
    public function __construct($id, $fName, $lName, $email, $age, $contactNum, $city, $postalCode, $province, $comment)
    {
        $this->id = $id;
        $this->fName = $fName;
        $this->lName = $lName;
        $this->email = $email;
        $this->age = $age;
        $this->contactNum = $contactNum;
        $this->city = $city;
        $this->postalCode = $postalCode;
        $this->province = $province;
        $this->comment = $comment;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getFName()
    {
        return $this->fName;
    }

    /**
     * @return mixed
     */
    public function getLName()
    {
        return $this->lName;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @return mixed
     */
    public function getContactNum()
    {
        return $this->contactNum;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return mixed
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @return mixed
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }



}