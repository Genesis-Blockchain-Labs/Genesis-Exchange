<link rel="stylesheet" href="<?php echo base_url(); ?>assest/css/datatables/css/jquery.dataTables.min.css"></style>
<link rel="stylesheet" href="<?php echo base_url(); ?>assest/css/datatables/css/jquery.dataTables.min.css"></style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript"src="<?php echo base_url(); ?>assest/css/datatables/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function(){
	$('#myTable').dataTable({
	"aoColumnDefs": [
	{ "bSearchable": false, "aTargets": [ -1 ] }
	] });
});   
</script>              
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
					<div class="clearfix"></div>
				</div>
				<form method="post" id="submit">
					Start Date:-<input type="text" name="start" id="start" required>
					End Date:-<input type="text" name="end" id="end" required>
					<input type="submit" value="Search">
				</form>
				<form method="post" id="reference_search">
				</form> 
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
						<table id="myTable" class="table table-striped responsive-utilities jambo_table table table-bordered" >  
							<thead>
								<tr class="headings">
									<th>S.No</th>
									<th>Name</th>
									<th>Email</th>
									<th>BTC Address</th>
									<th>BTC Amount</th>
									<th>ETH Address</th>
									<th>ETH Amount</th>
									<th>RIPPLE Address</th>
									<th>RIPPLE Amount</th>
									<th>Date of investment</th>
									<th>Status of investment</th>
									<th>Detail</th>
								</tr>
							</thead>
							<tbody>
					
							<?php 
							$i=0;
							if (!empty($user_detail)) { 
							foreach ($user_detail as $result){ 
							?>
								<tr class="odd pointer">							
									<td><?php echo ++$i; ?></td>	
									<td><a href="<?php echo base_url(); ?>index.php/admin/User/work/<?php echo $result['user_id']; ?>"><?php echo $result['firstname'].' '.$result['lastname']; ?></a></td>
									<td><?php echo $result['email']; ?></td>								
									<td><?php echo $result['BTC']; ?></td>								
									<td><?php echo $result['btc_amount']; ?></td>								
									<td><?php echo $result['ETH']; ?></td>								
									<td><?php echo $result['eth_amount']; ?></td>								
									<td><?php echo $result['RIPPLE']; ?></td>								
									<td><?php echo $result['ripple_amount']; ?></td>								
									<td><?php echo $result['date']; ?></td>	
									<td><?php echo $result['acc_status']; ?></td>	
									<td><a href="<?php echo base_url(); ?>kyc_detail/<?php echo $result['user_id']; ?>" class="btn btn-primary" target="_blank">View Detail</a></td> 
																  
								</tr>
                        <?php } } ?>  
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

<script type="text/javascript">
function confirmDeletion(user_id){
	var result = confirm("Are you sure you want to Delete this user?");
	if(result){  
		document.location.href="<?php echo base_url('User/delete_user'); ?>/"+user_id;
		return true; 
	}else{
		return false;
	}
} 
</script>