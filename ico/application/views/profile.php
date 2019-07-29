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
					<div class="alert  alert-danger alert-dismissible show" role="alert">
					  <?php echo $messages;     ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				</div>
	<?php     	}     ?>
            <div class="row">
                <div class="col-lg-offset-3 col-lg-6">
                    <div class="panel panel-default user-settings">
                        <div class="panel-heading">
                            <a href="#">PERSONAL INFORMATION</a>
                        </div>
                        <div class="panel-body">
						<?php if(isset($user) && !empty($user)){
							$firstname = $user['firstname'];
							$lastname = $user['lastname'];
							$email = $user['email'];
							$phone = $user['phone'];
							$profile_pic = $user['profile_pic'];
						} 	
							$attributes = array('class' => 'form-horizontal personel-infomation', 'id' => 'personal_info','role'=>"form", 'method'=>'post', 'enctype' => 'multipart/form-data', 'autocomplete'=>'off');
						
						$action_url = base_url().'update_personal_info';	
						echo form_open($action_url, $attributes);
						$data = array(
						'name'          => $this->security->get_csrf_token_name(),
						'type'         => 'hidden',
						'value'         => $this->security->get_csrf_hash()
						);
						echo form_input($data); ?>
						
                                <div class="row change-photo">
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="avatar-upload">
											<?php if($profile_pic!="") { ?>
											<img src="<?php echo base_url(); ?>uploads/profile_pic/<?php echo $profile_pic; ?>">
											<?php } else { ?>
												<img src="<?php echo base_url(); ?>assets/new_design/dist/img/son.png">
											<?php } ?>
                                        </div>
                                        <div class="btn btn-profile" id="profile">
										<?php $data = array(
													'name'          => 'profile_pic',
													'id'            => 'profile_pic',
													'type'         => 'file',
													'class'         => 'form-control',
													);
												
										echo form_input($data);
										?>   
										Change Profile Photo</div>
                                    </div>
                                    <div class="col-xs-6 col-sm-8 col-md-8">

                                    </div>
                                </div>
    
                                <table class="table table-user-information">
                                    <tbody>
                                    <tr>
                                        <td>
										<?php
										if(!empty($firstname)) {
											$data = array(
													'name'          => 'firstname',
													'id'            => 'firstname',
													'type'         => 'text',
													'value'         => $firstname,
													'class'         => 'form-control',
													'readonly'      => 'readonly',
													'placeholder'         => 'First Name',
													
													);
										}
										else{
													$data = array(
													'name'          => 'firstname',
													'id'            => 'firstname',
													'type'         => 'text',
													'value'         => set_value('firstname'),
													'class'         => 'form-control',
													'placeholder'         => 'First Name',
													);
										}		
										echo form_input($data);
													
										?>
										<div class="error-vlidation-err"><?php echo form_error('firstname'); ?></div>
										</td>
                                    </tr>
                                    <tr>
                                       
                                        <td>
										<?php	if(!empty($lastname)) {
											$data = array(
													'name'          => 'lastname',
													'id'            => 'lastname',
													'type'         => 'text',
													'value'         => $lastname,
													'class'         => 'form-control',
													'readonly'      => 'readonly',	
													'placeholder'         => 'Last Name',
													);
										}
										else{
													$data = array(
													'name'          => 'lastname',
													'id'            => 'lastname',
													'type'         => 'text',
													'value'         => set_value('lastname'),
													'class'         => 'form-control',
													'placeholder'         => 'Last Name',
													);
										}		
										echo form_input($data);
													
										?>
										<div class="error-vlidation-err"><?php echo form_error('lastname'); ?></div>
										</td>
                                    </tr>

                                    <tr class="trtop">
                                   
                                        <td>
										<?php	if(!empty($email)) {
											$data = array(
													'name'          => 'email',
													'id'            => 'email',
													'type'         => 'email',
													'value'         => $email,
													'class'         => 'form-control',
													'readonly'      => 'readonly',
													'placeholder'         => 'Email',
													);
										}
										else{
													$data = array(
													'name'          => 'email',
													'id'            => 'email',
													'type'         => 'email',
													'value'         => set_value('email'),
													'class'         => 'form-control',
													'placeholder'         => 'Email',
													);
										}		
										echo form_input($data);
													
										?>
										<div class="error-vlidation-err"><?php echo form_error('email'); ?></div>
										<div class="verifed">Verified</div></td>
                                    </tr>
                                    <tr>
                                      
                                        <td>
										<?php	if(!empty($phone)) {
											$data = array(
													'name'          => 'phone',
													'id'            => 'phone',
													'type'         => 'number',
													'value'         => $phone,
													'class'         => 'form-control',
													'placeholder'         => 'Mobile',
													);
										}
										else{
													$data = array(
													'name'          => 'phone',
													'id'            => 'phone',
													'type'         => 'number',
													'value'         => set_value('phone'),
													'class'         => 'form-control',
													'placeholder'         => 'Mobile',
													);
										}		
										echo form_input($data);
													
										?>
										<div class="error-vlidation-err"><?php echo form_error('phone'); ?></div></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <input type="submit" class="btn btn-save" value="Save Profile">
								<?php    echo form_close();      ?>	
                            
                        </div>
                    </div>
                </div>
            
            </div>
        </div>
	
<script>
function copyRefrel() {
	
   var copyText = document.getElementById('copyRefrelInput');    
    copyText.select();
    document.execCommand("Copy");
}
</script>


<?php include('includes/dashboard_footer.php');?>

<script>
/*function to check old password is correct or not*/
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