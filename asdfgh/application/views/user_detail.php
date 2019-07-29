<div class="right_col" role="main">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h4>User Detail</h4>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
				  <?php  
						$lerror = $this->session->flashdata('error_msg');
						  if(isset($lerror))
						  {
							  echo '<div class="alert alert-success">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$lerror.'</div>'; 
						  }
						  $lerrors = $this->session->flashdata('error_msgs');
						   if(isset($lerrors))
						  {
							  echo '<div class="alert alert-danger">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$lerrors.'</div>'; 
						  }
					 ?>	
					<div id="my-tab-content" class="tab-content">
						<div class="tab-pane active" id="orange">	
							<form action="" enctype="multipart/form-data" method="post" id="reference_code" name="fregisters" class="form-horizontal form-label-left">
							<input type="hidden" id="" name="<?php echo  $this->security->get_csrf_token_name() ?>" class="form-control" value="<?php echo  $this->security->get_csrf_hash() ?>">
							<input type="hidden" name="user_id" id="user_id" value="<?php echo $user->user_id; ?>"/>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tax">First Name:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<?php if($user->firstname!=""){ ?>
										<input type="text" id="fname" class="form-control col-md-7 col-xs-12" name="firstname" value="<?php echo $user->firstname; ?>" autocomplete="off" disabled="disabled">
									<?php  } else { ?>
									<input type="text" id="fname" class="form-control col-md-7 col-xs-12" name="firstname" value=set_value('firstname') disabled="disabled">
									<?php } ?>
								</div>
								<div class="error-vlidation-err"><?php echo form_error('firstname'); ?></div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tax">Last Name:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
								<?php if($user->lastname!=""){ ?>
									<input type="text" id="lname" class="form-control col-md-7 col-xs-12" name="lastname" value="<?php echo $user->lastname; ?>" autocomplete="off" disabled="disabled">
								<?php } else { ?>
									<input type="text" id="lname" class="form-control col-md-7 col-xs-12" name="lastname" value=set_value('lastname') disabled="disabled">
								<?php } ?>
								</div>
								<div class="error-vlidation-err"><?php echo form_error('lastname'); ?></div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tax">Email:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
								<?php  if($user->email!=""){ ?>
									<input type="text" id="email" class="form-control col-md-7 col-xs-12" name="email" value="<?php echo $user->email; ?>" disabled="disabled">
								<?php } else { ?>
									<input type="text" id="email" class="form-control col-md-7 col-xs-12" name="email" value=set_value('email') disabled="disabled">
								<?php } ?>
								</div>
								<div class="error-vlidation-err"><?php echo form_error('email'); ?></div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tax">Phone:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" id="phone" class="form-control col-md-7 col-xs-12" name="phone" value="<?php if($user->phone_number!=""){ echo $user->phone_number; } else { echo ''; } ?>" autocomplete="off" disabled="disabled">
								</div>
								<div class="error-vlidation-err"><?php echo form_error('phone'); ?></div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tax">Password:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
								<?php if($user->password!=""){ ?>
									<input type="password" id="password" class="form-control col-md-7 col-xs-12" name="password" value="<?php echo $user->password; ?>" autocomplete="off" disabled="disabled">
								<?php } else { ?>
									<input type="password" id="password" class="form-control col-md-7 col-xs-12" name="password" value=set_value('password') disabled="disabled">
								<?php } ?>
								</div>
								<div class="error-vlidation-err"><?php echo form_error('password'); ?></div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tax">Google Authentication Code:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" id="auth_code" class="form-control col-md-7 col-xs-12" name="auth_code" value="<?php echo $user->google_auth_code; ?>" disabled="disabled">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tax">Status:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="status" id="status" class="form-control col-md-7 col-xs-12" name="status" value="<?php if($user->status==1) { echo 'Active'; } else if($user->status==0) { echo 'Inactive'; } else if ($user->status==3){ echo 'Suspended' ;} ?>" autocomplete="off" disabled="disabled">
								
								</div>
								<div class="error-vlidation-err"><?php echo form_error('password'); ?></div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tax">Reference id:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" id="reference_id" class="form-control col-md-7 col-xs-12" name="reference_id" value="<?php if($user->reference_id!=""){ echo $user->reference_id; } else { echo ''; } ?>" autocomplete="off" disabled="disabled">
								</div>
								<div class="error-vlidation-err"><?php echo form_error('reference_id'); ?></div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tax">Refered id:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" id="refered_id" class="form-control col-md-7 col-xs-12" name="refered_id" value="<?php if($user->refered_id!=""){ echo $user->refered_id; } else { echo ''; } ?>" autocomplete="off" disabled="disabled">
								</div>
								<div class="error-vlidation-err"><?php echo form_error('refered_id'); ?></div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tax">Token Balance:</label>
								<div class="col-md-4 col-sm-6 col-xs-12">
									<input type="text" id="balance" class="form-control col-md-7 col-xs-12" name="balance" value="<?php if($user->total_coins!=""){ echo $user->total_coins; } else { echo ''; } ?>" disabled="disabled">
								</div>
								<div class="col-md-2 col-sm-6 col-xs-12">
								<button style="margin:0;" type="button" id="edit_token" class="pull-right btn btn-success btn-info" data-toggle="modal" onclick="show_modal();">Edit Token</button>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tax">Total Referred Users:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" id="total_user" class="form-control col-md-7 col-xs-12" name="total_user" value="<?php if($user->total_refer_user!=""){ echo $user->total_refer_user; } else { echo ''; } ?>" disabled="disabled">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tax">Referred User's Balance:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" id="referred_balance" class="form-control col-md-7 col-xs-12" name="referred_balance" value="<?php echo $user->balance; ?>" disabled="disabled">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tax">Last Login IP:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" id="ip_address" class="form-control col-md-7 col-xs-12" name="ip_address" value="<?php echo $user->ip_address; ?>" disabled="disabled">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tax">Last Activity:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" id="last_activity" class="form-control col-md-7 col-xs-12" name="last_activity" value="<?php echo $user->login_date; ?>" disabled="disabled">
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
								<button type="button" class="btn btn-success" id="submit_code_btn" onclick="show_edit_detail();">Edit</button>
								<a href="<?php echo base_url(); ?>transaction/<?php echo $user->user_id; ?>" class="btn btn-success" target="_blank">Investment History</a>
								</div>
							</div> 
						</form>
					</div>
				</div>
			</div>
  <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title user_modal">Update Tokens</h4>
			</div>
			<form action="<?php echo base_url(); ?>update_token" method="post">
				<div class="modal-body">
					<input type="hidden" id="" name="<?php echo  $this->security->get_csrf_token_name() ?>" class="form-control" value="<?php echo  $this->security->get_csrf_hash() ?>">
					<p><label class="label_modal">Token Balance: </label>
					<input type="number" name="total_coins" value="<?php echo $user->total_coins; ?>" class="form-control" min="0" step="0.000000000000000001" autocomplete="off"/> </p>
					<p><label class="label_modal">Reason: </label>
					<div class="add_stg">
						<textarea name="reason" class="form-control" required></textarea></p>	
					</div>
					<input type="hidden" name="user_id" id="user_id" value="<?php echo $user->user_id; ?>"/>
					<input type="hidden" name="prev_coins" id="prev_coins" value="<?php echo $user->total_coins; ?>"/>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success btn-info btn-lg">Update</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!---edit detail-->
