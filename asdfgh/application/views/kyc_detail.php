<div class="right_col" role="main">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_divanel">
	  
	   <a href="<?php echo base_url(); ?>kyc" class="btn btn-primary">Back</a>
        <div class="x_title">
            <h2>KYC Detail</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content remove-scroll">
			<div id="my-tab-content" class="tab-content">			
				<div class="tab-pane copy-these-text active" id="kyc_detail"> 
				
				<div class="inner_kyc"><span class="head">Name: </span>
				<input type="text" value="<?php echo $user['firstname'].' '.$user['lastname']; ?>" id="name" class="velue" readonly="readonly">
				<button type="button" class="btn btn-outline-success" onclick="copyTextName();">Copy</button>
				</div> 
			
				<div class="inner_kyc"><span class="head">Email: </span>
				<input type="text" value="<?php echo $user['email']; ?>" id="email" class="velue" readonly="readonly">
				<button type="button" class="btn btn-outline-success" onclick="copyTextEmail();">Copy</button>
				</div>
				
				<div class="inner_kyc"><span class="head">Phone: </span>
				<input type="text" value="<?php echo $user['phn']; ?>" id="phone" class="velue" readonly="readonly">
				<button type="button" class="btn btn-outline-success" onclick="copyTextPhone();">Copy</button>
				</div>
				
				<div class="inner_kyc"><span class="head">Date of Birth: </span>				
				<input type="text" value="<?php echo $user['dob']; ?>" id="dob" class="velue" readonly="readonly">
				<button type="button" class="btn btn-outline-success" onclick="copyTextDob();">Copy</button>
				</div>
				
				<div class="inner_kyc"><span class="head">Street: </span>
				<input type="text" value="<?php echo $user['street']; ?>" id="street" class="velue" readonly="readonly">
				<button type="button" class="btn btn-outline-success" onclick="copyTextStreet();">Copy</button>
			</div>



			 <div class="inner_kyc"><span class="head">City: </span>
				<input type="text" value="<?php echo $user['city']; ?>" id="city" class="velue" readonly="readonly">
				<button type="button" class="btn btn-outline-success" onclick="copyTextCity();">Copy</button>
			</div>			 


			 <div class="inner_kyc"><span class="head">State: </span>
				<input type="text" value="<?php echo $user['state']; ?>" id="state" class="velue" readonly="readonly">
				<button type="button" class="btn btn-outline-success" onclick="copyTextState();">Copy</button>
			</div>

			 <div class="inner_kyc"><span class="head">Postcode: </span>
				<input type="text" value="<?php echo $user['postcode']; ?>" id="postcode" class="velue" readonly="readonly">
				<button type="button" class="btn btn-outline-success" onclick="copyTextPostcode();">Copy</button>
			</div>

			 <div class="inner_kyc"><span class="head">Country : </span>
				<input type="text" value="<?php echo $user['country']; ?>" id="country" class="velue" readonly="readonly">
				<button type="button" class="btn btn-outline-success" onclick="copyTextCountry();">Copy</button>
			</div>
			
			 <div class="inner_kyc"><span class="head">Citizenship: </span><span class="velue"><?php echo $user['citizenship']; ?></span></div>
				
				<?php if($user->type == 'us_customer'){   ?>
					<div class="inner_kyc"><span class="head">Social Security Number: </span>
					<input type="text" value="<?php echo $user['ssn']; ?>" id="SSN" class="velue" readonly="readonly">
					<button type="button" class="btn btn-outline-success" onclick="copyTextSSN();">Copy</button></div> 
				<?php }else{   ?> 
					<div class="inner_kyc"><span class="head">Government Identification Number: </span>
					<input type="text" value="<?php echo $user['ssn']; ?>" id="SSN" class="velue" readonly="readonly">
					<button type="button" class="btn btn-outline-success" onclick="copyTextSSN();">Copy</button></div> 
				<?php }   ?>

			 <div class="inner_kyc"><span class="head">Occupation: </span><span class="velue"><?php echo $user['occupation']; ?></span></div>
			 
			  <div class="inner_kyc"><span class="head">Sources of Income: </span><span class="velue"><?php echo $user['sources_of_income']; ?></span></div>
			 
			 
			 <div class="inner_kyc"><span class="head">Reference Id: </span><span class="velue"><?php  
				 echo $user['reference_id'];
			  ?></span></div>
			  
			 <div class="inner_kyc"><span class="head">Refered Id:</span><span class="velue"><?php 
			 echo $user['refered_id'];
			 ?></span></div>			 
			 			 
			  <div class="inner_kyc"><span class="head">Currency: </span><span class="velue"><?php echo $user['currency']; ?></span></div>
			 <div class="inner_kyc"><span class="head">Purchase Amount: </span><span class="velue"><?php echo $user['purchase_amount']; ?></span></div>
			
			  <?php if(!empty($user['high_risk_country'])){ ?>
				<div class="inner_kyc"><span class="head">High Risk Country: </span><span class="velue"><?php echo $user['high_risk_country']; ?></span></div>
			 <?php } ?> 	
			 <div class="inner_kyc"><span class="head">ETH Wallet Address: </span>
				<input type="text" value="<?php echo $user['eth_address']; ?>" id="eth_address" class="velue" readonly="readonly">
				<button type="button" class="btn btn-outline-success" onclick="copyText_eth_address();">Copy</button>
			</div>
			 <div class="inner_kyc"><span class="head">Country Issuance: </span><span class="velue"> <?php echo $user['issuance']; ?></span></div>			 
			 <div class="inner_kyc"><span class="head">ID Proof: </span><span class="velue"><?php echo $user['id_proof']; ?></span></div>
	<?php if(!empty($user['image'])){    ?>		 
			<div class="inner_kyc">
				<span class="head">Image:</span>
				<span class="velue">
					<img src="<?php echo KYC_IMAGE_PATH;?><?php echo $user['image'];?>" class="uimage"  alt="<?php echo $user['image'];?>"/>
					<a href="<?php echo site_url('kyc/download/'.$user['user_id']) ?>" id="dwnld">Download </a>
				</span> 
			</div>  	
	<?php }    ?>			
			<div class="inner_kyc"><span class="head">Type of user: </span><span class="velue"><?php 
			if($user['type'] == 'us_customer'){echo 'Us customer'; }else{echo 'Non Us customer';}?></span></div>
			
			 <div class="inner_kyc"><span class="head">Status of kyc: </span><span class="velue kyc-vrfy">
				<select name="status" onchange="status(value,'<?php echo $user['user_id']; ?>')" class="form-control stt" <?php if($user['kyc_status'] == "verified"){ echo "disabled"; }?> id="<?php echo $user['user_id']; ?>">
										<option value="under" <?php	if($user['kyc_status'] == "under"){	echo "selected";}?>>Under Process</option>
										<option value="verified" <?php if($user['kyc_status'] == "verified"){ echo "selected";}?>>Verified</option>
									</select></span></div> 
			 <div class="inner_kyc"><span class="head">Date of submission: </span><span class="velue"><?php echo date('d M Y, h:i:s a',strtotime($user['date'])); ?></span></div>
			 <?php if(!empty($tracking_detail)){    ?>
			  <div class="inner_kyc"><span class="head">Device ID: </span><span class="velue"><?php echo $tracking_detail['device_id']; ?></span></div>
			   <div class="inner_kyc"><span class="head">Device Type: </span><span class="velue"><?php echo $tracking_detail['device_type']; ?></span></div>
			    <div class="inner_kyc"><span class="head">IP Address: </span><span class="velue"><?php echo $tracking_detail['ip_address']; ?></span></div>
				
				
			 <?php }  ?>
			 
			
			<div class="contribution-user">
				<div class="contributions-form"><span class="">Proof of contribution by user</span></div>
		<?php 	if(!empty($account)){  
					foreach($account as $value){  ?>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tax"><?php  echo $value['coin_name']; ?> Amount</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" id="add_<?php  echo $value['coin_name']; ?>" class="form-control col-md-7 col-xs-12" name="btc_add" value="<?php  echo $value['amount']; ?>" readonly="readonly"> 							
							</div>
						</div>			
		<?php 		}
				}else{ 		?>	
				
		<?php 	} 			?>			
					
					
			</div>  <!--   last  -->	
			<div class="contribution-admin">	
				<div class="contributions-form"><span class="">Contribution Verification by admin</span></div>
			
				<?php							
					$attributes = array('role'=>"form", 'id' => 'contribution', 'method'=>'post', 'class'=>'form-horizontal form-label-left');
					$url = base_url().'contribution';
					echo form_open_multipart($url, $attributes);
				
					$data = array(
						'name'          => $this->security->get_csrf_token_name(),
						'type'         => 'hidden',
						'value'         => $this->security->get_csrf_hash()
					);

					echo form_input($data);
					
