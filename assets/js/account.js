
$(document).ready(function() {
    const email = document.getElementById('session-data').getAttribute('data-email');
    const userID = document.getElementById('session-data').getAttribute('data-userID');
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('page') === 'account') {
        // Logic xử lý cho trang login.php khi có tham số ?page=login
        console.log("Trang login với tham số page đã được mở");
 
        $.ajax({
            url: `${baseUrl}/ajax/account.php`,
            type: 'GET',
            // data: { userID: userID },
            //type of data we are expecting in return
            dataType: 'json',
            //if success
            success: function(response) {
                // Check if response is success
                console.log(response);
                if (response.success) { 
                    $('#email').val(email);
                    $('#fullname').val(response.customer.customerName);
                    $('#phone').val(response.customer.phoneNumber);
                    $('#address').val(response.customer.address);
                    $('#avatar-preview').attr('src', response.customer.avatar);  
                } 
            },
            //if error
            error: function() {
                $('#error-message-updateinfor').hide();
                $('#error-message-updateinfor').text('Lỗi hệ thống, thử lại sau!').show();
            }
        })

        


}

    // Avatar change functionality
    const avatarButton = document.getElementById('avatar-button');
    const avatarInput = document.getElementById('avatar-input');
    const avatarPreview = document.getElementById('avatar-preview');
    
    avatarButton.addEventListener('click', function() {
        avatarInput.click();
    });
    
    avatarInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                avatarPreview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });


    $('#account-form').submit(function(event){
        event.preventDefault();  // Ngừng việc gửi form mặc định

        console.log("Sự kiện submit đã được kích hoạt! update info");

        const formData = new FormData();
        if (avatarInput.files.length > 0) {
            formData.append('avatar', avatarInput.files[0]);
        }  // Thêm ảnh vào FormData

        
        const customerName = document.getElementById('fullname').value;
        const phoneNumber = document.getElementById('phone').value;
        const address = document.getElementById('address').value;
        //const email = document.getElementById('email').value;
        formData.append('customerName', customerName);
        formData.append('phoneNumber', phoneNumber);
        formData.append('address', address);    
        //formData.append('email', email);

        console.log(formData);

        $.ajax({
            url: `${baseUrl}/ajax/account.php`,
            type: 'POST',
            data: formData,
            //type of data we are expecting in return
            dataType: 'json',
            processData: false,  // Ngừng jQuery xử lý dữ liệu tự động
            contentType: false,  // Ngừng jQuery set Content-Type header tự động
            //if success
            success: function(response) {
                // Check if response is success
                console.log(response);
                if (response.success) { 
                    // $('#email').val(email);
                    // $('#fullname').val(response.customer.customerName);
                    // $('#phone').val(response.customer.phoneNumber);
                    // $('#address').val(response.customer.address);
                    // $('#avatar-preview').attr('src', response.customer.avatar);
                    $('#error-message-updateinfo').hide();
                    $('#success-message-updateinfo').text("Cập nhật thông tin thành công!").show();
                } else{
                    $('#error-message-updateinfo').text(response.message).show();
                }
            },
            //if error
            error: function() {
                $('#error-message-updateinfor').hide();
                $('#error-message-updateinfor').text('Lỗi hệ thống, thử lại sau!').show();
            }
        })
    })
});