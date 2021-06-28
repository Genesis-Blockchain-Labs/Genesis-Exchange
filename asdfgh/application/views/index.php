
<!-- page content -->
<?php 
$kyc = ($pie['kyc']/$pie['all'])*100;
$nonkyc = 100 - $kyc;
?>
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
            <div class="title_left"></div>
		</div>
		<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="cora_btc">
			
				<div class="cora-in btc">
						<div class="dash_icon_text">
							<p><span>BTC Balance</span></p>
							
							<?php 
							
							
							if(isset($balance)) {
								foreach($balance as $coin => $bal) {
									if($coin == 'BTC') { $btc = $bal['balancef']; }
									if($coin == 'ETH') { $eth = $bal['balancef']; }
									if($coin == 'DASH') { $dash = $bal['balancef']; } 
									if($coin == 'LTC') { $ltc = $bal['balancef']; } 
								}
							}
							if($btc) { $btc = $btc ; } else { $btc = '0.00'; }
							if($eth) { $eth = $eth ; } else { $eth = '0.00'; }
							if($dash) { $dash = $dash ; } else { $dash = '0.00';}
							if($ltc) { $ltc = $ltc ; } else { $ltc = '0.00'; }
							?>
						</div>
						<div class="dash_coro">
							<img src="<?php echo base_url();?>assest/images/dashboard-btc-ico.png" alt="btc" /><span class="green_font"><?php echo $btc; ?></span>
						</div>
				</div>
				<div class="cora-in eth">
						<div class="dash_icon_text">
							<p><span>ETH Balance</span></p>
						</div>
						<div class="dash_coro">
							<img src="<?php echo base_url();?>assest/images/dashboard-eth-ico.png" alt="eth" /><span class="green_font">
							<?php echo $eth; ?>
							</span>
						</div>			
				</div>
				
				<div class="cora-in dash">
						<div class="dash_icon_text">
							<p><span>DASH Balance</span></p>
						</div>
						<div class="dash_coro">
							<img src="<?php echo base_url();?>assest/images/dashboard-dash-ico.png" alt="dash" /><span class="green_font"><?php echo $dash; ?></span>
						</div>		
				</div>
				<div class="cora-in ltc">
						<div class="dash_icon_text">
							<p><span>LTC Balance</span></p>
						</div>
						<div class="dash_coro">
							<img src="<?php echo base_url();?>assest/images/dashboard-ltc-ico.png" alt="ltc" /><span class="green_font"><?php echo $ltc; ?></span>
						</div>
				</div>
		
			</div>
		</div>
		</div>
		
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="enpor_cora">
							<div class="in_enpor_cora">
								<p class="stac-ico"><img src="<?php echo base_url();?>assest/images/stack-icon.png" alt="stack" /><span> TOTAL MYL COINS</span> </p>
								<div class="enpor-q-coins">
									<img src="<?php echo base_url();?>assest/images/logo.png" alt="SafeCardano" /><span class="green_font">1,000,000,000</span>
								</div>
							</div>
							
							<div class="in_enpor_cora">
								<p class="stac-ico"><img src="<?php echo base_url();?>assest/images/stack-icon2.png" alt="stack2" /><span> TOTAL SOLD MYL COINS</span> </p>
								<div class="enpor-q-coins">
									<img src="<?php echo base_url();?>assest/images/logo.png" alt="SafeCardano" /><span class="green_font"><?php echo round($sold_coin['total_coins'],2); ?></span>
								</div>
							</div>
							
							<div class="in_enpor_cora">
								<p class="stac-ico"><img src="<?php echo base_url();?>assest/images/current-status.png" alt="status" /><span> CURRENT STAGE</span> </p><br>
								<p><?php if($ico_date['ico_type'] == 'pre_ico') { echo 'PRE ICO'; }
								if($ico_date['ico_type'] == 'ico') { echo 'ICO - STAGE '.$ico_date['stages']; }
								?> </p>
								<div class="enpor-q-timer">
											<!-- clock start div -->
											 <div class="col-xs-12"> 
											  <div id="clockdiv2">
											   <div>
												<span class="days"></span>
												<div class="smalltext">Days</div>
											   </div>
											   <div>
												<span class="hours"></span>
												<div class="smalltext">Hours</div>
											   </div>
											   <div>
												<span class="minutes"></span>
												<div class="smalltext">Minutes</div>
											   </div>
											   <div>
												<span class="seconds"></span>
												<div class="smalltext">Seconds</div>
											   </div>
											  </div>
									   </div>
									  <!--  clock end -->
								</div>
							</div>
						</div>
					</div>
				</div>
		
        <div class="clearfix"></div>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel" style="">
						<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
					</div>
				</div>
          </div>
	</div>
</div>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="<?php echo base_url();?>assest/js/countdown.js"></script>

 <script type="text/javascript">
 $(document).ready(function() {
  var last_date = '<?php echo $ico_date['end_date']; ?> 23:59';
      $('#clockdiv2').countdown({date: last_date}, function() {
       
      });
   });
</script>
<script>
//LINE CHART : WEEKLY REGISTRATION
Highcharts.chart('container', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 'Last 30 Days Registrations'
    },
    xAxis: {
		title: {
            text: 'Dates'
        },
        categories: [
						<?php
						
								foreach($line as $ln)
								{
									echo "'".$ln['day']."'".',';
								}
						?>
		]
    },
    yAxis: {
        title: {
            text: 'Average Users'
        },
    },
	
    tooltip: {
        crosshairs: true,
        shared: true
    },
    plotOptions: {
        spline: {
            marker: {
                radius: 4,
                lineColor: '#666666',
                lineWidth: 1
            }
        }
    },
    series: [{
        name: '<?php echo 'Users';  ?>',
        marker: {
            symbol: 'square'
        },
        data: [<?php
						
								foreach($line as $ln)
								{
									echo $ln['total'].',';
								}
						?>]
    }]
});
</script>	
