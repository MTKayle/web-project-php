$(document).ready(function() {
    //register
    $('#registerForm').submit(function(event){
        // Prevent default form submission
        console.log("Sự kiện submit đã được kích hoạt!");
        event.preventDefault();
        console.log("Sự kiện submit đã được kích hoạt! đshsg");

        //Get form data
        const password = $('#password').val();
        const confirmPassword = $('#confirmPassword').val();
        const submitButton = $('#register-button');

        // if (!submitButton.data("original-text")) {
        //     submitButton.data("original-text", submitButton.html());
        // }

        // Check if password and confirm password not match
        if (password !== confirmPassword) {
            $('#error-message-register').text("Mật khẩu nhập lại không khớp.").show();
            return;
        }

        // Serialize form data => JSON
        const formData = $(this).serialize();
        console.log(formData);
        // setLoadingState(submitButton, true);

        // Send AJAX request (call API)
        console.log("Base URL:", baseUrl);
        $.ajax({
            url: `${baseUrl}/ajax/register.php`,
            type: 'POST',
            data: formData,
            //type of data we are expecting in return
            dataType: 'json',
            //if success
            success: function(response) {
                // Check if response is success
                console.log(response);
                if (response.success) {
                    $('#error-message-register').hide();
                    $('#success-message-register').text("Đăng ký thành công! Chuyển hướng...").show();

                    // Tạo giỏ hàng sau khi đăng ký
                    $.ajax({
                        url: `${baseUrl}/ajax/cart.php`,
                        type: 'POST',
                        data: { 
                            action: 'create',
                            userID: response.userID
                        },
                        success: function(cartRes) {
                            console.log("Giỏ hàng đã được tạo:", cartRes);
                        },
                        error: function() {
                            console.error("Không thể tạo giỏ hàng");
                        }
                    });
                    // Redirect to login page after 2 seconds
                    setTimeout(() => {
                        window.location.href = "?page=login";
                    }, 2000);
                    //window.location.href = "?page=login";
                } else{
                    $('#error-message-register').text(response.message).show();
                    // setLoadingState(submitButton, false);
                }
            },
            //if error
            error: function() {
                $('#error-message-register').hide();
                $('#error-message-register').text('Lỗi hệ thống, thử lại sau!').show();
                // setLoadingState(submitButton, false);
            }
        });
    });

    

    // function getCookie(name) {
    //     let cookies = document.cookie.split('; ');
    //     for (let i = 0; i < cookies.length; i++) {
    //         let cookie = cookies[i].split('=');
    //         if (cookie[0] === name) {
    //             return decodeURIComponent(cookie[1]);
    //         }
    //     }
    //     return null;
    // }

    // $('#login-button-header').click(function(event){
    //     // Prevent default form submission
    //     console.log("Sự kiện đã được kích hoạt!");
    //     let savedEmail = getCookie("email");
    //     let savedPassword = getCookie("password");
        
    //     if (savedEmail) {
    //         document.getElementById("email").value = savedEmail;
    //     }
    //     if (savedPassword) {
    //         document.getElementById("password").value = savedPassword;
    //     }
    // });

    // document.addEventListener("DOMContentLoaded", function () {
    //     if (window.location.pathname.includes("login.php")) {
    //         function getCookie(name) {
    //             let cookies = document.cookie.split(';');
    //             for (let i = 0; i < cookies.length; i++) {
    //                 let cookie = cookies[i].trim();
    //                 if (cookie.startsWith(name + "=")) {
    //                     return decodeURIComponent(cookie.substring(name.length + 1));
    //                 }
    //             }
    //             return "";
    //         }

    //         // Lấy email và password từ cookie
    //         let savedEmail = getCookie("email");
    //         let savedPassword = getCookie("password");

    //         // Tự động điền vào form đăng nhập nếu có cookie
    //         if (savedEmail) {
    //             document.getElementById("email").value = savedEmail;
    //         }
    //         if (savedPassword) {
    //             document.getElementById("password").value = savedPassword;
    //         }
    //     }

        
    // });

    // document.addEventListener("DOMContentLoaded", function () {
    //     // Kiểm tra nếu trang có query string ?page=account
    //     if (window.location.search.includes("page=login")) {
    //         // Đoạn mã này sẽ chạy khi tham số ?page=account có trong URL
    //         console.log("Trang có tham số ?page=account đã được tải.");
    
    //         function getCookie(name) {
    //             let cookies = document.cookie.split(';');
    //             for (let i = 0; i < cookies.length; i++) {
    //                 let cookie = cookies[i].trim();
    //                 if (cookie.startsWith(name + "=")) {
    //                     return decodeURIComponent(cookie.substring(name.length + 1));
    //                 }
    //             }
    //             return "";
    //         }
        
    //         // Hàm điền thông tin vào form nếu có cookie
    //         function autoFillForm() {
    //             let savedEmail = getCookie("email");
    //             let savedPassword = getCookie("password");
        
    //             if (savedEmail) {
    //                 document.getElementById("email").value = savedEmail;
    //             }
    //             if (savedPassword) {
    //                 document.getElementById("password").value = savedPassword;
    //             }
    //         }
        
    //         // Gọi hàm tự động điền thông tin khi trang được tải
    //         autoFillForm();
    //     }
        
    // });
    

    //login
    $('#loginForm').submit(function(event){
        // Prevent default form submission
        console.log("Sự kiện submit đã được kích hoạt!");
        event.preventDefault();


        // Serialize form data => JSON
        const formData = $(this).serialize();
        console.log(formData);

        // Send AJAX request (call API)
        console.log("Base URL:", baseUrl);
        $.ajax({
            url: `${baseUrl}/ajax/login.php`,
            type: 'POST',
            data: formData,
            //type of data we are expecting in return
            dataType: 'json',
            //if success
            success: function(response) {
                // Check if response is success
                console.log(response);
                if (response.success) {
                    $('#userID').val(response.user.id);
                    $('#error-message-login').hide();
                    $('#success-message-login').text("Đăng nhập thành công! Chuyển hướng...").show();
                    // Redirect to login page after 2 seconds
                    setTimeout(() => {
                        window.location.href = "./";
                    }, 2000);
                } else{
                    $('#error-message-login').text(response.message).show();
                }
            },
            //if error
            error: function() {
                $('#error-message-login').hide();
                $('#error-message-login').text('Lỗi hệ thống, thử lại sau!').show();
            }
        });
    });

    const logoutButton = document.getElementById("logout-button");

    logoutButton.addEventListener("click", function (e) {
        console.log("Sự kiện đã được kích hoạt!");
        e.preventDefault();
        console.log("Sự kiện đã được kích hoạt! 2");

        if (!confirm("Bạn có chắc chắn muốn đăng xuất?")) return;

        $.ajax({
            url: `${baseUrl}/ajax/logout.php`,
            type: "POST",
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    console.log("Đăng xuất thành công!");
                    window.location.href = "./";
                } else {
                    console.error("Đăng xuất không thành công!");
                }
            },
            error: function () {
                console.error("Lỗi hệ thống khi đăng xuất!");
            }
        });
    });
        
    
});