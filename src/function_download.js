document.addEventListener('DOMContentLoaded', function() {
    var dashboardItems = document.querySelectorAll('.dashboard-item');
    dashboardItems.forEach(function(item) {
        item.addEventListener('click', function() {
            var link = this.querySelector('.invisible-link').getAttribute('href');
            if (link) {
                window.open(link, '_blank');
            }
        });
    });
});