?>			
				
					<input type="hidden" id="user_id" class="form-control col-md-7 col-xs-12" name="user_id" value="<?php echo $user['user_id'];?>">
					<input type="hidden" id="refered_id" class="form-control col-md-7 col-xs-12" name="refered_id" value="<?php echo $user['refered_id'];?>">
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tax">Transaction ID</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" id="transaction_id" class="form-control col-md-7 col-xs-12" name="transaction_id" value="<?php if(isset($contribution->transaction_id)){echo $contribution->transaction_id;}?>"> 
						<span class="error_class" id="c_trans_err"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tax">Contribution amount</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" id="c_amount" class="form-control col-md-7 col-xs-12" name="contribution_amount" value="<?php if(isset($contribution->contribution_amount)){echo $contribution->contribution_amount;}?>"> 
						<span class="error_class" id="c_amount_err"></span>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tax">Contributed Currency Type</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" id="c_currency" class="form-control col-md-7 col-xs-12" name="contributed_currency" value="<?php if(isset($contribution->contributed_currency)){echo $contribution->contributed_currency;}?>"> 
						<span class="error_class" id="c_currency_err"></span>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tax">Contribution in dollar</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" id="contribution_in_dollar" class="form-control col-md-7 col-xs-12" name="contribution_in_dollar" value="<?php if(isset($contribution->contribution_in_dollar)){echo $contribution->contribution_in_dollar;}?>">
						<span class="error_class" id="c_dollar_err"></span>
						</div><span class="cur-sign">$</span>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tax">Bonus</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" id="bonus" class="form-control col-md-7 col-xs-12" name="bonus" value="<?php if(isset($contribution->bonus)){echo $contribution->bonus;}?>"> 
						<span class="error_class" id="c_bonus_err"></span>
						</div> <span class="cur-sign">%</span>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tax">Referral Coins</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" id="referral_coins" class="fmycontrol col-md-9 col-xs-12" name="referral_coins" value="<?php if(isset($reward_points)){echo $reward_points;}?>" readonly="readonly">
							<?php 	
								if(!empty($reward_points)){ 							
									if($reward_points != '0.00'){  ?>
										<span class="pull-right"><a href="<?php echo base_url() ?>referrals/<?php echo $user['user_id']; ?>" target="_blank" class=" btn btn-primary referel-user-list">Referel Detail</a></span>
										
							<?php	}}     ?>						
						<span class="error_class" id="c_bonus_err"></span>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tax">Referral Bonus Percentage</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" id="referral_bonus_percentage" class="form-control col-md-7 col-xs-12" name="referral_bonus_percentage" value="<?php if(isset($contribution->referral_bonus_percentage)){echo $contribution->referral_bonus_percentage;}else{echo '10';}?>">  
						<span class="error_class" id="c_bonus_err"></span>
						</div><span class="cur-sign"> %</span>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tax"><?php //echo DOMAIN_NAME; ?>Total Coins</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" id="total_coins" class="form-control col-md-7 col-xs-12" name="total_coins" value="<?php 
							
								$totl_boon = $own_coins+$reward_points;
								if(!empty($totl_boon) || $totl_boon != '0'){
									$total_boon = $totl_boon;
								}else{
									$total_boon = $contribution->total_coins;
								}
							echo $total_boon;?>" readonly="readonly"> 
						<span class="error_class" id="c_boon_coins_err"></span>
						</div>
					</div>
										
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tax">Status of investment</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select name="status" class="form-control stt" id="invest_<?php echo $user['user_id']; ?>">
								<option value="under" <?php	if($contribution->contribute_status == "under"){	echo "selected";}?>>Under Process</option>
								<option value="verified" <?php if($contribution->contribute_status == "verified"){ echo "selected";}?>>Verified</option>
							</select> 
						<span class="error_class" id="c_currency_err"></span>
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"> 
						<button type="submit" class="btn btn-success" id="update_contribution_btn">Update</button>
						</div>
					</div>
				<?php      echo form_close();   ?>
				</div>
        </div>
        </div>
      </div>
    </div>
  </div>
