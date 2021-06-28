<script type="text/javascript"src="<?php echo base_url(); ?>assest/css/datatables/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    function confirmDeletion(eid,table)
      {
        var result = confirm("Are you sure you want to Delete this event?");
        if(result)
          {  
            document.location.href="<?php echo site_url('admin/dashboard/del_event'); ?>/"+eid+"/"+table;
           return true; 
          }
        else
          {
            return false;
          }
      } 
		//bcbcb
      $(document).ready(function()
      {
          $('#myTable').dataTable();
      });
	  $(document).ready(function()
      {
          $('#myTable1').dataTable();
      });
</script>    
<head> 
    <link rel="stylesheet" href="<?php echo base_url(); ?>assest/css/datatables/css/jquery.dataTables.min.css"></style>
</head>              
<style>
a#dwnld {
    margin-left: 7%;
}
.error_class {
    color: red;
    display: none;
    float: left;
    font-size: 14px;
    text-align: left;
    width: 100%;
}

button.copy-button.btn.btn-outline-success.copy-btn {
    background: #00b437;
    color: white;
    font-size: 10px;
    padding: 2px 8px;
}
.pointer span {
    float: left;
    width: 100%;
}
</style>
<div class="right_col" role="main">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<?php  if(!empty($userdata['authentication'] == '1')){  ?>
				<div class="x_title">
					<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
						<li class="active">Second Factor</li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<?php  echo $this->session->flashdata('msg'); ?>	
					<div id="my-tab-content" class="tab-content">			
						<div class="tab-pane active" id="orange">
							<div class="contributions-form">
								<span class="">Disable Google Authentication</span>
							</div>
							<form action="<?php echo base_url();?>disable" enctype="multipart/form-data" method="post" class="form-horizontal form-label-left">
								<input type="hidden" id="" name="<?php echo  $this->security->get_csrf_token_name() ?>" class="form-control" value="<?php echo  $this->security->get_csrf_hash() ?>">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tax">Please Enter Verification Code:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">							
											<input type="text" id="auth_code" class="form-control col-md-7 col-xs-12" name="auth_code" value="" required="required" autocomplete="off">	
										</div>
								</div>
								<div class="form-group">
									<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
										<button type="submit" class="btn btn-success" id="submit_code_btn">Disable</button>
									</div>
								</div> 
							</form>
						</div>			
					</div>  
				</div>
			<?php	} else {  ?>	
			<div class="x_title">
				<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
					<li class="active">Second Factor</li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<?php   echo $this->session->flashdata('msg'); ?>	
				<div id="my-tab-content" class="tab-content">			
					<div class="tab-pane active" id="orange">
						<div class="contributions-form">
							<span class="">Enable Google Authentication</span>
						</div>
						<form action="<?php echo base_url();?>dashboard/enableauthpass" enctype="multipart/form-data" method="post" class="form-horizontal form-label-left">
							<input type="hidden" id="" name="<?php echo  $this->security->get_csrf_token_name() ?>" class="form-control" value="<?php echo  $this->security->get_csrf_hash() ?>">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tax">Please Enter Your Password:</label>
									<div class="col-md-6 col-sm-6 col-xs-12">							
										<input type="text" id="password" class="form-control col-md-7 col-xs-12" name="password" value="" required="required" autocomplete="off">	
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
										<button type="submit" class="btn btn-success" id="submit_code_btn">Enable</button>
									</div>
								</div> 
						</form>
					</div>			
				</div>  
			</div>
		<?php } ?>	
		</div>
