<?php
class Order
{
    public $orderID;
    public $guestEmail;
    public $guestName;
    public $guestPhone;
    public $guestAddress;
    public $paymentMethod;
    public $totalAmount;
    public $createAt;
    public $customerID;
    public $code;
    public $statusID;
    public $orderDetails;
 
    public $isActive;
    public function __construct($orderID, $guestEmail, $guestName, $guestPhone, $guestAddress, $paymentMethod, $totalAmount, $createAt, $customerID, $code, $statusID, $isActive)
    {
        $this->orderID = $orderID;
        $this->guestEmail = $guestEmail;
        $this->guestName = $guestName;
        $this->guestPhone = $guestPhone;
        $this->guestAddress = $guestAddress;
        $this->paymentMethod = $paymentMethod;
        $this->totalAmount = $totalAmount;
        $this->createAt = $createAt;
        $this->customerID = (int)$customerID;
        $this->code = (int)$code;
        $this->statusID = (int)$statusID;
        $this->isActive = (int)$isActive;
        // Initialize order details as an empty array
        $this->orderDetails = [];
    }

    public function addOrderDetail($orderDetail)
    {
        $this->orderDetails[] = $orderDetail;
    }

}
?>