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
						<li class="active">Broadcast</li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
				<?php  
                $lerror = $this->session->flashdata('broad_error_msg');
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
							<form action="<?php echo base_url();?>save_message" enctype="multipart/form-data" method="post" class="form-horizontal form-label-left" autocomplete="off">
								<input type="hidden" id="" name="<?php echo  $this->security->get_csrf_token_name() ?>" class="form-control" value="<?php echo  $this->security->get_csrf_hash() ?>">
								<div class="form-group">
									<label class="col-md-12 col-sm-3 col-xs-12" for="tax">Notification: </label>
									<div class="col-md-12 col-sm-6 col-xs-12">							
										
									<textarea name="message" id="message" class="form-control"></textarea>										
									</div>
									
									<div class="col-md-12 col-sm-3 col-xs-12">
									<div class="form-group">
									 <div class="col-md-12">
									  <div class="error-form-dv"><p><?php echo form_error('message');  ?></p></div>
									 </div>
									</div>
									<br />
										<button type="submit" class="btn btn-success" id="submit_code_btn">Send</button>
									</div>
								</div>	
							</form>
						</div>			
					</div>  
				</div>
				<div class="x_content table-responsive">     
					<table id="user_data" class="table table-striped responsive-utilities jambo_table table table-bordered" >  
						<thead>
							<tr class="headings">
								<th>S.No</th>
								<th>Notification Message</th>
								<th>Date / Time</th>
								<th>Action</th>
							</tr>
						</thead>
					</table>
				</div>
				</div>
				<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title user_modal">Edit Message</h4>
			</div>
			<form action="<?php echo base_url(); ?>update_message" method="post" autocomplete="off">
				<div class="modal-body">
					<input type="hidden" id="" name="<?php echo  $this->security->get_csrf_token_name() ?>" class="form-control" value="<?php echo  $this->security->get_csrf_hash() ?>">
					<p><label class="label_modal">Message: </label>
					<div class="add_stg">
						<textarea name="emessage" class="form-control" id="emessage" required></textarea></p>	
					</div>
					<input type="hidden" name="mes_id" id="mes_id" value=""/>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success btn-info btn-lg">Update</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
function edit_message(id,message){
	$('#mes_id').val(id);
	 $('#myModal').modal('show');
	 	$('#emessage').text(message);
}
</script>
<style>
.error-form-dv {
    COLOR: red;
}
</style>
<!------------------------------------->
<script>
function confirmdelete(id){
	var result = confirm("Are you sure you want to delete this Notification?");
	if(result){  
		document.location.href="<?php echo base_url('broadcast/delete_message'); ?>/"+id;
		return true; 
	}else{
		return false;
	}	
} 
</script>
<script>
    $(document).ready(function () {
		//$.fn.dataTable.ext.errMode = 'throw';
        $('#user_data').DataTable({
            //"processing": true,
            "serverSide": true,
            "ajax":{
		     "url": "<?php echo base_url('broadcast/get_all_messages') ?>",
		     "dataType": "json",
		     "type": "POST",
		     "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
		                   },
	    "columns": [
		          { "data": "id" },
		          { "data": "message" },
				  { "data": "date" }, 
				  { "data": "edit" },
		       ]	 

	    });
    });
</script>