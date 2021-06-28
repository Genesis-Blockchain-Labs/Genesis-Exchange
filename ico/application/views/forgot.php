<?php include('includes/header.php');?>		
<div class="login-box">
    <div class="login-panel panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Forgot Password</h3>
			<h4 id="sucess" class="all-success-alert"></h4>
        </div>
        <div class="panel-body user-settings full-width">
           <?php $attributes = array('class' => 'form-signin', 'id' => 'submit','role'=>"form", 'method'=>'post','name'=>"forgot", 'autocomplete'=>'off');
							echo form_open(' ', $attributes);
																
							 $csrf = array(
											'name' => $this->security->get_csrf_token_name(),
											'hash' => $this->security->get_csrf_hash()
									);
			?>  
							  
				<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
				<span id="reauth-email" class="reauth-email"></span>
                <table class="table table-user-information">
                    <tbody>
                    <tr>
     
                        <td><?php
							$data = array(
										'name'          => 'email',
										'id'            => 'inputEmail',
										'required'     => 'required',
										'type'         => 'email',
										'value'         => '',
										'class'         => 'form-control',
										'placeholder'         => 'E-mail',
								);
							echo form_input($data);											
						?></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center">
                            <input type="submit" class="btn-trans btn btn-login" id="submits" value="Submit">
							 <button type="button" class="btn-trans btn btn-block btn-signin" id="buttons" style="display:none">Please Wait...</button> 
							<button class="btn-trans btn btn-lg btn-block btn-signin" type="button" id="buttons" style="display:none">Please Wait..</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="login-bottom">
                    Don't have account yet? <a href="<?php echo base_url();?>signup">Sign up</a><br>
                    Have account yet? <a href="<?php echo base_url(); ?>login">Login</a>
                </div> 
            <?php 
					echo form_close();
			?>
        </div>
    </div>
</div>
        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>		 
<script>
$(function(){
	$( "#submit" ).submit(function( event ) {
		$("#buttons").show();
		$("#submits").hide();
		var newData= false;
			newData= new FormData(this);
			newData.append('<?php echo $this->security->get_csrf_token_name(); ?>','<?php echo $this->security->get_csrf_hash(); ?>');
			
		var request = $.ajax({
			  url: "<?php echo base_url()?>user/forget_pass",
			  method: "POST",
			  data: newData,
			  processData: false,
			  contentType: false,
			  dataType: "json",
			});
			 
			request.done(function( msg ) {
				var statusclass;
				if(msg.status == 1){ statusclass = 'alert green-alert alert-info fade in';}
				if(msg.status == 0){ statusclass = 'validation-eror';}
				$("#sucess").html('<div class="'+statusclass+'" style="font-size:15px" id="forgot_mail"><button type="button" class="close" onclick="hide_veryfy_div()" id="close_forgot">&times;</button>'+msg.msg+'</div>');
				$("#buttons").hide();
				$("#submits").show();
				
			});
		event.preventDefault();
	});
});	


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