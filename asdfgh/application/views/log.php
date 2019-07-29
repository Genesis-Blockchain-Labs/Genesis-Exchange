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
					<h4>Logs Detail</h4>
					<div class="clearfix"></div>
				</div>
				<div class="white">
					<div class="x_content table-responsive">
						<?php  
							$lerror = $this->session->flashdata('error_msg');
							  if(isset($lerror))
							  {
								  echo '<div class="alert alert-success">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$lerror.'</div>'; 
							  }
						?>  
							<table id="user_data" class="table table-striped responsive-utilities jambo_table table table-bordered" >  
								<thead>
								  <tr class="headings">
									<th>S.No</th>
									<th>User</th>
									<th>Login Date / Time</th>
									<th>IP Address</th>
									<th>Country</th>
									<th>Country Code</th>
									<th>Status</th>
								  </tr>
								</thead>
							</table>
					</div>
				</div>
			</div>
		</div>
	</div>

<script type="text/javascript"></script>

<!------------------------------------->
<script>
    $(document).ready(function () {
		//$.fn.dataTable.ext.errMode = 'throw';
        $('#user_data').DataTable({
            //"processing": true,
            "serverSide": true,
            "ajax":{
		     "url": "<?php echo base_url('Logs/posts') ?>",
		     "dataType": "json",
		     "type": "POST",
		     "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
		                   },
	    "columns": [
		          { "data": "id" },
		          { "data": "user" },
				  { "data": "login_date" },
		          { "data": "ip_address" },
				  { "data": "country" },
				  { "data": "country_code" },
				  { "data": "status" },
		       ]	 

	    });
    });
</script>