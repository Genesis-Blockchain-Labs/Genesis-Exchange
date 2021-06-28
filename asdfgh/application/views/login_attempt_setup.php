<div class="right_col" role="main">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h4>User Authentication</h4>
					<div class="clearfix"></div>
				</div>
				<div class="white">
					<div class="x_content">
						<div class="container">
							<?php echo $this->session->flashdata('success_msg'); ?>
							<div class="ref_admin">
								<div class="radio-col">
								<?php  $attributes = array('role'=>"form", 'method'=>'post');
										$url = base_url().'attempt_setup_update';
										echo form_open_multipart($url, $attributes); ?>
										<div class="row">
											<div class="col-md-3">
												<label>Login Attempts: </label>
											</div> 
											<div class="col-md-9">	
											<?php	
												if(!empty($admin_setup['login_failed_limit'])){
													$data = array(
														'name'          => 'login_failed_limit',
														'id' 			=>'login_failed_limit',
														'type'         => 'number',
														'value'         => $admin_setup['login_failed_limit'],
														'class'         => 'form-control',
														'min' 			=>	1,
													);
												}else{
													$data = array(
														'name'          => 'login_failed_limit',
														'id' 			=>'login_failed_limit',
														'type'         => 'number',
														'value'         => set_value('login_failed_limit'),
														'class'         => 'form-control',
														'min' 			=>	1,
													);
												}	
													echo form_input($data);
											?>
											</div>
										</div>
										<p><button type="submit" class="btn btn-success"  />Save</button></p>
									<?php echo form_close(); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
