<style>
input.velue {
    border: none;
    width: 30px;
    background: none;
}
button.btn.btn-outline-success.copy-ctry {
    font-size: 11px;
    background: #337ab7;
    color: #fff;
}
.cutry-td{
	width:110px;
	display: block;
	padding: 11px 9px !important;
} 
</style>
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
	</script>    
    <head> 
    <link rel="stylesheet" href="<?php echo base_url(); ?>assest/css/datatables/css/jquery.dataTables.min.css"></style>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    </head>              

<div class="right_col" role="main">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<div class="clearfix"></div>
				</div>
				<div class="white">
					<div class="x_content">
					<?php  
						$lerror = $this->session->flashdata('error_msg');
						  if(isset($lerror))
						  {
							  echo '<div class="alert alert-success">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$lerror.'</div>'; 
						  }
					 ?>  
						<table id="kyc_data" class="table table-striped responsive-utilities jambo_table table table-bordered" >  
							<thead>
							  <tr class="headings">
								<th>Sr No.</th>
								<th>Name</th>
								<th>Country</th>
								<th>Purchase amount</th>
								<th>Contribution Amount</th>
								<th>Reference ID</th>
								<th>Refered ID</th>
								<th>eth Address</th>
								<th>Status</th>
							
								<th>Detail</th>
							  </tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
<script>
function status(val,user_id){
	if(val == "verified"){
		$("#"+user_id).attr("disabled",true);
	}
	var request = $.ajax({
		url: "<?php echo base_url(); ?>kyc_status",
		method: "POST",
		data: {user_id: user_id,status: val},
	});
	request.done(function( msg ) {

	});
}

//function to delete
function delet(id)
{
	var txt;
	var r = confirm("Are you sure you want to Delete this entry?");
	if (r == true) {
		var request = $.ajax({
		url: "<?php echo base_url(); ?>index.php/admin/User/udelete",
		method: "POST",
		data: {id: id}
		});
		request.done(function( msg ) {
			window.location.reload();
		});
	} else {
		return false;
	}
}
</script>
<style>
select.form-control.stt {
    width: 140px;
}
</style>

<script>
 function get_record()
	{
		var start = $("#start").val();
		var end = $("#end").val();
		if(start != "" && end != "")
		{
				$.ajax({
				   url: '<?php echo base_url();?>index.php/admin/User/get_kyc_user',
				   data: {
					  start: start, end: end
				   },
				   error: function() {
					  $('#info').html('<p>An error has occurred</p>');
				   },
				  
				   success: function(data) {
					if(data)
					{
						$(".white").html(data);
					}
				   },
				   type: 'POST'
				});
		}
	}
</script>

<script>
   $( function() {
	$("#start").datepicker({
            defaultDate: new Date(),
			dateFormat: 'yy/mm/dd',
           //  minDate: new Date(),
            onSelect: function(dateStr) 
            {    
				
                $("#end").val(dateStr);
                $("#end").datepicker("option",{ minDate: new Date(dateStr)})
            }
        });

	
	$('#end').datepicker({
				defaultDate: new Date(),
				dateFormat: 'yy/mm/dd',
				onSelect: function(dateStr) {
				toDate = new Date(dateStr);
					
					
			   }  
			   
	  });  
}); 
  </script>

<script>
	$(function(){
		 $("#submit").submit(function(event)
         {
			get_record();
			event.preventDefault();
		});
	});
	
function copyCountryCode(id) {
    var copyText = document.getElementById("country_code"+id);
    copyText.select();
    document.execCommand("Copy");
    
}
</script>
<!------------------------------------->
<script>
    $(document).ready(function () {
		
		
        $('#kyc_data').DataTable({
            //"processing": true,
            "serverSide": true,
            "ajax":{
		     "url": "<?php echo base_url('Kyc/kyc_list') ?>",
		     "dataType": "json",
		     "type": "POST",
		     "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
		                   },
	    "columns": [
				{ "data": "id" },
		          { "data": "name" },
		          { "data": "Country" },
		          { "data": "Purchase_amount" },
		          { "data": "contributton_amount" },
		          { "data": "reference" },
				  { "data": "referred" },
				  { "data": "eth_address" },
				  { "data": "status" },
				  { "data": "detail" },
		       ]	 

	    });
    });
</script>
