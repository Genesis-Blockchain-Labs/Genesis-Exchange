<div class="login-box">
	<?php if(isset($type)) { ?>
										<div class="alert alert-info" id="mail_very_fy">
											<span style="font-size: 16px;">
														<?php
															if($type == 'f'){
																echo "Something went wrong";
															}else if($type == 'a'){
																echo "You are already verified";
															}else if($type == 't'){
																echo "Your account has been verified. Please login.";
															}			
														?>
											</span>		
														<button type="button" class="close" onClick="hide_veryfy_div()">&times;</button>			
										</div>
														<?php	}
														
													?>
    <div class="login-panel panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Login</h3>
        </div>
        <div class="panel-body user-settings">
				<?php $action_url = base_url().'do_log';
					$attributes = array('class' => 'form-signin', 'id' => 'submit', 'role'=>'form', 'autocomplete'=>'off');
					echo form_open($action_url, $attributes); 
				?>
					<input type="hidden" id="dfp" name="deviceFingerPrint"> 
					<input type="hidden" id="dft" name="deviceFingerprintTechnology" value="AU">	
											<span id="reauth-email" class="reauth-email"></span>
													<?php if(!empty($error_msg)){ ?>
													<div class="validation-eror">
														<label class="alert">													
												<?php	echo '<a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$error_msg.'';
														?>
														</label>
													</div>
														<?php }   ?>
														
														<?php if(!empty($sucs_msg)){ ?>
													<div class="validation-success-msg">
														<label class="alert">													
														<?php	echo '
												<a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$sucs_msg.'';
														?>
														</label>
													</div>
														<?php }   ?>
											  
                <table class="table table-user-information">
                    <tbody>
									<?php $data = array(
													'name'          => 'ip_address',
													'id'            => 'ip_address',
													'type'         => 'hidden'
											);

											echo form_input($data);	 
									?>
									<?php $data = array(
													'name'          => 'country',
													'id'            => 'country',
													'type'         => 'hidden'
											);

											echo form_input($data);	 
									?>
									<?php $data = array(
													'name'          => 'country_code',
													'id'            => 'country_code',
													'type'         => 'hidden'
											);

											echo form_input($data);	 
									?>
                    <tr>
                        
                    <td><?php $data = array(
													'name'          => 'email',
													'id'            => 'inputEmail',
													'type'         => 'text',
													'value'         => set_value('email'),
													'class'         => 'form-control',
													'placeholder'   => 'E-mail',
											);
											echo form_input($data);	 ?>
											<div class="error-vlidation"><?php echo form_error('email'); ?></div>
						</td>					
                    </tr>
                    <tr>
                      
									<td><?php $data = array(
													'name'          => 'password',
													'id'            => 'inputPassword',
													'type'         => 'password',
													'value'         => set_value('password'),
													'class'         => 'form-control',
													'placeholder'   => 'Password',
											);
											echo form_input($data);		 ?>
											<div class="error-vlidation"><?php echo form_error('password'); ?></div>
									</td>
						
                    </tr>
                        <tr><td colspan="2" class="text-center">
                            <input type="submit" class="btn btn-login" value="Login" id="submits">
							<button class="btn btn-lg btn-primary btn-block btn-signin" type="button" id="buttons" style="display:none">Please Wait..</button>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <div class="login-bottom">
                    Don't have account yet? <a href="<?php echo base_url()?>signup">Sign up</a><br>
                    Forgot password? <a href="<?php echo base_url()?>forgot">Recover</a>
                </div>
				 <div class="g-recaptcha" data-sitekey="6LcnG0gUAAAAAEK-jOUxqmXaAyVbE7YvzoPZDSHG" data-theme="dark"></div>
				<div class="g-captcha-error error-vlidation"><?php echo form_error('g-recaptcha-response'); ?></div>
            <?php echo form_close(); ?>
        </div>
    </div>

    <div class="my-recaptcha">
    </div>
</div>

	<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
				</div>
				<div class="modal-body">
					<p></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!--/slider_s-->        
<script>

//refresh captcha token
$(".c-ref").click(function() {
	jQuery.ajax({
		url: "<?php echo base_url(); ?>user/captchaRefresh",
		method: "GET",
		processData: false,
		contentType: false,
		success: function(res) {
			if (res)
			{
				jQuery(".c-img").html(res);
			}
		}
	});
});
</script>
<?php include('includes/footer.php');?>	  

<script>
   $.getJSON("http://freegeoip.net/json/", function(data) {
	   $('#ip_address').val(data.ip);
	   $('#country').val(data.country_name);
	   $('#country_code').val(data.country_code);
    });
</script>     