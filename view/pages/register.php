    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <line x1="19" y1="8" x2="19" y2="14"></line>
                                <line x1="22" y1="11" x2="16" y2="11"></line>
                            </svg>
                            <h2 class="mt-3">Create Account</h2>
                            <p class="text-muted">Please fill in your information to register</p>
                        </div>

                        <form id="registerForm">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name = "name" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name = "email" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name = "password" required>
                            </div>

                            <div class="mb-4">
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="confirmPassword" name = "confirmPassword" required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2" id = "register-button">
                                Register
                            </button>

                            <p id="error-message-register" class="text-danger text-center mt-3" ></p>
                            <p id="success-message-register" class="text-success text-center mt-3"></p>

                            <div class="text-center mt-4">
                                <p class="text-muted">
                                    Already have an account? <a href="?page=login" class="text-decoration-none">Sign in</a>
                                </p>
</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>