(function( $ ) {
	
	function showModal(title, content, title_close_button, callback_valid = null, title_valid_button = 'Valider') {
		$('#scp_modal_title').html(title);
		$('#scp_modal_content').html(content);
		$('#scp_modal_close_button').html(title_close_button);
		
		if(callback_valid != null) {
			$('#scp_modal_valid_button')
				.html(title_valid_button)
				.show()
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
	
	function testCallback() {
		console.log('test callback');
	}
	
	showModal('test', '<p><strong>test</strong> contenu</p>', 'titre bouton close', 'testCallback', 'override titre valider');

})( jQuery );