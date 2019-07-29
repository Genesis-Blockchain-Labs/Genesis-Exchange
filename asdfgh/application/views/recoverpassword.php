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
		<div id="signup">
			<div class="header">
				<img src="<?php echo base_url(); ?>assest/images/logo.png" height="50px" width="250px" style="margin-top:2%" > 
			</div>
			<?php 
			$recsuc_msg = $this->session->flashdata('recsuc_msg');
			if(isset($recsuc_msg)){
				echo '<div class="alert alert-info">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$recsuc_msg.'</div>';
			}
			
			$msg = $this->session->flashdata('rec_msg');
			if(isset($msg)){
				echo '<div class="alert alert-danger">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$msg.'</div>';
			}
			?>
			<form method="post" action="<?php echo base_url('recover'); ?>">
				<div class="inputs">
					<input type="hidden" id="" name="<?php echo  $this->security->get_csrf_token_name() ?>" class="form-control" value="<?php echo  $this->security->get_csrf_hash() ?>">
					
					<input type="email" id="inputEmail" name="email" class="form-control" placeholder="Enter valid email address" required autofocus>
					<span><a href="<?php echo base_url('Login'); ?>" class="recp">Login</a></span>
					<input class="biz_submit" id="submit" type="submit" name="submit" value="Submit">
				</div>
			</form>
		</div>
	</div>
</body>
</html>