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


    //get all orders for admin  
    public function getListOrdersAllStatus($page = 1, $limit = 10){
        $offset = ($page - 1) * $limit; 

        $query = "SELECT * FROM orders WHERE isActive = 1 ORDER BY orderID DESC LIMIT :limit OFFSET :offset";
        $statement = $this->connnection->prepare($query);
        $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        $statement->bindValue(':offset', $offset, PDO::PARAM_INT);  
        $statement->execute();

        // Tính tổng số trang
        $totalQuery = "SELECT COUNT(*) as total FROM orders WHERE isActive = 1";
        $totalResult = $this->connnection->query($totalQuery)->fetch(PDO::FETCH_ASSOC);
        $totalPages = ceil($totalResult['total'] / $limit);

        $orders = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            //get customer infor 
            $query = "SELECT * FROM customers WHERE customerID = :customerID";
            $statementCustomer = $this->connnection->prepare($query);
            $statementCustomer->execute(['customerID' => $row['customerID']]);
            $customerRow = $statementCustomer->fetch(PDO::FETCH_ASSOC);
            $customerAvatar = $customerRow['avatar'] ?? '\web-project-php\view\resources\images.jpg';

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
                $totalPages,
                $row['orderStatusID'],
                $row['isActive'],
                $customerAvatar
            );
        }
        return $orders;
    }

    //lay danh sach don hang theo trang theo trang thai
    public function getListOrderForStatusAdmin($statusID, $page = 1, $limit = 10){
        $offset = ($page - 1) * $limit;

        //lay danh sach don hang theo trang theo trang thai
        $query = "SELECT * FROM orders WHERE isActive = 1 AND orderStatusID = :statusID ORDER BY orderID DESC LIMIT :limit OFFSET :offset";
        $statement = $this->connnection->prepare($query);
        $statement->bindValue(':statusID', $statusID, PDO::PARAM_INT);
        $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
        $statement->execute();

        

        //tinh tong trang
        // Tính tổng số trang
        $totalQuery = "SELECT COUNT(*) as total FROM orders WHERE isActive = 1 AND orderStatusID = :statusID";
        $totalStatement = $this->connnection->prepare($totalQuery);
        $totalStatement->bindValue(':statusID', $statusID, PDO::PARAM_INT);
        $totalStatement->execute();
        $totalResult = $totalStatement->fetch(PDO::FETCH_ASSOC);    
        $totalPages = ceil($totalResult['total'] / $limit);

        $orders = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            //get customer infor 
            $query = "SELECT * FROM customers WHERE customerID = :customerID";
            $statementCustomer = $this->connnection->prepare($query);
            $statementCustomer->execute(['customerID' => $row['customerID']]);
            $customerRow = $statementCustomer->fetch(PDO::FETCH_ASSOC);
            $customerAvatar = $customerRow['avatar'] ?? '\web-project-php\view\resources\images.jpg';

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
                $totalPages,
                $row['orderStatusID'],
                $row['isActive'],
                $customerAvatar
            );
        }
        return $orders;
    }


    public function getOrderDetailsByOrderID($orderId)
    {
        $query = "SELECT order_item.*, orders.*, products.productName
        FROM order_item
        INNER JOIN orders ON order_item.orderID = orders.orderID
        INNER JOIN products ON order_item.productID = products.productID
        WHERE orders.orderID = :order_id
        AND orders.isActive = 1 ";
        $stmt = $this->connnection->prepare($query);
        $stmt->bindParam(':order_id', $orderId);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC) ?? null;
        //lay discount value voucher
        if (empty($row)) {
            return null;
        }
        $query = "SELECT * FROM vouchers WHERE code = :code";
        $statementDiscount = $this->connnection->prepare($query);
        $statementDiscount->execute(['code' => $row[0]['code']]);
        $discountRow = $statementDiscount->fetch(PDO::FETCH_ASSOC);
        $discount = $discountRow['discountValue'] ?? 0;
        //duyet qua tung row
        $orderDetails = [];
        foreach ($row as $detal){
            $orderDetails[] = [
                'orderID' => $detal['orderID'],
                'guestEmail' => $detal['guestEmail'],
                'guestName' => $detal['guestName'],
                'guestPhoneNumber' => $detal['guestPhoneNumber'],
                'shippingAddress' => $detal['shippingAddress'], 
                'paymentMethod' => $detal['paymentMethod'],
                'totalAmount' => $detal['totalAmount'],
                'productID' => $detal['productID'],
                'quantity' => $detal['quantity'],
                'unitPrice' => $detal['unitPrice'],
                'subTotal' => (float)$detal['subTotal'],
                'createAt' => $detal['createAt'],
                'isActive' => $detal['isActive'],
                'productName' => $detal['productName'],
                'discount' => $discount,
            ];
        } 
        return $orderDetails;
    }

    public function updateOrderStatus($orderId, $statusId)
    {
        $query = "UPDATE orders SET orderStatusID = :statusId WHERE orderID = :orderId";
        $stmt = $this->connnection->prepare($query);
        $stmt->bindParam(':statusId', $statusId);
        $stmt->bindParam(':orderId', $orderId);
        return $stmt->execute();
    }   

    
}