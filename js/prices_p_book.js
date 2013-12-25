var options = {
    type: 'POST',
    url: '/prices/p_book/',
    beforeSubmit: function() {
        $('#resutls').html("Deleting...");
    },
    success: function(response) {

        // Whatever is echo'd out from the page we're calling will be
        // returned as the parameter "response".
        // Let's inject that data into the page
        $('#results').html(response);
    }
};

$('form').ajaxForm(options);