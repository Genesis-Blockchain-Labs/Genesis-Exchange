<div class="create-box">
					<?php if(!empty($error_msg)){ ?>
					<div class="validation-eror">
					<label class="alert">													
					<?php	echo '<a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$error_msg.''; ?></label></div>
					<?php }   ?>
    
	<div class="login-panel panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title" style="font-size: 20px">Create Account</h3>
        </div>
        <div class="panel-body user-settings">
            <?php
												$attributes = array('class' => 'form-horizontal banner-reg-btn', 'id' => 'registration','role'=>"form", 'method'=>'post','autocomplete'=>'off');
												
												$url = base_url().'user/register_ajax';
												echo form_open($url, $attributes);
												
												
											?>
                <table class="table table-user-information">
                    <tbody>
                    <tr class="full-td">
                        <td><?php
												$refid = isset($refid)?$refid:'';
												$data = array(
												'name'          => 'user_id',
												'id'            => 'user_id',
												'type'         => 'hidden',
												'value'         => '',
												'placeholder'   => 'First Name',
												);
												echo form_input($data);
												
												
												$data = array(
												'name'          => 'Firstname',
												'id'            => 'Firstname',
												'type'         => 'text',
												'value'         => set_value('Firstname'),
												'class'         => 'form-control',
												'placeholder'   => 'First Name',
												);
												
											echo form_input($data);  ?>
											<div class="error-vlidation"><?php echo form_error('Firstname'); ?></div>
							</td>
                    </tr>
                    <tr class="full-td">
                        <td><?php
												
												$data = array(
												'name'          => 'Lastname',
												'id'            => 'Lastname',
												'type'         => 'text',
												'value'         => set_value('Lastname'),
												'class'         => 'form-control',
												'placeholder'   => 'Last Name',
												);
												
											echo form_input($data);?>
											<div class="error-vlidation"><?php echo form_error('Lastname'); ?></div>
							</td>
                    </tr>
                    <tr class="full-td">
                        <td><?php
												
												$data = array(
												'name'          => 'email',
												'id'            => 'email',
												'type'         => 'email',
												'value'         => set_value('email'),
												'class'         => 'form-control',
												'placeholder'   => 'Email',
												);
												
											echo form_input($data);?>
											<div class="error-vlidation"><?php echo form_error('email'); ?></div>
							</td>
                    </tr>
					<tr class="full-td">
                        <td>
							<select class="form-control selectpicker" name="country_name" id="country_name" onchange="addCountryCode(this.value)">
								<option value='-1'>Select Country</option>
								<?php $country = getCountries();
								foreach($country as $cnt)
								{
								?>
								<option value="<?php echo '+'.$cnt->phonecode;  ?>"><?php echo $cnt->country_name; ?></option>
								<?php } ?>
							</select>
						</td>
						
                    </tr>
					<tr class="half-td" >
						<td class="first-td">
							<input type="text" name="phonecode" id="phonecode" placeholder="Code" value="" class="form-control" disabled>
							<input type="hidden" name="phonecodeHidden" id="phonecodeHidden" value="">
						</td>
						<td class="second-td"><?php
							
							$data = array(
							'name'          => 'Phone',
							'id'            => 'Phone',
							'type'         => 'number',
							'value'         => set_value('Phone'),
							'class'         => 'form-control',
							'placeholder'   => 'Phone',
							'disabled' => 'true',
							);	
							echo form_input($data);?>
							<div class="error-vlidation"><?php echo form_error('Phone'); ?></div>
						</td>
					</tr>

                    <tr class="full-td">
                        <td><?php
												
												$data = array(
												'name'          => 'Password',
												'id'            => 'Password',
												'type'         => 'password',
												'value'         => set_value('Password'),
												'class'         => 'form-control',
												'placeholder'   => 'Password',												
												);
												
												echo form_input($data);
											?>
											<div class="error-vlidation"><?php echo form_error('Password'); ?></div>
						</td>
                    </tr>
                    <tr class="full-td">
                        <td><?php
												$data = array(
												'name'          => 'Retype-password',
												'id'            => 'Retype password',
												'type'         => 'password',
												'value'         => '',
												'class'         => 'form-control',
												'placeholder'   => 'Retype Password',													
												);
												
											echo form_input($data);?>
											<div class="error-vlidation"><?php echo form_error('Retype-password'); ?></div>
						</td>
                    </tr>
					<tr class="full-td">
                        <td><?php								
												
												if(!empty($refid)){ 
													$data = array(
													'name'          => 'reference_code',
													'id'            => 'reference_code',
													'placeholder'   => 'Reference Code',
													'type'         => 'text',
													'readonly'      => 'readonly',
													'value'         => $refid,
													'class'         => 'form-control',
													);
													echo form_input($data);
													}else{
													$data = array(
													'name'          => 'reference_code',
													'id'            => 'reference_code',
													'type'         => set_value('reference_code'),
													'class'         => 'form-control',
													'placeholder'   => 'Reference ID (Optional)',	
													);
													echo form_input($data);
												}
												
												$data = array(
												'name'          => $this->security->get_csrf_token_name(),
												'value'         => $this->security->get_csrf_hash(),
												'type'         => 'hidden',
												);
												echo form_input($data); ?>
						</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center">
                            <input type="submit" class="btn btn-submit" value="Submit" id="register_submit">
											<button type="button" class="btn btn-primary btn-block" id="buttons" style="display:none">Please wait..</button>
											
                        </td>
                    </tr>
                    </tbody>
                </table>

                <div class="login-bottom">
                    Already have an account? <a href="<?php echo base_url()?>login">Login</a><br>
                    <!--Forgot password? <a href="<?php //echo base_url()?>forgot">Recover</a-->
                </div>
				<div class="g-recaptcha" data-sitekey="6LdFHZkaAAAAANKYSE9AKsY_GoDNHXM2zRDSFebl" data-theme="dark"></div>
					<div class="g-captcha-error error-vlidation"><?php echo form_error('g-recaptcha-response'); ?></div>	
            <?php echo form_close(); ?>
        </div>
    </div>
    <div class="my-recaptcha">
		
    </div>
