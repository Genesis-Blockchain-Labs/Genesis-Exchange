<?php include('includes/dashboard_header.php');
$user_data = $this->session->userdata('user_data');
?>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<div id="primary" class="content-area">
		<main id="main" class="site-main container" role="main">

			
<article id="post-684" class="post-684 page type-page status-publish hentry">
	<header class="entry-header">
		<h1 class="entry-title">Wallets</h1>	
	</header><!-- .entry-header -->

	<div class="entry-content">
		<div class="ee-wrap">
<div class="ee-section">
<div class="ee-col-1-1">

			<div class="crsh-md-wrapper">
				<div class="crsh-md-row">
					
				</div>
				<div class="crsh-md-row">
					<div class="crsc-dashboard-m1-left">
						<div class="crsc-tabs-container">				
					<ul class="nav nav-tabs">
					<li class="<?php if($tab == 'BTC') { echo 'active' ;} if(!$tab){ echo 'active';}?>"><a data-toggle="tab" href="#bitcoin"><img src="<?php echo base_url();?>assets/dashboard/dist/img/coin-btc.png" class="coin-thumb" width="25"> Bitcoin </a></li>
					<li class="<?php if($tab == 'ETH') { echo 'active' ;}?>"><a data-toggle="tab" href="#ethereum"><img src="<?php echo base_url();?>assets/dashboard/dist/img/coin-eth.png" class="coin-thumb" width="25"> Ethereum</a></li>
					<li class="<?php if($tab == 'LTC') { echo 'active' ;}?>"><a data-toggle="tab" href="#ltc"><img src="<?php echo base_url();?>assets/dashboard/dist/img/coin-ltc.png" class="coin-thumb" width="25"> LTC</a></li>
					<li class="<?php if($tab == 'DASH') { echo 'active' ;}?>"><a data-toggle="tab" href="#dash"><img src="<?php echo base_url();?>assets/dashboard/dist/img/coin-dash.png" class="coin-thumb" width="25"> DASH</a></li>
					</ul>	
					<div class="tab-content">
    
					<div id="bitcoin" class="tab-pane fade in <?php if($tab == 'BTC') { echo 'active' ;} if(!$tab){ echo 'active';}?>">
					
					<div class="crsc-dashboard-m1-coin">
					
						<div class="crsc-dashboard-m1-info">
							<h1><img src="<?php echo base_url();?>assets/dashboard/dist/img/coin-btc.png" width = "30" class="coin-thumb"><span>HOW TO DEPOSIT IN BTC?<span></h1>
							In order to deposit in BTC (Bitcoin), you need to transfer your amount from your Bitcoin-wallet to our Bitcoin-address:<br>
							After you make the transfer, the transaction information will show in the "Transaction History".<br><br>
							Minimum deposit is 0.0015 BTC<br><br>
									
					<form action="<?php echo base_url();?>Wallet/createTransaction" id="primaryPostForm" method="POST" autocomplete="off">
						<input type="hidden" name="currency" value="BTC">
						<span><?php //echo $btc_address; ?> </span>
						
									<?php if(!empty($response['result']) && $tab == 'BTC') {?>
									<input class="www pamnt-add form-control" type="text" value="<?php echo $response['result']['status_url'];?>" id="btc1" readonly="readonly">
									<div class="inp_fa">
										<i class="fa fa-clipboard" style="font-size:12px"></i>
										<input type="button" onclick="myFunctions()" class="gry-btn btn btn-primary" value="Copy Address"/>
									</div>
									<div class="row-dat">
									<div class="col-xs-4">
                                        <img src="<?php echo $response['result']['qrcode_url']; ?>" class="img-responsive img-center">
									</div>
									
									<div class="col-xs-8">
									<div class="box-data">
									<label>Address:  </label>
									<input class="www pamnt-add form-control" type="text" value="<?php echo $response['result']['address'];?>" id="btc11" readonly="readonly">
									<div class="inp_fa">
										<i class="fa fa-clipboard" style="font-size:12px"></i>
										<input type="button" onclick="myFunctionss()" class="gry-btn btn btn-primary" value="Copy Address"/>
									</div>
									</div>
									<div class="box-data">
									<label>Transaction Id:  </label>
									<input class="www pamnt-add form-control" type="text" value="<?php echo $response['result']['txn_id'];?>" id="btc111" readonly="readonly">
									<div class="inp_fa">
										<i class="fa fa-clipboard" style="font-size:12px"></i>
										<input type="button" onclick="myFunctionsss()" class="gry-btn btn btn-primary" value="Copy Address"/>
									</div>
									</div>
									<div class="box-data">
									<label>Amount:&nbsp;</label><span><?php echo $response['result']['amount']; ?></span>
									</div>
									</div>
									</div>
									<?php } else { ?>
				   
						<input class="www pamnt-add form-control" type="text" value="<?php echo $btc_address; ?>" id="myInput" readonly="readonly">
									<div class="inp_fa">
										<i class="fa fa-clipboard" style="font-size:12px"></i>
										<input type="button" onclick="myFunction()" class="gry-btn btn btn-primary" value="Copy Address"/>
									</div>
									
									<div class="input-rg">
										<label>Amount  </label><br>
										<input type="hidden" name="address" value="<?php echo $btc_address; ?>">
										<input type="hidden" name="currency" value="BTC">
										<input type="text" name="amount">
										<input type="submit" name="btc_submit" value="Create Transaction" class="trans">
									</div>
									<?php } ?>
					</form>
				   
						</div>
				
					</div>
				</div>
    
	<div id="ethereum" class="tab-pane fade <?php if($tab == 'ETH') { echo 'in active' ;}?>">
					
					<div class="crsc-dashboard-m1-coin">
					
						<div class="crsc-dashboard-m1-info">
							<h1><img src="<?php echo base_url();?>assets/dashboard/dist/img/coin-eth.png" width = "30" class="coin-thumb"> <span>HOW TO DEPOSIT IN ETH?</span></h1>
							In order to deposit in ETH (Ethereum), you need to transfer your amount from your Ethereum-wallet to our Ethereum-address:<br>
							After you make the transfer, the transaction information will show in the "Transaction History".<br><br>
							Minimum deposit is 0.04 ETH<br><br>
									
					<form action="<?php echo base_url();?>Wallet/createTransaction" id="primaryPostForm" method="POST">
					    <span><?php //echo $eth_address; ?> </span>
						<input type="hidden" name="currency" value="ETH">
					<?php if(!empty($response['result']) && $tab == 'ETH') {?>
									<input class="www pamnt-add form-control" type="text" value="<?php echo $response['result']['status_url'];?>" id="eth2" readonly="readonly">
									<div class="inp_fa">
										<i class="fa fa-clipboard" style="font-size:12px"></i>
										<input type="button" onclick="myFunctions2()" class="gry-btn btn btn-primary" value="Copy Address"/>
									</div>
									<div class="row-dat">
									<div class="col-xs-4">
                                        <img src="<?php echo $response['result']['qrcode_url']; ?>" class="img-responsive img-center">
										</div>
									<div class="col-xs-8">
									<div class="box-data">
									<label>Address:  </label>
									<input class="www pamnt-add form-control" type="text" value="<?php echo $response['result']['address'];?>" id="eth22" readonly="readonly">
									<div class="inp_fa">
										<i class="fa fa-clipboard" style="font-size:12px"></i>
										<input type="button" onclick="myFunctions22()" class="gry-btn btn btn-primary" value="Copy Address"/>
									</div>
									</div>
									<div class="box-data">
									<label>Transaction Id:  </label>
									<input class="www pamnt-add form-control" type="text" value="<?php echo $response['result']['txn_id'];?>" id="eth222" readonly="readonly">
									<div class="inp_fa">
										<i class="fa fa-clipboard" style="font-size:12px"></i>
										<input type="button" onclick="myFunctions222()" class="gry-btn btn btn-primary" value="Copy Address"/>
									</div>
									</div>
									<div class="box-data">
									<label>Amount:&nbsp;</label><span><?php echo $response['result']['amount']; ?></span>
									</div>
									</div>
									</div>
									<?php } else { ?>
						<input class="www pamnt-add form-control" type="text" value="<?php echo $eth_address; ?>" id="myInput1" readonly="readonly">
									<div class="inp_fa">
									<i class="fa fa-clipboard" style="font-size:12px"></i>
									<input type="button" onclick="myFunction1()" class="gry-btn btn btn-primary" value="Copy Address"/>
									</div>
									<div class="input-rg">
										<label>Amount  </label><br>
										<input type="hidden" name="address" value="<?php echo $eth_address; ?>">
										<input type="hidden" name="currency" value="ETH">										
										<input type="text" name="amount">
										<input type="submit" name="eth_submit" value="Create Transaction" class="trans">
									</div>
									<?php } ?>
					</form>
				
						</div>
				
					</div>
				</div>
  
	<div id="ltc" class="tab-pane fade  <?php if($tab == 'LTC') { echo 'in active' ;}?>">	
					<div class="crsc-dashboard-m1-coin">
							<div class="crsc-dashboard-m1-info">
								<h1>
									<img src="<?php echo base_url();?>assets/dashboard/dist/img/coin-ltc.png" width = "30" class="coin-thumb"><span>HOW TO DEPOSIT IN LTC?</span>
								</h1>
								In order to deposit in LTC (Litecoin), you need to transfer your amount from your Litecoin-wallet to our Litecoin-address:<br>
								After you make the transfer, the transaction information will show in the "Transaction History".<br><br>
								Minimum deposit is 0.04 LTC<br><br>
										
								<form action="<?php echo base_url();?>Wallet/createTransaction" id="primaryPostForm" method="POST">
									<input type="hidden" name="currency" value="LTC">
								<?php if(!empty($response['result']) && $tab == 'LTC') {?>
												<input class="www pamnt-add form-control" type="text" value="<?php echo $response['result']['status_url'];?>" id="ltc3" readonly="readonly">
												<div class="inp_fa">
													<i class="fa fa-clipboard" style="font-size:12px"></i>
													<input type="button" onclick="myFunctions3()" class="gry-btn btn btn-primary" value="Copy Address"/>
												</div>
												<div class="row-dat">
													<div class="col-xs-4">
														<img src="<?php echo $response['result']['qrcode_url']; ?>" class="img-responsive img-center">
													</div>
													<div class="col-xs-8">
														<div class="box-data">
															<label>Address:  </label>
															<input class="www pamnt-add form-control" type="text" value="<?php echo $response['result']['address'];?>" id="ltc33" readonly="readonly">
															<div class="inp_fa">
																<i class="fa fa-clipboard" style="font-size:12px"></i>
																<input type="button" onclick="myFunctions33()" class="gry-btn btn btn-primary" value="Copy Address"/>
															</div>
														</div>
														<div class="box-data">
															<label>Transaction Id:  </label>
															<input class="www pamnt-add form-control" type="text" value="<?php echo $response['result']['txn_id'];?>" id="ltc333" readonly="readonly">
															<div class="inp_fa">
																<i class="fa fa-clipboard" style="font-size:12px"></i>
																<input type="button" onclick="myFunctions333()" class="gry-btn btn btn-primary" value="Copy Address"/>
															</div>
														</div>
														<div class="box-data">
															<label>Amount:&nbsp;</label><span><?php echo $response['result']['amount']; ?></span>
														</div>
													</div>
												</div>
												<?php }
												else { ?>
													<input class="www pamnt-add form-control" type="text" value="<?php echo $ltc_address; ?>" id="myInput2" readonly="readonly">
													<div class="inp_fa">
													<i class="fa fa-clipboard" style="font-size:12px"></i>
													<input type="button" onclick="myFunction2()" class="gry-btn btn btn-primary" value="Copy Address"/>
													</div>
													<div class="input-rg">
														<label>Amount  </label><br>
														<input type="hidden" name="address" value="<?php echo $ltc_address; ?>">								
														<input type="hidden" name="currency" value="LTC">
														<input type="text" name="amount">
														<input type="submit" name="ltc_submit" value="Create Transaction" class="trans">
													</div>
											<?php } ?>
								</form>
							</div>		
					</div>
				</div>
    
	<div id="dash" class="tab-pane fade <?php if($tab == 'DASH') { echo 'in active' ;}?>">
					
					<div class="crsc-dashboard-m1-coin">
						<div class="crsc-dashboard-m1-info">
							<h1>
								<img src="<?php echo base_url();?>assets/dashboard/dist/img/coin-dash.png" width = "30" class="coin-thumb"><span>HOW TO DEPOSIT IN DASH?</span>
							</h1>
							In order to deposit in DASH (Dash), you need to transfer your amount from your Dash-wallet to our Dash-address:<br>
							After you make the transfer, the transaction information will show in the "Transaction History".<br><br>
							Minimum deposit is 0.04 ETH
							<br><br>
									
					<form action="<?php echo base_url();?>Wallet/createTransaction" id="primaryPostForm" method="POST">
							<input type="hidden" name="currency" value="DASH">
						<?php if(!empty($response['result']) && $tab == 'DASH') {?>
									<input class="www pamnt-add form-control" type="text" value="<?php echo $response['result']['status_url'];?>" id="dash4" readonly="readonly">
									<div class="inp_fa">
										<i class="fa fa-clipboard" style="font-size:12px"></i>
										<input type="button" onclick="myFunctions4()" class="gry-btn btn btn-primary" value="Copy Address"/>
									</div>
									<div class="row-dat">
									<div class="col-xs-4">
                                        <img src="<?php echo $response['result']['qrcode_url']; ?>" class="img-responsive img-center">
									</div>
									<div class="col-xs-8">
									<div class="box-data">
									<label>Address:  </label>
									<input class="www pamnt-add form-control" type="text" value="<?php echo $response['result']['address'];?>" id="dash44" readonly="readonly">
									<div class="inp_fa">
										<i class="fa fa-clipboard" style="font-size:12px"></i>
										<input type="button" onclick="myFunctions44()" class="gry-btn btn btn-primary" value="Copy Address"/>
									</div>
									</div>
									<div class="box-data">
									<label>Transaction Id:  </label>
									<input class="www pamnt-add form-control" type="text" value="<?php echo $response['result']['txn_id'];?>" id="dash444" readonly="readonly">
									<div class="inp_fa">
										<i class="fa fa-clipboard" style="font-size:12px"></i>
										<input type="button" onclick="myFunctions444()" class="gry-btn btn btn-primary" value="Copy Address"/>
									</div>
									</div>
									<div class="box-data">
									<label>Amount:&nbsp;</label><span><?php echo $response['result']['amount']; ?></span>
									</div>
									</div>
									</div>
									<?php } else { ?>
									<input class="www pamnt-add form-control" type="text" value="<?php echo $dash_address; ?>" id="myInput3" readonly="readonly">
									<div class="inp_fa">
									<i class="fa fa-clipboard" style="font-size:12px"></i>
									<input type="button" onclick="myFunction3()" class="gry-btn btn btn-primary" value="Copy Address"/>
									</div>
									<div class="input-rg">
										<label>Amount  </label><br>
										<input type="hidden" name="address" value="<?php echo $dash_address; ?>">
										<input type="hidden" name="currency" value="DASH">
										<input type="text" name="amount">
										<input type="submit" name="dash_submit" value="Create Transaction" class="trans">
									</div>
									<?php } ?>
					</form>
				 
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
</div>
</div>
	</div><!-- .entry-content -->

	</article><!-- #post-## -->

		</main><!-- #main -->
	</div>
	
	
	<?php include('includes/footer.php');  ?>

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
}
function myFunctionss() {
  var copyText = document.getElementById("btc11");
  copyText.select();
  document.execCommand("Copy");
}
function myFunctionsss() {
  var copyText = document.getElementById("btc111");
  copyText.select();
  document.execCommand("Copy");
}
function myFunctions2() {
  var copyText = document.getElementById("eth2");
  copyText.select();
  document.execCommand("Copy");
}
function myFunctions22() {
  var copyText = document.getElementById("eth22");
  copyText.select();
  document.execCommand("Copy");
}
function myFunctions222() {
  var copyText = document.getElementById("eth222");
  copyText.select();
  document.execCommand("Copy");
}

function myFunctions3() {
  var copyText = document.getElementById("ltc3");
  copyText.select();
  document.execCommand("Copy");
}
function myFunctions33() {
  var copyText = document.getElementById("ltc33");
  copyText.select();
  document.execCommand("Copy");
}
function myFunctions333() {
  var copyText = document.getElementById("ltc333");
  copyText.select();
  document.execCommand("Copy");
}
function myFunctions4() {
  var copyText = document.getElementById("dash4");
  copyText.select();
  document.execCommand("Copy");
}
function myFunctions44() {
  var copyText = document.getElementById("dash44");
  copyText.select();
  document.execCommand("Copy");
}
function myFunctions444() {
  var copyText = document.getElementById("dash444");
  copyText.select();
  document.execCommand("Copy");
}

</script>
</body>
</html>