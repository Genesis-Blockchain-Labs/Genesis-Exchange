<?php include('includes/dashboard_header.php');
$user_data = $this->session->userdata('user_data');
?>
 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
				<?php if(!empty($price_bonus['token_price'])){ ?>
					<input type="hidden" name="token_price" id="token_price"  value="<?php echo $price_bonus['token_price']; ?>" />
				<?php } else { ?>
					<input type="hidden" name="token_price" id="token_price"  value="0" />
				<?php } if(!empty($price_bonus['extra_bonus'])){ ?>
					<input type="hidden" name="extra_bonus" id="extra_bonus"  value="<?php echo $price_bonus['extra_bonus']; ?>" />
				<?php } else { ?>
					<input type="hidden" name="extra_bonus" id="extra_bonus"  value="0" />
				<?php } if(!empty($ico_setup['dollar_to_safeada'])){ ?>
					<input type="hidden" name="dollar_to_safeada" id="dollar_to_safeada"  value="<?php echo $ico_setup['dollar_to_safeada']; ?>" />
				<?php } else { ?>
					<input type="hidden" name="dollar_to_safeada" id="dollar_to_safeada"  value="1" />
				<?php } ?>
                    <div class="panel panel-default coin-list">
                        <div class="panel-body">
								<?php							
									$attributes = array('role'=>"form", 'id' => 'btc_form', 'method'=>'post', 'autocomplete'=>'off');
									$url = base_url().'Invest/createTransaction';
									echo form_open_multipart($url, $attributes);
								
									$data = array(
											'name'          => $this->security->get_csrf_token_name(),
											'type'         => 'hidden',
											'value'         => $this->security->get_csrf_hash()
											);
									echo form_input($data);
									$data = array(
											'name'          => 'coin_type',
											'type'         => 'hidden',
											'value'         => 1
											);

									echo form_input($data);
							
							?> 							
							<input type="hidden" id="btc_token" value="" name="epr_token"/>
							<input type="hidden" id="btc_dollar" value="" name="dollar_amount"/>
							<input type="hidden" name="address" value="<?php echo $btc_address; ?>">
							<input type="hidden" name="currency" value="BTC">
                            <div class="row btc_div">
									<div class="col-lg-2">
										<div class="frame">
											<span class="helper"></span>
											<img src="<?php echo base_url();?>assets/new_design/dist/img/coinx-btc.png">
										</div>
									</div>
									<div class="col-lg-4">
										<div class="coin-title">Continue with Bitcoin</div>		
										<p>Enter the amount in bitcoin</p>
										<?php	
											$data = array(
												'name'          => 'amount',  
												'id'            => 'btc_amount',
												'placeholder'   => 'BTC Amount',
												'type'         => 'number',
												'value'         => set_value('btc_amount'),
												'class'         => 'form-control',
												'step'			=> '0.01',
												'min'			=>'0.01',
											);
											echo form_input($data);
										?>
								<div class="error-vlidation btc_error"></div>
										<small>Min payment 0.01 BTC</small>	
									</div>
									<div class="col-lg-2" id="btc_epr">
									</div>
									
									<div class="col-lg-2">
										<div class="area">
											<input type="button" onclick="save_btc();" class="btn btn-invest-now" value="Invest Now" id="btc_but">
										</div>
									</div>
									
									<div class="col-lg-2"></div>
                            </div>
							<?php echo form_close(); ?>
						<div class="crsc-dashboard-m1-info transac"></div>
                        </div>
                    </div>
                    <div class="panel panel-default coin-list">
                        <div class="panel-body">
							<?php							
								$attributes = array('role'=>"form", 'id' => 'u_s', 'method'=>'post', 'autocomplete'=>'off');
								$url = base_url().'eth';
								echo form_open_multipart($url, $attributes);
							
								$data = array(
									'name'          => $this->security->get_csrf_token_name(),
									'type'         => 'hidden',
									'value'         => $this->security->get_csrf_hash()
								);
								echo form_input($data);
													$data = array(
														'name'          => 'coin_type',
														'type'         => 'hidden',
														'value'         => 2
													);

								echo form_input($data);	
							?> 					
					<input type="hidden" id="eth_token" value="" name="epr_token"/>
					<input type="hidden" id="eth_dollar" value="" name="dollar_amount"/>
					<input type="hidden" name="address" value="<?php echo $eth_address; ?>">
					<input type="hidden" name="currency" value="ETH">
                            <div class="row eth_div">
                                <div class="col-lg-2">
                                    <div class="frame">
                                        <span class="helper"></span>
                                        <img src="<?php echo base_url();?>assets/new_design/dist/img/coinx-eth.png">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="coin-title">Continue with Ethereum</div>
                                    <p>Enter the amount in ethereum</p>
                                    <?php
								$data = array(
									'name'          => 'amount',
									'id'            => 'eth_amount',
									'placeholder'   => 'ETH Amount',
									'type'         => 'number',
									'value'         => set_value('eth_amount'),
									'class'         => 'form-control',
									'step'			=> '0.01',
									'min'			=>'0.01',
								);
								
								echo form_input($data);		
						?>
						<div class="error-vlidation eth_error"></div>
										
                                    <small>Min payment 0.01 ETH</small>		
                                </div>
                                <div class="col-lg-2" id="eth_epr">	
                                </div>
                                <div class="col-lg-2">
                                    <div class="area">
									<input type="button" class="btn btn-invest-now" id="eth_but" value="Invest Now" onclick="save_eth();">
                                    </div>
                                </div>
                                <div class="col-lg-2">   
                                </div>
                            </div>
							<?php echo form_close(); ?>
							<div class="crsc-dashboard-m1-info transac_eth"></div>
                        </div>
                    </div>
					<div class="panel panel-default coin-list">
                        <div class="panel-body">
							<?php							
								$attributes = array('role'=>"form", 'id' => 'doge_form', 'method'=>'post', 'autocomplete'=>'off');
								$url = base_url().'doge';
								echo form_open_multipart($url, $attributes);
							
								$data = array(
									'name'          => $this->security->get_csrf_token_name(),
									'type'         => 'hidden',
									'value'         => $this->security->get_csrf_hash()
								);
								echo form_input($data);
													$data = array(
														'name'          => 'coin_type',
														'type'         => 'hidden',
														'value'         => 3
													);

								echo form_input($data);	
							?> 					
					<input type="hidden" id="doge_token" value="" name="epr_token"/>
					<input type="hidden" id="doge_dollar" value="" name="dollar_amount"/>
					<input type="hidden" name="address" value="<?php echo $doge_address; ?>">
					<input type="hidden" name="currency" value="DOGE">
                            <div class="row doge_div">
                                <div class="col-lg-2">
                                    <div class="frame">
                                        <span class="helper"></span>
                                        <img src="<?php echo base_url();?>assets/new_design/dist/img/coinx-doge.png">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="coin-title">Continue with Dogecoin</div>
                                    <p>Enter the amount in dogecoin</p>
                                    <?php
								$data = array(
									'name'          => 'amount',
									'id'            => 'doge_amount',
									'placeholder'   => 'DOGE Amount',
									'type'         => 'number',
									'value'         => set_value('doge_amount'),
									'class'         => 'form-control',
									'step'			=> '0.01',
									'min'			=>'0.01',
								);
								
								echo form_input($data);		
						?>
						<div class="error-vlidation doge_error"></div>
										
                                    <small>Min payment 0.01 DOGE</small>		
                                </div>
                                <div class="col-lg-2" id="doge_epr">	
                                </div>
                                <div class="col-lg-2">
                                    <div class="area">
									<input type="button" class="btn btn-invest-now" id="doge_but" value="Invest Now" onclick="save_doge();">
                                    </div>
                                </div>
                                <div class="col-lg-2">   
                                </div>
                            </div>
							<?php echo form_close(); ?>
							<div class="crsc-dashboard-m1-info transac_doge"></div>
                        </div>
                    </div>
					<div class="panel panel-default coin-list">
                        <div class="panel-body">
							<?php							
								$attributes = array('role'=>"form", 'id' => 'bnb_form', 'method'=>'post', 'autocomplete'=>'off');
								$url = base_url().'bnb';
								echo form_open_multipart($url, $attributes);
							
								$data = array(
									'name'          => $this->security->get_csrf_token_name(),
									'type'         => 'hidden',
									'value'         => $this->security->get_csrf_hash()
								);
								echo form_input($data);
													$data = array(
														'name'          => 'coin_type',
														'type'         => 'hidden',
														'value'         => 4
													);

								echo form_input($data);	
							?> 					
					<input type="hidden" id="bnb_token" value="" name="epr_token"/>
					<input type="hidden" id="bnb_dollar" value="" name="dollar_amount"/>
					<input type="hidden" name="address" value="<?php echo $bnb_address; ?>">
					<input type="hidden" name="currency" value="BNB">
                            <div class="row bnb_div">
                                <div class="col-lg-2">
                                    <div class="frame">
                                        <span class="helper"></span>
                                        <img src="<?php echo base_url();?>assets/new_design/dist/img/coinx-bnb.png">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="coin-title">Continue with Bnb</div>
                                    <p>Enter the amount in bnb</p>
                                    <?php
								$data = array(
									'name'          => 'amount',
									'id'            => 'bnb_amount',
									'placeholder'   => 'BNB Amount',
									'type'         => 'number',
									'value'         => set_value('bnb_amount'),
									'class'         => 'form-control',
									'step'			=> '0.01',
									'min'			=>'0.01',
								);
								
								echo form_input($data);		
						?>
						<div class="error-vlidation bnb_error"></div>
										
                                    <small>Min payment 0.01 BNB</small>		
                                </div>
                                <div class="col-lg-2" id="bnb_epr">	
                                </div>
                                <div class="col-lg-2">
                                    <div class="area">
									<input type="button" class="btn btn-invest-now" id="bnb_but" value="Invest Now" onclick="save_bnb();">
                                    </div>
                                </div>
                                <div class="col-lg-2">   
                                </div>
                            </div>
							<?php echo form_close(); ?>
							<div class="crsc-dashboard-m1-info transac_bnb"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script>
