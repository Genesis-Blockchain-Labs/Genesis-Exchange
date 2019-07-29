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
				<div class="x_title">
					<h4>Progress Bar</h4>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
				<?php  echo $this->session->flashdata('msg'); ?>	
					<div id="my-tab-content" class="tab-content">
						<div class="tab-pane active" id="orange">
							<div class="contributions-form">
								<span class="">Manage Progress Bar</span>
							</div>
								<form action="<?php echo base_url();?>save_setting" enctype="multipart/form-data" method="post" id="reference_code" name="fregisters" class="form-horizontal form-label-left">
									<input type="hidden" id="" name="<?php echo  $this->security->get_csrf_token_name() ?>" class="form-control" value="<?php echo  $this->security->get_csrf_hash() ?>">
									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tax">Raised $:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
										<?php if(!empty($progress)){  ?>
										<input type="text" id="Raised" class="form-control col-md-7 col-xs-12" name="Raised" value="<?php echo $progress['raised'];  ?>" required="required">
										<?php }else{ ?>
										<input type="text" id="Raised" class="form-control col-md-7 col-xs-12" name="Raised" value="" required="required">
										<?php } ?>
										<span class="error_class" id="reference_name"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tax">Progress %:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<?php if(!empty($progress)){  ?>
											<input type="text" id="progress_bar" class="form-control col-md-7 col-xs-12" name="progress_bar" value="<?php echo $progress['progress_bar'];  ?>" required="required">
											<?php }else{  ?>
											<input type="text" id="progress_bar" class="form-control col-md-7 col-xs-12" name="progress_bar" value="" required="required">
											<?php }  ?>
											<span class="error_class" id="c_amount_err"></span>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
											<button type="submit" class="btn btn-success" id="submit_code_btn"><?php if(!empty($progress)){  ?>Update<?php }else{  ?>Save<?php }  ?>
											</button>
										</div>
									</div> 
							</form>
						</div>
					</div>
				</div>