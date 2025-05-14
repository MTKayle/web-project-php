<?php
require_once __DIR__ . '/../service/ProductService.php';

class ProductController
{
    private ProductService $productService;

    public function __construct($productService)
    {
        $this->productService = $productService;
    }

    public function getAllProducts($filters)
    {
        
        $products = $this->productService->getAllProducts($filters);
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
}
?>