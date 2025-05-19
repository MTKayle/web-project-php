<?php
require_once __DIR__ . '/../service/DashboardService.php';

class DashboardController
{
    
    private DashboardService $dashboardService;

    public function __construct($dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function getRevenueData($type)
    {
        if(!isset($type) || empty($type)) {
            echo json_encode(["success" => false, "message"=> "Không tìm thấy thông tin doanh thu"]);
            exit();
        }
        if($type !== "week" && $type !== "month" && $type !== "year") {
            echo json_encode(["success" => false, "message"=> "Không tìm thấy thông tin doanh thu"]);
            exit();
        }
        
        $data = $this->dashboardService->getRevenueData($type);

        if ($data) {
            echo json_encode( ["success" => true, "response" => $data]);  
            exit();
        } else {
            echo json_encode(["success" => false, "message"=> "Không tìm thấy thông tin doanh thu"]);
            exit();
        }
    }

    public function getDashboardData()
    {
        $data = $this->dashboardService->getDashboardData();
        if ($data) {
            echo json_encode(["success" => true, "response" => $data]);
            exit();
        } else {
            echo json_encode(["success" => false, "message"=> "Không tìm thấy thông tin tổng quan"]);
            exit();
        }
    }   

    public function getTop5Products()
    {
        $data = $this->dashboardService->getTop5Products();
        if ($data) {
            echo json_encode(["success" => true, "response" => $data]);
            exit();
        } else {
            echo json_encode(["success" => false, "message"=> "Không tìm thấy thông tin sản phẩm"]);
            exit();
        }
    }

    public function getListOrderForStatus($statusID){
        if(!isset($statusID) || empty($statusID)) {
            echo json_encode(["success" => false, "message"=> "Không tìm thấy thông tin đơn hàng"]);
            exit();
        }
        if($statusID !== "0" && $statusID !== "1" && $statusID !== "2" && $statusID !== "3") {
            echo json_encode(["success" => false, "message"=> "Không tìm thấy thông tin đơn hàng"]);
            exit();
        }
        
        $data = $this->dashboardService->getListOrderForStatus($statusID);

        if ($data) {
            echo json_encode( ["success" => true, "response" => $data]);  
            exit();
        } else {
            echo json_encode(["success" => false, "message"=> "Không tìm thấy thông tin đơn hàng"]);
            exit();
        }
    }

    
}