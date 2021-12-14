<?php

function pl_admin_include_files()
{
    wp_enqueue_script('pl-script', plugins_url( 'script.js', __FILE__ ));
    wp_enqueue_style('pl-style', plugins_url('style.css',__FILE__ ));
	wp_enqueue_style( 'wp-color-picker' ); 
    wp_enqueue_script( 'pl-color-picker-js', plugins_url( 'pl-color-picker.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
}
add_action( 'admin_enqueue_scripts', 'pl_admin_include_files' );

add_action( 'admin_menu', 'page_loader_menu' );

function page_loader_menu() {
	add_options_page( __('Page Loader','page-loader'), __('Page Loader Setting','page-loader'), 'manage_options', 'page-loader-setting', 'page_loader_admin' );
	add_action( 'admin_init', 'register_page_loader_settings' );
}

function register_page_loader_settings() {
	register_setting( 'page-loader-options', 'icon_color' );
	register_setting( 'page-loader-options', 'background_color' );
	register_setting( 'page-loader-options', 'loader_icon' );
}

function page_loader_admin() {
	?>
	
	<div class="wrap page-loader-options-wrap">
	
	<h1>Page Loader</h1>
	
	<p>Here you can manage options of Page Loader plugin.</p>
	
	<form method="post" action="options.php">
    <?php settings_fields( 'page-loader-options' ); ?>
    <?php do_settings_sections( 'page-loader-options' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Loader Icon Color</th>
        <td><input type="text" name="icon_color" class="pl-color-picker" data-default-color="#000000" value="<?php echo esc_attr( get_option('icon_color') ); ?>" /></td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Background Color</th>
        <td><input type="text" name="background_color" class="pl-color-picker" data-default-color="#ffffff" value="<?php echo esc_attr( get_option('background_color') ); ?>" /></td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Loader Icon</th>
        <td>
            <select name="loader_icon">
                <option value="plcircle" <?php selected( esc_attr( get_option('loader_icon') ), 'plcircle' ); ?>>Loader 1</option>
                <option value="plcircle2" <?php selected( esc_attr( get_option('loader_icon') ), 'plcircle2' ); ?>>Loader 2</option>
                <option value="plfan" <?php selected( esc_attr( get_option('loader_icon') ), 'plfan' ); ?>>Loader 3</option>
                <option value="plsqaure" <?php selected( esc_attr( get_option('loader_icon') ), 'plsqaure' ); ?>>Loader 4</option>
                <option value="pldrop" <?php selected( esc_attr( get_option('loader_icon') ), 'pldrop' ); ?>>Loader 5</option>
            </select>
        </tr>
    </table>
    
    
    <?php submit_button(); ?>

    </form>
    
    <h1>Page Loader Preview:</h1>
	<div id="pl-preview-box" style="background: <?php echo esc_attr( get_option('background_color') ) ?>; padding: 50px; display: inline-block; margin-bottom: 10px;">
	    <div class="<?php echo esc_attr( get_option('loader_icon') ) ?>" style="<?php
	    $icon = esc_attr( get_option('loader_icon') );
	    if ( $icon == "plcircle" || $icon == "plfan" ) {
	    echo 'border-color: ';
	    } else if ( $icon == "plcircle2" ) {
	    echo 'border-top-color: ';
	    } else {
	    echo 'background: ';
	    }
	    echo esc_attr( get_option('icon_color') );
	    ?>;"></div>
	</div>
    
	
	</div>
	
	<script>
	    
	    jQuery(document).ready(function($){
	        function updatepreview() {
	            var loadericon = $('select[name=loader_icon]').val();
                $('#pl-preview-box div').attr('class', loadericon);
                var backgroundcolor = $('input[name=background_color]').val();
                $('#pl-preview-box').css('background', backgroundcolor);
                var iconcolor = $('input[name=icon_color]').val();
                if ( (loadericon == "plcircle") || (loadericon == "plfan") ) {
                    $('#pl-preview-box div').css('border-color', iconcolor);
                    $('#pl-preview-box div').css('background', 'transparent');
                } else if( (loadericon == "plcircle2") ) {
                    $('#pl-preview-box div').css('border-color', 'rgba(0, 0, 0, 0.1)');
                    $('#pl-preview-box div').css('border-top-color', iconcolor);
                    $('#pl-preview-box div').css('background', 'transparent');
                } else {
                    $('#pl-preview-box div').css('background', iconcolor);
                    $('#pl-preview-box div').css('border-color', 'transparent');
                }
                
	        }
            $('.page-loader-options-wrap form, .page-loader-options-wrap input, .page-loader-options-wrap select').change(function() { updatepreview(); });
			setTimeout(function() { updatepreview() }, 2000);
        });
        
	</script>
	
	<?php
}

?>