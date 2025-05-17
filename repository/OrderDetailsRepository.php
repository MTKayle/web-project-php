<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Order.php';

class OrderDetailsRepository
{
    private $conn;

    public function __construct($database)
    {
        $this->conn = $database->getConnection();
    }

    public function getOrderDetails($orderId)
    {
        $query = "SELECT * FROM order_details WHERE order_id = :order_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':order_id', $orderId);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addOrderDetail($orderId, $productId, $quantity, $price)
    {
        // Calculate subtotal
        $subTotal = $quantity * $price;
        $query = "INSERT INTO order_item(orderID, productID, quantity, unitPrice, subTotal, createAt, isActive) VALUES (:order_id, :product_id, :quantity, :price, :subTotal, NOW(), 1)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':order_id', $orderId);
        $stmt->bindParam(':product_id', $productId);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':subTotal', $subTotal); 

        return $stmt->execute();
    }

    public function getOrderDetailsForStatusID($customerId, $orderId, $statusID)
    {
        $query = "SELECT order_item.*, orders.*, products.productName 
        FROM order_item
        INNER JOIN orders ON order_item.orderID = orders.orderID
        INNER JOIN products ON order_item.productID = products.productID
        WHERE orders.customerID = :customer_id 
        AND orders.isActive = 1 
        AND orders.orderStatusID = :status_id 
        AND order_item.orderID = :order_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':customer_id', $customerId);
        $stmt->bindParam(':order_id', $orderId);
        $stmt->bindParam(':status_id', $statusID);
        $stmt->execute();
        $orderDetails = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $orderDetails[] = [
                'orderID' => $row['orderID'],
                'productID' => $row['productID'],
                'quantity' => $row['quantity'],
                'unitPrice' => $row['unitPrice'],
                'subTotal' => $row['subTotal'],
                'createAt' => $row['createAt'],
                'isActive' => $row['isActive'],
                'productName' => $row['productName'],
            ];
        }
        return $orderDetails;
    }
    
}