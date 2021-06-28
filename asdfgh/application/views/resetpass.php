<!DOCTYPE html>
<html>
	<head>
		<title><?php echo DOMAIN_NAME;  ?></title>
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
				<?php if(!empty($user['valid'] == 'yes')){ ?>  	
				<?php 
					$msg = $this->session->flashdata('succre_msg');
					if(isset($msg)){
						echo '<div class="alert alert-success">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$msg.'</div>';
					}
				?>
					<form method="post" action="<?php echo base_url(); ?>index.php/Login/resetpass/<?php echo $id; ?>">
						<div Style="color: red;"><?php echo validation_errors(); ?></div>
							<div class="inputs">
								<input type="hidden" id="" name="<?php echo  $this->security->get_csrf_token_name() ?>" class="form-control" value="<?php echo  $this->security->get_csrf_hash() ?>">
								<input type="password" id="inputPassword" name="password" class="form-control" placeholder="Select new password" required autofocus>
								<input type="password" id="inputcPassword" name="cpassword" class="form-control" placeholder="Confirm new password" required autofocus>
								<input type="hidden" name="id" class="form-control" value="<?php echo $user['token']; ?>">
								<?php $session = $this->session->userdata('user_data');
										if(!empty($session)){   ?>
										<span><a href="<?php echo base_url('dashboard'); ?>" class="recp">Dashboard</a></span>
										<?php }else{?>
										<span><a href="<?php echo base_url('Login'); ?>" class="recp">Login</a></span>
										<?php }?>
										<input class="biz_submit" type="submit" name="submit" value="Submit">
							</div>
					</form>
					<?php }else {  
							echo '<div class="alert alert-error">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Something went wrong.</div>';

					?> 
				
					<?php } ?>  			
			</div>
		</div>
	</body>
</html>