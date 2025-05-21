<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Product.php';

class ProductRepository
{
    private $connnection;

    public function __construct($db)
    {
        $this->connnection = $db->getConnection();
    }

    public function joinTable($filters, $query){

        $query .= " INNER JOIN brands ON products.brandID = brands.brandID ";
        

        if(!empty($filters['category']) || !empty($filters['search'])) {
            $query .= " INNER JOIN category ON products.categoryID = category.categoryID ";
        }

        return $query;
    }

    public function whereQuery($filters, $where, &$params){


        if (!empty($filters['search'])) {
            $where .= " AND ((productName LIKE :search OR title LIKE :search OR description LIKE :search) OR (categoryName LIKE :search)
            OR (brandName LIKE :search))";
            $params[':search'] = "%". $filters['search']. "%";
        }

        if(!empty($filters['brand'])) {
            $inBrands = [];
            foreach ($filters['brand'] as $index => $id) {
                $brand= ":brand_$index";
                $inBrands[] = $brand;
                $params[$brand] = $id;
            }
            $where .= " AND brandCode IN (" . implode(', ', $inBrands) . ")";
        }


        if(!empty($filters['category'])) {
            $where.= " AND code LIKE :categoryName";
            $params[':categoryName'] = "%" . $filters['category'] . "%";
        }

        // Độ tuổi: xử lý nhiều khoảng tuổi (dùng OR cho từng khoảng)
        if (!empty($filters['age'])) {
            $ageConditions = [];
            foreach ($filters['age'] as $index => $rangeAge) {
                list($from, $to) = explode('-', $rangeAge);
                $ageFrom = ":age_from_$index";  
                $ageTo = ":age_to_$index";
                $ageConditions[] = "(ageFrom <= $ageTo AND ageTo >= $ageFrom)";
                $params[$ageFrom] = (int) $from;
                $params[$ageTo] = (int) $to;
            }
            $where .= " AND (" . implode(" OR ", $ageConditions) . ")";

        }

        // Giá: xử lý nhiều khoảng giá
        if (!empty($filters['price'])) {
            $priceConditions = [];
            foreach ($filters['price'] as $index => $rangePrice) {
                list($from, $to) = explode('-', $rangePrice);
                $priceFrom = ":price_from_$index";
                $priceTo = ":price_to_$index";  
                $priceConditions[] = "(price Between $priceFrom AND $priceTo)";
                $params[$priceFrom] = (int) $from;
                $params[$priceTo] = (int) $to;
            }
            $where .= " AND (" . implode(" OR ", $priceConditions) . ")";
        }

        

