<?php include('includes/header.php');
?>	
<body>
	<link rel="stylesheet" href="<?php echo base_url()?>assets/css/mycustom.css">
	<div class="clearfix"></div>
	<div class="containter">
		<div class="row">
			<div class="all-form">
				<div class="main-top-margin main-reg-para set_p">
					<div class="inner-main-top">	
						<div class="col-sm-12">
							<div class="bd_vont">
								<div>
									<div class="reg-para"></div>
									<div class="proof registration-page">
										<div class="team-content-wrapper">
											<div class="card card-container">
												<div class="m-l-heading">
													<h1>Authentication</h1>
												</div>                    
											
												<a href="<?php echo site_url('authenticate/'.$id); ?>"><button type="submit" class="btn btn-primary btn-block" id="register_submit"><i class="fa fa-key" aria-hidden="true"></i>Google Auth</button></a>
												<a href="<?php echo site_url('authenticateTwilio/'.$id); ?>"><button type="button" class="btn btn-primary btn-block" id="buttons"><i class="fa fa-key" aria-hidden="true"></i>Twilio</button></a>
												<?php
													echo form_close();
												?>
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
	<!--/slider_s-->
</main>

</body>
</html>

<?php include('includes/footer.php');?>