<div id="myModal" class="modal">
  <sdivan class="close">×</sdivan>
  <img class="modal-content" id="img01">
  <div id="cadivtion"></div>
</div>
<style>
a#dwnld {
    margin-left: 7%;
}
.error_class {
    color: red;
    display: none;
    float: left;
    font-size: 14px;
    text-align: left;
    width: 100%;
}
.contributions-form {
    border-bottom: 1px solid #efefef;
    color: #666;
    float: left;
    font-size: 20px;
    font-weight: bold;
    margin: 15px 0;
    padding-bottom: 6px;
    text-align: center;
    width: 100%;
}
.fmycontrol {
    height: 35px;
}
</style>

<script>
$('#contribution_in_dollar').keyup(function (){
	
	var inputVal = $('#contribution_in_dollar').val();
	var characterReg = /^[0-9]+$/;
	//var pattern = /^[0-9]+(,[0-9]+)*$/;
	if(!$.isNumeric(inputVal)){
		alert('Please enter only integer value.');
		$('#contribution_in_dollar').val('');
		return false;
	}
});
</script>

<script>
$('#c_amount').click(function(){	
	$('#c_amount_err').css('display','none');
});
$('#bonus').click(function(){	
	$('#c_bonus_err').css('display','none');
});
$('#boon_coins').click(function(){	
	$('#c_boon_coins_err').css('display','none');
});
$('#c_currency').click(function(){	
	$('#c_currency_err').css('display','none');
});


