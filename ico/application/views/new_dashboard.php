<?php include('includes/dashboard_header.php');
$user_data = $this->session->userdata('user_data');
?>
<style>

</style>  
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default user-dashboard">
                        <div class="panel-body" style="padding: 0">
                            <div class="row top-list">
                                 <div class="col-lg-3">
                                    <div class="box-title" style="padding: 10px 0 0 25px;">Account Balance</div>
                                    <div class="box" style="padding-left: 15px;">
                                        <div class="child">
                                            <div class="balance-box">
                                                <div class="balance"><img src="<?php echo base_url(); ?>assets/dashboard/dist/img/elogo.png"> <?php if(!empty($get_user_info['total_coins'])){ echo $get_user_info['total_coins']; }else{echo'0';} ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="box-title">Exchange Rate</div>
                                    <dl class="box">
                                        <div class="child" style="padding: 0">
                                            <div class="dl-horizontal">
                                                <dt><img src="<?php echo base_url(); ?>assets/dashboard/dist/img/coin-btc.png"> 1 BTC</dt>
                                                <dd><span id="current_btc"></span> <?php echo SHORT_DOMAIN_NAME; ?></dd>
                                            </div>
                                            <div class="dl-horizontal">
                                                <dt><img src="<?php echo base_url(); ?>assets/dashboard/dist/img/coin-eth.png"> 1 ETH</dt>
                                                <dd><span id="current_eth"></span> <?php echo SHORT_DOMAIN_NAME; ?></dd>
                                            </div>
                                            <div class="dl-horizontal">
                                                <dt><img src="<?php echo base_url(); ?>assets/dashboard/dist/img/coin-doge.png"> 1 DOGECOIN</dt>
                                                <dd><span id="current_doge"></span> <?php echo SHORT_DOMAIN_NAME; ?></dd>
                                            </div>
                                            <div class="dl-horizontal">
                                                <dt><img src="<?php echo base_url(); ?>assets/dashboard/dist/img/coin-bnb.png"> 1 BNB</dt>
                                                <dd><span id="current_bnb"></span> <?php echo SHORT_DOMAIN_NAME; ?></dd>
                                            </div>
                                        </div>
                                    </dl>
                                </div>
                                <div class="col-lg-3">
                                    <div class="box-title">ICO Statistics</div>
                                    <div class="box">
                                        <div class="child">
                                            <div class="ico-box">
                                                <p class="p1">Token Sold</p>
                                                <p class="p2"><?php echo $total_site_coins; ?></p>
                                                <div class="row threebottom">
                                                    <div class="col-xs-6">
                                                        Total Investors <span class="unit"><?php echo $total_invested_user; ?></span>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        Total Invested <span class="unit">$<?php echo $total_invested['totalamount']; ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="box-title">Current Stage</div>
                                    <div class="box" style="padding-right: 15px;">
                                        <div class="child" style="padding: 0">
                                            <div class="nowbonus">
                                                NOW<span class="number"><?php if(!empty($percentage)){ echo $percentage['extra_bonus'];}else{ echo '0';}?>%</span>BONUS
                                            </div>
                                            <div class="countdown">
                                                <div class="countdown-time">
                                                    <ul class="clearfix" id="js-countDown"></ul>
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

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default start-ico">
                        <div class="panel-body" style="padding: 20px 0">
						<h6 class="text-center">Current Progress</h6>
                            <div class="progressbartop">
                                <ul class="progressbar">
                                    <li class="active">
                                        <div class="top">Start ICO</div>
                                        <div class="title">Authorized Payment Institution</div>
                                        <p> P2P Loans<br>
                                            Investment Portfolios <br>
                                            EBA Clearing<br>
                                        </p>
                                    </li>
                                    <li class="stp">
                                        <div class="title">Electronic money
                                            instittaions</div>
                                        <p> P2P Loans<br>
                                            Investment Portfolios <br>
                                            EBA Clearing<br>
                                        </p>
                                    </li>
                                    <li class="">
                                        <div class="title">Commercial Bank</div>
                                        <p> P2P Loans<br>
                                            Investment Portfolios <br>
                                            EBA Clearing<br>
                                        </p>
                                    </li>
                                    <li class="">
                                        <div class="title">Digital Pass</div>
                                        <p> P2P Loans<br>
                                            Investment Portfolios <br>
                                            EBA Clearing<br>
                                        </p>
                                    </li>
                                    <li class="">
                                        <div class="title">SME Financial MarketPlace</div>
                                        <p> P2P Loans<br>
                                            Investment Portfolios <br>
                                            EBA Clearing<br>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default invest-coin">
                        <div class="panel-body">
                            <div class="row text-center">
                                <div class="col-lg-3">
                                    <div class="continue">Contribute with Bitcoin</div>
                                    <img src="<?php echo base_url(); ?>assets/dashboard/dist/img/coinx-btc.png" class="img-responsive img-center">
                                    <a href="<?php echo base_url();?>invest" class="btn btn-invest">Invest</a>
                                </div>
                                <div class="col-lg-3">
                                    <div class="continue">Contribute with Ethereum</div>
                                    <img src="<?php echo base_url(); ?>assets/dashboard/dist/img/coinx-eth.png" class="img-responsive img-center">
                                    <a href="<?php echo base_url();?>invest" class="btn btn-invest">Invest</a>
                                </div>
                                <div class="col-lg-3">
                                    <div class="continue">Contribute with Litecoin</div>
                                    <img src="<?php echo base_url(); ?>assets/dashboard/dist/img/coinx-ltc.png" class="img-responsive img-center">
                                    <a href="<?php echo base_url();?>invest" class="btn btn-invest">Invest</a>
                                </div>
                                <div class="col-lg-3">
                                    <div class="continue">Contribute with Dash</div>
                                    <img src="<?php echo base_url(); ?>assets/dashboard/dist/img/coinx-dash.png" class="img-responsive img-center">
                                    <a href="<?php echo base_url();?>invest" class="btn btn-invest">Invest</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default reffreal-link">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-5 col-lg-offset-1">
                                    <div class="link">Referral Link</div>
                                    <div class="copy_ref ds tooltip"><input type="text" class="form-control" value="<?php echo base_url();?>registration/?refid=<?php echo $get_user_info['reference_id'];?>" id="copyRefrelInput" readonly><button class="" onclick="copyRefrel();" onmouseout="outFunc()"> <span class="tooltiptext" id="myTooltip">Click Icon to copy</span></button></div>
                                    <div class="note">Tokens credited to your Account:<span><?php if(!empty($get_user_info['referral_coins'])){ echo $get_user_info['referral_coins']; }else{echo'0';} ?> <?php echo SHORT_DOMAIN_NAME; ?></span></div>
                                </div>
                                <div class="col-lg-4 col-lg-offset-2">
                                    <table class="table">
                                        <tr>
                                            <th>Referral Investors: </th>
                                            <td><?php if(!empty($count_refrel_usr)){ echo count($count_refrel_usr);}else{echo'0';} ?></td>
                                        </tr>
                                        <tr> 
                                            <th>Amount Invested: </th>
                                            <td>$ <?php if(!empty($referel_total_invst)){ echo $referel_total_invst;}else{echo'0';} ?></td>
                                        </tr>
                                        <tr>
                                            <th>Tokens Issued: </th>
                                            <td><?php if(!empty($get_user_info['referral_coins'])){ echo $get_user_info['referral_coins']; }else{echo'0';} ?> <?php echo SHORT_DOMAIN_NAME; ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


