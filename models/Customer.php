<?php

class Customer{
    public $customerID;
    public $customerName;
    public $phoneNumber;
    public $address;

    public $avatar;

    public function __construct($customerID, $customerName, $phoneNumber, $address, $avatar)
    {
        $this->customerID = $customerID;
        $this->customerName = $customerName;
        $this->phoneNumber = $phoneNumber;
        $this->address = $address;
        $this->avatar = $avatar;
    }
}
?>