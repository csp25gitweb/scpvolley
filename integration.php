<?php

require('integration_header.html');

switch($_GET['page']) {
	case 'home':
		require('integration_home.html');
	break;

	case 'contact':
		require('integration_contact.html');
	break;

	case 'actu':
		require('integration_actu.html');
	break;
}

require('integration_footer.html');