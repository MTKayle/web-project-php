const inputs = document.querySelectorAll('.code-input');
    inputs.forEach((input, index) => {
        input.addEventListener('input', () => {
            input.value = input.value.replace(/[^0-9]/g, ''); // chỉ số nguyên > 0
            if (input.value.length === 1 && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
        });

        input.addEventListener('keydown', (e) => {
            if (e.key === "Backspace" && !input.value && index > 0) {
                inputs[index - 1].focus();
            }
        });
    });

    // Countdown timer 5 minutes
    let timeLeft = 5 * 60;
    const countdownTimer = document.getElementById('countdownTimer');
    const resendBtn = document.getElementById('resendCodeBtn');

    const timerInterval = setInterval(() => {
        const minutes = String(Math.floor(timeLeft / 60)).padStart(2, '0');
        const seconds = String(timeLeft % 60).padStart(2, '0');
        countdownTimer.textContent = `${minutes}:${seconds}`;
        timeLeft--;

        if (timeLeft < 0) {
            clearInterval(timerInterval);
            countdownTimer.textContent = 'Hết hạn';
            resendBtn.disabled = false;
        }
    }, 1000);

    resendBtn.addEventListener('click', () => {
        // Gửi lại mã logic ở đây
        alert('Mã xác thực đã được gửi lại.');

        // Reset timer
        timeLeft = 5 * 60;
        resendBtn.disabled = true;
        const resetInterval = setInterval(() => {
            const minutes = String(Math.floor(timeLeft / 60)).padStart(2, '0');
            const seconds = String(timeLeft % 60).padStart(2, '0');
            countdownTimer.textContent = `${minutes}:${seconds}`;
            timeLeft--;

            if (timeLeft < 0) {
                clearInterval(resetInterval);
                countdownTimer.textContent = 'Hết hạn';
                resendBtn.disabled = false;
            }
        }, 1000);
    });

    // Xử lý sự kiện khi nhấn nút xác nhận
    $(document).ready(function() {  
        $('#verifyCodeForm').on('submit', function(e) {
            e.preventDefault();
            var inputs = document.querySelectorAll('.code-input');
            // Lấy giá trị từng ô input, nối thành chuỗi
            var code = Array.from(inputs).map(input => input.value).join('');
            console.log(code);
            if (code.length === inputs.length) {
                $.ajax({
                    url: `${baseUrl}/ajax/login.php`,
                    type: 'POST',
                    data: {action: 'verifyOTP', otp: code},
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            alert("Mã xác thực đúng, vui lòng đặt lại mật khẩu mới.");
                            window.location.href = '?page=reset-password';
                        } else {
                            $('#error-message-otp').text("Mã OTP không đúng hoặc đã hết hạn").show();   
                        }
                    },
                    error: function (response) {
                        $('#error-message-otp').text("Có lỗi xảy ra, vui lòng thử lại.");
                    }
                });
            } else {
                alert("Vui lòng nhập đầy đủ mã xác thực.");
            }
        });
    });