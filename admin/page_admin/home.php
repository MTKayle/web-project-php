<div class="d-flex">

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <header class="bg-white border-bottom p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="search-bar">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control bg-light border-start-0" placeholder="Search...">
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <button class="btn btn-light position-relative">
                        <i class="bi bi-bell"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span>
                    </button>
                    <button class="btn btn-light position-relative">
                        <i class="bi bi-chat"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">5</span>
                    </button>
                    <div class="dropdown">
                        <button class="btn d-flex align-items-center gap-2" data-bs-toggle="dropdown">
                            <img src="../assets/avatar/admin.jpg" class="avatar" alt="Admin">
                            <div class="d-none d-md-block text-start">
                                <div class="fw-bold" id="adminName"></div>
                                <div class="small text-muted">Admin</div>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- Dashboard Content -->
        <div class="p-4">
            <!-- Stats Cards -->
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="card border-top border-4 border-primary">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <div class="text-muted">Tổng doanh thu</div>
                                    <h3 class="mb-0" id="totalRevenue"></h3>
                                    <div class="small text-success" >
                                        <i class="bi bi-arrow-up" id="growRevenue"></i> 
                                    </div>
                                </div>
                                <div class="stat-icon bg-primary-subtle">
                                    <i class="bi bi-graph-up"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-top border-4 border-warning">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <div class="text-muted">Tổng bài viết diễn đàn</div>
                                    <h3 class="mb-0" id="totalInvestment"></h3>
                                    <div class="small text-success" >
                                        <i class="bi bi-arrow-up" id="growInvestment"></i> 
                                    </div>
                                </div>
                                <div class="stat-icon bg-warning-subtle">
                                    <i class="bi bi-walletbi bi-wallet"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-top border-4 border-info">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <div class="text-muted">Tổng sản phẩm bán ra</div>
                                    <h3 class="mb-0" id="totalProduct"></h3>
                                    <div class="small text-success" >
                                        <i class="bi bi-arrow-up" id="growProduct"></i>
                                    </div>
                                </div>
                                <div class="stat-icon bg-info-subtle">
                                    <i class="bi bi-airplane"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-top border-4 border-success">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <div class="text-muted">Tổng đơn hàng đã bán</div>
                                    <h3 class="mb-0" id="totalOrder"></h3>
                                    <div class="small text-success" >
                                        <i class="bi bi-arrow-up" id="growOrder"></i>
                                    </div>
                                </div>
                                <div class=" stat-icon bg-success-subtle">
                                    <i class="bi bi-bag"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="row g-4 mb-4">
                <div>
                    <div class="card">
                        <div class="card-header bg-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Biểu đồ doanh thu</h5>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-secondary" id="thisWeek">Tuần này</button>
                                    <button class="btn btn-sm btn-outline-secondary active" id="thisMonth">Tháng này</button>
                                    <button class="btn btn-sm btn-outline-secondary" id="thisYear">Năm này</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>
                </div>
                

            <!-- Tables Section -->
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header bg-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0" id="orderProcessing"></h5>
                                <a href="?page=orders" class="btn btn-link">Xem tất cả</a>
                            </div>
                        </div>
                        <div class="table-responsive" id="orderPending-list">
                            <!-- render danh sach order dang cho xu li -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header bg-white" style="height: 54.4px;">              
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Sản phẩm bán chạy</h5>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush" id="top5Product-list">
                                <!-- Top 5 Products will be dynamically inserted here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="../assets_admin/js_admin/home.js"></script>