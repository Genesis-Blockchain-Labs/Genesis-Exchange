<!DOCTYPE html>
<?php 
$ci = &get_instance();
	$ci->load->model('Dashboard_model');
	$data = $ci->Dashboard_model->get_website_status();
	if($data->website_status==0){
		redirect(base_url("mantainance"));
	}
?>
<html lang="en">

<head>
        <title><?php echo DOMAIN_NAME; ?></title>		
		<meta name="keywords" content="<?php echo DOMAIN_NAME; ?>">
		<meta name="description" content="<?php echo DOMAIN_NAME; ?>">
		<meta name="author" content="<?php echo DOMAIN_NAME; ?>">
		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- Favicon -->
		<link rel="icon" type="image/png" href="<?php echo base_url()?>assets/img/favicon2.png"/>  


    <title>ENPOR</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url()?>assets/new_design/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url()?>assets/new_design/dist/css/enpor-admin.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/new_design/dist/css/responsive.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/new_design/dist/css/bootstrap-select.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/new_design/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<!--old-->
        <link rel="stylesheet" href="<?php echo base_url()?>assets/css/animate.min.css">
		<!--Jquery-->
        <script src="<?php echo base_url()?>assets/js/jquery-2.2.3.js"></script>
       <script src="https://ajax.aspnetcdn.com/ajax/modernizr/modernizr-2.7.2.js"></script>
		<script src='https://www.google.com/recaptcha/api.js'></script>
	  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-42573594-2"></script>
      <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet"> 
</head>

<body>
<nav class="navbar navbar-default navbar-login">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"  aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
         <?php 
			$actual_link = HTTP."$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			?>
         
          
          <a href="<?php echo ($actual_link==home_url)? '#home':home_url;?>"><img src="<?php echo base_url()?>assets/new_design/dist/img/logo.png"></a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-center">
            <li><a href="<?php echo base_url()?>">Home</a></li>
            <li><a href="<?php echo base_url()?>#prod">Products</a></li>
            <li><a href="<?php echo base_url()?>#comp">Company</a></li>
            <li><a href="<?php echo base_url()?>#ico-roadmap">RoadMap & ICO</a></li>
            <li><a href="<?php echo base_url()?>#team1">Team</a></li>
            <li><a href="<?php echo base_url()?>#ref-prog">Referral Program</a></li>
            <li><a href="<?php echo base_url()?>#event">Events & Partners</a></li>
            <li><a href="<?php echo base_url()?>#faq1">FAQ</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo base_url()?>login">Login</a></li>
            <li><a href="<?php echo base_url()?>signup" style="color: #e3d191 !important;">Create Account</a></li>
        </ul>
    </div>
</nav>