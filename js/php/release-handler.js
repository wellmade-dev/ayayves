function fetchReleaseData(postId) {
    return new Promise((resolve, reject) => {
        jQuery.ajax({
            url: release_ajax.ajaxurl,
            type: 'POST',
            data: {
                action: 'fetch_release_data',
                post_id: postId
            },
            dataType: 'json',
            success: function(response) {
                resolve(response);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                reject('AJAX error in fetchReleaseData: ' + textStatus + ' - ' + errorThrown);
            }
        });
    });
}