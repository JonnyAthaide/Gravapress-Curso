jQuery(document).ready(function($){

	$.post(ajaxurl, {

		action: 'gravapress_update_profile'

	}, function(response) {

		console.log( 'AJAX success!' );

	});

});