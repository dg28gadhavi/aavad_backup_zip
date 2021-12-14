<?php
if (!defined('ABSPATH')) {
    die('No direct access allowed');
}

function amazingcontent_admin_pages()
{
//getting all settings
    $amazing_content_protector = get_option('amazing_content_protector');
//sanitize all post values
    if (isset($_POST['acp_nonce_submit'])) {
        $acp_nonce_submit = sanitize_text_field($_POST['acp_nonce_submit']);
        if ($acp_nonce_submit != '') {
            $amazing_content_protector = sanitize_text_field($_POST['amazing_content_protector']);
            $saved                     = sanitize_text_field($_POST['saved']);
            if (isset($amazing_content_protector)) {
                update_option('amazing_content_protector', $amazing_content_protector);
            }
            if ($saved == true) {
                echo ' <div class="updated"><p><strong>Settings Saved.</strong></p></div>';
            }
        }
    }

    ?>

 <div class="wrap">
    <div class="postbox4">
        <h3>General Settings</h3>
        <div class="acp_block">
            <label>Amazing Content Protector Free is to Automatically Protect the Website Content<br/><br/>
                 Basically this Plugin Disable the Control Keys like <br/><br/></label>

                <ul class="acp_protect_list">
                    <li>CTRL+A</li>
                    <li> CTRL+C</li>
                    <li>CTRL+V</li>
                    <li> CTRL+X</li>
                    <li>CTRL+S</li>
                    <li>CTRL+U</li>
                    <li>MOUSE RIGHT CLICK</li>
                </ul>


              <form method="post" id="form_submit" action="">
                <select style="width:250px" name="amazing_content_protector">
                    <option value='acp_enable' <?php if ($amazing_content_protector == 'acp_enable') {echo "selected='selected'";}?>>Enable
                    <option value='acp_disable' <?php if ($amazing_content_protector == 'acp_disable') {echo "selected='selected'";}?>>Disable</option>
                    </option>
                </select>

                <input type="hidden" name="saved"  value="saved"/>
                <input type="submit" name="acp_nonce_submit" class="button-primary" value="Save Changes" />
                <?php if (function_exists('wp_nonce_field')) {
        wp_nonce_field('acp_nonce_submit', ' acp_nonce_submit');
    }
    ?>
             </form>

        </div>
    </div>
</div>
    <?php

}
?>