function myFunction() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  document.execCommand("Copy");
}

function myFunction1() {
  var copyText = document.getElementById("myInput1");
  copyText.select();
  document.execCommand("Copy");
}
function myFunction2() {
  var copyText = document.getElementById("myInput2");
  copyText.select();
  document.execCommand("Copy");
}
function myFunction3() {
  var copyText = document.getElementById("myInput3");
  copyText.select();
  document.execCommand("Copy");
}
function myFunctions() {
  var copyText = document.getElementById("btc1");
  copyText.select();
  document.execCommand("Copy");
   var tooltip = document.getElementById("myTooltip1");
  tooltip.innerHTML = "Copied";
}
function myFunctionss() {
  var copyText = document.getElementById("btc11");
  copyText.select();
  document.execCommand("Copy");
   var tooltip = document.getElementById("myTooltip11");
  tooltip.innerHTML = "Copied";
}
function myFunctionsss() {
  var copyText = document.getElementById("btc111");
  copyText.select();
  document.execCommand("Copy");
   var tooltip = document.getElementById("myTooltip111");
  tooltip.innerHTML = "Copied";
}
function myFunctions2() {
  var copyText = document.getElementById("eth2");
  copyText.select();
  document.execCommand("Copy");
   var tooltip = document.getElementById("myTooltip2");
  tooltip.innerHTML = "Copied";
}
function myFunctions22() {
  var copyText = document.getElementById("eth22");
  copyText.select();
  document.execCommand("Copy");
   var tooltip = document.getElementById("myTooltip22");
  tooltip.innerHTML = "Copied";
}
function myFunctions222() {
  var copyText = document.getElementById("eth222");
  copyText.select();
  document.execCommand("Copy");
   var tooltip = document.getElementById("myTooltip222");
  tooltip.innerHTML = "Copied";
}

