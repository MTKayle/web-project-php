<?php

class DashboardData {
    public $totalProducts;
    public $totalProductMonthBefore;
    public $totalOrders;
    public $totalOrdersMonthBefore;
    public $totalRevenue;
    public $totalRevenueMonthBefore;
    public $totalInevestment;
    public $totalInevestmentMonthBefore;

    public function __construct($totalProducts, $totalProductMonthBefore, $totalOrders, $totalOrdersMonthBefore, $totalRevenue, $totalRevenueMonthBefore, $totalInevestment, $totalInevestmentMonthBefore) {
        $this->totalProducts = $totalProducts;
        $this->totalProductMonthBefore = $totalProductMonthBefore;
        $this->totalOrders = $totalOrders;
        $this->totalOrdersMonthBefore = $totalOrdersMonthBefore;
        $this->totalRevenue = $totalRevenue;
        $this->totalRevenueMonthBefore = $totalRevenueMonthBefore;
        $this->totalInevestment = $totalInevestment;
        $this->totalInevestmentMonthBefore = $totalInevestmentMonthBefore;
    }
}
?>
