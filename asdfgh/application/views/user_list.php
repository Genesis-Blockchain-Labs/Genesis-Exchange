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
					<h4>User Management</h4>
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
								<th>First Name</th>
								<th>Last Name</th>
								<th>Email</th>
								<th>Balance</th>
								<th>Total Referred Users</th>
								<th>Users Referred Balance</th>
								<th>Status</th>
								<th>Detail</th>
								<th>Action</th>
							  </tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

<script type="text/javascript">
function confirmDeletion(user_id){
	var result = confirm("Are you sure you want to Suspend this user?");
	if(result){  
		document.location.href="<?php echo base_url('User/delete_user'); ?>/"+user_id;
		return true; 
	}else{
		return false;
	}	
} 
function unsuspend(user_id){
	var result = confirm("Are you sure you want to Unsuspend this user?");
	if(result){  
		document.location.href="<?php echo base_url('User/unsuspend'); ?>/"+user_id;
		return true; 
	}else{
		return false;
	}	
} 
function confirmfullDeletion(user_id){
	var result = confirm("Are you sure you want to Permanently Delete this user?");
	if(result){  
		document.location.href="<?php echo base_url('User/fulldelete_user'); ?>/"+user_id;
		return true; 
	}else{
		return false;
	}	
} 
</script>

<!------------------------------------->
<script>
    $(document).ready(function () {
		//$.fn.dataTable.ext.errMode = 'throw';
        $('#user_data').DataTable({
            //"processing": true,
            "serverSide": true,
            "ajax":{
		     "url": "<?php echo base_url('User/posts') ?>",
		     "dataType": "json",
		     "type": "POST",
		     "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
		                   },
	    "columns": [
		          { "data": "id" },
		          { "data": "firstname" },
				  { "data": "lastname" },
		          { "data": "email" },
				  { "data": "balance" },
				  { "data": "total_refer_user" },
				  { "data": "balance_refered" },
		          { "data": "status" },
				  { "data": "detail" },
				  { "data": "delete" },
		       ]	 

	    });
    });
</script>