<?php if(!empty($percentage)){ $tokenrate = $percentage['token_price'];}else{ $tokenrate = 1;}?>
<script>
function copyRefrel() {
	
   var copyText = document.getElementById('copyRefrelInput');    
    copyText.select();
    document.execCommand("Copy");
	 var tooltip = document.getElementById("myTooltip");
  tooltip.innerHTML = "Copied";
}
function outFunc() {
  var tooltip = document.getElementById("myTooltip");
  tooltip.innerHTML = "Click Icon to copy";
}


</script>


<?php include('includes/dashboard_footer.php');?>
<script>
$(function(){
	$.ajax({
		type: "POST",
		url: "https://min-api.cryptocompare.com/data/price?fsym=BTC&tsyms=ETH,USD,EUR",
		data: {},
		dataType:'json',
		success:function(data){
			var btc = data.USD;
			var domain = '<?php echo DOMAIN_NAME ?>';
			//var btc = (btc*2);
			//var btc = btc * <?php echo $tokenrate; ?>;
			//var neltcs = btc * <?php echo $percentage['extra_bonus']/100; ?>;
            //var subtc = neltcs + btc;
			var subtc = btc*<?php echo $ico_setup['dollar_to_safeada']; ?>;
			$('#current_btc').html(subtc.toFixed(2));
		}
	});
	
	$.ajax({
		type: "POST",
		url: "https://min-api.cryptocompare.com/data/price?fsym=ETH&tsyms=BTC,USD,EUR",
		data: {},
		dataType:'json',
		success:function(data){
			var eth = data.USD;
			var domain = '<?php echo DOMAIN_NAME ?>';
			//var eth = (eth*2);
			//var eth = eth * <?php echo $tokenrate; ?>;
            //var neltcseth = eth * <?php echo $percentage['extra_bonus']/100; ?>;
            //var subtceth = neltcseth + eth;
			var subtceth = eth*<?php echo $ico_setup['dollar_to_safeada']; ?>;
			$('#current_eth').html(subtceth.toFixed(2));
		}
	});
	
	$.ajax({
		type: "POST",
		url: "https://min-api.cryptocompare.com/data/price?fsym=DOGE&tsyms=BTC,USD,EUR",
		data: {},
		dataType:'json',
		success:function(data){
			var doge = data.USD;
			//var doge = (doge*2);
			//var doge = doge * <?php echo $tokenrate; ?>;
            //var neltc = doge * <?php echo $percentage['extra_bonus']/100; ?>;
            //var sultc = neltc + doge;
			var sultc = doge*<?php echo $ico_setup['dollar_to_safeada']; ?>;
			$('#current_doge').html(sultc.toFixed(2));
		}
	});	
	
	$.ajax({
		type: "POST",
		url: "https://min-api.cryptocompare.com/data/price?fsym=BNB&tsyms=BTC,USD,EUR",
		data: {},
		dataType:'json',
		success:function(data){
			var bnb = data.USD;
			//var bnb = (bnb*2);
			//var bnb = bnb * <?php echo $tokenrate; ?>;
            //var nedash = bnb * <?php echo $percentage['extra_bonus']/100; ?>;
            //var subdash = nedash + bnb;
			var subdash = bnb*<?php echo $ico_setup['dollar_to_safeada']; ?>;
			$('#current_bnb').html(subdash.toFixed(2)); 
		}
	});	
});

</script>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>