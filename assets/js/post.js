 $(document).ready(function () {
    // Đăng bài viết
    $('#postForm').submit(function (e) {
        e.preventDefault();
        
        const title = $('#titleInput').val().trim();
        const content = $('#contentInput').val().trim();
        
        if (!title || !content) {
            alert("Vui lòng nhập đầy đủ tiêu đề và nội dung.");
            return;
        }

        const formData = new FormData(this);
        
        $.ajax({
            url: `${baseUrl}/ajax/post.php`,
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function (response) {
                alert("Đăng bài thành công!");
                location.reload();
            },
            error: function () {
                alert("Có lỗi xảy ra. Vui lòng thử lại.");
            }
        });
    });

    // Hủy bài viết
    $('#cancelButton').on('click', function () {
        if (confirm("Bạn có chắc muốn hủy bài viết này không?")) {
            $('#titleInput').val('');
            $('#contentInput').val('');
        }
    });
});