var PODLOVE = PODLOVE || {};

(function($) {
	$(document).ready( function() {
		$("._podlove_contributor_notifications_triangle").on( 'click', function() {
			$( this ).hide();
			$( this ).parent().find( '._podlove_contributor_notifications_triangle_expanded' ).show();
			$( this ).parent().parent().find( '._podlove_contributor_notifications_template' ).show();
		});
		$("._podlove_contributor_notifications_triangle_expanded").on( 'click', function() {
			$( this ).hide();
			$( this ).parent().find( '._podlove_contributor_notifications_triangle' ).show();
			$( this ).parent().parent().find( '._podlove_contributor_notifications_template' ).hide();
		});
	});
}(jQuery));