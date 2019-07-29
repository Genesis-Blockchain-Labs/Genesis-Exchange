<?php include('includes/header.php');?>	
<div class="login-box">
	
    <div class="login-panel panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">2 Factor Authentication</h3>
        </div>
        <div class="panel-body user-settings">
          <?php 
											$attributes = array('class' => 'form-signin', 'id' => 'submit', 'role'=>'form');
											echo form_open('authenticate/'.$id, $attributes); ?>
			
											<input type="hidden" id="dfp" name="deviceFingerPrint"> 
											<input type="hidden" id="dft" name="deviceFingerprintTechnology" value="AU">
											<?php  
											$lerror = $this->session->flashdata('error_msg');
											if(isset($lerror)){
												?>
												<label class="validation-eror">
												<?php
												echo '<div class="alert">
												<a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$lerror.'</div>';
											?></label>
											<?php }
											else {
											?>
												<h3>We have sent a message to your email address with an authentication code.</h3></br></br>
												<h3>Once you receive it enter the code below to complete your login.</h3></br></br>
										   <?php } ?>
											<span id="reauth-email" class="reauth-email"></span>
											
											
                <table class="table table-user-information">
                    <tbody>
									<?php $data = array(
													'name'          => 'ip_address',
													'id'            => 'ip_address',
													'type'         => 'hidden'
											);

											echo form_input($data);	 
									?>
									<?php $data = array(
													'name'          => 'country',
													'id'            => 'country',
													'type'         => 'hidden'
											);

											echo form_input($data);	 
									?>
									<?php $data = array(
													'name'          => 'country_code',
													'id'            => 'country_code',
													'type'         => 'hidden'
											);

											echo form_input($data);	 
									?>
                    <tr>
						<td><?php $data = array(
														'name'          => 'authcode',
														'type'         => 'text',
														'value'         => set_value('authcode'),
														'class'         => 'form-control',
														'placeholder'         => 'Code',
												);

												echo form_input($data);	 ?>
												<div class="error-vlidation"><?php echo form_error('authcode'); ?></div>
						</td>	
                    </tr>
                    <tr>
						<td colspan="2" class="text-center">
                            <input type="submit" class="btn btn-login" value="Login" id="submits">
							<button class="btn btn-lg btn-primary btn-block btn-signin" type="button" id="buttons" style="display:none">Please Wait..</button>
                        </td>
                    </tr>
                  </tbody>
               </table>
            <?php echo form_close(); ?>
        </div>
    </div>

    <div class="my-recaptcha">   
    </div>
</div>

<script>
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
</script>
<?php include('includes/footer.php');?>	  

<script>
   $.getJSON("http://freegeoip.net/json/", function(data) {
	   $('#ip_address').val(data.ip);
	   $('#country').val(data.country_name);
	   $('#country_code').val(data.country_code);
    });
</script>     