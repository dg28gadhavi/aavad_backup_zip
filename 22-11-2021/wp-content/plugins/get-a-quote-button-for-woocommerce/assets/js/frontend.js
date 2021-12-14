+(function($) {
    var WPB_Quote_Button = {

        initialize: function() {
            $('.wpb-get-a-quote-button-form-fire').on('click', this.FireContactForm);
        },

        FireContactForm: function(e) {
            e.preventDefault();

            var button  = $(this),
            id          = button.attr('data-id'),
            post_id     = button.attr('data-post_id'),
            form_style  = button.attr('data-form_style') ? !0 : !1,
            width       = button.attr('data-width');

            wp.ajax.send( {
                data: {
                    action: 'fire_contact_form',
                    contact_form_id: id,
                    wpb_post_id: post_id,
                    _wpnonce: WPB_GQB_Vars.nonce
                },
                beforeSend : function ( xhr ) {
					button.addClass('wpb-gqf-btn-loading');
				},
                success: function( res ) {
                    button.removeClass('wpb-gqf-btn-loading');
                    Swal.fire({
                        html: res,
                        showConfirmButton: false,
                        customClass: {
                            container: 'wpb-gqf-form-style-' + form_style,
                        },
                        padding: '30px',
                        width: width,
                        showCloseButton: true,
                    });

                    
                    // For CF7 5.3.1 and before
                    if ($.isFunction(wpcf7.initForm)) {
                        wpcf7.initForm( $('.wpcf7-form') );
                    }

                    // For CF7 5.4 and after
                    if ($.isFunction(wpcf7.init)) {
                        document.querySelectorAll(".wpcf7 > form").forEach(function (e) {
                            return wpcf7.init(e);
                        });
                    }
                },
                error: function(error) {
                    alert( error );
                }
            });
        },


    };

    $(function() {
        WPB_Quote_Button.initialize();
    });


    /**
     * Hide if variation has no stock 
     */
    
    $(document).on( 'found_variation', 'form.variations_form', function( event, variation ) { 
        if( !variation.is_in_stock ){
            $('.wpb-gqb-product-type-variable').addClass('wpb-gqb-product-type-variable-show');
        }else{
            $('.wpb-gqb-product-type-variable').removeClass('wpb-gqb-product-type-variable-show');
        }
    });

    $(document).on( 'click', '.reset_variations', function( event ) {
        $('.wpb-gqb-product-type-variable').removeClass('wpb-gqb-product-type-variable-show');
    });

})(jQuery);