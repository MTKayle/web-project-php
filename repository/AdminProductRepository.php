<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Product.php';

class AdminProductRepository
{
    private $connection;

    public function __construct($db)
    {
        $this->connection = $db->getConnection();
    }

    public function getAllProducts($page = 1, $perPage = 10)
    {
        try {
            $offset = ($page - 1) * $perPage;
            $query = "SELECT * FROM products WHERE isActive = TRUE LIMIT :perPage OFFSET :offset";
            $statement = $this->connection->prepare($query);
            $statement->bindValue(':perPage', $perPage, PDO::PARAM_INT);
            $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
            $statement->execute();

            $products = [];
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $products[] = new Product(
                    $row['productID'],
                    $row['productName'],
                    $row['title'],
                    $row['description'],
                    $row['price'],
                    $row['stockQuantity'],
                    $row['image'],
                    $row['categoryID']
                );
            }
            return $products;
        } catch (PDOException $e) {
            error_log("Lỗi khi lấy sản phẩm: " . $e->getMessage());
            file_put_contents(__DIR__ . '/debug.log', "Error in getAllProducts: " . $e->getMessage() . "\n", FILE_APPEND);
            return [];
        }
    }

    public function getTotalProducts()
    {
        try {
            $query = "SELECT COUNT(*) as total FROM products WHERE isActive = TRUE";
            $statement = $this->connection->prepare($query);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return (int)$result['total'];
        } catch (PDOException $e) {
            error_log("Lỗi khi đếm sản phẩm: " . $e->getMessage());
            file_put_contents(__DIR__ . '/debug.log', "Error in getTotalProducts: " . $e->getMessage() . "\n", FILE_APPEND);
            return 0;
        }
    }

    public function deactivateProduct($productId)
    {
        try {
            $query = "UPDATE products SET isActive = FALSE WHERE productID = :productId";
            $statement = $this->connection->prepare($query);
            $statement->bindValue(':productId', $productId, PDO::PARAM_INT);
            return $statement->execute();
        } catch (PDOException $e) {
            error_log("Lỗi khi vô hiệu hóa sản phẩm: " . $e->getMessage());
            file_put_contents(__DIR__ . '/debug.log', "Error in deactivateProduct: " . $e->getMessage() . "\n", FILE_APPEND);
            return false;
        }
    }

    public function insertProduct($data, $image)
    {
        try {
            $sql = "INSERT INTO products 
                (productName, title, description, price, stockQuantity, image, brandID, categoryID, ageFrom, ageTo) 
                VALUES (:productName, :title, :description, :price, :stockQuantity, :image, :brandID, :categoryID, :ageFrom, :ageTo)";
            $stmt = $this->connection->prepare($sql);

            return $stmt->execute([
                ':productName' => $data['productName'],
                ':title' => $data['title'],
                ':description' => $data['description'],
                ':price' => $data['price'],
                ':stockQuantity' => $data['stockQuantity'],
                ':image' => $image,
                ':brandID' => $data['brandID'],
                ':categoryID' => $data['categoryID'],
                ':ageFrom' => $data['ageFrom'],
                ':ageTo' => $data['ageTo'],
            ]);
        } catch (PDOException $e) {
            error_log("Lỗi khi thêm sản phẩm: " . $e->getMessage());
            file_put_contents(__DIR__ . '/debug.log', "Database error in insertProduct: " . $e->getMessage() . "\n", FILE_APPEND);
            throw $e;
        }
    }
}
