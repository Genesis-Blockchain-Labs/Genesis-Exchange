<div class="right_col" role="main">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>ICO SETUP</h2>
					<div class="clearfix"></div>
				</div>
				<div class="white">
					<div class="x_content">
						<div class="container">
							<div class="mid-ct-form">
							<?php $msg = $this->session->flashdata('error_msg'); 
							if($msg){ ?>
								<div class="alert alert-success">
								<?php echo $msg; ?>
								</div>
								<?php } ?>
								<?php	$message = $this->session->flashdata('success_msg'); 
								if(!empty($message)){    ?>
									<div class="col-sm-12">
										<div class="alert alert-success fade in" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
								<?php echo $message;     ?>
										</div>
									</div>
							<?php  } ?>
							<?php	$messages = $this->session->flashdata('icoerror_msgs'); 
							if(!empty($messages)){    ?>
							<div class="col-sm-12">
								<div class="validation-eror">
									<div class="alert">
										<?php echo $messages;     ?>
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
									</div>
								</div>
							</div>
						<?php  }  ?>
							<ul class="nav nav-tabs">
								<li class="<?php if($tab != 'ico') { echo "active"; }?>"><a data-toggle="tab" href="#pre_ico">Pre-ICO</a></li>
								<li class="<?php if($tab == 'ico') { echo "active"; }?>"><a data-toggle="tab" href="#ico">ICO</a></li>
							</ul>

							<div class="tab-content">
							<div id="pre_ico" class="tab-pane fade <?php if($tab != 'ico') { echo "in active"; }?>">
							<?php  $attributes = array('role'=>"form", 'method'=>'post');
									$url = base_url().'pre_ico_setting';
									echo form_open_multipart($url, $attributes); ?>
								<div class="add_more_fields">
									<div class="add_stg">		
										<div class="icoset_detail">
										<p><label>Details: </label></p>
										<?php if(!empty($pro_ico['details'])){ 
										$data = array(
											'name'          => 'details',
											//'type'         => 'text',
											'value'         => $pro_ico['details'],
											'class'         => 'form-control',
											'rows'        => '5',
											  'cols'        => '10',
										);
										}else{

										$data = array(
											'name'          => 'details',
											//'type'         => 'text',
											'value'         => set_value('details'),
											'class'         => 'form-control',
											'rows'        => '5',
											  'cols'        => '10',
										);
									}	
										echo form_textarea($data);
								?>
											<span class="error-form-dv"><?php echo form_error('details'); ?></span> 
										</div>
										<br>
										<br>
									<div class="icoset_input">
										<div>
										<p><label>Start Date: </label> </p><?php	
										if(!empty($pro_ico['start_date'])){
										$data = array(
										'name'          => 'start_date',
										'id' 			=>'start_date',
										'type'         => 'text',
										'value'         => $pro_ico['start_date'],
										'class'         => 'form-control',
										'autocomplete' => 'off',
										);
										}else{
										$data = array(
											'name'          => 'start_date',
											'id' 			=>'start_date',
											'type'         => 'text',
											'value'         => set_value('start_date'),
											'class'         => 'form-control',
											'autocomplete' => 'off',
											);
										}	
										echo form_input($data);
										?><span class="error-form-dv"><?php echo form_error('start_date'); ?></span>
										</div>
										
										<div>
										<p><label>End Date: </label> </p><?php	
										if(!empty($pro_ico['end_date'])){
										$data = array(
										'name'          => 'end_date',
										'id' 			=>'end_date',
										'type'         => 'text',
										'value'         => $pro_ico['end_date'],
										'class'         => 'form-control',
										'autocomplete' => 'off',
										);
										}
										else{
											$data = array(
											'name'          => 'end_date',
											'id' 			=>'end_date',
											'type'         => 'text',
											'value'         => set_value('end_date'),
											'class'         => 'form-control',
											'autocomplete' => 'off',
											);
										}	
										echo form_input($data);
										?><span class="error-form-dv"><?php echo form_error('end_date'); ?></span>
										</div>
										
										<div>
										<p><label>Token Supply: </label></p> <?php	
										if(!empty($pro_ico['token_supply'])){
										$data = array(
										'name'          => 'token_supply',
										'type'         => 'number',
										'value'         => $pro_ico['token_supply'],
										'class'         => 'form-control',
										'min'			=>'1',
										'autocomplete' => 'off',
										);
										}
										else{
										$data = array(
										'name'          => 'token_supply',
										'type'         => 'number',
										'value'         => set_value('token_supply'),
										'class'         => 'form-control',
										'min'			=>'1',
										'autocomplete' => 'off',
										);
									}	
									echo form_input($data);
									?><span class="error-form-dv"><?php echo form_error('BTC'); ?></span>
									</div>
									
									<div>
									<p><label>Token Price: </label> </p><?php	
									if(!empty($pro_ico['token_price'])){
									$data = array(
									'name'          => 'token_price',
									//'type'         => 'number',
									'type'         => 'text',
									'value'         => $pro_ico['token_price'],
									'class'         => 'form-control',
									'min'			=>'1',
									'autocomplete' => 'off',
									);
									}
									else{
									$data = array(
									'name'          => 'token_price',
									//'type'         => 'number',
									'type'         => 'text',
									'value'         => set_value('token_price'),
									'class'         => 'form-control',
									'min'			=>'1',
									'autocomplete' => 'off',
									);
									}	
									echo form_input($data);
									?><span class="error-form-dv"><?php echo form_error('token_price'); ?></span>
									</div>
									
									<div>
									<p><label>Extra Bonus: </label> </p><?php	
									if(!empty($pro_ico['extra_bonus'])){
									$data = array(
									'name'          => 'extra_bonus',
									'type'         => 'number',
									'value'         => $pro_ico['extra_bonus'],
									'class'         => 'form-control',
									'min'			=>'1',
									'autocomplete' => 'off',
									);
									}
									else{
									$data = array(
									'name'          => 'extra_bonus',
									'type'         => 'number',
									'value'         => set_value('extra_bonus'),
									'class'         => 'form-control',
									'min'			=>'1',
									'autocomplete' => 'off',
									);
									}
									echo form_input($data);
									?><span class="error-form-dv"><?php echo form_error('extra_bonus'); ?></span>
									</div>
									
									<div>
									<p><label>1 Dollar(To SafeAda): </label> </p><?php	
									if(!empty($pro_ico['dollar_to_safeada'])){
									$data = array(
									'name'          => 'dollar_to_safeada',
									'type'         => 'number',
									'value'         => $pro_ico['dollar_to_safeada'],
									'class'         => 'form-control',
									'min'			=>'1',
									'autocomplete' => 'off',
									);
									}
									else{
									$data = array(
									'name'          => 'dollar_to_safeada',
									'type'         => 'number',
									'value'         => set_value('dollar_to_safeada'),
									'class'         => 'form-control',
									'min'			=>'1',
									'autocomplete' => 'off',
									);
									}
									echo form_input($data);
									?><span class="error-form-dv"><?php echo form_error('dollar_to_safeada'); ?></span>
									</div>
									<p><input type="hidden" name="ico_type" value="pre_ico" /></p>
									
								</div>
							</div>
						</div>
						<p class="icoset_save"><button type="submit"  class="btn btn-primary"  />Save</button></p>
						<?php echo form_close();   ?>
					</div>
					<div id="ico" class="tab-pane fade <?php if($tab == 'ico') { echo "in active"; }?>">
      
					<?php  	$attributes = array('role'=>"form", 'method'=>'post', 'id'=>"add_stages");
					$url = base_url().'ico_setting';
					echo form_open_multipart($url, $attributes); ?>
						<div class="add_more_fields" id="add_more_fields">
						<?php if(!empty($ico)) { $no =  1; foreach($ico as $ico_val) { ?>
						<?php $choose_end_date = date('Y-m-d', strtotime($last_stage['end_date']."+1 days")); ?>
						<input type="hidden" id="choose_end_date" name="choose_end_date" value="<?php echo $choose_end_date; ?>" />	
							<div class="add_stg add_field_<?php echo $no; ?>">
							<h3>ICO Stage <?php echo $no; ?></h3>
								<div class="icoset_detail">
									<p><label>Details: </label>
										<textarea name="detailss[]" class="form-control" rows="5" cols="10" id="detailss_<?php echo $no; ?>"><?php echo $ico_val['details']; ?></textarea>
										<span id="details_er_<?php echo $no; ?>" class="error-form-dv"></span>
									</p>
								</div>
								<div class="icoset_input">
									<p><label>Stage Title: </label>
										<input type="text" name="stages[]" value="<?php echo $ico_val['stages_title']; ?>" class="form-control" id="stages_<?php echo $no; ?>" autocomplete="off">
										<span id="stages_er_<?php echo $no; ?>" class="error-form-dv"></span>
									</p>
									<p><label>Start Date: </label> 
										<input type="text" name="start_dates[]" value="<?php echo $ico_val['start_date']; ?>" id="start_date_<?php echo $no; ?>" class="form-control" autocomplete="off">
										<span id="start_date_er_<?php echo $no; ?>" class="error-form-dv"></span>
									</p>
										
									<p><label>End Date: </label> 
										<input type="text" name="end_dates[]" value="<?php echo $ico_val['end_date']; ?>" id="end_date_<?php echo $no; ?>" class="form-control" onchange="addEndDate(this)" autocomplete="off">
										<span id="end_date_er_<?php echo $no; ?>" class="error-form-dv"></span>
									</p>
										
									<p><label>Token Supply: </label>
										<input type="number" name="token_supplys[]" value="<?php echo $ico_val['token_supply']; ?>" min="1" class="form-control" id="token_supplys_<?php echo $no; ?>" autocomplete="off">
										<span id="token_supplys_er_<?php echo $no; ?>" class="error-form-dv"></span>
									</p>
										
									<p><label>Token Price: </label> 
										<input type="number" name="token_prices[]" value="<?php echo $ico_val['token_price']; ?>" min="1" class="form-control" id="token_prices_<?php echo $no; ?>" autocomplete="off">
										<span id="token_prices_er_<?php echo $no; ?>" class="error-form-dv"></span>
									</p>
										
									<p><label>Extra Bonus: </label> 
										<input type="number" name="extra_bonuss[]" value="<?php echo $ico_val['extra_bonus']; ?>" min="1" class="form-control" id="extra_bonuss_<?php echo $no; ?>" autocomplete="off">
										<span id="extra_bonuss_er_<?php echo $no; ?>" class="error-form-dv"></span>
									</p>
								</div>
							</div>
							<input type="hidden" name="ico_setup_id[]" value="<?php  echo $ico_val['id']; ?>">
							<input type="hidden" name="ico_stage[]" value="<?php  echo $ico_val['stages']; ?>" />
							<script>
							$( function() {
							$( "#start_date_<?php echo $no; ?>" ).datepicker({ minDate: new Date("<?php echo $choose_end_date; ?>"), dateFormat: 'yy-mm-dd'});
							$( "#end_date_<?php echo $no; ?>" ).datepicker({ minDate: new Date('<?php echo $choose_end_date; ?>'), dateFormat: 'yy-mm-dd'});
			   
							} );
							</script>
						<?php $no++; } } else { ?>
							<div class="add_stg add_field_1">
								<h3>ICO Stage 1</h3>
									<div class="icoset_detail">
										<p><label>Details: </label>
											<textarea name="detailss[]" class="form-control" rows="5" cols="10" id="detailss_1"><?php echo set_value('detailss'); ?></textarea>
											<span id="details_er_1" class="error-form-dv"></span>
										</p>
									</div>
									<div class="icoset_input">
										<p><label>Stage Title: </label>
											<input type="text" name="stages[]" value="<?php echo set_value('stages'); ?>" class="form-control" id="stages_1">
											<span id="stages_er_1" class="error-form-dv"></span>
										</p>
										<p><label>Start Date: </label> 
											<input type="text" name="start_dates[]" value="<?php echo set_value('start_date'); ?>" id="start_date_1" class="form-control">
											<span id="start_date_er_1" class="error-form-dv"></span>
										</p>
											
										<p><label>End Date: </label> 
											<input type="text" name="end_dates[]" value="<?php echo set_value('end_date'); ?>" id="end_date_1" class="form-control" onchange="addEndDate(this)">
											<span id="end_date_er_1" class="error-form-dv"></span>
										</p>
											
										<p><label>Token Supply: </label>
											<input type="number" name="token_supplys[]" value="<?php echo set_value('token_supply'); ?>" min="1" class="form-control" id="token_supplys_1">
											<span id="token_supplys_er_1" class="error-form-dv"></span>
										</p>
											
										<p><label>Token Price: </label> 
											<input type="number" name="token_prices[]" value="<?php echo set_value('token_price'); ?>" min="1" class="form-control" id="token_prices_1">
											<span id="token_prices_er_1" class="error-form-dv"></span>
										</p>
											
										<p><label>Extra Bonus: </label> 
											<input type="number" name="extra_bonuss[]" value="<?php echo set_value('extra_bonus'); ?>" min="1" class="form-control" id="extra_bonuss_1">
											<span id="extra_bonuss_er_1" class="error-form-dv"></span>
										</p>
									</div>
									<input type="hidden" name="ico_stage[]" value="1" />
								</div>
								<?php } ?>
							</div>
							<p><input type="hidden" name="ico_type" value="ico" /></p>
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
							<p class="icoset_save"><button type="submit" class="btn btn-primary" id="save_stage"/>Save</button></p>
							<button class="btn btn-primary add_more_button">Add More Stages</button>
							<?php $end_date = date('Y-m-d', strtotime($pro_ico['end_date']."+1 days")); ?>
								<input type="hidden" id="end_date_selected" name="end_date" value="<?php echo $end_date; ?>" />	
							<?php  echo form_close();  ?>
						</div>
					  </div>
				   </div>
			    </div>
		      </div>
		   </div>
	    </div>
     </div>
  </div>
 <script>
   $( function() {
	  
	    $( "#start_date_1" ).datepicker({ minDate: new Date("<?php echo $end_date; ?>"), dateFormat: 'yy-mm-dd'});
	   $( "#end_date_1" ).datepicker({ minDate: new Date("<?php echo $end_date; ?>"), dateFormat: 'yy-mm-dd'});
	   
    $( "#start_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
	 $( "#end_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
	  
	 
	  
  } );
  </script>
  
  <script>
 $(document).ready(function() {
	 
	 <?php if(!empty($ico)) { ?>
		var i = '<?php echo count($ico); ?>';
	 <?php } else { ?>
		var i = 1;
	 <?php } ?>
	
    $('.add_more_button').click(function(e){ //click event on add more fields button having class add_more_button
        e.preventDefault();
        i++;
            
			$('#add_more_fields').append('<div class="add_stg add_field_'+i+'"><div class="remove-btn"><a href="#" class="remove_field" style="margin-left:10px;">Remove</a></div><h3>ICO Stage '+i+'</h3><div class="icoset_detail"><p><label>Details: </label><textarea name="detailss[]" class="form-control" rows="5" cols="10" id="detailss_'+i+'"><?php echo set_value('details'); ?></textarea><span id="details_er_'+i+'" class="error-form-dv"></span></p></div><div class="icoset_input"><p><label>Stage Title: </label><input type="text" name="stages[]" value="<?php echo set_value('stages'); ?>" class="form-control" id="stages_'+i+'" autocomplete="off"><span id="stages_er_'+i+'" class="error-form-dv"></span></p><p><label>Start Date: </label><input type="text" name="start_dates[]" value="<?php echo set_value('start_date'); ?>" id="start_date_'+i+'" class="form-control" autocomplete="off"><span id="start_date_er_'+i+'" class="error-form-dv"></span></p><p><label>End Date: </label><input type="text" name="end_dates[]" value="<?php echo set_value('end_date'); ?>" id="end_date_'+i+'" class="form-control" onchange="addEndDate(this)" autocomplete="off"><span id="end_date_er_'+i+'" class="error-form-dv"></span></p><p><label>Token Supply: </label><input type="number" name="token_supplys[]" value="<?php echo set_value('token_supply'); ?>" min="1" class="form-control" id="token_supplys_'+i+'" autocomplete="off"><span id="token_supplys_er_'+i+'" class="error-form-dv"></span></p><p><label>Token Price: </label><input type="number" name="token_prices[]" value="<?php echo set_value('token_price'); ?>" min="1" class="form-control" id="token_prices_'+i+'" autocomplete="off"><span id="token_prices_er_'+i+'" class="error-form-dv"></span></p><p><label>Extra Bonus: </label><input type="number" name="extra_bonuss[]" value="<?php echo set_value('extra_bonus'); ?>" min="1" class="form-control" id="extra_bonuss_'+i+'" autocomplete="off"><span id="extra_bonuss_er_'+i+'" class="error-form-dv"></span></p></div><input type="hidden" name="ico_stage[]" value="'+i+'" /></div>'); //add input field
			
			
			 
			<?php if(!empty($ico)) { ?>
			$( "#start_date_"+i+"").datepicker({ minDate: new Date("<?php echo $choose_end_date; ?>"), dateFormat: 'yy-mm-dd'});
			$( "#end_date_"+i+"").datepicker({ minDate: new Date("<?php echo $choose_end_date; ?>"), dateFormat: 'yy-mm-dd'});
			$( "#start_date_"+i+"").datepicker({ dateFormat: 'yy-mm-dd' });
			$( "#end_date_"+i+"").datepicker({ dateFormat: 'yy-mm-dd' });
        <?php } ?>
    });  
    $('#add_more_fields').on("click",".remove_field", function(e){
	//user click on remove text links
        e.preventDefault(); $('.add_field_'+i+'').remove();
		if(i > 1)
		{
		i--;
		}
    })
});
  </script>
  <script>
  function addEndDate(selectObject) {
	  //alert('hello');
		var select_enddate = selectObject.value; 
		var select_string_id = selectObject.id;
		var select_array_id = select_string_id.split("_");
		var i = select_array_id[2];
		//alert(i);
		i = parseInt(i) + 1;
		
		///////add one day//////
		var date  = new Date(select_enddate);
		date.setDate(date.getDate()+1);
		$('#end_date_selected').val(date);
		
		var enddate = $('#end_date_selected').val();
		$( "#start_date_"+i+"").datepicker({ minDate: new Date(""+enddate+""), dateFormat: 'yy-mm-dd'});
		$( "#end_date_"+i+"").datepicker({ minDate: new Date(""+enddate+""), dateFormat: 'yy-mm-dd'});
			
}
  </script>
  <script>
  $('#save_stage').click(function(event){ 
//alert('hello');  
		event.preventDefault();		
		var total = $('.add_stg').length;
		//alert(total);
		
		for(var i=1;i<=total;i++){
			var detailss = $('#detailss_'+i+'').val();
			var stages = $('#stages_'+i+'').val();
			var start_date = $('#start_date_'+i+'').val();
			var end_date = $('#end_date_'+i+'').val();
			var token_supply = $('#token_supplys_'+i+'').val();
			var token_prices = $('#token_prices_'+i+'').val();
			var extra_bonus = $('#extra_bonuss_'+i+'').val();
			
			
			if(detailss == ''){
				
				$('#details_er_'+i+'').show();
				$('#details_er_'+i+'').html("Please enter details.");
				return false;
			}
			else{$('#details_er_'+i+'').hide();}
			
			if(stages == ''){
				$('#stages_er_'+i+'').show();
				$('#stages_er_'+i+'').html("Please enter stages.");
				return false;
			}else{$('#stages_er_'+i+'').hide();}
			
			if(start_date == ''){
				$('#start_date_er_'+i+'').show();
				$('#start_date_er_'+i+'').html("Please enter start date.");
				return false;
			}else{$('#start_date_er_'+i+'').hide();}
			
			if(end_date == ''){
				$('#end_date_er_'+i+'').show();
				$('#end_date_er_'+i+'').html("Please enter end date.");
				return false;
			}else{$('#end_date_er_'+i+'').hide();}
			
			if(token_supply == ''){
				$('#token_supplys_er_'+i+'').show();
				$('#token_supplys_er_'+i+'').html("Please enter token supply.");
				return false;
			}else{$('#token_supplys_er_'+i+'').hide();}
			
			if(token_prices == ''){
				$('#token_prices_er_'+i+'').show();
				$('#token_prices_er_'+i+'').html("Please enter token prices.");
				return false;
			}else{$('#token_prices_er_'+i+'').hide();}
			
			if(extra_bonus == ''){
				$('#extra_bonuss_er_'+i+'').show();
				$('#extra_bonuss_er_'+i+'').html("Please enter extra bonus.");
				return false;
			}else{$('#extra_bonuss_er_'+i+'').hide();}
		}
			$("#add_stages").submit();	
	});
  </script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>