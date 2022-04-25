<?php

class Visitors extends Contact
{
    public $shortStay;

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
     * @param $shortStay
     */

    public function __construct($id, $fName, $lName, $email, $age, $contactNum, $city, $postalCode, $province, $comment,$shortStay )
    {
        parent::__construct($id, $fName, $lName, $email, $age, $contactNum, $city, $postalCode, $province, $comment);
        $this->shortStay = $shortStay;
    }

    /**
     * @return mixed
     */
    public function getShortStay()
    {
        return $this->shortStay;
    }


}