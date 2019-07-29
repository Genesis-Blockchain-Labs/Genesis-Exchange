
</head>

<body>
	<link rel="stylesheet" href="<?php echo base_url()?>assets/css/mycustom.css">
	<div class="clearfix"></div>
				<div class="all-form">
					<div class="main-top-margin main-reg-para">
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
										<div class="card card-container">
											<div class="m-l-heading">
												<h1>Sign Up</h1>
											</div>                    
											<?php
												//$refid = $_GET['refid'];
												$attributes = array('class' => 'form-horizontal banner-reg-btn', 'id' => 'registration','role'=>"form", 'method'=>'post');
												
												$url = base_url().'user/register_ajax';
												echo form_open($url, $attributes);
												
												
											?>
											
											
											<?php
												$refid = isset($refid)?$refid:'';
												$data = array(
												'name'          => 'user_id',
												'id'            => 'user_id',
												'type'         => 'hidden',
												'value'         => '',
												);
												echo form_input($data);
												
												
												$data = array(
												'name'          => 'Firstname',
												'id'            => 'Firstname',
												'placeholder'   => 'First Name',
												//'required'     => 'required',
												'type'         => 'text',
												'value'         => set_value('Firstname'),
												'class'         => 'form-control',
												);
												
											echo form_input($data);  ?>
											<div class="error-vlidation"><?php echo form_error('Firstname'); ?></div>
											
											<?php
												
												$data = array(
												'name'          => 'Lastname',
												'id'            => 'Lastname',
												'placeholder'   => 'Last Name',
												//'required'     => 'required',
												'type'         => 'text',
												'value'         => set_value('Lastname'),
												'class'         => 'form-control',
												);
												
											echo form_input($data);?>
											<div class="error-vlidation"><?php echo form_error('Lastname'); ?></div>
											
											<?php
												
												$data = array(
												'name'          => 'email',
												'id'            => 'email',
												'placeholder'   => 'Email',
												//'required'     => 'required',
												'type'         => 'email',
												'value'         => set_value('email'),
												'class'         => 'form-control',
												);
												
											echo form_input($data);?>
											<div class="error-vlidation"><?php echo form_error('email'); ?></div>
											
											<?php
												
												$data = array(
												'name'          => 'Phone',
												'id'            => 'Phone',
												'placeholder'   => 'Phone (Optional)',
												//'required'     => 'required',
												'type'         => 'number',
												'value'         => set_value('Phone'),
												'class'         => 'form-control',
												);
												
											echo form_input($data);?>
											<div class="error-vlidation"><?php echo form_error('Phone'); ?></div>
											
											<?php
												
												$data = array(
												'name'          => 'Password',
												'id'            => 'Password',
												'placeholder'   => 'Password',
												//'required'     => 'required',
												'type'         => 'password',
												'value'         => set_value('Password'),
												'class'         => 'form-control',
												);
												
												echo form_input($data);
											?>
											<div class="error-vlidation"><?php echo form_error('Password'); ?></div>
											
											<?php
												$data = array(
												'name'          => 'Retype-password',
												'id'            => 'Retype password',
												'placeholder'   => 'Retype password',
												//'required'     => 'required',
												'type'         => 'password',
												'value'         => '',
												'class'         => 'form-control',
												);
												
											echo form_input($data);?>
											<div class="error-vlidation"><?php echo form_error('Retype-password'); ?></div>
											
											<?php								
												
												if(!empty($refid)){ 
													$data = array(
													'name'          => 'reference_code',
													'id'            => 'reference_code',
													'placeholder'   => 'Reference Code',
													'type'         => 'text',
													'readonly'      => 'readonly',
													'value'         => $refid,
													'class'         => 'form-control',
													);
													echo form_input($data);
													}else{
													$data = array(
													'name'          => 'reference_code',
													'id'            => 'reference_code',
													'placeholder'   => 'Reference ID (Optional)',
													'type'         => set_value('reference_code'),
													'class'         => 'form-control',
													);
													echo form_input($data);
												}
												
												$data = array(
												'name'          => $this->security->get_csrf_token_name(),
												'value'         => $this->security->get_csrf_hash(),
												'type'         => 'hidden',
												);
												echo form_input($data);
												
												/* echo '<div class="captcha"><div class="inner-c"><p class="c-img">'.$cap_img.'</p><p class="c-ref"><img src="'.base_url().'assets/img/refresh-btn.png"></p></div><p class="c-input"><input class="form-control" type="text" name="captcha" placeholder="Enter Captcha (case sensitive)" required /></p></div>'; */
											?>
											<button type="submit" class="btn btn-primary btn-block" id="register_submit">Register</button>
											<button type="button" class="btn btn-primary btn-block" id="buttons" style="display:none">Please wait..</button>
											<?php
												echo form_close();
											?>
											<div class="forgot-reg-link">
											<p class="login-link"><span>Already have an account? </span><a href="<?php echo base_url()?>login" class="login-register-link">Login</a> </p>
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
						</div>
						<!-- Modal -->
						<div id="myModal" class="modal fade" role="dialog">
							<div class="modal-dialog">
								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<!--  <button type="button" class="close" data-dismiss="modal">&times;</button> -->
									</div>
									<div class="modal-body">
										<p id="response_msg"></p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
	<!--/slider_s-->
