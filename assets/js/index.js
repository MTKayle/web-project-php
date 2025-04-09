document.addEventListener('DOMContentLoaded', function() {
    // Initialize all dropdowns
    var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
    var dropdownList = dropdownElementList.map(function(dropdownToggleEl) {
        return new bootstrap.Dropdown(dropdownToggleEl)
    })

    // Optional: Add manual toggle behavior if needed
    document.querySelectorAll('.nav-item.dropdown').forEach(function(dropdown) {
        dropdown.addEventListener('click', function(e) {
            if (window.innerWidth < 992) { // Only for mobile view
                if (e.target.classList.contains('dropdown-toggle')) {
                    e.preventDefault();
                    e.stopPropagation();

                    // Find the dropdown menu within this nav item
                    const dropdownMenu = this.querySelector('.dropdown-menu');

                    // Toggle the show class
                    if (dropdownMenu.classList.contains('show')) {
                        dropdownMenu.classList.remove('show');
                    } else {
                        // Close all other dropdowns first
                        document.querySelectorAll('.dropdown-menu.show').forEach(function(menu) {
                            menu.classList.remove('show');
                        });
                        dropdownMenu.classList.add('show');
                    }
                }
            }
        });
    });
});