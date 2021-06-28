
<div class="right_col" role="main">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h4>Event Detail</h4>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
				  <?php  
						$lerror = $this->session->flashdata('error_msg');
						  if(isset($lerror))
						  {
							  echo '<div class="alert alert-success">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$lerror.'</div>'; 
						  } 
					 ?>	
					<div id="my-tab-content" class="tab-content">
						<div class="tab-pane active" id="orange">	
							<form action="<?php echo base_url();?>update_event" enctype="multipart/form-data" method="post" id="reference_code" name="fregisters" class="form-horizontal form-label-left">
							<input type="hidden" id="token_id" name="<?php echo  $this->security->get_csrf_token_name() ?>" class="form-control" value="<?php echo  $this->security->get_csrf_hash() ?>">
							<input type="hidden" name="id" id="id" value="<?php  echo $user->id; ?>"/>
							<div class="form-group upload-image">							
								<div class="col-md-3 col-sm-12 col-xs-12">
									<div class="col-md-12 col-sm-12 col-xs-12">
									<img src="<?php echo SITE_BASE_URL."img/".$user->logo; ?>" alt="image" style="height:100%; padding:10px 0px;">
										
									</div>
									<div class="col-md-3 col-sm-3 col-xs-6"  >
										<button type="button" style="float:left" id="image_change" class="btn btn-primary" >Change Logo</button>
									</div>									
								</div>
								
								
								
								<div class="col-md-9 col-sm-12 col-xs-12" id="choose_img" style="display:none">
								  <div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="file">choose Logo: </label>
									<input type="file" class="file" id="logochange" class="col-md-7 col-xs-12" name="logochange"  autocomplete="off">
									<div class="input-group col-xs-12">
										<span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
									  <input type="text" class="form-control input-lg" disabled placeholder="Upload Image">
									  <span class="input-group-btn">
										<button class="browse btn btn-primary input-lg" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
									  </span>
									</div>
								  </div>
								</div>								
								
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tax"> Event Name:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<?php if($user->event_name!=""){ ?>
										<input type="text" id="eventname" class="form-control col-md-7 col-xs-12" name="eventname" value="<?php echo $user->event_name; ?>" autocomplete="off">
									<?php  } else { ?>
									<input type="text" id="eventname" class="form-control col-md-7 col-xs-12" name="eventname" value=set_value('eventname')>
									<?php  } ?>
								</div>
								<div class="error-vlidation-err"><?php  echo form_error('eventname'); ?></div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tax">Event Link:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<?php  if($user->event_link!=""){ ?>
										<input type="text" id="link" class="form-control col-md-7 col-xs-12" name="eventlink" value="<?php echo $user->event_link; ?>" autocomplete="off">
									<?php  } else { ?>
									<input type="text" id="link" class="form-control col-md-7 col-xs-12" name="eventlink" value=set_value('eventlink')>
									<?php  } ?>
								</div>
								<div class="error-vlidation-err"><?php  echo form_error('eventlink'); ?></div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tax">Status:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<select id="status" class="form-control col-md-7 col-xs-12" name=status>
										<option <?php  if($user->status=='1'){ echo "selected"; }?> value="1" >Active</option>
										<option <?php  if($user->status=='0'){ echo "selected"; }?> value="0">Inactive</option>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
								<button type="submit" class="btn btn-success" id="submit_code_btn">Save</button>
								
								</div>
							</div> 
						</form>
					</div>
				</div>
			</div>

<script>
function show_modal(){
	 $('#myModal').modal('show');
}

$( "#image_change" ).on( "click", function() {
  $( "#choose_img" ).show();
});
 
$( document ).ready( function() {
	var form=  $( "#reference_code" ).serializeArray();
			
		$.post('<?php echo base_url("Eventmanage/get_image/".$user->id);?>', form)
        .done(function(data) { 
		
			console.log(data);	
			
			 $('#image_path').attr('src','data:image/jpg;'+data+'');  

		});
       
});


$(document).on('click', '.browse', function(){
	var file = $(this).parent().parent().parent().find('.file');
  file.trigger('click');
});
$(document).on('change', '.file', function(){
  $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
});
</script>
