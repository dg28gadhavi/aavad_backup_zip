<?php /*
Plugin Name: Page Loader
Plugin URI:  http://tdevs.com
Description: Page Loader is a free Wordpress plugin to show an loader animation while page is being loaded.
Version:     1.1
Author:      tDevs	
Author URI:  http://tdevs.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
 
Page Loader is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
Page Loader is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with Loading Animation. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/

function pl_include_files()
{
    wp_enqueue_script( 'pl-script', plugins_url( 'script.js', __FILE__ ) );
    wp_enqueue_style('pl-style', plugins_url('style.css',__FILE__ ));
}
add_action( 'wp_enqueue_scripts', 'pl_include_files' );


function page_loader() {
?>
<div id="plcover" style="background: <?php
$backgroundcolor = esc_attr( get_option('background_color') );
if (empty($backgroundcolor)) { echo '#ffffff'; } else { echo $backgroundcolor; }
?>">
<div id="plcontent">
<div class="<?php
$loadericon = esc_attr( get_option('loader_icon') );
if (empty($loadericon)) { echo 'plcircle'; } else { echo $loadericon; }
?>" style="<?php
	    if ( $loadericon == "plcircle" || $loadericon == "plfan" || empty($loadericon)) {
	    echo 'border-color: ';
	    } else if ( $loadericon == "plcircle2" ) {
	    echo 'border-top-color: ';
	    } else {
	    echo 'background: ';
	    }
	    $iconcolor = esc_attr( get_option('icon_color') );
		if (empty($iconcolor)) { echo '#000000'; } else { echo $iconcolor; }
	    ?>;"></div>
</div>
</div>
<?php
}
add_action( 'wp_body_open', 'page_loader', 0 );

add_action( 'wp_footer', function() {
	if (!did_action('wp_body_open')) {
		page_loader();
	}
}, 0 );

include( plugin_dir_path( __FILE__ ) . 'admin.php');

?>