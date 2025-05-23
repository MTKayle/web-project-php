<?php
require_once __DIR__ . '/../repository/OrderRepository.php';
require_once __DIR__ . '/../repository/OrderDetailsRepository.php';
require_once __DIR__ . '/../repository/CartRepository.php';
require_once __DIR__ . '/../repository/ProductRepository.php';
require_once __DIR__ . '/../repository/CustomerRepository.php';
require_once __DIR__ . '/../models/Order.php';
require_once __DIR__ . '/../models/OrderDetail.php';


class PaymentService {
    private OrderRepository $orderRepository;
    private CartRepository $cartRepository;
    private OrderDetailsRepository $orderDetailRepository;
    private ProductRepository $productRepository;
    private CustomerRepository $customerRepository;

    public function __construct($orderRepository, $orderDetailRepository, $cartRepository, $productRepository, $customerRepository) {
        $this->orderRepository = $orderRepository;
        $this->orderDetailRepository = $orderDetailRepository;
        $this->cartRepository = $cartRepository;
        $this->productRepository = $productRepository;
        $this->customerRepository = $customerRepository;
    }


    public function createOrder($orderData) {

        if (empty($orderData)) {
            return null;
        }
        $orderID = $this->orderRepository->addOrder($orderData);

        if(!empty($orderData['code']) && !empty($orderData['customerID'])) {
            $voucher = $this->customerRepository->getVoucherByCode($orderData['code']);
            if ($voucher) {
                $code = $voucher['code'];
                $this->customerRepository->updateIsUsedVoucher($orderData['customerID'], $orderData['code']);
            }
        }

        $cartItems = $this->cartRepository->getAllCartItems($orderData['cartID']);
        if ($orderID) {
            foreach ($cartItems as $item) {
                $productPrice = $this->productRepository->getProductPriceById($item['productID']);
                $this->orderDetailRepository->addOrderDetail($orderID, $item['productID'], $item['quantity'], $productPrice);
                $this->productRepository->updateStockQuantity($item['productID'], $item['quantity']);
            }
            return $orderID;
        }
        return null;
    }

    public function getOrderDetailsForStatusID($customerId, $statusID) {
        $orders = $this->orderRepository->getListOrderForStatus($customerId, $statusID);
        $orderDetails = [];
        foreach ($orders as $order) {
            $details = $this->orderDetailRepository->getOrderDetailsForStatusID($customerId, $order->orderID, $statusID);
            $OrderDetail = [];
            foreach ($details as $detail) {
                $product = $this->productRepository->getProductById($detail['productID']);
                $OrderDetail[] = new OrderDetail(
                    $detail['orderID'],
                    $detail['productID'],
                    $detail['quantity'],
                    $detail['unitPrice'],
                    $detail['subTotal'],
                    $detail['productName'],
                    $product->image
                );
            } 
            $order->orderDetails = $OrderDetail;
            $orderDetails[] = $order;
        }
        return $orderDetails;
    }
}