</main>

</body>
</html>
<script>
	/* $("#registration").submit(function(event) {
		//alert();
		var live_url = "<?php  echo base_url();?>";
		//if(live_url == "https://boon.vc/"){
		// gtag_report_conversion(live_url);
		//}
		$("#pass_error").html(" ");
		$("#c_pass_error").html(" ");
		$("#buttons").show();
		$("#register_submit").hide();
		event.preventDefault();
		if (!ValidateEmail($("#email").val())) {
		$("#buttons").hide();
		$("#register_submit").show();
		$("#myModal").modal('show');
		$(".modal-title").html(" ");
		$(".modal-body").html("<p>Invalid email address !</p>");	
		event.preventDefault();			
		}else{
		
		var newData= false;
		newData= new FormData(this);
		newData.append('<?php echo $this->security->get_csrf_token_name(); ?>','<?php echo $this->security->get_csrf_hash(); ?>');
		
		var request = $.ajax({
		url: "<?php  echo base_url();?>user/register_ajax",
		method: "POST",
		data: newData,
		processData: false,
		contentType: false,
		});
		request.done(function(msg) {
		$("#buttons").hide();
		$("#register_submit").show();
		if (msg == "0") {				
		$("#myModal").modal('show');
		$(".modal-title").html(" ");
		$(".modal-body").html("<p>Email is already exist !</p>");
		} else if (msg == "3") {
		$("#myModal").modal('show');
		$(".modal-title").html(" ");
		$(".modal-body").html("<p>Captcha does not match !</p>");
		} else if (msg == "2") {
		$("#myModal").modal('show');
		$(".modal-title").html(" ");
		$(".modal-body").html("<p>Something went wrong !</p>");
		}else if(msg == "10"){
		$("#myModal").modal('show');
		$(".modal-title").html(" ");
		$(".modal-body").html("<p>The reference code you have entered is incorrect. Please provide correct one or you can leave this field empty.</p>");
		$("#popup").trigger("click");
		$("#reference_code").val("");
		}else {
		window.location = "<?php  echo base_url();?>user/register_thank";
		}
		});
		}
		
		event.preventDefault();
	}); */
	
	//google analytics tag conversion
	function gtag_report_conversion(url) {
		var callback = function () {
			if (typeof(url) != 'undefined') {
				window.location = url;
			}
		};
		gtag('event', 'conversion', {
			'send_to': 'AW-826936146/n8ayCIWn0XkQ0paoigM',
			'event_callback': callback
		});
		return false;
	}
	
	
	
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
	
	
	function ValidateEmail(email) {
		var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
		return expr.test(email);
	};	
</script>
<?php include('includes/footer.php');?>