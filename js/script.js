(function( $ ) {
    $.showModal = function(title, content, title_close_button, callback_valid = '', title_valid_button = 'Valider') {
        $('#scp_modal_title').html(title);
        $('#scp_modal_content').html(content);
        $('#scp_modal_close_button').html(title_close_button);

        if(callback_valid != '') {
            $('#scp_modal_valid_button')
                .html(title_valid_button)
                .removeClass('hidden')
                .click(function() {
                    eval(callback_valid + '()');

                    $(this)
                        .prop('disabled', true)
                        .html('Chargement...')
                    ;

                    $('#scp_modal_close_button').prop('disabled', true);
                    $('#scp_modal_close_button_small').hide();
                })
            ;
        }

        $('#scp_modal').modal({backdrop: 'static', keyboard: false}); 
    }

})( jQuery );



