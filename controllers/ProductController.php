<?php
require_once __DIR__ . '/../service/ProductService.php';

class ProductController
{
    private ProductService $productService;

    public function __construct($productService)
    {
        $this->productService = $productService;
    }

    public function getAllProducts($filters, $page)
    {
        
        $products = $this->productService->getAllProducts($filters, 15, $page);
        if ($products) {
            echo json_encode(["success" => true, "products" => $products]);
            exit();
        } else {
            echo json_encode(["success" => false, "message" => "Không tìm thấy sản phẩm nào"]);
            exit();
        }
    }

    public function getProductByID($productID)
    {
        $product = $this->productService->getProductByID($productID);
        if ($product) {
            echo json_encode(["success" => true, "product" => $product]);
            exit();
        } else {
            echo json_encode(["success" => false, "message" => "Không tìm thấy sản phẩm"]);
            exit();
        }
    }

    public function getNewProducts($limit = 4)
    {
        $products = $this->productService->getNewProducts($limit);
        if ($products) {
            echo json_encode(["success" => true, "products" => $products]);
            exit();
        } else {
            echo json_encode(["success" => false, "message" => "Không tìm thấy sản phẩm mới"]);
            exit();
        }
    }

    public function getProductDetailById($productID)
    {
        $product = $this->productService->getProductDetailById($productID);
        if ($product) {
            echo json_encode(["success" => true, "product" => $product]);
            exit();
        } else {
            echo json_encode(["success" => false, "message" => "Không tìm thấy sản phẩm"]);
            exit();
        }
    }

    public function updateProduct($productID, $data)
    {
        if(empty($productID) || empty($data)) {
            echo json_encode(["success" => false, "message" => "Thiếu thông tin sản phẩm"]);
            exit();
        }
        $product = $this->productService->updateProduct($productID, $data);
        if ($product) {
            echo json_encode(["success" => true, "message" => "Cập nhật sản phẩm thành công"]);
            exit();
        } else {
            echo json_encode(["success" => false, "message" => "Cập nhật sản phẩm thất bại"]);
            exit();
        }
    }

    
}
?>