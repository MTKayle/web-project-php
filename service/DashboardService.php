<?php

require_once __DIR__ . '/../repository/DashboardRepository.php';
require_once __DIR__ . '/../models/Chart.php';
require_once __DIR__ . '/../models/DashboarData.php';

class DashboardService
{
    private DashboardRepository $dashboardRepository;

    public function __construct($dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }

    public function getRevenueData($type)
    {
        return $this->dashboardRepository->getRevenueData($type);
    }

    public function getDashboardData()
    {
        //Lấy dữ liệu tổng quan cho dashboard
        $totalProducts = $this->dashboardRepository->getTotalProduct();
        $totalProductMonthBefore = $this->dashboardRepository->getTotalProductsOfMonthsBefore();
        $totalOrders = $this->dashboardRepository->getTotalOrder();   
        $totalOrdersMonthBefore = $this->dashboardRepository->getTotalOrderOfMonthsBefore(); 
        $totalRevenue = $this->dashboardRepository->getTotalRevenue();
        $totalRevenueMonthBefore = $this->dashboardRepository->getTotalRevenueOfMonthsBefore();
        $totalInvestment = $this->dashboardRepository->getTotalPost();
        $totalInvestmentMonthBefore = $this->dashboardRepository->getTotalPostOfMonthsBefore();

        // Tính tỷ lệ gia tăng
        if ($totalProductMonthBefore == 0) {
            $increaseProducts = $totalProducts > 0 ? 100 : 0;
        } else {
            $increaseProducts = ($totalProducts - $totalProductMonthBefore) / $totalProductMonthBefore * 100;
        }
        
        if ($totalOrdersMonthBefore == 0) {
            $increaseOrders = $totalOrders > 0 ? 100 : 0;
        } else {
            $increaseOrders = ($totalOrders - $totalOrdersMonthBefore) / $totalOrdersMonthBefore * 100;
        }
        
        if ($totalRevenueMonthBefore == 0) {
            $increaseRevenue = $totalRevenue > 0 ? 100 : 0;
        } else {
            $increaseRevenue = ($totalRevenue - $totalRevenueMonthBefore) / $totalRevenueMonthBefore * 100;
        }
        
        if ($totalInvestmentMonthBefore == 0) {
            $increaseInvestment = $totalInvestment > 0 ? 100 : 0;
        } else {
            $increaseInvestment = ($totalInvestment - $totalInvestmentMonthBefore) / $totalInvestmentMonthBefore * 100;
        }
        
        // Làm tròn kết quả
        $increaseProducts = round($increaseProducts, 2);
        $increaseOrders = round($increaseOrders, 2);
        $increaseRevenue = round($increaseRevenue, 2);
        $increaseInvestment = round($increaseInvestment, 2);
        

        return new DashboardData(
            $totalProducts,
            $increaseProducts,
            $totalOrders,
            $increaseOrders,
            $totalRevenue,
            $increaseRevenue,
            $totalInvestment,
            $increaseInvestment
        );
    }

    public function getTop5Products()
    {
        //Lấy dữ liệu top 5 sản phẩm bán chạy nhất
        $topProducts = $this->dashboardRepository->getTop5Products();
        $topProductsData = [];
        foreach ($topProducts as $product) {
            $topProductsData[] = [
                'productID' => $product['productID'],
                'productName' => $product['productName'],
                'price' => $product['price'],
                'quantitySold' => $product['total_quantity'],
                'stockQuantity' => $product['stockQuantity'],
                'image'=>$product['image'],
                'brandName' => $product['brandName'],
                'title'=>$product['title'],
            ];
        }
        return $topProductsData;
    }

    public function getListOrderForStatus($statusID){
        return $this->dashboardRepository->getListOrderForStatus( $statusID);
    }

    public function getProductNew(){
        //Lấy dữ liệu sản phẩm mới
        $productNew = $this->dashboardRepository->getProductNew();
        $productNewData = [];
        foreach ($productNew as $product) {
            $productNewData[] = [
                'productID' => $product['productID'],
                'productName' => $product['productName'],
                'price' => $product['price'],
                'stockQuantity' => $product['stockQuantity'],
                'image'=>$product['image'],
                'brandName' => $product['brandName'],
                'title'=>$product['title'],
            ];
        }
        return $productNewData;
    }
}

?>