<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Chart.php';
require_once __DIR__ . '/../models/Order.php';

class DashboardRepository
{
    private $connection;

    public function __construct($db)
    {
        $this->connection = $db->getConnection();
    }

    public function getRevenueData($type)
    {
        if($type == 'week'){
            $query = "SELECT 
            d.day_label AS weekday_name,
            COALESCE(SUM(o.totalAmount), 0) AS total_revenue
        FROM (
            SELECT 2 AS day_number, 'Thứ 2' AS day_label
            UNION ALL SELECT 3, 'Thứ 3'
            UNION ALL SELECT 4, 'Thứ 4'
            UNION ALL SELECT 5, 'Thứ 5'
            UNION ALL SELECT 6, 'Thứ 6'
            UNION ALL SELECT 7, 'Thứ 7'
            UNION ALL SELECT 1, 'Chủ nhật'
        ) d
        LEFT JOIN orders o
            ON DAYOFWEEK(o.createAt) = d.day_number
            AND YEARWEEK(o.createAt, 1) = YEARWEEK(CURDATE(), 1)
        GROUP BY d.day_number, d.day_label
        ORDER BY d.day_number
        ;";

            $statement = $this->connection->prepare($query);
            $statement->execute();
            $revenues = $statement->fetchAll(PDO::FETCH_ASSOC);
            $labels = [];
            $data = [];
            foreach ($revenues as $revenue) {
                $labels[] = $revenue['weekday_name'];
                $data[] = (float)$revenue['total_revenue'];
            }
            return new Chart(
                $labels,
                $data,
                'Doanh thu trong tuần',
            );
        } else if($type == 'month'){
            $query = "WITH RECURSIVE days AS (
                SELECT 1 AS day_of_month
                UNION ALL
                SELECT day_of_month + 1
                FROM days
                WHERE day_of_month < DAY(LAST_DAY(CURDATE()))
            )
            SELECT 
                d.day_of_month,
                COALESCE(SUM(o.totalAmount), 0) AS total_revenue
            FROM days d
            LEFT JOIN orders o 
                ON DAY(o.createAt) = d.day_of_month
                AND MONTH(o.createAt) = MONTH(CURDATE())
                AND YEAR(o.createAt) = YEAR(CURDATE())
            GROUP BY d.day_of_month
            ORDER BY d.day_of_month;
            ";

            $statement = $this->connection->prepare($query);
            $statement->execute();
            $revenues = $statement->fetchAll(PDO::FETCH_ASSOC);
            $labels = [];
            $data = [];
            foreach ($revenues as $revenue) {
                $labels[] = $revenue['day_of_month'].'/' . date('m');
                $data[] = (float)$revenue['total_revenue'];
            }
            return new Chart(
                $labels,
                $data,
                'Doanh thu trong tháng',
            );
        } else if($type == 'year'){
            $query = "SELECT 
            m.month_num,
            m.month_name,
            COALESCE(SUM(o.totalAmount), 0) AS total_revenue
        FROM (
            SELECT 1 AS month_num, 'Tháng 1' AS month_name
            UNION ALL SELECT 2, 'Tháng 2'
            UNION ALL SELECT 3, 'Tháng 3'
            UNION ALL SELECT 4, 'Tháng 4'
            UNION ALL SELECT 5, 'Tháng 5'
            UNION ALL SELECT 6, 'Tháng 6'
            UNION ALL SELECT 7, 'Tháng 7'
            UNION ALL SELECT 8, 'Tháng 8'
            UNION ALL SELECT 9, 'Tháng 9'
            UNION ALL SELECT 10, 'Tháng 10'
            UNION ALL SELECT 11, 'Tháng 11'
            UNION ALL SELECT 12, 'Tháng 12'
        ) m
        LEFT JOIN orders o
            ON MONTH(o.createAt) = m.month_num
            AND YEAR(o.createAt) = YEAR(CURDATE())
        GROUP BY m.month_num, m.month_name
        ORDER BY m.month_num;";

            $statement = $this->connection->prepare($query);
            $statement->execute();
            $revenues = $statement->fetchAll(PDO::FETCH_ASSOC);
            $labels = [];
            $data = [];
            foreach ($revenues as $revenue) {
                $labels[] = $revenue['month_name'];
                $data[] = (float)$revenue['total_revenue'];
            }
            return new Chart(
                $labels,
                $data,
                'Doanh thu trong năm',
            );
        }
        return null;
    }

    public function getTotalRevenue()
    {
        $query = "SELECT SUM(totalAmount) AS total_revenue FROM orders";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return (float)$result['total_revenue'];
    }

    public function getTotalRevenueOfMonthsBefore(){
        $query = "SELECT SUM(totalAmount) AS total_revenue FROM orders
        WHERE createAt < DATE_SUB(CURDATE(), INTERVAL (DAY(CURDATE()) - 1) DAY)";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result ? (int)$result['total_revenue'] : 1;
    }

    public function getTotalOrder()
    {
        $query = "SELECT COUNT(orderID) AS total_order FROM orders";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return (int)$result['total_order'];
    }

    public function getTotalOrderOfMonthsBefore(){
        $query = "SELECT COUNT(orderID) AS total_order FROM orders
        WHERE createAt < DATE_SUB(CURDATE(), INTERVAL (DAY(CURDATE()) - 1) DAY)";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result ? (int)$result['total_order'] : 1;
    }

    public function getTotalProduct()
    {
        $query = "SELECT Sum(quantity) AS total_product_sell FROM order_item";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return (int)$result['total_product_sell'];
    }

    public function getTotalProductsOfMonthsBefore(){
        $query = "SELECT SUM(quantity) AS total_product_sell
        FROM order_item
        WHERE createAt < DATE_SUB(CURDATE(), INTERVAL (DAY(CURDATE()) - 1) DAY)";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result ? (int)$result['total_product_sell'] : 1;
    }

    public function getTotalPost()
    {
        $query = "SELECT Count(postID) AS total_post FROM posts";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return (float)$result['total_post'];
    }

    public function getTotalPostOfMonthsBefore(){
        $query = "SELECT Count(postID) AS total_post FROM posts
        WHERE createAt < DATE_SUB(CURDATE(), INTERVAL (DAY(CURDATE()) - 1) DAY)";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result ? (int)$result['total_post'] : 1;
    }

    public function getTop5Products()
    {
        $query = "SELECT p.productID, p.productName, p.price, p.stockQuantity, p.image, SUM(oi.quantity) AS total_quantity
        FROM products p
        JOIN order_item oi ON p.productID = oi.productID
        GROUP BY p.productID, p.productName, p.price
        ORDER BY total_quantity DESC
        LIMIT 5";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNumberOfOrdersByStatus($statusID)
    {
        $query = "SELECT COUNT(orderID) AS total_orders FROM orders WHERE orderStatusID = :statusID";
        $statement = $this->connection->prepare($query);
        $statement->execute(['statusID' => $statusID]);
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return (int)$result['total_orders'];
    }

    public function getListOrderForStatus($statusID){
        $query = "SELECT * FROM orders WHERE isActive = 1 AND orderStatusID = :statusID ORDER BY createAt DESC LIMIT 7";
        $statement = $this->connection->prepare($query);
        $statement->execute(['statusID' => $statusID]);
        $numberOrders = $this->getNumberOfOrdersByStatus($statusID);
        $orders = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
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
                $numberOrders
            );
        }
        return $orders;
    }

    


}
?>