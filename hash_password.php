<?php
// Mật khẩu muốn hash
$password = "admin123"; // Thay bằng mật khẩu bạn muốn

// Hash mật khẩu
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Hiển thị kết quả
echo "Hashed Password: " . $hashedPassword;
?>
