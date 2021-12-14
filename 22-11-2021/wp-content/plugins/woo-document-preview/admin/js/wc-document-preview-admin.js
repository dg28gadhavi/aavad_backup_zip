(function ($) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	$(function () {
				
		$(document).on( "click", ".wcdp-add-document-cl" , function(e){		
            var woo_audio_tr = '<tr class="wcdp-document-file"><td class="sort"></td><td class="file_name"><input class="input_text" placeholder="File Name" name="wcdp_documents[wcdp_file_names][]" value="" type="text"></td><td class="file_url"><input id="wcdp_file_urls" class="input_text" placeholder="http://" name="wcdp_documents[wcdp_file_urls][]" value="" type="text"></td><td class="file_url_choose" width="1%"><input type="file" id="wcdp_preview_attachment" name="wcdp_documents[wcdp_preview_attachment][]" value="" size="25"/></td><td width="15%"><a href="javascript:void(0)"  class="wcdp-add-document-cl">Add</a>&nbsp;<a href="javascript:void(0)" class="wcdp-delete-document-cl" id="wcdp-delete-document-id">Remove</a></td></tr>'; 
			$('.woo-document-preview-table tbody').append(woo_audio_tr);			
        });
			
		
		$(document).on( "click", ".wcdp-delete-document-cl" , function(e){		
			$(this).parents('tr').remove();
			
			/*$( '.preview_files p.wcap-del-msg' ).text( '' );
			var file_url = $( this ).data().file;
			var p_id     = $( this ).data().p_id;
			var data     = {
				'action': 'wcdp_delete_document_ajax',
				'file_url': file_url,
				'p_id': p_id,
			};
			// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
			// global: wcdp_ajax_object 
			$.post(
				wcdp_ajax_object.ajax_url, data, function (response) {
					$( '.wcdp-preview-tr .wcdp-document-file .file_url .input_text' ).val( '' );
					$( '.wcdp-preview-tr .wcdp-document-file .file_name .input_text' ).val( '' );
					if (response != '') {
						$( '.preview_files p.wcdp-del-msg' ).text( 'File Removed Successfully.' ).show();
					}
				}
			);
			*/
		});
		$( 'body.post-type-product form#post' ).on(
			'submit', function () {
				if ($( '#wcdp_preview_attachment' ).val() != '') {
					var fext = $( '#wcdp_preview_attachment' ).val().split( '.' ).pop().toLowerCase();
					if ($.inArray( fext, ['pdf','doc','docx','xlsx'] ) == -1) {
						$( '.preview_files p.wcdp-del-msg' ).text( "The file type that you've uploaded is invalid. Please upload given file type documents." ).show();
						$( ".wcdp-document-file .file_url_choose #wcdp_preview_attachment" ).addClass( "focused" );
						$( 'html, body' ).animate(
							{
								scrollTop: ($( '#wcdp_preview_attachment' ).offset().top)
							}, 500
						);
						return false;
					}
				}
				if ($( '#wcdp_file_urls' ).val() != '') {
					var ext = $( '#wcdp_file_urls' ).val().split( '.' ).pop().toLowerCase();
					if ($.inArray( ext, ['pdf','doc','docx','xlsx'] ) == -1) {
						$( '.preview_files p.wcdp-del-msg' ).text( "The file type that you've uploaded is invalid. Please upload given file type documents." ).show();
						$( ".wcdp-document-file td.file_url #wcdp_file_urls" ).addClass( "focused" );
						$( 'html, body' ).animate(
							{
								scrollTop: ($( '#wcdp_file_urls' ).offset().top)
							}, 500
						);
						return false;
					}
				}
			}
		);
	});
	
})( jQuery );
