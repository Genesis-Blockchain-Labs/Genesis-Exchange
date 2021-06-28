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
             <h4>Transaction management</h4>
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
					<?php 
					if(isset($user_id) && $user_id!=""){ 
					?>
						<input type="hidden" name="user_id" value="<?php echo $user_id;?>" id="user_id"/>
					<?php } ?>
					  <table id="user_data" class="table table-striped responsive-utilities jambo_table table table-bordered" >  
						<thead>
						  <tr class="headings">
							<th>S.No</th>
							<th>Email</th>
							<th>Amount</th>
							<th>Invested Amount In Dollars</th>
							<th>Currency</th>
							<th>Date / Time</th>   
							<th>Status</th>
							<th>Delete</th>
						  </tr>
						</thead>
					</table>
				</div>
            </div>
        </div>
    </div>
  </div>
</div>  
<script type="text/javascript">
function confirmDeletion(id){
	var result = confirm("Are you sure you want to Permanently Delete this transaction?");
	if(result){  
		document.location.href="<?php echo base_url('Transaction/delete_transaction'); ?>/"+id;
		return true; 
	}else{
		return false;
	}
} 
</script>
<!------------------------------------->
<script>
    $(document).ready(function () {
		var user_id = $('#user_id').val();
		//$.fn.dataTable.ext.errMode = 'throw';
        $('#user_data').DataTable({
			
            //"processing": true,
            "serverSide": true,
            "ajax":{
		     "url": "<?php echo base_url('Transaction/posts') ?>",
		     "dataType": "json",
		     "type": "POST",
		     "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>','user_id':user_id }
		                   },
	    "columns": [
		          { "data": "id" },
		          { "data": "email" },
				  { "data": "amount" },
				   { "data": "dollar_amount" },
		          { "data": "currency" },
				  { "data": "date" },
				  { "data": "status" },
				  { "data": "delete" },
		       ]	 

	    });
    });
</script>