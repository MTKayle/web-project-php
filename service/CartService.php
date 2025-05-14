<?php
require_once __DIR__ . '/../repository/CartRepository.php';
require_once __DIR__ . '/../repository/ProductRepository.php';
require_once __DIR__ . '/../models/Cart.php';

class CartService
{
    private CartRepository $cartRepository;
    private ProductRepository $productRepository;

    public function __construct($cartRepository, $productRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->productRepository = $productRepository;
    }

    public function addToCart($cartID, $productID)
    {
        if($this->cartRepository->itemExists($cartID, $productID)) {
            return $this->cartRepository->increaseQuantity($cartID, $productID);
        }else{
            return $this->cartRepository->addToCart($cartID, $productID);
        }
        
    }

    public function createCartForCustomer($customerID)
    {
        return $this->cartRepository->createCartForCustomer($customerID);
    }

    public function getAllCartItems($cartID){
        $items = $this->cartRepository->getAllCartItems($cartID);

        $cartItems = [];

        foreach($items as $item){
            $product = $this->productRepository->getProductByID($item['productID']);

            $cartItems[] = new Cart(
                $item['cartID'],
                null,
                $item['productID'],
                $item['quantity'],
                $product
            );
        }

        return $cartItems;
    }

    public function updateQuantity($cartID, $productID, $quantity)
    {
        return $this->cartRepository->updateQuantity($cartID, $productID, $quantity);
    }

    public function removeCartItem($cartID, $productID)
    {
        return $this->cartRepository->removeCartItem($cartID, $productID);
    }

    public function clearCart($cartID)
    {
        return $this->cartRepository->clearCart($cartID);
    }
}