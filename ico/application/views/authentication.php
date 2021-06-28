<?php include('includes/dashboard_header.php');
$user_data = $this->session->userdata('user_data');
?>
<style>
.error-vlidation p {
    color: red;
}
.google-auth {
    display: none;
}
.twilio-auth {
    display: none;
}

</style>

<div class="content mt-3">
<?php	$message = $this->session->flashdata('error_msg'); 
			if(!empty($message)){    ?>
				<div class="col-sm-12">
					<div class="alert  alert-success alert-dismissible fade show" role="alert">
					  <span class="badge badge-pill badge-success">Success</span>&nbsp;&nbsp;<?php echo $message;     ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				</div>
<?php     	}     ?>		
		
		<div class="dash-section">
			<div class="das">
				<div class="ee-col-1-4 ee-center dsl">Your referral link:</div>
				<div class="ee-col-2-4 ee-center ds">
					<input class="cssc-clipboard-data" value="<?php echo base_url();?>registration/?refid=<?php echo $user_data['reference_id'];?>" id="copyRefrelInput">
				</div>
			</div>
			<div class="ee-col-1-4 ee-center dsb">
				<button class="cssc-clipboard-button crsh_ref_url" onclick="copyRefrel();"><i class="fa fa-clipboard" style="font-size:12px"></i> Copy Address</button>
			</div>
        </div>
		
		
		<div class="animated fadeIn">
		  <div class="content mt-3">
			<div class="animated fadeIn">
			  <div class="row">
				
				<div class="col-lg-12">
				
					<div class="card">
                      <div class="card-header">
                        <h3 class="text-center">Select Authentication </h3>
                      </div>
                      <div class="card-footer aut_h">
                        <button type="submit" class="btn btn-primary btn-sm" onclick="show_auth('google')">
                          Enable Google Authenticator
                        </button>
                        <button type="reset" class="invisible btn btn-primary btn-sm" onclick="show_auth('twilio')">
                          Enable Twilio
                        </button> 
                      </div>
                 </div>
               </div>
			   
			   </br>
			   </br>
			   </br>
			   </br>
					<div class="google-auth st" style="<? echo $google_auth_class;?>">
						<div class="col-6 auth_2">
							<img src="<?php echo $google_auth['auth_url']; ?>" alt="bar-code" class="img-responsive" id="img_bar">
						</div>
						<div class="col-6">
							
								<ul>
									<li>Step  1. You need to download google authenticator app. </li>
									<li> Step  2. After installation app, you need to scan the barcode.</li>
									<li> Step  3. After that verification code will generate that you need while login.</li>
									<li> Step  4. Enter that verification code at verification page for login.</li>
								</ul>
							
						</div>
					<?php
							$attributes = array('class' => '', 'id' => 'google_auth','role'=>"form", 'method'=>'post','enctype'=>"multipart/form-data", 'autocomplete'=>'off');
							
							$url = base_url('google_auth');
							echo form_open($url, $attributes);
							
					
													
							$data = array(
										'name'          => 'google_auth_code',
										'id'            => 'google_auth_code',
										'type'         => 'hidden',
										'value'       => $google_auth['auth_code'],
										'class'         => 'form-control  col-xs-10 url-upload link',
									);

							echo form_input($data);
							
							
							$data = array(
										'name'          => 'login_type',
										'id'            => 'login_type',
										'type'         => 'hidden',
										'value'       => 'google',
										'class'         => 'form-control  col-xs-10 url-upload link',
									);

							echo form_input($data);
					?> 
											
											
		
						<button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
							Confirm Google Authentication
                        </button>
						
				<?php	 echo form_close();    ?>
		    		
					</div>	
					
					<div class=" twilio-auth st" style="<? echo $twilio_auth_class;?>">
						<div class="col-lg-6">
						<?php
								$attributes = array('class' => '', 'id' => 'google_auth','role'=>"form", 'method'=>'post','enctype'=>"multipart/form-data");
								
								$url = base_url('twilio_auth');
								echo form_open($url, $attributes);										
								$data = array(
											'name'          => 'phone',
											'id'            => 'phone',
											'type'         => 'text',
											'value'       => set_value('phone'),
											'class'         => 'form-control  col-xs-10 url-upload link',
										);

								echo form_input($data);				
								$data = array(
											'name'          => 'login_type',
											'id'            => 'login_type',
											'type'         => 'hidden',
											'value'       => 'twilio',
											'class'         => 'form-control  col-xs-10 url-upload link',
										);

								echo form_input($data);
						?>
			<div class="error-vlidation"><?php echo form_error('phone'); ?></div>
						</div>	
							<button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
								Confirm Twilio Authentication
							</button>						
					</div>
					
               </div>
				
		   </div>
		</div>
	  </div>
	</div>
		

	</div>	
	
<script>	
function show_auth(select){
	if(select=='google'){
		$('.google-auth').css('display','block');
		$('.twilio-auth').css('display','none');
	}else{
		$('.google-auth').css('display','none');		
	}
}
</script>	
<script>
function copyRefrel(){	
	var copyText = document.getElementById('copyRefrelInput');    
	copyText.select();
	document.execCommand("Copy");
}
</script>
<?php include('includes/dashboard_footer.php');?>
