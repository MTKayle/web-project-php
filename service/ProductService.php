<?php
require_once __DIR__ . '/../repository/ProductRepository.php';
require_once __DIR__ . '/../models/Product.php';

class ProductService{
    private ProductRepository $productRepository;

    public function __construct($productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts($filters = [], $limit = 9, $page = 1)
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

    public function uploadGallary($productID, $avatar){
        $avatarPaths = []; // Mảng chứa đường dẫn đã lưu của các ảnh

    if (isset($_FILES['images']) && is_array($_FILES['images']['name'])) {
            $uploadDir = 'C:/xampp/htdocs/web-project-php/assets/img_product/';
            $avatarWebDir = '/web-project-php/assets/img_product/';

            $total = count($_FILES['images']['name']);

            for ($i = 0; $i < $total; $i++) {
                $tmpName = $_FILES['images']['tmp_name'][$i];
                $fileName = $_FILES['images']['name'][$i];
                $error = $_FILES['images']['error'][$i];

                if ($error === UPLOAD_ERR_OK) {
                    $uniqueName = uniqid() . '_' . basename($fileName);
                    $fullPath = $uploadDir . $uniqueName;
                    $webPath = $avatarWebDir . $uniqueName;

                    if (move_uploaded_file($tmpName, $fullPath)) {
                        $avatarPaths[] = $webPath; // Lưu đường dẫn để dùng tiếp
                    }
                }
            }
        }
        return $this->productRepository->uploadGallary($productID, $avatarPaths);
    }
}
?>