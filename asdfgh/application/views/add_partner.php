<link rel="stylesheet" href="<?php echo base_url(); ?>assest/css/datatables/css/jquery.dataTables.min.css"></style>
<link rel="stylesheet" href="<?php echo base_url(); ?>assest/css/datatables/css/jquery.dataTables.min.css"></style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript"src="<?php echo base_url(); ?>assest/css/datatables/js/jquery.dataTables.min.js"></script>
<style>	
.search_div {
    float: right;
}
</style>	
<div class="right_col" role="main">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h4>Add Partner</h4>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
	
					<div id="my-tab-content" class="tab-content">			
						<div class="tab-pane active" id="orange">
							<form action="<?php echo base_url(); ?>savepartner" id="add_form" enctype="multipart/form-data" method="post" class="form-horizontal form-label-left">
								<input type="hidden" id="" name="<?php echo  $this->security->get_csrf_token_name() ?>" class="form-control" value="<?php echo  $this->security->get_csrf_hash() ?>">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tax">Partner Name: </label>
									<div class="col-md-6 col-sm-6 col-xs-12">							
										<input type="text" id="partnername" class="form-control col-md-7 col-xs-12" name="partnername" value="<?php echo set_value('partnername');  ?>" autocomplete="off">	
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
										<div class="error-form-dv"><?php echo form_error('partnername');  ?></div>
									</div>
								</div>								
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tax">Link: </label>
									<div class="col-md-6 col-sm-6 col-xs-12">							
										<input type="text" id="partnerlink" class="form-control col-md-7 col-xs-12" name="partnerlink" value="<?php echo set_value('partnerlink');  ?>" autocomplete="off">	
									</div>
								</div> 
								<div class="form-group">
									<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
										<div class="error-form-dv"><?php echo form_error('partnerlink');  ?></div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tax">Upload Logo: </label>
									<div class="col-md-6 col-sm-6 col-xs-12" id="choose_img">	
									<input type="file" id="logofile" class="file" name="logo"  autocomplete="off">	
									<div class="input-group col-xs-12">
										<span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
									  <input type="text" class="form-control input-lg" disabled placeholder="Upload Image">
									  <span class="input-group-btn">
										<button class="browse btn btn-primary input-lg" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
									  </span>
									</div>									
									</div>
								</div>								
								<div class="form-group">
									<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
										<div class="error-form-dv"><?php echo form_error('logo');  ?></div>
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
		</div>
	</div>

<script type="text/javascript">

$(document).on('click', '.browse', function(){
	var file = $(this).parent().parent().parent().find('.file');
  file.trigger('click');
});
$(document).on('change', '.file', function(){
  $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
});
</script>