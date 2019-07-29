<!DOCTYPE html>
<html>
<head>
	<title><?php echo DOMAIN_NAME; ?> | Admin</title>
	<meta name="keywords" content="<?php echo DOMAIN_NAME; ?>">
	<meta name="description" content="<?php echo DOMAIN_NAME; ?>">
	<meta name="author" content="<?php echo DOMAIN_NAME; ?>">

	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	  
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="<?php echo base_url()?>assest/img/favicon2.png"/> 
	
	
	<link href="<?php echo base_url();?>assest/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url();?>assest/normalize.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assest/style.css">
</head>
<body>
	<div class="container">
		<div class="log_danger"></div> 
        <form id="signup" method="post" action="<?php echo base_url('index.php/Login'); ?>">
			<div class="header">
				<img src="<?php echo base_url(); ?>assest/images/logo.png" height="50px" width="250px" style="margin-top:2%" > 
			</div>
				<?php  
				$lerror = $this->session->flashdata('error_msg');
				if(isset($lerror)){
					echo '<div class="alert alert-danger">
					<a href="javascript:void(0);" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$lerror.'</div>';
				}
				
				$lerror = $this->session->flashdata('reset_msg');
				if(isset($lerror)){
					echo '<div class="alert alert-success">
					<a href="javascript:void(0);" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$lerror.'</div>';
				}
				
				$data = array(
								'name'          => $this->security->get_csrf_token_name(),
								'value'         => $this->security->get_csrf_hash(),
								'type'         => 'hidden',
						);
				echo form_input($data);
				?>
			<div class="sep"></div>
			<div class="inputs">
                <input type="email" id="inputEmail" name="username" class="form-control" placeholder="Email address" required>
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
				<input type="hidden" id="ip_address" name="ip_address">
				<input type="hidden" id="country" name="country">
				<input type="hidden" id="country_code" name="country_code">
				<button id="submit" type="submit" name="submit"> Sign in</button><br/ >
				<span><a href="<?php echo base_url('recover'); ?>" class="recp">Recover Password</a></span>
			</div>
		</form>
	</div>
</body>
</html>
<script src="<?php echo base_url();?>assest/js/jquery.min.js"></script>
<script>
   
	
$('.close').click(function(){
	$('.alert.alert-danger').css('display','none');
});	
</script> 
<script>
   $.getJSON("http://freegeoip.net/json/", function(data) {
	   $('#ip_address').val(data.ip);
	   $('#country').val(data.country_name);
	   $('#country_code').val(data.country_code);
    });
</script>  