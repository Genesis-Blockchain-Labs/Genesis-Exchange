<?php include('includes/left_sidebar.php');  ?>


	<div id="primary" class="content-area">
		<main id="main" class="site-main container" role="main">

			
<article id="post-2198" class="post-2198 page type-page status-publish hentry">
	<header class="entry-header">
		<h1 class="entry-title">2FA</h1>	</header><!-- .entry-header -->

	<div class="entry-content">
		
				<div class="crsh-md-wrapper">
					<div class="crsh-md-row">
			
						<div class="ee-wrap">
							<div class="ee-section">
								<div class="ee-col-1-1">
	
									
									<h2>What is two-factor authentication?</h2>
									
									Protect your account from unauthorized access by enabling two-factor authentication.<br />
									When two-factor authentication is active you need to enter a one time code every time you log in.<br /><br />
									
									<img src="https://mybettercoin.com/office/wp-content/uploads/2017/12/mybet-2fa.png" />	<br /><br />
									
									<h2>Set up mobile app based two-factor authentication</h2>
									<ol>
										<li>
											Download the Google Authenticator app for your mobile phone or tablet: 
											<a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2" target="_blank">Android</a>, 
											<a href="https://itunes.apple.com/us/app/google-authenticator/id388497605?mt=8" target="_blank">iPhone, iPad and iPod</a> or 
											<a href="http://www.windowsphone.com/en-us/store/app/authenticator/e7994dbc-2336-4950-91ba-ca22d653759b" target="_blank">Windows Phone</a>.
										</li>
										<li>
											Your backup code is: <strong>KY2OJVF3QUDHXBF6</strong><br />
											<strong>Important!</strong> Write this code down on a piece of paper and store it safe. You will need it if you lose your phone, or you will be locked out of your account.
										</li>
										<li>
											Launch the authenticator app on your mobile device. Find the scan a barcode function in the app and scan the barcode below.<br /><br />
											
											<img src="https://chart.googleapis.com/chart?chs=200x200&chld=M|0&cht=qr&chl=otpauth%3A%2F%2Ftotp%2Fimmanet.mukesh%40gmail.com%3Fsecret%3DKY2OJVF3QUDHXBF6%26issuer%3DMYBETTERCOIN" /><br /><br />										
										</li>
										<li>
											Enter the authentication code given by your mobile app in the form below and press "Enable 2-FA" button.
										</li>
									</ol>
	
								</div>
							</div>
						</div>
						<div class="ee-wrap">
							<div class="ee-section">
								<div class="ee-col-1-1">
									<div id="crsc-form-ajax-submit-feedback"></div>
								</div>
							</div>
						</div>
						<div class="ee-wrap">
							<div class="ee-section">
								<div class="ee-col-1-1">		
									<form action="https://mybettercoin.com/office/wp-admin/admin-ajax.php" class="crsc_ajax_submit_form" method="post">						
										<input type="hidden" id="crscsf_nonce_field" name="crscsf_nonce_field" value="b6fcbd5999" />							
										<input type="hidden" name="action" value="crsc_ajax_submit_form"/>
										<input type="hidden" name="subaction" value="crsc_2fa_form_submision"/>
										
										<input type="hidden" name="task" value="enable"/>
										
										<label for="name">Authentication key*</label>
										<input name="2fa-secret" type="text" value="KY2OJVF3QUDHXBF6" readonly /><br />
										
										<label for="email">6 digit Authentication code*</label>
										<input name="2fa-code" type="text" value="" maxlength="6" /><br />
										
										<input name="confirm" type="checkbox" value="1" /><label for="phone">I have written down my backup code <strong>KY2OJVF3QUDHXBF6</strong> on paper</label><br />
										
										<input type="submit" value="Enable 2-FA">
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			
<p><!--<span style="font-size:18px; color:#ff0000">NOTE: <u>If you enable 2FA, *DO NOT* logout without scanning your QR code</u>!
You won't be able to log back into your account!</span>

[twofactor_user_settings]--></p>
	</div><!-- .entry-content -->

	</article><!-- #post-## -->

		</main><!-- #main -->
	</div><!-- #primary -->


	</div><!-- #content -->

</div><!-- #page -->

<script type='text/javascript' src='https://mybettercoin.com/office/wp-content/plugins/contact-form-7/includes/js/scripts.js'></script>
<script type='text/javascript' src='https://mybettercoin.com/office/wp-content/plugins/wp-user-manager/assets/js/wp_user_manager.min.js?ver=1.4.3'></script>
<script type='text/javascript' src='https://mybettercoin.com/office/wp-content/plugins/wp-user-manager/assets/js//vendor/hideShowPassword.min.js?ver=1.4.3'></script>
<script type='text/javascript' src='https://www.google.com/recaptcha/api.js?ver=1.1.0'></script>
<script type='text/javascript' src='https://mybettercoin.com/office/wp-content/themes/fotografo/js/navigation.js?ver=20151215'></script>
<script type='text/javascript' src='https://mybettercoin.com/office/wp-content/themes/fotografo/js/tether.js?ver=20151215'></script>
<script type='text/javascript' src='https://mybettercoin.com/office/wp-content/themes/fotografo/js/bootstrap.js?ver=20151215'></script>
<script type='text/javascript' src='https://mybettercoin.com/office/wp-includes/js/wp-embed.min.js'></script>
<script>
(function( $ ) {
    "use strict"; 
    // javascript code here. i.e.: $(document).ready( function(){} ); 
	 $( "#menu-toogle" ).click(function() {
		$( ".nav-panel" ).toggleClass( "active" );
	});
})(jQuery);
</script>
</body>
</html>
