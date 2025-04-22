<?php
require_once __DIR__ . '/../service/CartService.php';

class CartController
{
    private CartService $cartService;

    public function __construct($cartService)
    {
        $this->cartService = $cartService;
    }

    public function addToCart($cartID, $productID)
    {
        if (empty($cartID) || empty($productID)) {
            echo json_encode(["success" => false, "message" => "Không có thông tin sản phẩm"]);
            exit();
        }
        $result = $this->cartService->addToCart($cartID, $productID);
        if ($result) {
            echo json_encode(["success" => true, "message" => "Thêm sản phẩm vào giỏ hàng thành công"]);
            exit();
        } else {
            echo json_encode(["success" => false, "message" => "Thêm sản phẩm vào giỏ hàng thất bại"]);
            exit();
        }
    }

    public function createCartForCustomer($customerID)
    {
        if (empty($customerID)) {
            echo json_encode(["success" => false, "message" => "Không có thông tin khách hàng"]);
            exit();
        }
        $result = $this->cartService->createCartForCustomer($customerID);
        if ($result) {
            session_start();
            $_SESSION['cartID'] = $result;
            echo json_encode(["success" => true, "message" => "Tạo giỏ hàng thành công"]);
            exit();
        } else {
            echo json_encode(["success" => false, "message" => "Tạo giỏ hàng thất bại"]);
            exit();
        }
    }

    public function getAllCartItems($cartID){
        if(empty($cartID)){
            echo json_encode(["success"=> false, "message"=> "Không có thông tin giỏ hàng"]);
            exit();
        }

        $result = $this->cartService->getAllCartItems($cartID);
        if($result){
            echo json_encode(["success"=> true, "cartItems"=> $result]);
            exit();
        }else{
            echo json_encode(["success"=> false, "message"=> "Không có sản phẩm nào trong giỏ hàng"]);
            exit();
        }
    }

    public function updateQuantity($cartID, $productID, $quantity)
    {
        if (empty($cartID) || empty($productID) || empty($quantity)) {
            echo json_encode(["success" => false, "message" => "Không có thông tin sản phẩm"]);
            exit();
        }
        $result = $this->cartService->updateQuantity($cartID, $productID, $quantity);
        if ($result) {
            echo json_encode(["success" => true, "message" => "Cập nhật số lượng sản phẩm thành công"]);
            exit();
        } else {
            echo json_encode(["success" => false, "message" => "Cập nhật số lượng sản phẩm thất bại"]);
            exit();
        }
    }

    public function removeCartItems($cartID, $productID){
        if(empty($cartID) || empty($productID)){
            echo json_encode(["success"=> false, "message"=> "Không có thông tin sản phẩm"]);
            exit();
        }
        $result = $this->cartService->removeCartItem($cartID, $productID);
        if($result){
            echo json_encode(["success"=> true, "message"=> "Xóa sản phẩm khỏi giỏ hàng thành công"]);
            exit();
        }else{
            echo json_encode(["success"=> false, "message"=> "Xóa sản phẩm khỏi giỏ hàng thất bại"]);
            exit();
        }
    }
}