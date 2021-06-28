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
					<div class="col-md-6 col-sm-6 col-xs-6">
						<h4>Events Management</h4>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-6">
						<a href="<?php echo base_url(); ?>addevent" class="btn btn-primary" >Add New Event</a>
					</div>
					
					<div class="clearfix"></div>
					
				</div>
				<div class="white">
					<div class="x_content table-responsive">
					<?php  
						echo $this->session->flashdata('success_msg');
						echo $this->session->flashdata('error_msg');
					?>  
						<table id="event_list" class="table table-striped responsive-utilities jambo_table table table-bordered" >  
							<thead>
							  <tr class="headings">
								<th>S.No</th>
								<th>Event Name</th>
								<th>Event Link</th>
								<th>Logo</th>
								<th>Status</th>
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

function confirmfullDeletion(id){
	var result = confirm("Are you sure you want to Permanently Delete this Event?");
	if(result){  
		document.location.href="<?php echo base_url('Eventmanage/fulldelete_event'); ?>/"+id;
		return true; 
	}else{
		return false;
	}	
} 

</script>
 
<!------------------------------------->
<script>

    $(document).ready(function () {
		
        $('#event_list').DataTable({
           
            "serverSide": true,
            "ajax":{
		     "url": "<?php echo base_url('Eventmanage/events_posts') ?>",
		     "dataType": "json",
		     "type": "POST",
		     "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
		                   },
	    "columns": [
		          { "data": "id" },
		          { "data": "eventname" },
				  { "data": "eventlink" },
		          { "data": "logo" },
				  { "data": "status" },				
				  { "data": "delete" },
		       ]	 

	    });
    }); 
	
</script>