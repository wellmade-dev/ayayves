function fetchContactForm() {
    return new Promise((resolve, reject) => {
        jQuery.ajax({
            url: contact_ajax.ajaxurl,
            type: 'POST',
            data: { action: 'get_contact_form' },
            success: function(response) {
                resolve(response);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                reject('AJAX error in fetchContactForm: ' + textStatus + ' - ' + errorThrown);
            }
        });
    });
}