<?php
class Product{
    public $productID;
    public $productName;
    public $title;
    public $description;
    public $price;
    public $stockQuantity;
    public $image;
    public $brandName;
    public $galleryImages;


    public function __construct($productID, $productName, $title, $description, $price, $stockQuantity, $image, $brandName, $galleryImages = [])
    {
        $this->productID = $productID;
        $this->productName = $productName;
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->stockQuantity = $stockQuantity;
        $this->image = $image;
        $this->brandName = $brandName;
        $this->galleryImages = $galleryImages;
    }
}
?>