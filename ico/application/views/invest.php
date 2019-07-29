<?php include('includes/dashboard_header.php');
$user_data = $this->session->userdata('user_data');
?>
 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
				<?php if(!empty($price_bonus['token_price'])){ ?>
					<input type="hidden" name="token_price" id="token_price"  value="<?php echo $price_bonus['token_price']; ?>" />
				<?php } 
				if(!empty($price_bonus['extra_bonus'])){ ?>
					<input type="hidden" name="extra_bonus" id="extra_bonus"  value="<?php echo $price_bonus['extra_bonus']; ?>" />
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
								$attributes = array('role'=>"form", 'id' => 'ltc_form', 'method'=>'post', 'autocomplete'=>'off');
								$url = base_url().'litecoin';
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
					<input type="hidden" id="ltc_token" value="" name="epr_token" />
					<input type="hidden" id="ltc_dollar" value="" name="dollar_amount"/>
					<input type="hidden" name="address" value="<?php echo $ltc_address; ?>">
										<input type="hidden" name="currency" value="LTC">
                            <div class="row ltc_div">
                                <div class="col-lg-2">
                                    <div class="frame">
                                        <span class="helper"></span>
                                        <img src="<?php echo base_url();?>assets/new_design/dist/img/coinx-ltc.png">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="coin-title">Continue with Litecoin</div>
                                    <p>Enter the amount in litecoin</p>
                                    <?php
									$data = array(
										'name'          => 'amount',
										'id'            => 'litecoin_amount',
										'placeholder'   => 'Litecoin Amount',
										'type'         => 'number',
										'value'         => set_value('litecoin_amount'),
										'class'         => 'form-control',
										'step'			=> '0.01',
										'min'			=>'0.01',
									);
								
								echo form_input($data);
						?>
						<div class="error-vlidation ltc_error"></div>
                                    <small>Min payment 0.01 LTC</small>				
                                </div>
                                <div class="col-lg-2" id="ltc_epr">
                                </div>
                                <div class="col-lg-2">
                                    <div class="area">		
								<p><input type="button" type="submit" class="btn btn-invest-now" value="Invest Now" id="ltc_but" onclick="save_ltc();"></p>
                                    </div>
                                </div>
                                <div class="col-lg-2">  
                                </div>
                            </div>
							<?php      echo form_close();   ?>
							<div class="crsc-dashboard-m1-info transac_ltc"></div>
                        </div>
						
                    </div>
                    <div class="panel panel-default coin-list">
                        <div class="panel-body">
							<?php							
								$attributes = array('role'=>"form", 'id' => 'dash_form', 'method'=>'post', 'autocomplete'=>'off');
								$url = base_url().'dash';
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
						<input type="hidden" id="dash_token" value="" name="epr_token"/>
						<input type="hidden" id="dash_dollar" value="" name="dollar_amount"/>
						<input type="hidden" name="address" value="<?php echo $dash_address; ?>">
										<input type="hidden" name="currency" value="DASH">
                            <div class="row dash_div">
                                <div class="col-lg-2">
                                    <div class="frame">
                                        <span class="helper"></span>
                                        <img src="<?php echo base_url();?>assets/new_design/dist/img/coinx-dash.png">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="coin-title">Continue with Dash</div>		
                                    <p>Enter the amount in dash</p>
                                    <?php
									$data = array(
										'name'          => 'amount',
										'id'            => 'dash_amount',
										'placeholder'   => 'DASH Amount',
										'type'         => 'number',
										'value'         => set_value('dash_amount'),
										'class'         => 'form-control',
										'step'			=> '0.01',
										'min'			=>'0.01',
									);
								  
									echo form_input($data);
									?>
							<div class="error-vlidation dash_error"></div>
                                    <small>Min payment 0.01 DASH</small>	
                                </div>
                                <div class="col-lg-2" id="dash_epr">
                                </div>    
                                <div class="col-lg-2">
                                    <div class="area">	
											<input type="button" class="btn btn-invest-now" id="dash_but" value="Invest Now" onclick="save_dash();">
                                    </div>
                                </div>
                                <div class="col-lg-2">  
                                </div>
                            </div>
								<?php      echo form_close();   ?>
								<div class="crsc-dashboard-m1-info transac_dash"></div>
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
		var token_price = $('#token_price').val();
		var extra_bonus = $('#extra_bonus').val();
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
				var amount_epr = btc_dollar/parseFloat(token_price);
				var bonus_epr = (amount_epr*extra_bonus)/100;
				var amount = amount_epr+bonus_epr;
				amount = amount.toFixed(2);
				$('#btc_dollar').val(btc_dollar);
				$('#btc_token').val(amount);
				$('#btc_epr').html('<div class="cash" >'+amount+' EPR</div><small>You will receive</small>');
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
		var token_price = $('#token_price').val();
		var extra_bonus = $('#extra_bonus').val();
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
				var amount_epr = eth_dollar/parseFloat(token_price);
				var bonus_epr = (amount_epr*extra_bonus)/100;
				var amount = amount_epr+bonus_epr;
					amount = amount.toFixed(2);
					$('#eth_dollar').val(eth_dollar);
					$('#eth_token').val(amount);					
				$('#eth_epr').html('<div class="cash" >'+amount+' EPR</div><small>You will receive</small>');
			
		}
	});
	}
	else if(eth=="" || eth==0 || eth<parseFloat(0.01)){
		$('#eth_epr').html('');
	}
	});
	/*******************get ltc live rate*******************/
	$('#litecoin_amount').keyup(function(){
		var ltc = $('#litecoin_amount').val();
		var token_price = $('#token_price').val();
		var extra_bonus = $('#extra_bonus').val();
		if(token_price == 0){
			token_price = 1;
		}
		if(extra_bonus == 0){
			extra_bonus = 1;
		}		
	if(ltc!="" && ltc!=0 && ltc>=parseFloat(0.01)){
	 $.ajax({
		 url: "https://min-api.cryptocompare.com/data/price?fsym=LTC&tsyms=USD",
		 method:'POST',
		 success: function(result){
				var usd = parseFloat(result.USD);
				var ltc_dollar = parseFloat(ltc)*usd;
				var amount_epr = ltc_dollar/parseFloat(token_price);
				var bonus_epr = (amount_epr*extra_bonus)/100;
				var amount = amount_epr+bonus_epr;
				amount = amount.toFixed(2);
				$('#ltc_dollar').val(ltc_dollar);
				$('#ltc_token').val(amount);
				$('#ltc_epr').html('<div class="cash" >'+amount+' EPR</div><small>You will receive</small>');
			
		}
	});
	}
	else if(ltc=="" || ltc==0 || ltc<parseFloat(0.01)){
		$('#ltc_epr').html('');
	}
	});
	/******************get dash live rate********************/
	$('#dash_amount').keyup(function(){
		var dash = $('#dash_amount').val();
			var token_price = $('#token_price').val();
		var extra_bonus = $('#extra_bonus').val();
		if(token_price == 0){
			token_price = 1;
		}
		if(extra_bonus == 0){
			extra_bonus = 1;
		}		
	if(dash!="" && dash!=0 && dash>=parseFloat(0.01)){
 $.ajax({ 
		 url: "https://min-api.cryptocompare.com/data/price?fsym=DASH&tsyms=USD",
		 method:'POST',
		 success: function(result){
			var usd = parseFloat(result.USD);
				var dash_dollar = parseFloat(dash)*usd;
				var amount_epr = dash_dollar/parseFloat(token_price);
				var bonus_epr = (amount_epr*extra_bonus)/100;
				var amount = amount_epr+bonus_epr;
				amount = amount.toFixed(2);
				$('#dash_dollar').val(dash_dollar);
				$('#dash_token').val(amount);
				$('#dash_epr').html('<div class="cash" >'+amount+' EPR</div><small>You will receive</small>');
			
		}
	});
	}
	else if(dash=="" || dash==0 || dash<parseFloat(0.01)){
		$('#dash_epr').html('');
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
					if(datas.error=="ok"){
					var address =datas.result.address;
					var qrcode_url = datas.result.qrcode_url;
					var amount = datas.result.amount;
					var status_url = datas.result.status_url;
					var txn_id = datas.result.txn_id;
					var epr = datas.result.epr_token;
					//<span class="tooltiptext" id="myTooltip111">Click Icon to copy</span><i class="fa fa-clipboard" style="font-size:12px"></i><input type="button" onclick="myFunctionsss()" onmouseout="outFunc111()" class="gry-btn btn btn-primary" value=""/>
						var html = '<div class="row btc_div"><div class="col-lg-2"> <div class="frame"><span class="helper"></span><img src="'+base_url+'assets/new_design/dist/img/coinx-btc.png"></div></div><div class="col-lg-5"><p>Address:</p><div class="inp_fa"><input class="www pamnt-add form-control" type="text" value="'+address+'" id="btc11" readonly="readonly"><div class="copy_div ds ds_tool tooltip"><span class="tooltiptext" id="myTooltip11">Click Icon to copy</span><i class="fa fa-clipboard" style="font-size:12px"></i><input type="button" onclick="myFunctionss()" onmouseout="outFunc11()" class="gry-btn btn btn-primary" value=""/></div></div><br/><div class="error-vlidation-err"></div><p>Transaction Id:</p><div class="inp_fa"><input class="www pamnt-add form-control" type="text" value="'+txn_id+'" id="btc111" readonly="readonly"><div class="copy_div ds ds_tool tooltip"></div></div><br/><div class="box-data"><span class="amount_invst">'+amount+' BTC</span><label class="lbl_inst">Invested Amount</label></div> <div class="box-data"><span class="amount_invst">'+epr+' EPR</span><label class="lbl_inst">You will receive</label></div></div><div class="col-lg-5"><div class="area"><img class="qr_code" src="'+qrcode_url+'" title="scan code"></div></div>';
					
					$('.btc_div').css('display','none');
					$('.transac').html(html);
				}
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
					var address =datas.result.address;
					var qrcode_url = datas.result.qrcode_url;
					var amount = datas.result.amount;
					var status_url = datas.result.status_url;
					var txn_id = datas.result.txn_id;
					var epr = datas.result.epr_token;
					//<span class="tooltiptext" id="myTooltip222">Click Icon to copy</span><i class="fa fa-clipboard" style="font-size:12px"></i><input type="button" onclick="myFunctions222()" onmouseout="outFunc222()" class="gry-btn btn btn-primary" value=""/>
					var html = '<div class="row eth_div"><div class="col-lg-2"> <div class="frame"><span class="helper"></span><img src="'+base_url+'assets/new_design/dist/img/coinx-eth.png"></div></div><div class="col-lg-5"><p>Address:</p><div class="inp_fa"><input class="www pamnt-add form-control" type="text" value="'+address+'" id="eth22" readonly="readonly"><div class="copy_div ds ds_tool tooltip"><span class="tooltiptext" id="myTooltip22">Click Icon to copy</span><i class="fa fa-clipboard" style="font-size:12px"></i><input type="button" onclick="myFunctions22()"  onmouseout="outFunc22()" class="gry-btn btn btn-primary" value=""/></div></div><br/><div class="error-vlidation-err"></div><p>Transaction Id:</p><div class="inp_fa"><input class="www pamnt-add form-control" type="text" value="'+txn_id+'" id="eth222" readonly="readonly"><div class="copy_div ds ds_tool tooltip"></div></div><br/><div class="box-data"><span class="amount_invst">'+amount+' ETH</span><label class="lbl_inst">Invested Amount</label></div><div class="box-data"><span class="amount_invst">'+epr+' EPR</span><label class="lbl_inst">You will receive</label></div></div><div class="col-lg-5"><div class="area"><img class="qr_code" src="'+qrcode_url+'" title="scan code"></div></div>';
					
					
					
					$('.eth_div').css('display','none');
					$('.transac_eth').html(html);
				}
	});
	}
}
/*to save ltc invest amount*/
function save_ltc(){
	var base_url = "<?php echo base_url(); ?>";
		var ltc = $('#litecoin_amount').val();
		var token = $('#ltc_token').val();
			if(ltc==""){
		$('.ltc_error').html("Please enter the amount.");
		return false;
	}
	else if(ltc==0 || ltc<parseFloat(0.01)){
					$('.ltc_error').html("Minimum amount should be 0.01 LTC");
					return false;
				}
	else if(token==""){
		return false;
	}
	else{
	var datastring = $("#ltc_form").serialize();
		$('#ltc_but').val("Loading...");
	$.ajax({url: "<?php echo base_url(); ?>Invest/createTransaction",
				method:"POST",
				data:datastring,
				dataType: "json",
				success: function(datas){
					var address =datas.result.address;
					var qrcode_url = datas.result.qrcode_url;
					var amount = datas.result.amount;
					var status_url = datas.result.status_url;
					var txn_id = datas.result.txn_id;
					var epr = datas.result.epr_token;
					//<span class="tooltiptext" id="myTooltip333">Click Icon to copy</span><i class="fa fa-clipboard" style="font-size:12px"></i><input type="button" onclick="myFunctions333()" onmouseout="outFunc333()" class="gry-btn btn btn-primary" value=""/>
					var html = '<div class="row ltc_div"><div class="col-lg-2"> <div class="frame"><span class="helper"></span><img src="'+base_url+'assets/new_design/dist/img/coinx-ltc.png"></div></div><div class="col-lg-5"><p>Address:</p><div class="inp_fa"><input class="www pamnt-add form-control" type="text" value="'+address+'" id="ltc33" readonly="readonly"><div class="copy_div ds ds_tool tooltip"><span class="tooltiptext" id="myTooltip33">Click Icon to copy</span><i class="fa fa-clipboard" style="font-size:12px"></i><input type="button" onclick="myFunctions33()" onmouseout="outFunc33()" class="gry-btn btn btn-primary" value=""/></div></div><br/><div class="error-vlidation-err"></div><p>Transaction Id:</p><div class="inp_fa"><input class="www pamnt-add form-control" type="text" value="'+txn_id+'" id="ltc333" readonly="readonly"><div class="copy_div ds ds_tool tooltip"></div></div><br/><div class="box-data"><span class="amount_invst">'+amount+' LTC</span><label class="lbl_inst">Invested Amount</label></div><div class="box-data"><span class="amount_invst">'+epr+' EPR</span><label class="lbl_inst">You will receive</label></div></div><div class="col-lg-5"><div class="area"><img class="qr_code" src="'+qrcode_url+'" title="scan code"></div></div>';
					$('.ltc_div').css('display','none');
					$('.transac_ltc').html(html);
				}
	});
	}
}
/*to save dash invest amount*/
function save_dash(){
	var base_url = "<?php echo base_url(); ?>"
	var dash = $('#dash_amount').val();
	var token = $('#dash_token').val();
	if(dash==""){
		$('.dash_error').html("Please enter the amount.");
		return false;
	}
	else if(dash==0 || dash<parseFloat(0.01)){
					$('.dash_error').html("Minimum amount should be 0.01 DASH");
					return false;
				}
	else if(token==""){
		return false;
	}else{
	var datastring = $("#dash_form").serialize();
	$('#dash_but').val("Loading...");
 $.ajax({url: "<?php echo base_url(); ?>Invest/createTransaction",
				method:"POST",
				data:datastring,
				dataType: "json",
				success: function(datas){
					var address =datas.result.address;
					var qrcode_url = datas.result.qrcode_url;
					var amount = datas.result.amount;
					var status_url = datas.result.status_url;
					var txn_id = datas.result.txn_id;
					var epr = datas.result.epr_token;
					//<span class="tooltiptext" id="myTooltip444">Click Icon to copy</span><i class="fa fa-clipboard" style="font-size:12px"></i><input type="button" onclick="myFunctions444()" onmouseout="outFunc444()" class="gry-btn btn btn-primary" value=""/>
				var html = '<div class="row dash_div"><div class="col-lg-2"> <div class="frame"><span class="helper"></span><img src="'+base_url+'assets/new_design/dist/img/coinx-dash.png"></div></div><div class="col-lg-5"><p>Address:</p><div class="inp_fa"><input class="www pamnt-add form-control" type="text" value="'+address+'" id="dash44" readonly="readonly"><div class="copy_div ds ds_tool tooltip"><span class="tooltiptext" id="myTooltip44">Click Icon to copy</span><i class="fa fa-clipboard" style="font-size:12px"></i><input type="button" onclick="myFunctions44()" onmouseout="outFunc44()" class="gry-btn btn btn-primary" value=""/></div></div><br/><div class="error-vlidation-err"></div><p>Transaction Id:</p><div class="inp_fa"><input class="www pamnt-add form-control" type="text" value="'+txn_id+'" id="dash444" readonly="readonly"><div class="copy_div ds ds_tool tooltip"></div></div><br/><div class="box-data"><span class="amount_invst">'+amount+' DASH</span><label class="lbl_inst">Invested Amount</label></div><div class="box-data"><span class="amount_invst">'+epr+' EPR</span><label class="lbl_inst">You will receive</label></div></div><div class="col-lg-5"><div class="area"><img class="qr_code" src="'+qrcode_url+'" title="scan code"></div></div>';
					$('.dash_div').css('display','none');
					$('.transac_dash').html(html);
				}
	});
	}
}
</script>
