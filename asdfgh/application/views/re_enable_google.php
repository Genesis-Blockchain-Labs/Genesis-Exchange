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
.contributions-form {
    border-bottom: 1px solid #efefef;
    color: #666;
    float: left;
    font-size: 20px;
    font-weight: bold;
    margin: 15px 0;
    padding-bottom: 6px;
    text-align: center;
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
					<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
						<li class="active">Progress Bar</li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
				  <?php  
						$lerror = $this->session->flashdata('error_msg');
						  if(isset($lerror))
						  {
							  echo '<div class="alert alert-success">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$lerror.'</div>'; 
						  }
					 ?>	
						<div id="my-tab-content" class="tab-content">
							<div class="tab-pane active" id="orange">
								<div class="contributions-form">
									<span class="">Enable the google authentication</span>
								</div>
									<form action="<?php echo base_url();?>save_setting" enctype="multipart/form-data" method="post" id="reference_code" name="fregisters" class="form-horizontal form-label-left">
										<input type="hidden" id="" name="<?php echo  $this->security->get_csrf_token_name() ?>" class="form-control" value="<?php echo  $this->security->get_csrf_hash() ?>">
										<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tax">
										<img src="<?php echo $google_auth['auth_url']; ?>" alt="bar-code" class="img-responsive" id="img_bar">
										</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<ul>
													<li>Step  1. You need to download google authenticator app. </li>
													<li> Step  2. After installation app, you need to scan the barcode.</li>
													<li> Step  3. After that verification code will generate that you need while login.</li>
													<li> Step  4. Enter that verification code at verification page for login.</li>
												</ul>
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