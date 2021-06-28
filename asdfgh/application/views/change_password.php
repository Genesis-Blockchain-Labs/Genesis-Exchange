<div class="right_col" role="main">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
						<li class="active">Change Password</li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
			   <?php 
				$recsuc_msg = $this->session->flashdata('recsuc_msg');
				if(isset($recsuc_msg)){
					echo '<div class="alert alert-success">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$recsuc_msg.'</div>';
				}
				
				$msg = $this->session->flashdata('rec_msg');
				if(isset($msg)){
					echo '<div class="alert alert-error">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$msg.'</div>';
				}
				?>
					<div id="my-tab-content" class="tab-content">			
						<div class="tab-pane active" id="orange">
							<div class="contributions-form">
								<span class="">Enter Email Address</span>
							</div>
							<form action="<?php echo base_url();?>passwordrecover" enctype="multipart/form-data" method="post" class="form-horizontal form-label-left">
								<input type="hidden" id="" name="<?php echo  $this->security->get_csrf_token_name() ?>" class="form-control" value="<?php echo  $this->security->get_csrf_hash() ?>">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tax">Email: </label>
									<div class="col-md-6 col-sm-6 col-xs-12">							
										<input type="text" id="email" class="form-control col-md-7 col-xs-12" name="email" value="<?php echo set_value('ip');  ?>" autocomplete="off">	
									</div>
								</div>	
								<div class="form-group">
									<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
										<div class="error-form-dv"><?php echo form_error('ip');  ?></div>
									</div>
								</div> 
								<div class="form-group">
									<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
										<button type="submit" class="btn btn-success" id="submit_code_btn">Save</button>
									</div>
								</div> 
							</form>
						</div>			
					</div>  
				</div>
			</div>
<style>
.error-form-dv {
    COLOR: red;
}
</style>