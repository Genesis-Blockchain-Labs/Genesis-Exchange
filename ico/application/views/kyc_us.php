<?php include('includes/dashboard_header.php');
$user_data = $this->session->userdata('user_data');
//echo'<pre>';print_r($user_data);exit;
?>
<style>
.error-vlidation p {
    color: red;
}
</style>

 
	 <div class="content mt-3">
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
		  <div class="content mt-3 k_yc">
			<div class="animated fadeIn">
			  <div class="dash_kyc">
				<div class="col-lg-9">
                  <div class="card">
					
                        
                          <!-- Credit Card -->
                          <div id="pay-invoice">
                              
                                  <div class="card-title">
                                      <h3 class="text-center">KYC For U.S. User</h3>
                                  </div>
<?php							
								$attributes = array('role'=>"form", 'id' => 'u_s', 'method'=>'post');
								$kyc_url = base_url().'us_submit';
								echo form_open_multipart($kyc_url, $attributes);
								
								$data = array(
								'name'          => $this->security->get_csrf_token_name(),
								'type'         => 'hidden',
								'value'         => $this->security->get_csrf_hash()
								);

								echo form_input($data);

					
								/* $csrf = array(
										'name' => $this->security->get_csrf_token_name(),
										'hash' => $this->security->get_csrf_hash()
								); */
        ?> 
								 <!-- <form action="" method="post" novalidate="novalidate"> -->
                                      <div class="form-group text-center">
                                          
                                      </div>
							 <div class="card-body">
								 <h3><span>User Details</span></h3>
                                      <div class="form-group">
                                          <label for="cc-payment" class="control-label mb-1">Legal Name * </label>
                                          <?php
											$data = array(
											'name'          => 'name',
											'id'            => 'tname',
											//'placeholder'   => 'Legal Name *',
											// 'required'     => 'required',
											'type'         => 'text',
											'value'         => set_value('name'),
											'class'         => 'form-control  col-xs-10 url-upload link',
											);

											echo form_input($data);
											?>  
											<div class="error-vlidation"><?php echo form_error('name'); ?></div>
                                      </div>
									  
									<!--  <div class="form-group">
                                          <label for="cc-payment" class="control-label mb-1">Phone Number * </label>
                                          <?php
												/* $data = array(
												'name'          => 'phone',
												'id'            => "phone",
												'placeholder'   => 'Phone Number *',
												'type'         => 'number',
												'value'         => set_value('phone'),
												'class'         => 'form-control  col-xs-10 url-upload link',
												);
												echo form_input($data); */
												?>
												<div class="error-vlidation"><?php //echo form_error('phone'); ?></div>
                                      </div> -->
									  <div class="form-group">
                                          <label for="cc-payment" class="control-label mb-1">Date Of Birth * </label>
                                          <?php
												$data = array(
												'name'          => 'Date-Of-Birth',
												'placeholder'   => 'Date Of Birth (mm/dd/yyyy) *',
												//'required'     => 'required',
												'id'         => 'dob',
												'type'         => 'text',
												'readonly'         => 'readonly',
												'value'         => set_value('Date-Of-Birth'),
												'class'         => 'form-control  col-xs-10 url-upload link',
												);
												echo form_input($data);
												?>  
												<div class="error-vlidation"><?php echo form_error('Date-Of-Birth'); ?></div>
                                      </div>
									  
									  
								 </div>
                                 <div class="card-body">
                                      <h3><span>Address</span></h3>
										<div class="form-group">
                                          <label for="cc-payment" class="control-label mb-1">Street * </label>
												<?php
												$data = array(
												'name'          => 'street',
												'id'            => "street",
												//'placeholder'   => 'Street *',
												// 'required'     => 'required',
												'type'         => 'text',
												'value'         => set_value('street'),
												'class'         => 'form-control  col-xs-10 url-upload link',
												);

												echo form_input($data);
												?>
												<div class="error-vlidation"><?php echo form_error('street'); ?></div>
                                      </div>
									  
									  <div class="form-group">
                                          <label for="cc-payment" class="control-label mb-1">City * </label>
                                          <?php
												$data = array(
												'name'          => 'city',
												'id'            => "city",
												//'placeholder'   => 'City *',
												//'required'     => 'required',
												'type'         => 'text',
												'value'         => set_value('city'),
												'class'         => 'form-control  col-xs-10 url-upload link',
												);

												echo form_input($data);
												?> 
												<div class="error-vlidation"><?php echo form_error('city'); ?></div>
                                      </div>
									  <div class="form-group">
                                          <label for="cc-payment" class="control-label mb-1">State * </label>
                                          <?php
											$data = array(
											'name'          => 'state',
											'id'            => "state",
											//'placeholder'   => 'State *',
											//'required'     => 'required',
											'type'         => 'text',
											'value'         => set_value('state'),
											'class'         => 'form-control  col-xs-10 url-upload link',
											);

											echo form_input($data);
											?>
											<div class="error-vlidation"><?php echo form_error('state'); ?></div>
                                      </div>
									  
									  <div class="form-group">
                                          <label for="cc-payment" class="control-label mb-1">Postcode * </label>
                                          <?php
												$data = array(
												'name'          => 'postcode',
												'id'            => "postcode",
												//'placeholder'   => 'Postcode *',
												//'required'     => 'required',
												'type'         => 'text',
												'value'         => set_value('postcode'),
												'class'         => 'form-control  col-xs-10 url-upload link',
												);

												echo form_input($data);
												?>
												<div class="error-vlidation"><?php echo form_error('postcode'); ?></div>
                                      </div>
									  
									  <div class="form-group">
                                          <label for="cc-payment" class="control-label mb-1">Select Country * </label>
                                          <?php
											$country = array('' => 'Select Country *' );
											if(!empty($contry))
											{
											foreach($contry as $val){ 
											$country[$val['country_name']] = $val['country_name'];
											}
											}
											$attr = array(
											'class' => 'form-control type',
											//'required' => 'required'
											);
											echo form_dropdown('country',$country,set_value('country'),$attr);
											?>


											<!--select name="country" id="country" class="form-control type" required>
											<option value="">Select Country *</option>
											<?php 
											if(!empty($contry)){
											foreach($contry as $val){ ?>
											<option value="<?php echo $val['country_name']; ?>"><?php echo $val['country_name']; ?></option>
											<?php }
											}
											?> 
											</select-->
											
											<div class="error-vlidation"><?php echo form_error('country'); ?></div>
                                      </div>
									  
									  
									  
									  
									  <div class="form-group">
                                          <label for="cc-payment" class="control-label mb-1">Select Citizenship * </label>
                                          <?php
											$citizenship = array('' => 'Select Citizenship *' );
											if(!empty($contry))
											{
											foreach($contry as $val){ 
											$citizenship[$val['country_name']] = $val['country_name'];
											}
											}
											$attr = array(
											'class' => 'form-control type',
											//'required' => 'required',
											'id' => "citizenship",
											);
											echo form_dropdown('citizenship', $citizenship,set_value('citizenship'),$attr);
											?>
											<!--select name="citizenship" id="citizenship" class="form-control type" required>
											<option value="">Select Citizenship *</option>
											<?php 
											if(!empty($contry)){
											foreach($contry as $val){ ?>
											<option value="<?php echo $val['country_name']; ?>"><?php echo $val['country_name']; ?></option>
											<?php }
											}
											?>
											</select-->
											<div class="error-vlidation"><?php echo form_error('citizenship'); ?></div>
                                      </div>
									  
                                    </div>
									<div class="card-body"> 
									  <h3><span>Other Details</span></h3>
									  
									  <div class="form-group">
                                          <label for="cc-payment" class="control-label mb-1">SSN (Last 4 digits) * </label>
                                          <?php
												$data = array(
												'name'          => 'social_number',
												'id'            => "social_number",
												//'placeholder'   => 'SSN (Last 4 digits) *',
												// 'required'     => 'required',
												'minlength'     => '4',
												'maxlength'     => '4',
												'type'         => 'text',
												'value'         => set_value('social_number'),
												'class'         => 'form-control  col-xs-10 url-upload link',
												);

												echo form_input($data);
												?>
												<div class="error-vlidation"><?php echo form_error('social_number'); ?></div>
                                      </div>
									  
									  
									  
									  <div class="form-group">
                                          <label for="cc-payment" class="control-label mb-1">Occupation * </label>
                                          <?php
												$data = array(
												'name'          => 'occupation',
												'id'            => "occupation",
												//'placeholder'   => 'Occupation *',
												// 'required'     => 'required',
												'type'         => 'text',
												'value'         => set_value('occupation'),
												'class'         => 'form-control  col-xs-10 url-upload link',
												);

												echo form_input($data);
												?>
												<div class="error-vlidation"><?php echo form_error('occupation'); ?></div>
                                      </div>
									  
									  <div class="form-group">
                                          <label for="cc-payment" class="control-label mb-1">Sources of income * </label>
                                         <?php
											$data = array(
											'name'          => 'sources_of_income',
											'id'            => "sources_of_income",
											//'placeholder'   => 'Sources of income  *',
											//'required'     => 'required',
											'type'         => 'text',
											'value'         => set_value('sources_of_income'),
											'class'         => 'form-control  col-xs-10 url-upload link',
											);

											echo form_input($data);
											?>
											<div class="tooltip">Help
											<span class="tooltiptext"><h3>Source of Income</h3><p>What is/are your recurring means of financial support? (Examples: Individual – salary, monthly pension/annuity payout; Non-Individual – sales of product/service) Source of Wealth – From what sources have you accumulated your capital? (Examples: Individual – divestment of property, inheritance, accumulated savings; Non-Individual – venture funding)</p></span>
											</div>
											
											<div class="error-vlidation"><?php echo form_error('sources_of_income'); ?></div>
                                      </div>
									  <div class="form-group">
                                          <label for="cc-payment" class="control-label mb-1">Reference ID (Optional)</label>
                                          <?php
												if(!empty($user_data['refered_id'])){
												$data = array(
												'name'          => 'reference_id',
												'id'            => "reference_id",
												'value'         => $user_data['refered_id'],
												'readonly'         => 'readonly',
												'class'         => 'form-control  col-xs-10 url-upload link',
												);
												echo form_input($data);
												}else{
												$data = array(
												'name'          => 'reference_id',
												'id'            => "reference_id",
												//'placeholder'   => 'Reference id (Optional)',
												'value'         => set_value('reference_id'),
												'class'         => 'form-control  col-xs-10 url-upload link',
												);
												echo form_input($data);

												}
												?>
                                      </div>
									  
									  <div class="form-group">
                                          <label for="cc-payment" class="control-label mb-1">Currency (Fiat, ETH, BTC, etc.) * </label>
                                         <?php
											$data = array(
											'name'          => 'currency',
											'id'            => "currency",
											//'placeholder'   => 'Currency (Fiat, ETH, BTC, etc.)  *',
											//'required'     => 'required',
											'type'         => 'text',
											'value'         => set_value('currency'),
											'class'         => 'form-control  col-xs-10 url-upload link',
											);

											echo form_input($data);
											?>
											<div class="error-vlidation"><?php echo form_error('currency'); ?></div>
                                      </div>
									  <div class="form-group">
                                          <label for="cc-payment" class="control-label mb-1">Purchase amount (USD) * </label>
                                          <?php
											$data = array(
											'name'          => 'Purchase-amount',
											'id'            => "Purchase-amount",
											//'placeholder'   => 'Purchase amount (USD) *',
											//'required'     => 'required',
											'type'         => 'text',
											'value'         => set_value('Purchase-amount'),
											'class'         => 'form-control  col-xs-10 url-upload link',
											);

											echo form_input($data);
											?>
											<div class="error-vlidation"><?php echo form_error('Purchase-amount'); ?></div>
                                      </div>
									  
									  <div class="form-group">
                                          <label for="cc-payment" class="control-label mb-1">Eth Wallet address * </label>
                                         <?php
											$data = array(
											'name'          => 'wallet_address',
											'id'            => "wallet_address",
											//'placeholder'   => 'Eth Wallet address *',
											//'required'     => 'required',
											'type'         => 'text',
											//'minlength'   => '30',
											'value'         => set_value('wallet_address'),
											'class'         => 'form-control  col-xs-10 url-upload link',
											);

											echo form_input($data);
											?>
											<div class="error-vlidation"><?php echo form_error('wallet_address'); ?></div>
											<p style="color:red;"><?php if(!empty($eth_add_err)){echo $eth_add_err;} ?></p>
                                      </div>
									  
									  <div class="form-group">
                                          <label for="cc-payment" class="control-label mb-1">Country of issuance * </label>
                                          <?php
											$issuence = array('' => 'Country of issuance  *' );
											if(!empty($contry))
											{
											foreach($contry as $val){ 
											$issuence[$val['country_name']] = $val['country_name'];
											}
											}
											$attr = array(
											'class' => 'form-control type',
											// 'required' => 'required',
											'id' => "issuence",
											);
											echo form_dropdown('issuence', $issuence,set_value('issuence'),$attr);
											?>


											<!--select name="issuence" id="issuence" class="form-control type" required>
											<option value="">Country of issuance *</option>
											<?php 
											if(!empty($contry)){
											foreach($contry as $val){ ?>
											<option value="<?php echo $val['country_name']; ?>"><?php echo $val['country_name']; ?></option>
											<?php }
											}
											?>
											</select-->
											<div class="error-vlidation"><?php echo form_error('issuence'); ?></div>
                                      </div>
									  
									  <div class="form-group">
                                          <label for="cc-payment" class="control-label mb-1">Select the Id Proof * </label>
                                          <?php
											$id_type = array(
											'' => '',
											'DL' => 'Driver Licence',
											'Passport' => 'Passport',
											'id' => 'ID',
											'Residence' => 'Residence Permit',
											);
											$attr = array(
											'class' => 'form-control type',
											//'required' => 'required',
											'id' => "id_type",
											);
											echo form_dropdown('id_type', $id_type,set_value('id_type'),$attr);
											?>
											
											
											<div class="error-vlidation"><?php echo form_error('id_type'); ?></div>
                                      </div>
									  
									  <div class="form-group">
                                          <label for="cc-payment" class="control-label mb-1">Select Image * </label>
                                          <?php
											$data = array(
											'name'          => 'file',
											'id'            => "file",
											//'placeholder'   => 'file',
											// 'required'     => 'required',
											'value'         => set_value('file'),
											'class'         => 'form-control  col-xs-10 url-upload link',
											"accept"  =>  ".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf",
											);

											echo form_upload($data); 
											?>
											<div class="error-vlidation"><?php echo form_error('file'); ?></div>
                                      </div>
									  
									  <div class="form-group">
										<button type="submit" class="btn btn-success btn-sm">
										<i class="fa fa-dot-circle-o"></i> Submit
										</button> 
									  </div>
									</div>  
								 <?php echo form_close(); ?>
								  
								  
							 </div>
						 </div> <!-- .card -->	
					  </div>
				  </div>
				</div>
			  </div>
			</div>
		  </div>
		</div>
		
		
		
		
		
	</div>	
	
	

<?php include('includes/dashboard_footer.php');?>

<script>
function copyRefrel(){	
	var copyText = document.getElementById('copyRefrelInput');    
	
	copyText.select();
	document.execCommand("Copy");
	
}
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>  

<script>
  $( function() {
    $( "#dob" ).datepicker({ dateFormat: 'mm/dd/yy', changeMonth: true,
      changeYear: true,yearRange: "-100:+0", });
  } );
 
  </script>
  
  