function myFunctions3() {
  var copyText = document.getElementById("ltc3");
  copyText.select();
  document.execCommand("Copy");
   var tooltip = document.getElementById("myTooltip3");
  tooltip.innerHTML = "Copied";
}
function myFunctions33() {
  var copyText = document.getElementById("ltc33");
  copyText.select();
  document.execCommand("Copy");
   var tooltip = document.getElementById("myTooltip33");
  tooltip.innerHTML = "Copied";
}
function myFunctions333() {
  var copyText = document.getElementById("ltc333");
  copyText.select();
  document.execCommand("Copy");
   var tooltip = document.getElementById("myTooltip333");
  tooltip.innerHTML = "Copied";
}
function myFunctions4() {
  var copyText = document.getElementById("dash4");
  copyText.select();
  document.execCommand("Copy");
   var tooltip = document.getElementById("myTooltip4");
  tooltip.innerHTML = "Copied";
}
function myFunctions44() {
  var copyText = document.getElementById("dash44");
  copyText.select();
  document.execCommand("Copy");
   var tooltip = document.getElementById("myTooltip44");
  tooltip.innerHTML = "Copied";
}
function myFunctions444() {
  var copyText = document.getElementById("dash444");
  copyText.select();
  document.execCommand("Copy");
   var tooltip = document.getElementById("myTooltip444");
  tooltip.innerHTML = "Copied";
}
function outFunc4() {
  var tooltip = document.getElementById("myTooltip4");
  tooltip.innerHTML = "Click Icon to copy";
}
function outFunc44() {
  var tooltip = document.getElementById("myTooltip44");
  tooltip.innerHTML = "Click Icon to copy";
}
function outFunc444() {
  var tooltip = document.getElementById("myTooltip444");
  tooltip.innerHTML = "Click Icon to copy";
}
function outFunc3() {
  var tooltip = document.getElementById("myTooltip3");
  tooltip.innerHTML = "Click Icon to copy";
}
function outFunc33() {
  var tooltip = document.getElementById("myTooltip33");
  tooltip.innerHTML = "Click Icon to copy";
}
function outFunc333() {
  var tooltip = document.getElementById("myTooltip333");
  tooltip.innerHTML = "Click Icon to copy";
}
function outFunc2() {
  var tooltip = document.getElementById("myTooltip2");
  tooltip.innerHTML = "Click Icon to copy";
}
function outFunc22() {
  var tooltip = document.getElementById("myTooltip22");
  tooltip.innerHTML = "Click Icon to copy";
}
function outFunc222() {
  var tooltip = document.getElementById("myTooltip222");
  tooltip.innerHTML = "Click Icon to copy";
}
function outFunc1() {
  var tooltip = document.getElementById("myTooltip1");
  tooltip.innerHTML = "Click Icon to copy";
}
function outFunc11() {
  var tooltip = document.getElementById("myTooltip11");
  tooltip.innerHTML = "Click Icon to copy";
}
function outFunc111() {
  var tooltip = document.getElementById("myTooltip111");
  tooltip.innerHTML = "Click Icon to copy";
}
</script>
<?php include('includes/dashboard_footer.php');?>
<script>
	$(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});
	var btc = $('#btc_amount').val();
	/**************get btc live rate************/
	$('#btc_amount').keyup(function(){
		var btc = $('#btc_amount').val();
		//var token_price = $('#token_price').val();
		//var extra_bonus = $('#extra_bonus').val();
		var dollar_to_safeada = $('#dollar_to_safeada').val();
		if(token_price == 0){
			token_price = 1;
		}
		if(extra_bonus == 0){
			extra_bonus = 1;
		}
	if(btc!="" && btc!=0 && btc>=parseFloat(0.01)){
		 $.ajax({
			 url: "https://min-api.cryptocompare.com/data/price?fsym=BTC&tsyms=USD",
			 method:'POST',
			 success: function(result){
				var usd = parseFloat(result.USD);
				var btc_dollar = parseFloat(btc)*usd;
				//var amount_epr = btc_dollar/parseFloat(token_price);
				//var bonus_epr = (amount_epr*extra_bonus)/100;
				//var amount = amount_epr+bonus_epr;
				var amount = btc_dollar*dollar_to_safeada;
				amount = amount.toFixed(2);
				$('#btc_dollar').val(btc_dollar);
				$('#btc_token').val(amount);
				$('#btc_epr').html('<div class="cash" >'+amount+' SafeAda</div><small>You will receive</small>');
			}
		});
	}
	else if(btc=="" || btc==0 || btc<parseFloat(0.01)){
		$('#btc_epr').html('');
	}	
	});
	/******************get eth live arte*******************/
	$('#eth_amount').keyup(function(){
		var eth = $('#eth_amount').val();
		//var token_price = $('#token_price').val();
		//var extra_bonus = $('#extra_bonus').val();
		var dollar_to_safeada = $('#dollar_to_safeada').val();
		if(token_price == 0){
			token_price = 1;
		}
		if(extra_bonus == 0){
			extra_bonus = 1;
		}		
	if(eth!="" && eth!=0 && eth>=parseFloat(0.01)){
	 $.ajax({
		 url: "https://min-api.cryptocompare.com/data/price?fsym=ETH&tsyms=USD",
		 method:'POST',
		 success: function(result){
			var usd = parseFloat(result.USD);
				var eth_dollar = parseFloat(eth)*usd;
				//var amount_epr = eth_dollar/parseFloat(token_price);
				//var bonus_epr = (amount_epr*extra_bonus)/100;
				//var amount = amount_epr+bonus_epr;
				var amount = eth_dollar*dollar_to_safeada;
					amount = amount.toFixed(2);
					$('#eth_dollar').val(eth_dollar);
					$('#eth_token').val(amount);					
				$('#eth_epr').html('<div class="cash" >'+amount+' SafeAda</div><small>You will receive</small>');
			
		}
	});
	}
	else if(eth=="" || eth==0 || eth<parseFloat(0.01)){
		$('#eth_epr').html('');
	}
	});
	/******************get doge live arte*******************/
	$('#doge_amount').keyup(function(){
		var doge = $('#doge_amount').val();
		//var token_price = $('#token_price').val();
		//var extra_bonus = $('#extra_bonus').val();
		var dollar_to_safeada = $('#dollar_to_safeada').val();
		if(token_price == 0){
			token_price = 1;
		}
		if(extra_bonus == 0){
			extra_bonus = 1;
		}		
	if(doge!="" && doge!=0 && doge>=parseFloat(0.01)){
	 $.ajax({
		 url: "https://min-api.cryptocompare.com/data/price?fsym=DOGE&tsyms=USD",
		 method:'POST',
		 success: function(result){
			var usd = parseFloat(result.USD);
				var doge_dollar = parseFloat(doge)*usd;
				//var amount_epr = doge_dollar/parseFloat(token_price);
				//var bonus_epr = (amount_epr*extra_bonus)/100;
				//var amount = amount_epr+bonus_epr;
				var amount = doge_dollar*dollar_to_safeada;
					amount = amount.toFixed(2);
					$('#doge_dollar').val(doge_dollar);
					$('#doge_token').val(amount);					
				$('#doge_epr').html('<div class="cash" >'+amount+' SafeAda</div><small>You will receive</small>');
			
		}
	});
	}
	else if(doge=="" || doge==0 || doge<parseFloat(0.01)){
		$('#doge_epr').html('');
	}
	});	
	/******************get bnb live arte*******************/
	$('#bnb_amount').keyup(function(){
		var bnb = $('#bnb_amount').val();
		//var token_price = $('#token_price').val();
		//var extra_bonus = $('#extra_bonus').val();
		var dollar_to_safeada = $('#dollar_to_safeada').val();
		if(token_price == 0){
			token_price = 1;
		}
		if(extra_bonus == 0){
			extra_bonus = 1;
		}		
	if(bnb!="" && bnb!=0 && bnb>=parseFloat(0.01)){
	 $.ajax({
		 url: "https://min-api.cryptocompare.com/data/price?fsym=BNB&tsyms=USD",
		 method:'POST',
		 success: function(result){
			var usd = parseFloat(result.USD);
				var bnb_dollar = parseFloat(bnb)*usd;
				//var amount_epr = bnb_dollar/parseFloat(token_price);
				//var bonus_epr = (amount_epr*extra_bonus)/100;
				//var amount = amount_epr+bonus_epr;
				var amount = bnb_dollar*dollar_to_safeada;
					amount = amount.toFixed(2);
					$('#bnb_dollar').val(bnb_dollar);
					$('#bnb_token').val(amount);					
				$('#bnb_epr').html('<div class="cash" >'+amount+' SafeAda</div><small>You will receive</small>');
			
		}
	});
	}
	else if(bnb=="" || bnb==0 || bnb<parseFloat(0.01)){
		$('#bnb_epr').html('');
	}
	});		
