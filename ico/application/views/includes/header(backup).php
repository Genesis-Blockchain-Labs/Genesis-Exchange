
<!doctype html>
<html class="no-js" lang="en">
        <head>
        <title><?php echo DOMAIN_NAME; ?></title>		
		<meta name="keywords" content="<?php echo DOMAIN_NAME; ?>">
		<meta name="description" content="<?php echo DOMAIN_NAME; ?>">
		<meta name="author" content="<?php echo DOMAIN_NAME; ?>">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- Favicon -->
        <link rel="icon" type="image/png" href="<?php echo base_url()?>assets/img/favicon2.png"/>   
        
        <!--CSS-->
        <link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/css/style.min.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/css/animate.min.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/css/custom.css">
		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/mycustom.css"> 
        <!--Jquery-->
        <script src="<?php echo base_url()?>assets/js/jquery-2.2.3.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
        <!-- (Optional) Latest compiled and minified JavaScript translation files -->
       <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/i18n/defaults-*.min.js"></script> -->
        <script src="https://ajax.aspnetcdn.com/ajax/modernizr/modernizr-2.7.2.js"></script>
        <!-- <script src="<?php echo base_url()?>assets/js/TweenMax.min.js"></script> 
        <script type="text/javascript" src="<?php echo base_url()?>assets/js/wow.js"></script>
        <script src="<?php //echo base_url()?>assets/js/waypoints.min.js"></script>
        <script src="<?php //echo base_url()?>assets/js/jquery.counterup.js"></script>
        <script src="<?php //echo base_url()?>assets/js/particles.min.js"></script>
        <script defer src="<?php //echo base_url()?>assets/js/jquery.flexslider.js"></script>
        <script src="<?php //echo base_url()?>assets/js/countdown-timer.js"></script>
        <script src="<?php// echo base_url()?>assets/js/smoothscroll.js"></script>
        <script src="<?php// echo base_url()?>assets/js/canvasjs.min.js"></script>
        <script src="<?php// echo base_url()?>assets/js/jquery.canvasjs.min.js"></script>
        <script src="<?php //echo base_url()?>assets/js/jquery-parallax.js"></script> -->


       

        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-42573594-2"></script>
       
        
        </head>
    
<body>



<main> 
  
  <!-- Header start-->
  <div class="header">
      <div class="inner-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="logo-warp">
          <?php 
			$actual_link = HTTP."$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			?>
         
          
          <a href="<?php echo ($actual_link==home_url)? '#home':home_url;?>"> <img src="<?php echo base_url();?>assets/images/logo-main.png" class="img-responsive main-logo"/></a></div>
          <div class="header-right">
            <div class=" clearfix"></div>
            <div class="header-top-right"> 
              <nav class="navbar navbar-default"> 
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                  	<div id="nav-icon2" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                      <span></span>
                      <span></span>
                      <span></span>
                      <span></span>
                      <span></span>
                      <span></span>
                    </div>
                </div>
                
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="<?php echo base_url()?>signup">Sign Up</a></li>
						<li><a href="<?php echo base_url()?>login">Login</a></li>
						<li><a href="<?php echo base_url()?>">Home</a></li>
					</ul>
				</div> 

                <!-- /.navbar-collapse --> 
              </nav>
              <div class="social-icons "> 
              	<!--<a class="twitter" href="https://twitter.com/BoonTechUSA" target="_blank">
                	<img src="<?php //echo base_url()?>assets/img/social/twitter.svg" class="social-icons-svg" alt="twiiter" />
                </a> 
                <a class="slack-ic" href="https://boontech.slack.com" target="_blank">
                	<img src="<?php //echo base_url()?>assets/img/social/slack-symbol.svg" class="social-icons-svg" alt="slack" />
                </a> 
                <a class="telegram" href="https://t.me/joinchat/CbaCNAwlT_j_yrAaiP7O6g" target="_blank">
                	<img src="<?php //echo base_url()?>assets/img/social/telegram.svg" class="social-icons-svg" alt="Telegram" />
                </a> 
                <a class="youtube" href="https://www.youtube.com/channel/UCy8RUR0x8w-eniyj2OHc86g" target="_blank">
                	<img src="<?php //echo base_url()?>assets/img/social/youtube.svg" class="social-icons-svg" alt="Youtube" />
                </a> 
                <a class="facebool" href="https://www.facebook.com/boontechusa/" target="_blank">
                	<img src="<?php //echo base_url()?>assets/img/social/facebook.svg" class="social-icons-svg" alt="facebook" />
                </a> -->
             </div>
             
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
  </div>
  
  <!-- Header end--> 

    
	
<script id="augur.js" async src="//cdn.augur.io/augur.min.js" data-e2ee="1" data-fastcallback="augurCallback" data-callback="augurCallback" data-warpspeed="truk"></script>

<script> 
	function augurCallback(json) { 
	console.log(json);
		//document.getElementById('dfp').value = JSON.stringify(json); 
		/* document.getElementById('dfp').value = json.device.ID; 
		document.getElementById('dft').value = json.device.type;  */
		$('#dfp').val(json.device.ID);
		$('#dft').val(json.device.type);
		$('#nondfp').val(json.device.ID);
		$('#nondft').val(json.device.type);
		console.log(json);
	} 
</script>
