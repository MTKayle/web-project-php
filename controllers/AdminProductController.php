<?php
require_once __DIR__ . '/../service/AdminProductService.php';

class AdminProductController
{
    private $productService;

    public function __construct($productService)
    {
        $this->productService = $productService;
    }

    public function showAllProducts($page = 1)
    {
        $perPage = 10;
        $products = $this->productService->getAllProducts($page, $perPage);
        $totalProducts = $this->productService->getTotalProducts();
        return [
            'products' => $products,
            'totalProducts' => $totalProducts,
            'perPage' => $perPage,
            'currentPage' => $page
        ];
    }

    public function deactivateProduct($productId)
    {
        return $this->productService->deactivateProduct($productId);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Yêu cầu không hợp lệ']);
            exit;
        }

        $image = $_FILES['image'] ?? '';

        $productData = [
            'productName' => $_POST['productName'] ?? '',
            'title' => $_POST['title'] ?? '',
            'description' => $_POST['description'] ?? '',
            'price' => floatval($_POST['price'] ?? 0),
            'stockQuantity' => intval($_POST['stockQuantity'] ?? 0),
            'brandID' => intval($_POST['brandID'] ?? 0),
            'categoryID' => intval($_POST['categoryID'] ?? 0),
            'ageFrom' => intval($_POST['ageFrom'] ?? 0),
            'ageTo' => intval($_POST['ageTo'] ?? 0),
            'image' => $image
        ];

        // Kiểm tra dữ liệu bắt buộc
        if (empty($productData['productName']) || empty($productData['price']) || empty($productData['stockQuantity'])) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Thiếu các trường bắt buộc']);
            exit;
        }

        try {
            $result = $this->productService->addProduct($productData);
            header('Content-Type: application/json');
            echo json_encode(['success' => $result]);
        } catch (Exception $e) {
            file_put_contents(__DIR__ . '/debug.log', "Error in add: " . $e->getMessage() . "\n", FILE_APPEND);
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Lỗi server: ' . $e->getMessage()]);
        }
    }
}