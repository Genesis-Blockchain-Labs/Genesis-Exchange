<?php include('includes/header.php');?>	
<style>


	.validate_error{
	float: left;
	font-size: 17px;	
	}

	.error-vlidation p {
	color: red;
	font-size: 15px;
	font-family: monospace;
	}
	.col-xs-12.meg-div {
	color: #d7d7d7;
	font-size: 18px;
	}
</style>
<div class="login-box">
    <div class="login-panel panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">PASSWORD RECOVERY</h3>     
        </div>
        <div class="panel-body user-settings">
													<?php
														$attributes = array('class' => 'form-horizontal', 'id' => 'reset_pass','role'=>"form", 'method'=>'post', 'autocomplete'=>'off');
														
														$action_url = base_url().'user/update_pass';
														
														echo form_open($action_url, $attributes);
														
														$csrf = array(
														'name' => $this->security->get_csrf_token_name(),
														'hash' => $this->security->get_csrf_hash()
														);
													?>
													<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
													
													<?php if(!empty($token_data)) { 				
														
														$data = array(
														'name'          => 'token',
														'id'            => 'token',
														'type'         => 'hidden',
														'value'         => $token_data['forgot_token'],
														);
														
														echo form_input($data);
														
													?>
													<?php if(!empty($pass_save)){  ?>
														<div class="alert green-alert alert-info fade in" role="alert">
															<button type="button" class="close" data-dismiss="alert" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														  <?php echo $pass_save;     ?>
														</div>									
									
														<script>
																 var timer = setTimeout(function() {
																	window.location.href="<?php  echo base_url();?>login";
																}, 3000);
														</script>
														<?php }else{   ?>
														
														<div class="alert green-alert alert-info fade in" role="alert">
															<button type="button" class="close" data-dismiss="alert" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														  Please enter your new password
														</div>														
														<?php }   ?>
										<table class="table table-user-information">
											<tbody>
												<tr>
													
													<td><?php
																							$data = array(
																							'name'          => 'password',
																							'id'            => 'password',
																							'type'         => 'password',
																							'maxlength'     =>  "20",
																							'class'         => 'form-control',
																							'placeholder'         => 'Password',
																							);
																							
																							echo form_input($data);
																							
																						?>
																						<div class="error-vlidation"><?php echo form_error('password'); ?></div>
												</td>
											</tr>
											<tr>
												
												<td><?php
																						$data = array(
																						'name'          => 'Confirm-Password',
																						'id'            => 'confirm_password',
																						'type'         => 'password',
																						'maxlength'     =>  "20",
																						'class'         => 'form-control',
																						'placeholder'         => 'Confirm Password',
																						);
																						
																						echo form_input($data);
																						
																					?>
																					
																					<div class="error-vlidation"><?php echo form_error('Confirm-Password'); ?></div>
												</td>
												</tr>
												<tr>
													<td colspan="2" class="text-center">
													  <button type="submit" class="btn btn-login" id="submits">Update</button>
													</td>
												</tr>
											</tbody>
										</table>

									<div class="login-bottom">
										Don't have account yet? <a href="<?php echo base_url();?>signup">Sign up</a><br>
										Have account yet? <a href="<?php echo base_url(); ?>login">Login</a>
									</div> 
								<?php 
							echo form_close();
						}
							else{  ?>
									<div class="alert alert-info" id="mail_very_fy" style="display:block;">
										<span style="font-size: 16px;">
											Your link has been expired.
											
										</span>	
										
										<button type="button" class="close" onClick="hide_veryfy_div()">&times;</button>
										
									</div>
						<?php    }  ?>
		
        </div>
    </div>
</div>



<script>

	</script>
	
	<?php include('includes/footer.php');?>		