        return $where;
    }

    public function orderQuery($filters, $sqlOrder){
        if(!empty($filters['sort'])){
            switch ($filters['sort']) {
                case 'price_asc':
                    $sqlOrder .= " ORDER BY price ASC ";
                    break;
                case 'price_desc':
                    $sqlOrder .= " ORDER BY price DESC ";
                    break;
                case 'newest':
                    $sqlOrder .= " ORDER BY createAt DESC ";
                    break;
                case 'oldest':
                    $sqlOrder .= " ORDER BY createAt ASC ";
                    break;
                default:
                    break;
            }
        }else{
            $sqlOrder .= " ORDER BY productID DESC";
        }
        return $sqlOrder;
    }


    public function getAllProducts($filters = [], $limit = 15, $page = 1){
        // echo $filters['age'];
        $offset = ($page - 1) * $limit; // Tính toán offset dựa trên trang hiện tại và số lượng sản phẩm mỗi trang
        $query =  "SELECT  *  FROM products ";

        $query = $this->joinTable($filters, $query);

        $where = " WHERE 1=1 "; // Điều kiện mặc định để dễ dàng thêm các điều kiện khác

        

        $params = [];

        $where = $this->whereQuery($filters, $where, $params, );

        
        $query .= $where;

        
        $query = $this->orderQuery($filters, $query);

        $queryCount = $query;

        $query .= " LIMIT :limit OFFSET :offset";


        

        $statement = $this->connnection->prepare($query);
        foreach ($params as $key => $value) {
            $statement->bindValue($key, $value);
        }
        $statement->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $statement->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $statement->execute();

        

        $products = [];

        //tinh tong so trang
        $queryCount = str_replace("SELECT *", "SELECT COUNT(*)", $queryCount);
        $statementCount = $this->connnection->prepare($queryCount);
        foreach ($params as $key => $value) {
            $statementCount->bindValue($key, $value);
        }
        $statementCount->execute();
        $totalProducts = $statementCount->fetchColumn();
        $totalPages = ceil($totalProducts / $limit);

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $products[] = new Product(
                $row['productID'],
                $row['productName'],
                $row['title'],
                $totalPages,
                $row['price'],
                $row['stockQuantity'],
                $row['image'],
                $row['brandName']
            );
        }

        return $products;
    }

    public function getProductByID($productID)
    {
        $query = "SELECT * FROM products WHERE productID = :productID";
        $statement = $this->connnection->prepare($query);
        $statement->execute(['productID' => $productID]);
        if ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            return new Product(
                $row['productID'],
                $row['productName'],
                $row['title'],
                $row['description'],
                $row['price'],
                $row['stockQuantity'],
                $row['image'],
                null,
            );
        }
        return null;
    }

    public function getNewProducts($limit = 4)
    {
        $query = "SELECT * FROM products ORDER BY createAt DESC LIMIT :limit";
        $statement = $this->connnection->prepare($query);
        $statement->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $statement->execute();
        $products = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $products[] = new Product($row['productID'], $row['productName'], $row['title'], $row['description'], $row['price'], $row['stockQuantity'], $row['image']);
        }
        return $products;
    }

    public function getProductDetailById($productID)
    {
        $query = "SELECT p.*, GROUP_CONCAT(g.imagePath) AS additionalImages, b.brandName
                    FROM products p
                    LEFT JOIN product_gallery g 
                    ON p.productID = g.productID
                    LEFT JOIN brands b
                    ON p.brandID = b.brandID
                    WHERE p.productID = :productID
                    GROUP BY p.productID";
        $statement = $this->connnection->prepare($query);
        $statement->bindValue(':productID', $productID, PDO::PARAM_INT);
        $statement->execute();
        // Kiểm tra kết quả trả về
        if ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        // Chuyển chuỗi ảnh phụ thành mảng
            $additionalImages = $row['additionalImages'] ? explode(',', $row['additionalImages']) : [];

            // Trả về đối tượng Product bao gồm danh sách ảnh phụ
            return new Product(
                $row['productID'],
                $row['productName'],
                $row['title'],
                $row['description'],
                $row['price'],
                $row['stockQuantity'],
                $row['image'],
                $row['brandName'],
                $additionalImages
            );
        }
    }

    public function getProductPriceById($productID)
    {
        $query = "SELECT price FROM products WHERE productID = :productID";
        $statement = $this->connnection->prepare($query);
        $statement->bindValue(':productID', $productID, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchColumn();
    }

    public function updateStockQuantity($productID, $quantity)
    {
        $query = "UPDATE products SET stockQuantity = stockQuantity - :quantity WHERE productID = :productID";
        $statement = $this->connnection->prepare($query);
        $statement->bindValue(':productID', $productID, PDO::PARAM_INT);
        $statement->bindValue(':quantity', $quantity, PDO::PARAM_INT);
        return $statement->execute();
    }

    public function updateProduct($productID, $data)
    {
        $query = "UPDATE products SET productName = :productName, title = :title, description = :description, price = :price, stockQuantity = :stockQuantity WHERE productID = :productID";
        $statement = $this->connnection->prepare($query);
        $statement->bindValue(':productName', $data['productName']);
        $statement->bindValue(':title', $data['title']);
        $statement->bindValue(':description', $data['description']);
        $statement->bindValue(':price', $data['price']);
        $statement->bindValue(':stockQuantity', $data['stockQuantity']);
        $statement->bindValue(':productID', (int)$productID);
        return $statement->execute();
    }

    public function uploadGallary($productID, $imagePaths){
        $query = "INSERT INTO product_gallery (productID , imagePath) VALUES (:productID, :imagePath)";
        $statement = $this->connnection->prepare($query);
        foreach ($imagePaths as $imagePath) {
            $statement->bindValue(':productID', (int)$productID);
            $statement->bindValue(':imagePath', $imagePath);
            if (!$statement->execute()) {
                return false; // Nếu có lỗi trong quá trình lưu ảnh, trả về false
            }
        }
        return true; // Trả về true nếu tất cả ảnh đã được lưu thành công
    }
}
?>