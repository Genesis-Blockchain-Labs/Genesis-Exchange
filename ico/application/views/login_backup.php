</head>
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/mycustom.css">
<body class="">
<div class="clearfix"></div>
<div class="all-form">
<div class="main-top-margin log_in">
	<div class="container">
		<div class="row">
			<div class="inner-main-top">
				<div class="main-inner-top">
					<div class="bd_vont">
						<div class="container">
							<div class="row">
								<div class="col-sm-12">
									<div class="proof">
									<div class="team-content-wrapper">
										<div class="login-content">

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
										
										<div class="card card-container login-ch">
										<div class="m-l-heading">
											<h1>Login</h1>
											
										</div>
											<p id="profile-name" class="profile-name-card"></p>
											
											<?php
											
											$action_url = base_url().'do_log';
											
											
											$attributes = array('class' => 'form-signin', 'id' => 'submit');
											echo form_open($action_url, $attributes);
											 
								?>  
						  
											<input type="hidden" id="dfp" name="deviceFingerPrint"> 
											<input type="hidden" id="dft" name="deviceFingerprintTechnology" value="AU">
											
											<span id="reauth-email" class="reauth-email"></span>
											
											 <label class="validation-eror">
													<?php if(!empty($error_msg)){  
															echo $error_msg;
														?>
														<?php }   ?>
											 </label> 
											
											<label>
										<?php
										$data = array(
													'name'          => 'email',
													'id'            => 'inputEmail',
													'placeholder'   => 'Email address',
													//'required'     => 'required',
													'type'         => 'text',
													'value'         => set_value('email'),
													'class'         => 'form-control',
											);

											echo form_input($data);
										
										?>	
										<div class="error-vlidation"><?php echo form_error('email'); ?></div>
											</label>
											
											<label>
										<?php
										$data = array(
													'name'          => 'password',
													'id'            => 'inputPassword',
													'placeholder'   => 'Password',
													//'required'     => 'required',
													'type'         => 'password',
													'value'         => set_value('password'),
													'class'         => 'form-control',
											);
											echo form_input($data);
											?>
											<div class="error-vlidation"><?php echo form_error('password'); ?></div>
											</label>
											
																							
											<button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" id="submits">LOGIN</button>
											<button class="btn btn-lg btn-primary btn-block btn-signin" type="button" id="buttons" style="display:none">Please Wait..</button>
											<div class="forgot-reg-link">
												<p><span> Forgot your password? </span> <a href="<?php echo base_url()?>forgot" class="login-register-link">Recover</a>
												</p>
												<p> <span>Do not have an account?  </span> <a href="<?php echo base_url()?>signup" class="login-register-link">Register</a>
												</p>
											</div>
											<!--/form  -->
											<?php echo form_close(); ?>
											<!-- /form -->

										</div>
										<!-- /card-container -->
										<br/>
										<br/>
										
									</div>
									</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
				   <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
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
</div>
</div>
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