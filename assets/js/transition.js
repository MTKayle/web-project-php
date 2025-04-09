window.addEventListener("DOMContentLoaded", function() {
    document.body.classList.add("page-loaded");
});

// Lắng nghe click vào các link
document.querySelectorAll("a[href]").forEach(function(link) {
    link.addEventListener("click", function(e) {
        const href = this.getAttribute("href");

        // Bỏ qua các link đặc biệt
        if (
            href.startsWith("#") ||
            href.startsWith("javascript:") ||
            this.target === "_blank"
        ) return;

        e.preventDefault(); // Ngăn chuyển trang ngay lập tức

        // Bắt đầu hiệu ứng fade out
        document.body.classList.remove("page-loaded");

        setTimeout(function() {
            window.location.href = href;
        }, 400); // Delay phải trùng với CSS transition
    });
});