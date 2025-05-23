<?php
require_once __DIR__ . '/../service/OrderService.php';

class OrderController
{
    private OrderService $orderService;
    public function __construct($orderService)
    {
        $this->orderService = $orderService;
    }

    public function getListOrdersAllStatus($page, $limit = 10)
    {
        $data = $this->orderService->getListOrdersAllStatus($page, $limit);
        if ($data) {
            echo json_encode(["success" => true, "response" => $data]);
            exit();
        } else {
            echo json_encode(["success" => false, "message"=> "Không tìm thấy thông tin đơn hàng"]);
            exit();
        }
    }

    public function getListOrderForStatusAdmin($statusID, $page, $limit = 10) 
    {
        $data = $this->orderService->getListOrderForStatusAdmin($statusID, $page, $limit);
        if ($data) {
            echo json_encode(["success" => true, "response" => $data]);
            exit();
        } else {
            echo json_encode(["success" => false, "message"=> "Không tìm thấy thông tin đơn hàng"]);
            exit();
        }
    }

    public function getOrderDetailsByOrderID($orderID)
    {
        if (empty($orderID)) {
            echo json_encode(["success" => false, "message"=> "Không tìm thấy thông tin đơn hàng"]);
            exit();
        }
        $data = $this->orderService->getOrderDetailsByOrderID($orderID);
        if ($data) {
            echo json_encode(["success" => true, "response" => $data]);
            exit();
        } else {
            echo json_encode(["success" => false, "message"=> "Không tìm thấy thông tin đơn hàng"]);
            exit();
        }
    }

    public function updateOrderStatus($orderID, $statusID)
    {
        if (empty($orderID) || empty($statusID)) {
            echo json_encode(["success" => false, "message"=> "Không tìm thấy thông tin đơn hàng"]);
            exit();
        }
        $data = $this->orderService->updateOrderStatus($orderID, $statusID);
        if ($data) {
            echo json_encode(["success" => true, "message" => "Cập nhật trạng thái đơn hàng thành công"]);
            exit();
        } else {
            echo json_encode(["success" => false, "message"=> "Không tìm thấy thông tin đơn hàng"]);
            exit();
        }
    }


}