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
select.form-control.stt {
    width: 140px;
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
	 $(document).ready(function()
      {
          $('#myTable').dataTable();
      });
    </script>    
    <head> 
    <link rel="stylesheet" href="<?php echo base_url(); ?>assest/css/datatables/css/jquery.dataTables.min.css"></style>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="/resources/demos/style.css">
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
							<table id="myTable" class="table table-striped responsive-utilities jambo_table table table-bordered" >  
								<thead>
								  <tr class="headings">
									<th>S.N.</th>
									<th>Total Coins</th>
									<th>Contribution in Dollars</th>
									<th>Detail</th>
								  </tr>
								</thead>
							<tbody>
							<?php 
							if ($user != false) { $i=1;
								foreach ($user as $result){ ?>
								<tr class="odd pointer">
									<td><?php echo $i; ?></td>
									<td><?php echo $result['total_coins']; ?></td>
									<td><?php echo $result['contribution_in_dollar']; ?></td>
									<td><a href="<?php echo base_url() ?>kyc_detail/<?php echo $result['user_id']; ?>" target="_blank" class="btn btn-primary">Detail</a></td>								
								</tr>
							<?php $i++; } } ?>  
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
<script>
function status(val,id)
{
	if(val == "verified")
	{
		$("#"+id).attr("disabled",true);
	}
	var request = $.ajax({
		url: "<?php echo base_url(); ?>index.php/admin/User/change_status",
		method: "POST",
		data: {id: id,status: val },
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