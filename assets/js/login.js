$(document).ready(function() {
    // quen mat khau
    $('#forgotPassword').on('click', function() {
        document.getElementById("loginForm").style.display = "none";
        document.getElementById("forgotPasswordForm").style.display = "block";

        //khigui form quen mat khau
        $('#forgotPasswordForm').on('submit', function(e) {
            e.preventDefault();
            var email = $('#forgotEmail').val().trim(); // Lấy giá trị email từ input
            if (email) {
                // Ẩn nút gửi, hiện loading
                $('#sendOtpBtn').hide();
                $('#loadingOtp').show();

                $.ajax({
                    url: `${baseUrl}/ajax/login.php`,
                    type: 'POST',
                    data: {action: 'forgotPassword', email: email},
                    dataType: 'json',
                    success: function (response) {
                        $('#sendOtpBtn').show();
                        $('#loadingOtp').hide();
                        if (response.success) {
                            // alert("Đã gửi yêu mã xác thực đến email của bạn.");
                            // Chuyển đến trang nhập mã xác thực
                            // alert(response.message);
                            window.location.href = '?page=forgot-password';
                        } else {
                            alert(response.message);    
                        }
                    },
                    error: function (response) {
                        $('#sendOtpBtn').show();
                        $('#loadingOtp').hide();
                        $('#error-message-otp').text("Có lỗi xảy ra, vui lòng thử lại.");
                    }
                });
            } else {
                alert("Vui lòng nhập địa chỉ email của bạn.");
            }
        });
        
    });

    document.getElementById("backToLogin").addEventListener("click", function (e) {
        e.preventDefault();
        document.getElementById("forgotPasswordForm").style.display = "none";
        document.getElementById("loginForm").style.display = "block";
    });
});