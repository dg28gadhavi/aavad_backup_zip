<?php
global $wp_version ;
?>
<div class="mystickyelement-new-widget-wrap">
	<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins" />	
	<h2 class="text-center"><?php esc_html_e( 'Upgrade to Pro and connect your My Sticky Elements form to the following platforms. Your leads will be synced with the selected platforms', 'mystickyelements' ); ?></h2>
	<div class="mystickyelement-new-widget-row">
		<div class="mystickyelement-features">
			<ul>
				<li>
					<div class="elements-int-container mystickyelement-feature">
						<div class="mystickyelement-feature-top">
							<img src="<?php echo MYSTICKYELEMENTS_URL ?>/images/mailchimp.png" />
						</div>
						<div class="feature-title">Connect your forms to MailChimp</div>
						<div id="elements-int-container-content feature-description">
							<p>
							<a href="#" class="integrate-element-form button-primary  ">
								<?php echo 'Connect to MailChimp';?>
							</a>
							</p>
						</div>
					</div>
					<div class="mystickyelement-integration-button">
						<a href="<?php echo esc_url(admin_url("admin.php?page=my-sticky-elements-upgrade")); ?>" class="new-upgrade-button" target="blank">Upgrade to Pro</a>
					</div>
				</li>
				<li>
					<div class="elements-int-container mystickyelement-feature">
						<div class="mystickyelement-feature-top">
							<img src="<?php echo MYSTICKYELEMENTS_URL ?>/images/mailpoet.png" />
						</div>
						<div class="feature-title">Connect your forms to MailPoet</div>
						<div id="elements-int-container-content feature-description">
							<?php							
							$admin_message = '';
							$activation_url = '#';
								
							$admin_message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, esc_html__( 'Connect to MailPoet' ) ) . '</p>';
							
							echo $admin_message;
							
							?>			
						</div>
					</div>
					<div class="mystickyelement-integration-button">
						<a href="<?php echo esc_url(admin_url("admin.php?page=my-sticky-elements-upgrade")); ?>" class="new-upgrade-button" target="blank">Upgrade to Pro</a>
					</div>
				</li>
			</ul>
			<div class="clear clearfix"></div>
		</div>
		<a href="<?php echo esc_url(admin_url("admin.php?page=my-sticky-elements-upgrade")); ?>" class="new-upgrade-button" target="blank">Upgrade to Pro</a>
	</div>	
</div>

<style>
*, ::after, ::before {
    box-sizing: border-box;
}
/*New Widget Page css*/
.mystickyelement-new-widget-wrap {
    border-radius: 10px;
    padding: 10px;
    margin: 40px auto 0 auto;
    background-size: auto 100%;
    width: 100%;
    max-width: 776px;
    background: #fff url("../images/bg.png") right bottom no-repeat;
    font-family: 'Poppins';
    line-height: 20px;
}

.mystickyelement-new-widget-wrap h2 {
    font-style: normal;
    font-weight: 600;
    font-size: 20px;
    line-height: 30px;
    color: #1E1E1E;
    margin: 15px 0;
}
.mystickyelement-features ul {
    margin: 0;
    padding: 0;
}
.mystickyelement-features ul li {
    margin: 0;
    width: 50%;
    float: left;
    padding: 10px;
	position: relative;
}
.mystickyelement-feature {
    margin: 30px 0 0 0;
    background: #FFFFFF;
    border: 1px solid #605DEC;
    box-sizing: border-box;
    border-radius: 4px;
    padding: 30px 15px 10px 15px;
    min-height: 140px;
    position: relative;
}
.mystickyelement-feature.second {
    min-height: 155px;
}
.feature-title {
    font-family: Poppins;
    font-style: normal;
    font-weight: bold;
    font-size: 13px;
    line-height: 18px;
    color: #1E1E1E;
}
.feature-description {
    font-family: Poppins;
    font-style: normal;
    font-weight: normal;
    font-size: 13px;
    line-height: 18px;
    color: #1E1E1E;
}
a.new-upgrade-button {
    height: 40px;
    background: #605DEC;
    border-radius: 100px;
    border: solid 1px #605DEC;
    display: inline-block;
    text-align: center;
    color: #fff;
    line-height: 40px;
    margin: 10px 0 10px 10px;
    padding: 0 25px;
    text-decoration: none;
    text-transform: uppercase;
}
a.new-demo-button {
    height: 40px;
    color: #605DEC;
    border: solid 1px #605DEC;
    border-radius: 100px;
    display: inline-block;
    text-align: center;
    background: #fff;
    line-height: 40px;
    margin: 10px 0 10px 10px;
    padding: 0 25px;
    text-decoration: none;
    width: 165px;
}
.mystickyelement-feature.analytics {
    min-height: 115px;
}
.mystickyelement-feature-top {
    width: 50px;
    height: 50px;
    border: solid 1px #605dec;
    border-radius: 50%;
    position: absolute;
    left: 0;
    right: 0;
    margin: 0 auto;
    top: -25px;
    background: #fff;
    z-index: 11;
    padding: 10px;
}
.mystickyelement-feature-top img {
    width: 100%;
    height: auto;
}

.mystickyelement-features ul li:hover .mystickyelement-integration-button{
	display: block;
}
.mystickyelement-integration-button {
	display: none;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    z-index: 9;
}

</style>