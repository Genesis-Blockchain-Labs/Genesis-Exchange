<?php //include_once('includes/header.php');?>	
<style>
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
    background: #00b437 none repeat scroll 0 0;
    border: medium none;
    font-family: open sans condensed;
    font-size: 24px;
    height: 44px;
    padding: 0;
}
.registration-page .login-register-link {
    color: #000;
    float: left;
    font-size: 18px;
    margin-top: 15px;
    text-align: center;
    width: 100%;
}
.registration-page .form-horizontal .control-label {
    color: #000;
    font-size: 18px;
    font-weight: normal;
    text-align: left;
}

*[role="form"] {
    border-radius: 4px;
    box-shadow: 0 2px 20px rgba(0, 0, 0, 0.2);
    margin: 35px auto;
    max-width: 560px;
    padding: 23px;
}

*[role="form"] h2 {
    color: rgb(48, 186, 58);
    font-size: 30px;
    font-weight: bold;
    letter-spacing: 2px;
    margin-bottom: 20px;
    text-align: left;
}
.registration-page input {
    font-family: open sans condensed;
    font-size: 16px;
    height: 44px;
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
    margin: 40px auto 0 !important ;
    max-width: 556px;
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



.validate_error{
	float: left;
    font-size: 17px;	
}
</style>
</head>
<body class="">    
			<div class="clearfix"></div>
						<div class="main-top-margin">
            <div class="bd_vont">
                <div class="container">
                    <div class="row">    
                        <div class="col-sm-12">
                <div class="proof registration-page">
                    
			<!--	<h1>What is Proof-of-Confidence?</h1>  -->

<p>Thank you for your interest in the Boon pre-sale. In order to support the interests of the project and our community, we have created a whitelist for the most interested participants. Please complete the form below to be considered for the pre-sale participation.</p>

<!-- <p>You show us your confidence in our project we will show our confidence in rewarding you with Boon coins. </p> -->
	
		   <!--form class="form-horizontal" role="form" method="post" id="register"-->
		   <?php
				$attributes = array('class' => 'form-horizontal', 'id' => 'set_paasword','role'=>"form", 'method'=>'post');
				echo form_open(' ', $attributes);
												
			$csrf = array(
											'name' => $this->security->get_csrf_token_name(),
											'hash' => $this->security->get_csrf_hash()
									);
									?>
					<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                <div class="m-l-heading">
					<h2>Registration</h2>
					
				</div>
                <div class="form-group">
                    <label for="password" class="col-xs-3 control-label">Password</label>
                    <div class="col-xs-9">
                        <!--input type="password" id="password" name="password" placeholder="Max length 20 characters" class="form-control" required maxlength="20"-->
						
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
                        <!--input type="password" id="cpassword" name="cpassword" placeholder="Max length 20 characters" class="form-control" required maxlength="20"-->						
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
						<a href="<?php echo base_url(); ?>login" class="login-register-link"  >Already have an account? <span style="color: rgb(48, 186, 58); font-weight: bold;">Login</span></a>						
						
                    </div>
                </div>
            <!--/form-->
			<?php
					echo form_close();
			?>
<br/>

<br/>

                </div>
                </div></div></div></div>     

        

<button type="button" data-toggle="modal" data-target="#myModal" id="popup"></button>

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
	
       
        <!--/slider_s-->
       
    </main>
	</div>
</body>
</html>	
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>
$(function(){
	$("#set_paasword").submit(function( event ){
		$("#pass_error").html(" ");
		$("#c_pass_error").html(" ");
		$pass = $("#password").val();
		$cpass = $("#cpassword").val();
		$phone = $("#phone").val();
		$filter = /^[0-9-+]+$/;		
 
		if(parseInt($pass.length ) < 6){
			$("#pass_error").html("Minimum password length must be 6.");
			return false;
		}else if($pass != $cpass){
			$("#c_pass_error").html("Confirm password do not match.");
			return false;
		} else {		
			$("#buttons").show();
			$("#submits").hide();
			event.preventDefault();
			
			var newData= false;
			newData= new FormData(this);
			newData.append('<?php echo $this->security->get_csrf_token_name(); ?>','<?php echo $this->security->get_csrf_hash(); ?>');
			
			var request = $.ajax({
				   url: "<?php  echo base_url();?>user/set_paasword",
				  method: "POST",
				  data: newData,
				  processData: false,
				  contentType: false,
				});				 
			request.done(function( msg ){
					$("#buttons").hide();
					$("#submits").show();
					if(msg == "0"){
						$(".modal-body").html("<p>Email is already exist</p>");
						$("#popup").trigger("click");
					}else{
						$(".modal-body").html("<p>"+msg+"</p>");
						$("#popup").trigger("click");
						$(this).trigger('reset');
						setInterval(function(){ 					
							window.location = "<?php  echo base_url();?>login";
						}, 5000);
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
</script>		       
<?php include('includes/footer.php');?>	
      