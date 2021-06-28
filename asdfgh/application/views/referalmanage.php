<div class="right_col" role="main">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h4>Referal Management</h4>
					<div class="clearfix"></div>
				</div>
				<div class="white">
					<div class="x_content">
						<div class="container">
						<?php	$message = $this->session->flashdata('error_msg'); 
						if(!empty($message)){    ?>
							<div class="col-sm-12">
								<div class="alert alert-success fade in" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								  <?php echo $message; ?>
								</div>
							</div>
							<?php } ?>
							<div class="ref_admin">
							<?php  $attributes = array('role'=>"form", 'method'=>'post');
									$url = base_url().'save_referral';
									echo form_open_multipart($url, $attributes); ?>
									<div class="radio-col">
										<label>Referral System Management: </label> 
											<input type="radio" name="system_management" value="1" <?php if($referral['system_management']==1) { ?>checked="checked" <?php } ?>/><span>ON</span>
											<input type="radio" name="system_management" value="0" <?php if($referral['system_management']==0) { ?> checked="checked" <?php } ?>/><span>OFF</span>
											<span class="error-vlidation-err"><?php echo form_error('details'); ?></span>
									</div>
									<div class="row">
										<div class="col-md-3">
											<label>Referral bonus: </label>
										</div> 
											<div class="col-md-9 inp_ref">	
											<?php	
											if(!empty($referral['bonus'])){
												$data = array(
													'name'          => 'bonus',
													'id' 			=>'bonus',
													'type'         => 'number',
													'value'         => $referral['bonus'],
													'class'         => 'form-control',
													'min' 			=>	1,
												);
											}else{
												$data = array(
													'name'          => 'bonus',
													'id' 			=>'bonus',
													'type'         => 'number',
													'value'         => set_value('bonus'),
													'class'         => 'form-control',
													'min' 			=>	1,
												);
											}	
												echo form_input($data);
											?>
											<span class="perce_inp">%</span>
									</div>
								</div>
								<p>	<span class="error-vlidation-err"><?php echo form_error('bonus'); ?></span></p>
								<input type="hidden" id="" name="<?php echo  $this->security->get_csrf_token_name() ?>" class="form-control" value="<?php echo  $this->security->get_csrf_hash() ?>">
								<p><button type="submit" class="btn btn-success"  />Save</button></p>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>