/**************to save btc invest****************/
function save_btc(){
	var base_url = "<?php echo base_url(); ?>";
	var btc = $('#btc_amount').val();
	var token = $('#btc_token').val();
	if(btc==""){
		$('.btc_error').html("Please enter the amount.");
		return false;
	}
	else if(btc==0 || btc<parseFloat(0.01)){
					$('.btc_error').html("Minimum amount should be 0.01 BTC");
					return false;
				}
	else if(token==""){
		return false;
	}
	else{
	var datastring = $("#btc_form").serialize();
		$('#btc_but').val("Loading...");
 $.ajax({url: "<?php echo base_url(); ?>Invest/createTransaction",
				method:"POST",
				data:datastring,
				dataType: "json",
				success: function(datas){
					if(datas.error!="ok"){
						$('.btc_error').html(datas.error);
						$('#btc_but').val("Invest Now");
						return false;
					}
					var address =datas.result.address;
					var qrcode_url = datas.result.qrcode_url;
					var amount = datas.result.amount;
					var status_url = datas.result.status_url;
					var txn_id = datas.result.txn_id;
					var epr = datas.result.epr_token;
					//<span class="tooltiptext" id="myTooltip111">Click Icon to copy</span><i class="fa fa-clipboard" style="font-size:12px"></i><input type="button" onclick="myFunctionsss()" onmouseout="outFunc111()" class="gry-btn btn btn-primary" value=""/>
						var html = '<div class="row btc_div"><div class="col-lg-2"> <div class="frame"><span class="helper"></span><img src="'+base_url+'assets/new_design/dist/img/coinx-btc.png"></div></div><div class="col-lg-5"><p>Address:</p><div class="inp_fa"><input class="www pamnt-add form-control" type="text" value="'+address+'" id="btc11" readonly="readonly"><div class="copy_div ds ds_tool tooltip"><span class="tooltiptext" id="myTooltip11">Click Icon to copy</span><i class="fa fa-clipboard" style="font-size:12px"></i><input type="button" onclick="myFunctionss()" onmouseout="outFunc11()" class="gry-btn btn btn-primary" value=""/></div></div><br/><div class="error-vlidation-err"></div><p>Transaction Id:</p><div class="inp_fa"><input class="www pamnt-add form-control" type="text" value="'+txn_id+'" id="btc111" readonly="readonly"><div class="copy_div ds ds_tool tooltip"></div></div><br/><div class="box-data"><span class="amount_invst">'+amount+' BTC</span><label class="lbl_inst">Invested Amount</label></div> <div class="box-data"><span class="amount_invst">'+epr+' SafeAda</span><label class="lbl_inst">You will receive</label></div></div><div class="col-lg-5"><div class="area"><img class="qr_code" src="'+qrcode_url+'" title="scan code"></div></div>';
					
					$('.btc_div').css('display','none');
					$('.transac').html(html);
				}
	});
	}
}
/***********to save eth invest amount*/
function save_eth(){
	var base_url = "<?php echo base_url(); ?>";
		var eth = $('#eth_amount').val();
		var token = $('#eth_token').val();
	if(eth==""){
		$('.eth_error').html("Please enter the amount.");
		return false;
	}
	else if(eth==0 || eth<parseFloat(0.01)){
					$('.eth_error').html("Minimum amount should be 0.01 ETH");
					return false;
				}
	else if(token==""){
		return false;
	}
	else{
	var datastring = $("#u_s").serialize();
		$('#eth_but').val("Loading...");
		$.ajax({url: "<?php echo base_url(); ?>Invest/createTransaction",
				method:"POST",
				data:datastring,
				dataType: "json",
				success: function(datas){
					if(datas.error!="ok"){
						$('.eth_error').html(datas.error);
						$('#eth_but').val("Invest Now");
						return false;
					}
					var address =datas.result.address;
					var qrcode_url = datas.result.qrcode_url;
					var amount = datas.result.amount;
					var status_url = datas.result.status_url;
					var txn_id = datas.result.txn_id;
					var epr = datas.result.epr_token;
					//<span class="tooltiptext" id="myTooltip222">Click Icon to copy</span><i class="fa fa-clipboard" style="font-size:12px"></i><input type="button" onclick="myFunctions222()" onmouseout="outFunc222()" class="gry-btn btn btn-primary" value=""/>
					var html = '<div class="row eth_div"><div class="col-lg-2"> <div class="frame"><span class="helper"></span><img src="'+base_url+'assets/new_design/dist/img/coinx-eth.png"></div></div><div class="col-lg-5"><p>Address:</p><div class="inp_fa"><input class="www pamnt-add form-control" type="text" value="'+address+'" id="eth22" readonly="readonly"><div class="copy_div ds ds_tool tooltip"><span class="tooltiptext" id="myTooltip22">Click Icon to copy</span><i class="fa fa-clipboard" style="font-size:12px"></i><input type="button" onclick="myFunctions22()"  onmouseout="outFunc22()" class="gry-btn btn btn-primary" value=""/></div></div><br/><div class="error-vlidation-err"></div><p>Transaction Id:</p><div class="inp_fa"><input class="www pamnt-add form-control" type="text" value="'+txn_id+'" id="eth222" readonly="readonly"><div class="copy_div ds ds_tool tooltip"></div></div><br/><div class="box-data"><span class="amount_invst">'+amount+' ETH</span><label class="lbl_inst">Invested Amount</label></div><div class="box-data"><span class="amount_invst">'+epr+' SafeAda</span><label class="lbl_inst">You will receive</label></div></div><div class="col-lg-5"><div class="area"><img class="qr_code" src="'+qrcode_url+'" title="scan code"></div></div>';
					
					
					
					$('.eth_div').css('display','none');
					$('.transac_eth').html(html);
				}
	});
	}
}
/***********to save doge invest amount*/
function save_doge(){
	var base_url = "<?php echo base_url(); ?>";
		var doge = $('#doge_amount').val();
		var token = $('#doge_token').val();
	if(doge==""){
		$('.doge_error').html("Please enter the amount.");
		return false;
	}
	else if(doge==0 || doge<parseFloat(0.01)){
					$('.doge_error').html("Minimum amount should be 0.01 DOGE");
					return false;
				}
	else if(token==""){
		return false;
	}
	else{
	var datastring = $("#doge_form").serialize();
		$('#doge_but').val("Loading...");
		$.ajax({url: "<?php echo base_url(); ?>Invest/createTransaction",
				method:"POST",
				data:datastring,
				dataType: "json",
				success: function(datas){
					if(datas.error!="ok"){
						$('.doge_error').html(datas.error);
						$('#doge_but').val("Invest Now");
						return false;
					}
					var address =datas.result.address;
					var qrcode_url = datas.result.qrcode_url;
					var amount = datas.result.amount;
					var status_url = datas.result.status_url;
					var txn_id = datas.result.txn_id;
					var epr = datas.result.epr_token;
					//<span class="tooltiptext" id="myTooltip222">Click Icon to copy</span><i class="fa fa-clipboard" style="font-size:12px"></i><input type="button" onclick="myFunctions222()" onmouseout="outFunc222()" class="gry-btn btn btn-primary" value=""/>
					var html = '<div class="row doge_div"><div class="col-lg-2"> <div class="frame"><span class="helper"></span><img src="'+base_url+'assets/new_design/dist/img/coinx-doge.png"></div></div><div class="col-lg-5"><p>Address:</p><div class="inp_fa"><input class="www pamnt-add form-control" type="text" value="'+address+'" id="doge22" readonly="readonly"><div class="copy_div ds ds_tool tooltip"><span class="tooltiptext" id="myTooltip22">Click Icon to copy</span><i class="fa fa-clipboard" style="font-size:12px"></i><input type="button" onclick="myFunctions22()"  onmouseout="outFunc22()" class="gry-btn btn btn-primary" value=""/></div></div><br/><div class="error-vlidation-err"></div><p>Transaction Id:</p><div class="inp_fa"><input class="www pamnt-add form-control" type="text" value="'+txn_id+'" id="doge222" readonly="readonly"><div class="copy_div ds ds_tool tooltip"></div></div><br/><div class="box-data"><span class="amount_invst">'+amount+' DOGE</span><label class="lbl_inst">Invested Amount</label></div><div class="box-data"><span class="amount_invst">'+epr+' SafeAda</span><label class="lbl_inst">You will receive</label></div></div><div class="col-lg-5"><div class="area"><img class="qr_code" src="'+qrcode_url+'" title="scan code"></div></div>';
					
					
					
					$('.doge_div').css('display','none');
					$('.transac_doge').html(html);
				}
	});
	}
}
/***********to save bnb invest amount*/
function save_bnb(){
	var base_url = "<?php echo base_url(); ?>";
		var bnb = $('#bnb_amount').val();
		var token = $('#bnb_token').val();
	if(bnb==""){
		$('.bnb_error').html("Please enter the amount.");
		return false;
	}
	else if(bnb==0 || bnb<parseFloat(0.01)){
					$('.bnb_error').html("Minimum amount should be 0.01 BNB");
					return false;
				}
	else if(token==""){
		return false;
	}
	else{
	var datastring = $("#bnb_form").serialize();
		$('#bnb_but').val("Loading...");
		$.ajax({url: "<?php echo base_url(); ?>Invest/createTransaction",
				method:"POST",
				data:datastring,
				dataType: "json",
				success: function(datas){
					if(datas.error!="ok"){
						$('.bnb_error').html(datas.error);
						$('#bnb_but').val("Invest Now");
						return false;
					}
					var address =datas.result.address;
					var qrcode_url = datas.result.qrcode_url;
					var amount = datas.result.amount;
					var status_url = datas.result.status_url;
					var txn_id = datas.result.txn_id;
					var epr = datas.result.epr_token;
					//<span class="tooltiptext" id="myTooltip222">Click Icon to copy</span><i class="fa fa-clipboard" style="font-size:12px"></i><input type="button" onclick="myFunctions222()" onmouseout="outFunc222()" class="gry-btn btn btn-primary" value=""/>
					var html = '<div class="row bnb_div"><div class="col-lg-2"> <div class="frame"><span class="helper"></span><img src="'+base_url+'assets/new_design/dist/img/coinx-bnb.png"></div></div><div class="col-lg-5"><p>Address:</p><div class="inp_fa"><input class="www pamnt-add form-control" type="text" value="'+address+'" id="bnb22" readonly="readonly"><div class="copy_div ds ds_tool tooltip"><span class="tooltiptext" id="myTooltip22">Click Icon to copy</span><i class="fa fa-clipboard" style="font-size:12px"></i><input type="button" onclick="myFunctions22()"  onmouseout="outFunc22()" class="gry-btn btn btn-primary" value=""/></div></div><br/><div class="error-vlidation-err"></div><p>Transaction Id:</p><div class="inp_fa"><input class="www pamnt-add form-control" type="text" value="'+txn_id+'" id="bnb222" readonly="readonly"><div class="copy_div ds ds_tool tooltip"></div></div><br/><div class="box-data"><span class="amount_invst">'+amount+' BNB</span><label class="lbl_inst">Invested Amount</label></div><div class="box-data"><span class="amount_invst">'+epr+' SafeAda</span><label class="lbl_inst">You will receive</label></div></div><div class="col-lg-5"><div class="area"><img class="qr_code" src="'+qrcode_url+'" title="scan code"></div></div>';
					
					
					
					$('.bnb_div').css('display','none');
					$('.transac_bnb').html(html);
				}
	});
	}
}
</script>
