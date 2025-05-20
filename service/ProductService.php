<?php
require_once __DIR__ . '/../repository/ProductRepository.php';
require_once __DIR__ . '/../models/Product.php';

class ProductService{
    private ProductRepository $productRepository;

    public function __construct($productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts($filters = [], $limit = 15, $page = 1)
    {
        // Validate limit và page
        $limit = (int)$limit > 0 ? (int)$limit : 18;
        $page = (int)$page > 0 ? (int)$page : 1;

        

        if (isset($filters['search'])) {
            $filters['search'] = trim($filters['search']);
            if ($filters['search'] === '') {
                unset($filters['search']);
            }
        }

        return $this->productRepository->getAllProducts($filters, $limit, $page);
    }

    public function getProductByID($productID)
    {
        return $this->productRepository->getProductByID($productID);
    }

    public function getNewProducts($limit = 4)
    {
        return $this->productRepository->getNewProducts($limit);
    }

    public function getProductDetailById($productID){
        $product = $this->productRepository->getProductDetailById($productID);
        if ($product) {
            return $product;
        } else {
            return null;
        }
    }

    public function updateProduct($productID, $data){
        return $this->productRepository->updateProduct($productID, $data);
    }
}
?>