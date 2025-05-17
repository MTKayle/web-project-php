<?php

class OrderDetail
{
    public $orderID;
    public $productID;
    public $quantity;
    public $price;
    public $subTotal;
    public $productName;
    public $productImage;

    public function __construct($orderID, $productID, $quantity, $price, $subTotal, $productName, $productImage)
    {
        $this->orderID = $orderID;
        $this->productID = $productID;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->subTotal = $subTotal;
        $this->productName = $productName;
        $this->productImage = $productImage;
    }
}
?>