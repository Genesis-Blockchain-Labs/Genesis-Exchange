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
					<h4>Support Management</h4>
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
								<th>Ticket No.</th>
								<th>From</th>
								<th>Email</th>
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
function confirmclose(ticket_id){
	var result = confirm("Are you sure you want to Close this ticket?");
	if(result){  
		document.location.href="<?php echo base_url('Support/close_ticket'); ?>/"+ticket_id;
		return true; 
	}else{
		return false;
	}	
} 
function confirmdelete(ticket_id){
	var result = confirm("Are you sure you want to delete this ticket?");
	if(result){  
		document.location.href="<?php echo base_url('Support/delete_ticket'); ?>/"+ticket_id;
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
		     "url": "<?php echo base_url('support/posts') ?>",
		     "dataType": "json",
		     "type": "POST",
		     "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
		                   },
	    "columns": [
		          { "data": "id" },
				  {"data": "ticket_no"},
		          { "data": "username" },
				  { "data": "email" },
		          { "data": "status" },
				  { "data": "detail" },
				  { "data": "close"},
		       ]	 

	    });
    });
</script>