$(document).ready(function () {
    $('#resetPasswordForm').on('submit', function (e) {
        e.preventDefault();

        const newPassword = $('#newPassword').val().trim();
        const confirmPassword = $('#confirmPassword').val().trim();

        $('#error-message-reset').text('');
        $('#success-message-reset').text('');

        // Kiểm tra độ dài và không có khoảng trắng
        if (newPassword.length < 6) {
            $('#error-message-reset').text('Mật khẩu phải có ít nhất 6 ký tự.');
            return;
        }

        if (/\s/.test(newPassword)) {
            $('#error-message-reset').text('Mật khẩu không được chứa khoảng trắng.');
            return;
        }

        if (newPassword !== confirmPassword) {
            $('#error-message-reset').text('Mật khẩu nhập lại không khớp.');
            return;
        }

        // Gửi mật khẩu mới về server qua AJAX
        $.ajax({
            url: `${baseUrl}/ajax/login.php`,
            type: 'POST',
            data: {
                action: 'resetPassword',
                password: newPassword
            },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    $('#success-message-reset').text('Đặt lại mật khẩu thành công!');
                    $('#resetPasswordForm')[0].reset();
                    // Chuyển hướng về trang đăng nhập sau 2 giây
                    setTimeout(function () {
                        window.location.href = '?page=login';
                    }, 1000);
                } else {
                    $('#error-message-reset').text(response.message || 'Đã xảy ra lỗi.');
                }
            },
            error: function () {
                $('#error-message-reset').text('Có lỗi xảy ra, vui lòng thử lại.');
            }
        });
    });
});