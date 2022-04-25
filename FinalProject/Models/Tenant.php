<?php

class Tenant extends Contact
{
    public $moveHousing;
    public $rentAmount;

    /**
     * @param $moveHousing
     * @param $rentAmount
     */
    public function __construct($id, $fName, $lName, $email, $age, $contactNum, $city, $postalCode, $province, $comment, $moveHousing, $rentAmount)
    {
        parent::__construct($id, $fName, $lName, $email, $age, $contactNum, $city, $postalCode, $province, $comment);
        $this->moveHousing = $moveHousing;
        $this->rentAmount = $rentAmount;
    }

    /**
     * @return mixed
     */
    public function getMoveHousing()
    {
        return $this->moveHousing;
    }

    /**
     * @return mixed
     */
    public function getRentAmount()
    {
        return $this->rentAmount;
    }




}