$('#update_contribution_btn').click(function(event){
	$('#c_amount_err').css('display','none');
	$('#c_bonus_err').css('display','none');
	$('#c_boon_coins_err').css('display','none');
	$('#c_currency_err').css('display','none');
	event.preventDefault();
	var ContributionAmount 	= $('#c_amount').val();
	var Bonus 				= $('#bonus').val();
	var BoonCoins 			= $('#boon_coins').val();
	var ContributedCurrency = $('#c_currency').val();
	var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
	
});
</script>

<script>
function status(val,user_id){
	
	if(val == "verified"){
		$("#"+user_id).attr("disabled",true);
	}
	var request = $.ajax({
		url: "<?php echo base_url(); ?>kyc_status",
		method: "POST",
		data: {user_id:user_id,status:val,'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
	});
	request.done(function( msg ) {
		window.location.href="<?php echo base_url();?>kyc_detail/"+user_id;
	});
}

function account_status(val,user_id){
	
	if(val == "verified"){
		$("#invest_"+user_id).attr("disabled",'disabled');
	}
	var request = $.ajax({
		url: "<?php echo base_url(); ?>contribution/change_status",
		method: "POST",
		data: {user_id:user_id,status:val,'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
	});
	request.done(function( msg ) {
		window.location.href="<?php echo base_url();?>kyc_detail/"+user_id;
	});
}
</script>

<script>
function copyTextSerial() {
    var copyText = document.getElementById("SerialNumber");
    copyText.select();
    document.execCommand("Copy");
  
}
function copyTextName() {
    var copyText = document.getElementById("name");
    copyText.select();
    document.execCommand("Copy");
  
}
function copyTextEmail() {
    var copyText = document.getElementById("email");
    copyText.select();
    document.execCommand("Copy");
    
}
function copyTextDob() {
    var copyText = document.getElementById("dob");
    copyText.select();
    document.execCommand("Copy");
    
}
function copyTextPhone() {
    var copyText = document.getElementById("phone");
    copyText.select();
    document.execCommand("Copy");
   
}
function copyTextStreet() {
    var copyText = document.getElementById("street");
    copyText.select();
    document.execCommand("Copy");
    
}
function copyTextAddressOne() {
    var copyText = document.getElementById("address_one");
    copyText.select();
    document.execCommand("Copy");
    
}
function copyTextAddressTwo() {
    var copyText = document.getElementById("address_two");
    copyText.select();
    document.execCommand("Copy");
    
}
function copyTextCity() {
    var copyText = document.getElementById("city");
    copyText.select();
    document.execCommand("Copy");
    
}
function copyTextState() {
    var copyText = document.getElementById("state");
    copyText.select();
    document.execCommand("Copy");
   
}
function copyTextPostcode() {
    var copyText = document.getElementById("postcode");
    copyText.select();
    document.execCommand("Copy");
   
}
function copyTextCountry() {
    var copyText = document.getElementById("country");
    copyText.select();
    document.execCommand("Copy");
    
}
function copyTextSSN() {
    var copyText = document.getElementById("SSN");
    copyText.select();
    document.execCommand("Copy");
   
}

function copyTextCountryCode() {
    var copyText = document.getElementById("country_code");
    copyText.select();
    document.execCommand("Copy");
   
}
function copyText_eth_address() {
    var copyText = document.getElementById("eth_address");
    copyText.select();
    document.execCommand("Copy");
    
}
</script>
<script>

$("#contribution_in_dollar").on("keyup",function (event) {
	var amount = $('#contribution_in_dollar').val();
     var referral_coins = $('#referral_coins').val();
	 if(referral_coins==''){
		 referral_coins=0;
	 }
    
		amount = amount.replace("($","").replace(")","")
		amount = amount.replace(",","");
     
			var bonus = $('#bonus').val();
			if(bonus==0 || bonus==''){ 
				bonus = 0;
			}   
			var one_boon_coin = parseFloat(0.04);
			var boon_coin_bonus = ((amount*2)*(bonus/100));
			var boon_totolamont = (amount*2);
			var boon_coin = (boon_coin_bonus + boon_totolamont);
				boon_coin = (parseFloat(boon_coin))+(parseFloat(referral_coins));
			$('#total_coins').val(boon_coin);
        });

	$("#bonus").on("keyup",function (event) {
		
           
		 var amount = $('#contribution_in_dollar').val();
		 var referral_coins = $('#referral_coins').val();
		 
		 if(referral_coins==''){
			 referral_coins=0;
		 }
		amount = amount.replace("($","").replace(")","")
		amount = amount.replace(",","");
		var bonus = $('#bonus').val();
		if(bonus==0 || bonus==''){
			bonus = 0;
		}   
		var one_boon_coin = parseFloat(0.04);
		var boon_coin_bonus = ((amount*2)*(bonus/100));
		var boon_totolamont = (amount*2);
		var boon_coin = (boon_coin_bonus + boon_totolamont);
		var boon_coin = (boon_coin_bonus + boon_totolamont);
			boon_coin = (parseFloat(boon_coin))+(parseFloat(referral_coins));
		$('#total_coins').val(boon_coin);
	});
	
	
	$("#referral_bonus_percentage").on("keyup",function (event) {
		
		var user_id = $('#user_id').val();
		var percent = $('#referral_bonus_percentage').val();
		$.ajax({
			url:'<?php echo base_url(); ?>kyc/get_refrel_bonus',
			data:{'user_id':user_id,'percent':percent},
			type:'post',
			dataType:'json',
			success:function(res){
				var percent = res.data;
				console.log(res);
				$('#referral_coins').val(percent);
				
				console.log(res);
				var amount = $('#contribution_in_dollar').val();
				var referral_coins = $('#referral_coins').val();
				 
				if(referral_coins==''){
					referral_coins=0;
				}
				amount = amount.replace("($","").replace(")","")
				amount = amount.replace(",","");
				var bonus = $('#bonus').val();
				if(bonus==0 || bonus==''){
					bonus = 0;
				}   
				var one_boon_coin = parseFloat(0.04);
				var boon_coin_bonus = ((amount*2)*(bonus/100));
				var boon_totolamont = (amount*2);
				var boon_coin = (boon_coin_bonus + boon_totolamont);
				var boon_coin = (boon_coin_bonus + boon_totolamont);
					boon_coin = (parseFloat(boon_coin))+(parseFloat(referral_coins));
				$('#total_coins').val(boon_coin);
			}			
		});
	});

	
   	

</script>


<script type="text/javascript">
function confirmDeletion(eid,table){
	var result = confirm("Are you sure you want to Delete this event?");
	if(result){  
		document.location.href="<?php echo site_url('admin/dashboard/del_event'); ?>/"+eid+"/"+table;
		return true; 
	}else{
		return false;
	}
} 

</script>

