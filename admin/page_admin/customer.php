<div class="d-flex">
    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <header class="bg-white border-bottom p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="search-bar">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control bg-light border-start-0"
                            placeholder="Search customers...">
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <button class="btn btn-light position-relative">
                        <i class="bi bi-bell"></i>
                        <span
                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span>
                    </button>
                    <div class="dropdown">
                        <button class="btn d-flex align-items-center gap-2" data-bs-toggle="dropdown">
                            <img src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg"
                                class="avatar" alt="Admin">
                            <div class="d-none d-md-block text-start">
                                <div class="fw-bold">Alex Johnson</div>
                                <div class="small text-muted">Admin</div>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- Customers Content -->
        <div class="p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Customers</h2>
                <div class="d-flex gap-2">
                    <button class="btn btn-primary">
                        <i class="bi bi-plus-lg me-2"></i>Add Customer
                    </button>
                    <button class="btn btn-outline-primary">
                        <i class="bi bi-download me-2"></i>Export
                    </button>
                </div>
            </div>

            <!-- Customer Stats -->
            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="bg-primary bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-people text-primary fs-4"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">Total Customers</h6>
                                    <h3 class="mb-0">9,721</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="bg-success bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-person-plus text-success fs-4"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">New This Month</h6>
                                    <h3 class="mb-0">473</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="bg-info bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-cart-check text-info fs-4"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">Active Buyers</h6>
                                    <h3 class="mb-0">6,284</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="bg-warning bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-star text-warning fs-4"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">VIP Customers</h6>
                                    <h3 class="mb-0">892</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Email</th>
                                    <th>Orders</th>
                                    <th>Spent</th>
                                    <th>Last Order</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg"
                                                alt="Customer" class="avatar me-2">
                                            <div>
                                                <h6 class="mb-0">Emma Thompson</h6>
                                                <small class="text-muted">Joined Sep 2024</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>emma.t@example.com</td>
                                    <td>24</td>
                                    <td>$2,890.00</td>
                                    <td>Oct 2, 2025</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-light me-2"><i
                                                class="bi bi-pencil"></i></button>
                                        <button class="btn btn-sm btn-light"><i
                                                class="bi bi-three-dots-vertical"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://images.pexels.com/photos/1222271/pexels-photo-1222271.jpeg"
                                                alt="Customer" class="avatar me-2">
                                            <div>
                                                <h6 class="mb-0">Michael Chen</h6>
                                                <small class="text-muted">Joined Aug 2024</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>m.chen@example.com</td>
                                    <td>18</td>
                                    <td>$1,750.00</td>
                                    <td>Oct 2, 2025</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-light me-2"><i
                                                class="bi bi-pencil"></i></button>
                                        <button class="btn btn-sm btn-light"><i
                                                class="bi bi-three-dots-vertical"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://images.pexels.com/photos/733872/pexels-photo-733872.jpeg"
                                                alt="Customer" class="avatar me-2">
                                            <div>
                                                <h6 class="mb-0">Sophia Rodriguez</h6>
                                                <small class="text-muted">Joined Jul 2024</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>s.rodriguez@example.com</td>
                                    <td>31</td>
                                    <td>$3,420.00</td>
                                    <td>Oct 1, 2025</td>
                                    <td><span class="badge bg-warning">Inactive</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-light me-2"><i
                                                class="bi bi-pencil"></i></button>
                                        <button class="btn btn-sm btn-light"><i
                                                class="bi bi-three-dots-vertical"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
