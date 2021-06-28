<?php
?>	
<style>
body {
	background: #001349; /* Old browsers */
	background: -moz-radial-gradient(center, ellipse cover, #001349 0%, #000815 50%); /* FF3.6-15 */
	background: -webkit-radial-gradient(center, ellipse cover, #001349 0%, #000815 50%); /* Chrome10-25,Safari5.1-6 */
	background: radial-gradient(ellipse at center, #001349 0%, #000815 50%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#001349', endColorstr='#000815', GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
}
.proof_tbl{
	width:50%;
	height:auto;
	align:center;
}

table, tr, td {
	border: 1px solid black;
    font-size: 17px;
    text-align: left;
}
.header-right {
    float: right;
    padding-right: 0;
    width: auto;
}
.proof {
    font-family: open sans condensed;
    margin: 110px 0 0;
}
.main-top-margin {
    margin-top: 0;
}
.proof.registration-page > p {
    font-size: 20px;
    margin: 0 auto;
    max-width: 845px;
    text-align: center;
}
.proof.registration-page .btn.btn-primary.btn-block {
    font-family: 'Roboto Mono', monospace;
		display: inline-block;
		position: relative;
		background: none;
		border: none;
		cursor: pointer;
		font-weight: 300 !important;
		background: rgba(14,108,253,0.7);
		border-radius: 50px;
		color: #fff;
		font-size: 16px;
		font-weight: 300;
		margin: 2px 0 10px;
		padding: 0px 15px;
		width: 100%;
		height: 50px;
		-webkit-transition: background-color .5s ease-in-out;
		-moz-transition: background-color .5s ease-in-out;
		-o-transition: background-color .5s ease-in-out;
		transition: background-color .5s ease-in-out;
}

.registration-page .login-register-link {
	font-family: 'Roboto Mono', monospace;
    color: #fff;
	font-weight: 100;
    float: left;
    font-size: 14px;
    margin-top: 15px;
    text-align: center;
    width: 100%;
}
.registration-page .form-horizontal .control-label {
	font-family: 'Roboto Mono', monospace;
    color: #fff;
	font-weight: 100 !important;
    font-size: 14px;
    font-weight: normal;
    text-align: left;
}

*[role="form"] {
    border-radius: 4px;
    margin: 35px auto;
    max-width: 560px;
    padding: 23px;
}

*[role="form"] h2 {
    font-family: 'Roboto Mono', monospace;
    font-size: 32px;
    line-height: 32px;
    color: rgba(255, 255, 255, 0.8);
    font-weight: 100;
    text-align: center;
    margin: 0px 0px 10px;
}
.registration-page input {
    font-size: 16px;
		font-family: 'Roboto Mono', monospace;
		font-weight: 300;
		width: 100%;
		height: 50px;
		border-radius: 50px;
		border: none;
		margin: 0 0 10px;
		background-color: rgba(255,255,255,0.2);
		padding: 10px 25px;
		color: #fff;
		-moz-box-shadow: 0px 0px 22px 1px rgba(14,108,253,0.3);
		-webkit-box-shadow: 0px 0px 22px 1px rgba(14,108,253,0.3);
		box-shadow: 0px 0px 22px 1px rgba(14,108,253,0.3)
}
a.support-link.submit {
    float: left;
    text-align: center;
    width: 100%;
    margin: 0 0 28px;
}
#email {
	  background: rgba(0, 0, 0, 0) url("../img/mail-icon.png") no-repeat scroll 96% center;
    float: right;
   
}
#password, #cpassword {
    background: rgba(0, 0, 0, 0) url("../img/lock-icon.png") no-repeat scroll 96% center;
    float: right;
}
#firstName{
    background: rgba(0, 0, 0, 0) url("../img/name-icon.png") no-repeat scroll 96% center;
    float: right;
}
.proof {
    margin: 30px auto;
    max-width: 556px;
}
@media (max-width: 991px) {
.top-menu a { padding: 2px 11px;}	
.header-top-right .social-icons a { margin-right: 9px;}

.bd_vont .proof {
    margin: 130px auto 0 !important ;
    max-width: 556px;
}

}

@media (max-width: 768px) {
	.bd_vont .proof {
    margin: 160px auto 0 !important ;
    max-width: 556px;
}
	.header-right {
		width: 100%;
	}
.proof {
    margin: 40px 0 0!important;
}
.proof_tbl {
    height: auto;
    width: 100%;
}
	.footer-top .col-sm-4 { 
    margin-bottom:40px;
}
}
	
	@media (max-width: 580px) {
		.proof.registration-page .btn.btn-primary.btn-block {
			font-size: 12px;
		}
		
		.btn.btn-primary.btn-block {
			font-size: 12px;
		}
	}



.validate_error{
	float: left;
    font-size: 17px;	
}
tbody > tr{display: inline-block;
    width: 49%;}



