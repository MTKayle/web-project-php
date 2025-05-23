<?php

require_once __DIR__ . '/../repository/OrderRepository.php';



class OrderService
{
    private OrderRepository $orderRepository;
    public function __construct($orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }
    

    public function getListOrdersAllStatus($page, $limit = 10){
        $orders = $this->orderRepository->getListOrdersAllStatus($page);
        if ($orders) {
            return $orders;
        } else {
            return null;
        }
    }

    public function getListOrderForStatusAdmin($statusID, $page, $limit = 10){
        $orders = $this->orderRepository->getListOrderForStatusAdmin($statusID, $page);
        if ($orders) {
            return $orders;
        } else {
            return null;
        }
    }

    public function getOrderDetailsByOrderID($orderID){
        $orderDetails = $this->orderRepository->getOrderDetailsByOrderID($orderID);
        if ($orderDetails) {
            return $orderDetails;
        } else {
            return null;
        }
    }

    public function updateOrderStatus($orderID, $statusID){
        $result = $this->orderRepository->updateOrderStatus($orderID, $statusID);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}

?>