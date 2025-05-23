<?php
require_once __DIR__ . '/../repository/AdminProductRepository.php';
require_once __DIR__ . '/../config/Database.php';

class AdminProductService
{
    private $productRepository;

    public function __construct(AdminProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts($page, $perPage)
    {
        return $this->productRepository->getAllProducts($page, $perPage);
    }

    public function getTotalProducts()
    {
        return $this->productRepository->getTotalProducts();
    }

    public function deactivateProduct($productId)
    {
        return $this->productRepository->deactivateProduct($productId);
    }

    public function addProduct($data)
    {

        file_put_contents(__DIR__ . '/debug.log', "Adding product: " . print_r($data, true) . "\n", FILE_APPEND);
        
        $avatarPath = '';
        $productImage = $data['image'];
        if ($productImage['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'C:/xampp/htdocs/web-project-php/assets/img_product/';
            $avatarName = uniqid() . '_' . basename($productImage['name']);
            $avatarDir = '/web-project-php/assets/img_product/'. $avatarName;
            $avatarPath = move_uploaded_file($productImage['tmp_name'], $uploadDir.$avatarName) ? $avatarDir : '';
        }
        
        return $this->productRepository->insertProduct($data, $avatarPath);
    }
}