</style>
</head>
<body>    
			<div class="clearfix"></div>
						<div class="main-top-margin">
            <div class="bd_vont">
                <div class="container">
                    <div class="row">    
                        <div class="col-sm-12">
							
                <div class="proof registration-page">
                <div class="team-content-wrapper">
			<?php if(isset($type)) { ?>
                                            <div class="alert alert-info" id="mail_very_fy" style="display:block;">
                                                <span style="font-size: 16px;">
															<?php
																if($type == 'f'){
																	echo "Something went wrong.";
																}else if($type == 'a'){
																	echo "Your account already verified.";
																}else if($type == 't'){
																	echo "Your account has been verified.";
																}
																
															?>
												</span>	
															
											<button type="button" class="close" onClick="hide_veryfy_div()">&times;</button>
															
											</div>
															<?php	}
															
														?>
			<?php
					if(!empty($email_verify)){
						
				$attributes = array('class' => 'form-horizontal', 'id' => 'register','role'=>"form", 'method'=>'post');
				echo form_open(' ', $attributes);
						
							$data = array(
										'name'          => 'user_id',
										'id'            => 'user_id',
										'type'         => 'hidden',
										'value'         => $email_verify['id'],
								);

							echo form_input($data);
							
						$csrf = array(
											'name' => $this->security->get_csrf_token_name(),
											'hash' => $this->security->get_csrf_hash()
									);
									?>
				<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                <div class="m-l-heading">
					<h2>Registration</h2>
					<strong><a class="support-link submit" target="_blank" href="https://t.me/booncoin">Contact us</a></strong>
				</div>
                <div class="form-group">
                    <label for="password" class="col-xs-3 control-label">Password</label>
                    <div class="col-xs-9">
						
						<?php
							$data = array(
										'name'          => 'password',
										'id'            => 'password',
										'placeholder'   => 'Max length 20 characters',
										'required'     => 'required',
										'type'         => 'password',
										'value'         => '',
										'maxlength'     =>  "20",
										'class'         => 'form-control',
								);

							echo form_input($data);
											
						?>
						<p id="pass_error" style="color:red" class="validate_error"></p>
                    </div>
					
                </div>
				<div class="form-group">
                    <label for="password" class="col-xs-3 control-label">Confirm Password</label>
                    <div class="col-xs-9">						
						<?php
							$data = array(
										'name'          => 'cpassword',
										'id'            => 'cpassword',
										'placeholder'   => 'Max length 20 characters',
										'required'     => 'required',
										'type'         => 'password',
										'value'         => '',
										'maxlength'     =>  "20",
										'class'         => 'form-control',
								);

							echo form_input($data);
											
						?>
						
						<p id="c_pass_error" style="color:red" class="validate_error"></p>
                    </div>
                </div>
				
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <button type="submit" class="btn btn-primary btn-block" id="submits">Register</button>
                        <button type="button" class="btn btn-primary btn-block" id="buttons" style="display:none">Please Wait...</button>
						<a href="<?php echo base_url(); ?>login" class="login-register-link"  >Already have an account? <span style="color: rgb(14, 108, 253); font-weight: 300;">Login</span></a>						
						
                    </div>
                </div>
			<?php
					echo form_close();
					
					}
			?>
<br/>

<br/>

                </div>
			</div>
           </div>
	</div>
</div>
</div>     

        

<button type="button" data-toggle="modal" data-target="#myModal" id="popup"></button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
       
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
	
       
        <!--/slider_s-->
       
    </main>
	</div>
</body>
</html>	
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>
$(function(){
	$("#register").submit(function( event ){
		$("#pass_error").html(" ");
		$("#c_pass_error").html(" ");
		var pass = $("#password").val();
		var cpass = $("#cpassword").val();
		var phone = $("#phone").val();
		var filter = /^[0-9-+]+$/;		
 
		if(pass.length < 8){
			$("#pass_error").show(); 	
			$("#pass_error").html("Minimum password length must be 8.");
			return false;
		}else if(pass != cpass){
			$("#c_pass_error").html("Confirm password do not match.");
			return false;
		}  else {		
			$("#buttons").show();
			$("#submits").hide();
			event.preventDefault();
			var request = $.ajax({
				   url: "<?php  echo base_url();?>user/set_password",
				  method: "POST",
				  data: new FormData(this),
				  processData: false,
				  contentType: false,
				});
				 
			request.done(function( msg ){
					$("#buttons").hide();
					$("#submits").show();
					if(msg == "0"){
						$(".modal-body").html("<p>Password not set,</p>");
						$("#popup").trigger("click");
					}else{						
						$(".modal-body").html("<p>You have been registered successfully.</p>");
						$("#popup").trigger("click");
						$(this).trigger('reset');
						setInterval(function(){ 					
							window.location = "<?php  echo base_url();?>dashboard";
						}, 3000);
					}
			});
		}	
		event.preventDefault();	
	});
});

	
</script>		       
<script>
$(function(){
$('#phone').click(function(){
	$("#ph_error").html(" ");	
}); 
});	

$(function(){
	$("#mail_very_fy").css("display",'block');	
});	       
</script>		       
<?php include('includes/footer.php');?>	
      