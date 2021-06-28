<?php include('includes/header.php');?>
<div class="login-box">
    <div class="login-panel panel panel-default">
        <div class="panel-heading">
            
        </div>
        <div class="panel-body user-settings">
			
			
			<?php 	
			if(!empty($userdata)){   ?>
			
			<h3>Press verify button to confirm ip address.</h3>
			<?php
				$action_url = base_url().'verifyip';
				$attributes = array('class' => 'form-signin', 'id' => 'submit', 'role'=>'form');
				echo form_open($action_url, $attributes); 
				$data = array(
							'name' => 'token',
							'id'   => 'token',
							'type' => 'hidden',
							'value' => $userdata['ip_token']
							);

							echo form_input($data);	 
					?>
									
					<label class="validation-eror">
					</label> 
					<table class="table table-user-information">
						<tbody>									
							<tr>
								<td colspan="2" class="text-center">
									<input type="submit" class="verfy-btn btn btn-lg btn-primary btn-block btn-signin" value="Verify" id="submits">
									
								</td>
								
							</tr>
						</tbody>
					</table>			 
            <?php echo form_close(); ?>
			<h3>Press cancel button if you don't want to change your ip address.</h3>
				<a href="<?php echo base_url();?>login"><button class="verfy-btn btn btn-lg btn-primary btn-block btn-signin" id="buttons" >Cancel</button></a>
				
			<?php }else{ ?>	
					
					<table class="table table-user-information">
						<tbody>									
							<tr>
								<td colspan="2" class="text-center">
									<?php echo $content; ?>
								</td>								
							</tr>
						</tbody>
					</table>
			<?php } ?>	
				
        </div>
    </div>

    <div class="my-recaptcha">
    </div>
</div>

<?php include('includes/footer.php');?>	  


<script>
$(document).ready(function () {
   $.getJSON("http://freegeoip.net/json/", function(data) {
	   $('#ip_address').val(data.ip);
	   $('#country').val(data.country_name);
	   $('#country_code').val(data.country_code);
    });
});
</script> 