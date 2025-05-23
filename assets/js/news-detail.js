$(document).ready(function(){

    const urlParams = new URLSearchParams(window.location.search);
    const newsId = urlParams.get('articleID');

    $.ajax({
        url: `${baseUrl}/ajax/news.php`,
        type: 'POST',
        data: { action: 'getNewsById' , articleID: newsId},
        dataType: 'json',
        success: function(response) {
            // Check if response is success
            console.log(response);
            if (response.success) {
                $('#newsDetail').html(response.response.content);
            } else {
                console.error("Failed to fetch news data.");
            }
        },
        error: function() {
            console.error("Error fetching news data.");
        }
    });

});