<div class="d-flex">
    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <header class="bg-white border-bottom p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="search-bar">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control bg-light border-start-0" placeholder="Search products...">
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <button class="btn btn-light position-relative">
                        <i class="bi bi-bell"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span>
                    </button>
                    <div class="dropdown">
                        <button class="btn d-flex align-items-center gap-2" data-bs-toggle="dropdown">
                            <img src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg" class="avatar" alt="Admin">
                            <div class="d-none d-md-block text-start">
                                <div class="fw-bold">Alex Johnson</div>
                                <div class="small text-muted">Admin</div>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- Products Content -->
        <div class="p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Products</h2>
                <button class="btn btn-primary">
                    <i class="bi bi-plus-lg me-2"></i>Add New Product
                </button>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://images.pexels.com/photos/3394650/pexels-photo-3394650.jpeg" alt="Headphones" class="product-img me-3">
                                            <div>
                                                <h6 class="mb-0">Premium Wireless Headphones</h6>
                                                <small class="text-muted">#PRD001</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Electronics</td>
                                    <td>$249.99</td>
                                    <td>156</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-light me-2"><i class="bi bi-pencil"></i></button>
                                        <button class="btn btn-sm btn-light"><i class="bi bi-trash"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://images.pexels.com/photos/437037/pexels-photo-437037.jpeg" alt="Smart Watch" class="product-img me-3">
                                            <div>
                                                <h6 class="mb-0">Smart Watch Series 5</h6>
                                                <small class="text-muted">#PRD002</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Electronics</td>
                                    <td>$299.99</td>
                                    <td>89</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-light me-2"><i class="bi bi-pencil"></i></button>
                                        <button class="btn btn-sm btn-light"><i class="bi bi-trash"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://images.pexels.com/photos/6976094/pexels-photo-6976094.jpeg" alt="TV" class="product-img me-3">
                                            <div>
                                                <h6 class="mb-0">Ultra HD 4K TV 55"</h6>
                                                <small class="text-muted">#PRD003</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Electronics</td>
                                    <td>$699.99</td>
                                    <td>42</td>
                                    <td><span class="badge bg-warning">Low Stock</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-light me-2"><i class="bi bi-pencil"></i></button>
                                        <button class="btn btn-sm btn-light"><i class="bi bi-trash"></i></button>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>