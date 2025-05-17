<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Order.php';

class OrderRepository{
    private $connnection;

    public function __construct($db)
    {
        $this->connnection = $db->getConnection();
    }

    // public function getOrdersByUserId($userId){
    //     $query = "SELECT * FROM orders WHERE userID = :userID";
    //     $statement = $this->connnection->prepare($query);
    //     $statement->execute(['userID' => $userId]);
    //     $orders = [];
    //     while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    //         $orders[] = new Order($row['orderID'], $row['userID'], $row['orderDate'], $row['totalAmount']);
    //     }
    //     return $orders;
    // }

    public function addOrder($order){
        try {
            $this->connnection->beginTransaction();
            $query = "INSERT INTO orders (guestEmail, guestName, guestPhoneNumber, shippingAddress, paymentMethod, totalAmount, createAt, customerID, code, orderStatusID, isActive) 
            VALUES (:guestEmail, :guestName, :guestPhoneNumber, :shippingAddress, :paymentMethod, :totalAmount, NOW(), :customerID, :code, 1, 1)";
            $statement = $this->connnection->prepare($query);
            $statement->execute([
                'guestEmail' => $order['email'],
                'guestName' => $order['fullname'],
                'guestPhoneNumber' => $order['phone'],
                'shippingAddress' => $order['address'],
                'paymentMethod' => $order['paymentMethod'],
                'totalAmount' => $order['totalAmount'],
                'customerID' => !empty($order['customerID']) ? $order['customerID'] : null,
                'code' => !empty($order['code']) ? $order['code'] : null,
            ]);
            $orderID =  $this->connnection->lastInsertId();
            $this->connnection->commit();
            return $orderID;
        } catch (PDOException $e) {
            $this->connnection->rollback();
            return null;
        }
    }

    public function getListOrderForStatus($customerID, $statusID){
        $query = "SELECT * FROM orders WHERE customerID = :customerID AND isActive = 1 AND orderStatusID = :statusID";
        $statement = $this->connnection->prepare($query);
        $statement->execute(['customerID' => $customerID, 'statusID' => $statusID]);
        $orders = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            //get discount
            $query = "SELECT * FROM vouchers WHERE code = :code";
            $statementDiscount = $this->connnection->prepare($query);
            $statementDiscount->execute(['code' => $row['code']]);
            $discountRow = $statementDiscount->fetch(PDO::FETCH_ASSOC);
            $discount = $discountRow['discountValue'] ?? '';

            $orders[] = new Order(
                $row['orderID'],
                $row['guestEmail'],
                $row['guestName'],
                $row['guestPhoneNumber'],
                $row['shippingAddress'],
                $row['paymentMethod'],
                $row['totalAmount'],
                $row['createAt'],
                $row['customerID'],
                $row['code'],
                $row['orderStatusID'],
                $row['isActive'],
                $discount
            );
        }
        return $orders;
    }

    
}