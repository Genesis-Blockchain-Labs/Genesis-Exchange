<link rel="stylesheet" href="<?php echo base_url(); ?>assest/css/datatables/css/jquery.dataTables.min.css"></style>
<link rel="stylesheet" href="<?php echo base_url(); ?>assest/css/datatables/css/jquery.dataTables.min.css"></style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript"src="<?php echo base_url(); ?>assest/css/datatables/js/jquery.dataTables.min.js"></script>
<div class="right_col" role="main">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
						<li class="active">Block IP Address (For Admin Panel)</li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<?php   $lerror = $this->session->flashdata('ip_error_msg');
							if(isset($lerror)){
							if($lerror['code']=='1'){
							echo '<div class="alert alert-success">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$lerror['mess'].'</div>';
							}else{
							echo '<div class="alert alert-error">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$lerror['mess'].'</div>';
							}					  
							}
					?>	
					<div id="my-tab-content" class="tab-content">			
						<div class="tab-pane active" id="orange">
							<div class="contributions-form">
								<span class="">Enter the IP Address which you want to block</span>
							</div>
							<form action="<?php echo base_url();?>blockip" enctype="multipart/form-data" method="post" class="form-horizontal form-label-left">
								<input type="hidden" id="" name="<?php echo  $this->security->get_csrf_token_name() ?>" class="form-control" value="<?php echo  $this->security->get_csrf_hash() ?>">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tax">IP address: </label>
										<div class="col-md-6 col-sm-6 col-xs-12">							
											<input type="text" id="ip" class="form-control col-md-7 col-xs-12" name="ip" value="<?php echo set_value('ip');  ?>" autocomplete="off">	
											<div class="form-group">
												<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
													<div class="error-form-dv"><?php echo form_error('ip');  ?></div>
												</div>
											</div> 								
										</div>
										<div class="col-md-3 col-sm-6 col-xs-12">
											<div class="form-group">
												<button type="submit" class="btn btn-success" id="submit_code_btn">Block</button>
											</div>
										</div> 
							</form>
						</div>			
					</div>  
				</div>
				<div class="x_content table-responsive">     
					<table id="user_data_admin" class="table table-striped responsive-utilities jambo_table table table-bordered" >  
						<thead>
							<tr class="headings">
								<th>S.No</th>
								<th>IP Address</th>
								<th>Date / Time</th>
								<th>Action</th>
							</tr>
						</thead>
                   </table>
				</div>
			</div>
<style>
.error-form-dv {
    COLOR: red;
}
</style>
<!------------------------------------->
<script>
function confirmunblock(id){
	var result = confirm("Are you sure you want to unblock the IP address?");
	if(result){  
		document.location.href="<?php echo base_url('ip/unblock_ip'); ?>/"+id;
		return true; 
	}else{
		return false;
	}	
} 
</script>
<script>
    $(document).ready(function () {
		//$.fn.dataTable.ext.errMode = 'throw';
        $('#user_data_admin').DataTable({
            //"processing": true,
            "serverSide": true,
            "ajax":{
		     "url": "<?php echo base_url('ip/posts') ?>",
		     "dataType": "json",
		     "type": "POST",
		     "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
		                   },
	    "columns": [
		          { "data": "id" },
		          { "data": "ip" },
				  { "data": "date" }, 
				  { "data": "unblock" },
		       ]	 

	    });
    });
</script>