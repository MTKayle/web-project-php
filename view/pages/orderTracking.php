<div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Page Title -->
                <div class="text-center mb-5">
                    <h1 class="fw-bold">Theo dõi đơn hàng</h1>
                    <p class="text-muted"></p>
                </div>

                <!-- Order Status Tabs -->
                <div class="row mb-5">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div id="processing-tab" class="status-tab card shadow-sm text-center py-4 border-2 active card-tab">
                            <div class="position-relative d-inline-block mx-auto">
                                <i class="bi bi-gear-fill text-primary fs-1 mb-3"></i>
                                
                            </div>
                            <h4>Đang xử lý</h4>
                            <p class=" mb-0">Đơn hàng đang đợi chuẩn bị</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div id="waiting-tab" class="status-tab card shadow-sm text-center py-4 border-2 card-tab">
                            <div class="position-relative d-inline-block mx-auto">
                                <i class="bi bi-truck fs-1 text-warning mb-3"></i>
                                
                            </div>
                            <h4>Chờ vận chuyển</h4>
                            <p class=" mb-0">Đơn hàng đang được vận chuyển</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div id="delivered-tab" class="status-tab card shadow-sm text-center py-4 border-2 card-tab">
                            <div class="position-relative d-inline-block mx-auto">
                                <i class="bi bi-check-circle-fill text-success fs-1 mb-3"></i>
                                
                            </div>
                            <h4>Đã giao hàng</h4>
                            <p class=" mb-0">Đơn hàng đã được giao</p>
                        </div>
                    </div>
                </div>

                <!-- Order List (initially empty, will be populated based on tab) -->
                <div id="order-list" class="mb-4"></div>
            </div>
        </div>
    </div>