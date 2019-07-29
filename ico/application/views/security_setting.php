<?php include('includes/dashboard_header.php');
$user_data = $this->session->userdata('user_data');
?>
<style>
.form-group.error-vlidation p {
	color: red;
	font-size: 15px;
	font-family: monospace;
}
</style>
<div id="page-wrapper">
<?php	$message = $this->session->flashdata('error_msg'); 
			if(!empty($message)){    ?>
				<div class="col-sm-12">
					<div class="alert green-alert alert-info fade in" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					  <?php echo $message;     ?>
					</div>
				</div>
	<?php     	}     ?>
	<?php	$messages = $this->session->flashdata('error_msgs'); 
			if(!empty($messages)){    ?>
				<div class="col-sm-12">
					<div class="validation-eror">
					<div class="alert">
					  <?php echo $messages;     ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					</div>
				</div>
	<?php     	}     ?>
            <div class="row">
                <div class="col-lg-offset-3 col-lg-6">
                    <div class="panel panel-default user-settings">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <span class="change-pass">Change Password</span>
                            </div>
                            <a href="#">SECURITY SETTINGS</a>
                        </div>
                        <div class="panel-body">
											<?php
												$attributes = array('class' => 'form-horizontal personel-infomation', 'id' => 'reset_pass','role'=>"form", 'method'=>'post', 'autocomplete'=>'off');
												
												$action_url = base_url().'update_profile';
												
												echo form_open($action_url, $attributes);
												
												$data = array(
												'name'          => $this->security->get_csrf_token_name(),
												'type'         => 'hidden',
												'value'         => $this->security->get_csrf_hash()
												);
												
												echo form_input($data); ?>
											<table class="table table-user-information">
												<tbody>
												<tr>
													
													<td>
														<?php
																	$data = array(
																	'name'          => 'old_password',
																	'id'            => 'old_password',
																	'type'         => 'password',
																	'value'         => set_value('old_password'),
																	'maxlength'     =>  "20",
																	'class'         => 'form-control',
																	'placeholder'         => 'Old Password',
																	);
																	
																	echo form_input($data);
																	
														?>
														<div class="error-vlidation"><?php echo form_error('old_password'); ?></div>
													<div class="verifed" id="verified" style="display:none;"></div>
													</td>
												</tr>
												<tr>
													
													<td>
														<?php
																	$data = array(
																	'name'          => 'New-password',
																	'id'            => 'New-password',
																	'type'         => 'password',
																	'value'         => set_value('New-password'),
																	'maxlength'     =>  "20",
																	'class'         => 'form-control',
																	'placeholder'         => 'New Password',
																	);
																	
																	echo form_input($data);
																	
																?>
									
														<div class="error-vlidation"><?php echo form_error('New-password'); ?></div>
													</td>
												</tr>
												<tr>
													
													<td>
														<?php
															$data = array(
															'name'          => 'Repeat-Password',
															'id'            => 'Repeat-Password',
															'type'         => 'password',
															'value'         => set_value('Repeat-Password'),
															'maxlength'     =>  "20",
															'class'         => 'form-control',
															'placeholder'         => 'Repeat Password',
															);
															
															echo form_input($data);
															
														?>
														
														<div class="error-vlidation"><?php echo form_error('Repeat-Password'); ?></div>
													</td>
												</tr>
											</tbody>
										</table>
									<input type="submit" class="btn btn-save" value="Update Password">
									<?php    echo form_close();      ?>	
                        </div>
                    </div>
                    <div class="panel panel-default user-settings">
                        <div class="panel-heading">
                            <a href="#">TWO FACTOR AUTHENTICATION</a>
                        </div>
                        <div class="panel-body">
								<?php if(isset($google_auth) && !empty($google_auth)){
										$auth_url = $google_auth['auth_url'];
										$auth_code = $google_auth['auth_code'];
									}
									$id = $user_data['user_id']; ?>
								<?php
											$attributes = array('class' => 'personel-infomation', 'id' => 'submit', 'method'=>'post', 'autocomplete'=>'off');
											echo form_open('authenticates/'.$id, $attributes);
											
										?>
										<div class="row key">
											<div class="col-xs-6">
												<span>Google Authentication</span>
											</div>
										</div>
                                <div class="row key">
                                    <div class="col-xs-4">
										<img src="<?php echo $auth_url; ?>" class="img-responsive img-center">
										
                                    </div>
                                    <div class="col-xs-6">
                                        <span>Authentication Key</span>
                                        <?php echo $auth_code; ?>
                                    </div>
                                </div>		
								<input type="hidden" name="admin_id" value="<?php echo $id; ?>" id="admin_id" />
								<input type="hidden" name="google_auth_code" value="<?php echo $auth_code; ?>" id="google_auth_code" />
									
                                <table class="table table-user-information">
                                    <tbody>
										<tr>
											
											<td>
												<?php
													$data = array(
													'name'          => 'authcode',
													'id'            => 'authcode',
													'type'         => 'text',
													'value'         => '',
													'class'         => 'form-control',
													'placeholder'         => 'Authentication Code',
													);
													
													echo form_input($data);
													
												?>	
												<div class="error-vlidation"><?php echo form_error('authcode'); ?></div>
											</td>
										</tr>
                                   </tbody>
                                </table>
									<?php
									$data = array(
										'name'          => 'login_type',
										'id'            => 'login_type',
										'type'         => 'hidden',
										'value'       => 'google',
										'class'         => 'form-control  col-xs-10 url-upload link',
									);

									echo form_input($data); ?>
                                <div class="text-center">
									<?php if(isset($is_exist_auth) && !empty($is_exist_auth['login_type']) && $is_exist_auth['login_type']=="google"){ ?>
										<input type="hidden" value="disable_auth" name="action"/>
										<input type="submit" class="btn btn-disable" value="Disable">
									<?php } else { ?>
										<input type="submit" class="btn btn-enable" value="Enable" id="submits">
									<?php } ?>
                                </div>
                            <?php
							echo form_close();
							?>
                        </div>
                    </div>
				</div>
</div>
</div>

<?php include('includes/dashboard_footer.php');?>

<script>
$('#old_password').keyup(function(){
	var old_pass = $('#old_password').val();
			$.ajax({
		  url: "<?php echo base_url(); ?>check_password",
		  data:{old_password:old_pass},
		  type: "POST",
		  dataType: "json",
		  success: function(res){
			if(res.status==1){
				$('#verified').css('display','block');
			}
			else{
				$('#verified').css('display','none');
			}
		  }
		});
});
</script>