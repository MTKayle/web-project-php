<?php
require_once __DIR__ . '/../service/PaymentService.php';

class PaymentController
{
    private PaymentService $paymentService;

    public function __construct($paymentService)
    {
        $this->paymentService = $paymentService;
    }

    // public function getOrdersByUserId($userId)
    // {
    //     $orders = $this->paymentService->getOrdersByUserId($userId);
    //     if ($orders) {
    //         echo json_encode(["success" => true, "orders" => $orders]);
    //         exit();
    //     } else {
    //         echo json_encode(["success" => false, "message" => "Không tìm thấy đơn hàng nào"]);
    //         exit();
    //     }
    // }

    public function createOrder($orderData)
    {
        if (empty($orderData)) {
            echo json_encode(["success" => false, "message" => "Không có thông tin đơn hàng"]);
            exit();
        }

        try {
            $order = $this->paymentService->createOrder($orderData);
            if ($order) {
                echo json_encode(["success" => true, "order" => $order]);
                exit();
            } else {
                echo json_encode(["success" => false, "message" => "Thanh toán thất bại"]);
                exit();
            }
        } catch (Exception $e) {
            echo json_encode(["success" => false, "message" => "Hệ thống gặp lỗi, vui lòng thử lại sau!"]);
            exit();
        }
    }

    public function getOrderDetailsForStatusID($customerID, $statusID)
    {
        if (empty($customerID)) {
            echo json_encode(["success" => false, "message" => "Không có thông tin đơn hàng"]);
            exit();
        }

        try {
            $orders = $this->paymentService->getOrderDetailsForStatusID($customerID, $statusID);
            if ($orders) {
                echo json_encode(["success" => true, "orders" => $orders]);
                exit();
            } else {
                echo json_encode(["success" => false, "message" => "Không tìm thấy đơn hàng nào"]);
                exit();
            }
        } catch (Exception $e) {
            echo json_encode(["success" => false, "message" => "Hệ thống gặp lỗi, vui lòng thử lại sau!"]);
            exit();
        }
    }
    


}
?>