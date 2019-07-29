<div class="right_col" role="main">
<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
        <div class="x_title">
             <h4>Activation Email Status</h4>
              <div class="clearfix"></div>
        </div>
		<div class="white">
			<div class="x_content">
				<div class="container">
					<?php echo $this->session->flashdata('success_msg'); ?>
					<div class="ref_admin">
						<div class="radio-col">
						<?php  $attributes = array('role'=>"form", 'method'=>'post');
						$url = base_url().'activate_setup_update';
						echo form_open_multipart($url, $attributes); ?>
						<label>Activation Email Functionality: </label> 
						<input type="radio" name="activation_email_status" value="1" <?php if($admin_setup['activation_email_status']==1) { ?>checked="checked" <?php } ?>/><span>ON</span>
						<input type="radio" name="activation_email_status" value="0" <?php if($admin_setup['activation_email_status']==0) { ?> checked="checked" <?php } ?>/><span>OFF</span>
						<span class="error-vlidation-err"><?php echo form_error('details'); ?></span>
						<input type="hidden" id="" name="<?php echo  $this->security->get_csrf_token_name() ?>" class="form-control" value="<?php echo  $this->security->get_csrf_hash() ?>">
						<br><br>
						<p><button type="submit" class="btn btn-success"  />Save</button></p>
						<?php  echo form_close();  ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
 </div>
