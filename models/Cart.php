<?php
class Cart
{
    public $cartID;
    public $customerID;
    public $productID;
    public $quantity;

    public Product $product;

    public function __construct($cartID, $customerID, $productID, $quantity, $product = null)
    {
        $this->cartID = $cartID;
        $this->customerID = $customerID;
        $this->productID = $productID;
        $this->quantity = $quantity;
        $this->product = $product;
    }

}
?>