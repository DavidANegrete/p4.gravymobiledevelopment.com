/**
 * Created by davif on 12/17/13.
 */
var options = {
    type: 'POST',
    url: '/users/p_settings_delete_delete/',
    beforeSubmit: function() {
        $('#delete_confirm').html("Deleting...");
    },
    success: function(response) {

        // Whatever is echo'd out from the page we're calling will be
        // returned as the parameter "response".
        // Let's inject that data into the page
        $('#delete_confirm').html(response);
    }
};

$('form').ajaxForm(options);