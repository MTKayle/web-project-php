document.addEventListener('DOMContentLoaded', function() {
    // Get the toggle button and sidebar
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    const sidebar = document.querySelector('.sidebar');
    
    // Handle toggle button click
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
        });
    }
    
    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(event) {
        const sidebarMenu = document.getElementById('sidebarMenu');
        
        // Check if sidebar is open on mobile and click is outside
        if (window.innerWidth < 992 && 
            sidebarMenu.classList.contains('show') && 
            !sidebar.contains(event.target) &&
            !sidebarToggle.contains(event.target)) {
            
            // Create a new bootstrap collapse instance and hide it
            const bsCollapse = new bootstrap.Collapse(sidebarMenu);
            bsCollapse.hide();
        }
    });
    
    // Handle resize events
    window.addEventListener('resize', function() {
        const sidebarMenu = document.getElementById('sidebarMenu');
        
        // If window is resized to desktop view, ensure sidebar is visible
        if (window.innerWidth >= 992) {
            sidebar.classList.remove('collapsed');
            sidebarMenu.classList.add('show');
        }
    });
});