</div>

						<!-- Modal -->
						<div id="myModal" class="modal fade" role="dialog">
							<div class="modal-dialog">
								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<!--  <button type="button" class="close" data-dismiss="modal">&times;</button> -->
									</div>
									<div class="modal-body">
										<p id="response_msg"></p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
					
	<!--/slider_s-->
<!--/main-->

</body>
</html>
<script>
	//google analytics tag conversion
	function gtag_report_conversion(url) {
		var callback = function () {
			if (typeof(url) != 'undefined') {
				window.location = url;
			}
		};
		gtag('event', 'conversion', {
			'send_to': 'AW-826936146/n8ayCIWn0XkQ0paoigM',
			'event_callback': callback
		});
		return false;
	}
	
	
	
	//refresh captcha token
	$(".c-ref").click(function() {
		jQuery.ajax({
			url: "<?php echo base_url(); ?>user/captchaRefresh",
			method: "GET",
			processData: false,
			contentType: false,
			success: function(res) {
				if (res)
				{
					jQuery(".c-img").html(res);
				}
			}
		});
	});
	
	
	function ValidateEmail(email) {
		var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
		return expr.test(email);
	};	
	
$(document).ready(function () {
   $.getJSON("http://freegeoip.net/json/", function(data) {
    });
});
</script>
<script>
function addCountryCode(code){
	if(code == '-1')
	{
		document.getElementById("Phone").disabled = true;
		document.getElementById("phonecode").value = '';
		document.getElementById("phonecodeHidden").value = '';
	}
	else
	{
		document.getElementById("phonecode").value = code;
		document.getElementById("phonecodeHidden").value = code;
		document.getElementById('Phone').removeAttribute('disabled');
	}
}
</script>
<?php include('includes/footer.php');?>