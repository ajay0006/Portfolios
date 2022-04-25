<?php

class Investor extends Contact
{

    public $investor;
    public $investorAmount;

    /**
     * @param $investor
     * @param $investorAmount
     */
    public function __construct($id, $fName, $lName, $email, $age, $contactNum, $city, $postalCode, $province, $comment, $investor, $investorAmount)
    {
        parent::__construct($id, $fName, $lName, $email, $age, $contactNum, $city, $postalCode, $province, $comment);
        $this->investor = $investor;
        $this->investorAmount = $investorAmount;
    }

    /**
     * @return mixed
     */
    public function getInvestor()
    {
        return $this->investor;
    }

    /**
     * @return mixed
     */
    public function getInvestorAmount()
    {
        return $this->investorAmount;
    }
}