$('#refresh-button').click(function() {

    $.ajax({
        type: 'POST',
        url: '/posts/p_settings_delete_delete',
        success: function(response) {

        }
    });
});