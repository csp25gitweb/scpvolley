(function( $ ) {
	var notify;
	
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
	
	$.hideModal = function() {
		$('#scp_modal_valid_button')
			.addClass('hidden')
			.removeProp('disabled')
			.off()
		;
		$('#scp_modal_close_button').removeProp('disabled');
		$('#scp_modal_close_button_small').show();
		$('#scp_modal').modal('hide');
	}
	
	$.showNotify = function(type, title) {
		var icon;
		switch(type) {
			case 'success':
				icon = 'fa-chevron-circle-down';
			break;
			case 'info':
				icon = 'fa-info-circle';
			break;
			case 'warning':
				icon = 'fa-exclamation-circle';
			break;
			case 'danger':
				icon = 'fa-bomb';
			break;
		}
		notify = $.notify({
			icon: 'fa fa-2x ' + icon,
			message: title
		},{
			type: type,
			mouse_over: 'pause',
			placement: {
				from: 'bottom',
				align: 'center'
			},
			animate: {
				enter: 'animated fadeIn',
				exit: 'animated fadeOut'
			}
		});
	}
	
	$.hideNotify = function() {
		notify.close();
	}
	
	$.showCalendar = function(listEvents) {
		$('#calendar').fullCalendar({
			header: {
			  left: 'prev,next today',
			  center: 'title',
			  right: 'month,listWeek,listDay'
			},
			locale: 'fr',
			navLinks: true,
			eventLimit: true,
			events: listEvents
		});
	}

})( jQuery );

if($('#calendar').length) {
    
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            
            var myEvents = JSON.parse(this.response);
            $.showCalendar(myEvents);
        }
    };

    xhttp.open("POST", "index.php?controller=agenda&action=getAll", true);
    xhttp.send();
}