<div id="userModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title user_modal">Edit Detail</h4>
			</div>
			<form action="<?php echo base_url();?>update_userdetail" method="post" autocomplete="off" id="edit_user">
				<div class="modal-body">
					<input type="hidden" id="" name="<?php echo  $this->security->get_csrf_token_name() ?>" class="form-control" value="<?php echo  $this->security->get_csrf_hash() ?>">
					<p><label class="label_modal">First Name: </label>
					<?php if($user->firstname!=""){ ?>
										<input type="text" id="fname" class="form-control col-md-7 col-xs-12" name="firstname" value="<?php echo $user->firstname; ?>">
									<?php  } else { ?>
									<input type="text" id="fname" class="form-control col-md-7 col-xs-12" name="firstname" value="" >
									<?php } ?>
					</p>
					<p><label class="label_modal">Last Name: </label>
					<?php if($user->lastname!=""){ ?>
									<input type="text" id="lname" class="form-control col-md-7 col-xs-12" name="lastname" value="<?php echo $user->lastname; ?>" >
								<?php } else { ?>
									<input type="text" id="lname" class="form-control col-md-7 col-xs-12" name="lastname" value="" >
								<?php } ?>
					</p>
					<p><label class="label_modal">Phone: </label>
					<?php if($user->phone_number!=""){ ?>
									<input type="text" id="phone" class="form-control col-md-7 col-xs-12" name="phone" value="<?php echo $user->phone_number; ?>">
								<?php } else { ?>
									<input type="text" id="phone" class="form-control col-md-7 col-xs-12" name="phone" value="">
								<?php } ?>
					</p>
					<p><label class="label_modal">New Password: </label>
									<input type="password" id="password1" class="form-control col-md-7 col-xs-12" name="password1" value="" >
					</p>
					<p><label class="label_modal">Confirm New Password: </label>
									<input type="password" id="cpassword1" class="form-control col-md-7 col-xs-12" name="cpassword1" value="">			
					</p>
					<div class="error-form-dv passwor"></div>
					<br/><br/>
						<p><label class="label_modal">Status: </label>
						<select name="status">
						<option value="1" <?php if($user->status==1){ echo 'selected'; } else{ echo ''; } ?>>Active</option>
						<option value="0" <?php if($user->status==0){ echo 'selected'; } else{ echo ''; } ?>>Inactive</option>
						<option value="3" <?php if($user->status==3){ echo 'selected'; } else{ echo ''; } ?>>Suspend</option>
						<option value="1" <?php if($user->status==1){ echo 'selected'; } else{ echo ''; } ?>>Unsuspend</option>						
						</select>
						</p>	
					<input type="hidden" name="user_id" id="user_id" value="<?php echo $user->user_id; ?>"/>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success btn-info btn-lg" onclick="save_detail()">Update</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--end-->
<script>
function show_modal(){
	 $('#myModal').modal('show');
}
function show_edit_detail(){
	$('#userModal').modal('show');
}
function save_detail(){
	var password = $('#password1').val();
	var cpassword = $('#cpassword1').val();
	var length = password.length;
	if(password!==""){
	if(password!=cpassword){
		$('.passwor').html('');
		$('.passwor').html("<p>The Confirm Password field does not match the New Password field.</p>");
		return false;
	}
	else if(length<6){
		$('.passwor').html('');
		$('.passwor').html("<p>The Password field must be at least 6 characters in length.</p>");
		return false;
	}
	else{
	$('#edit_user').submit();
	}
	}
	else{
	$('#edit_user').submit();
	}
}
</script>
