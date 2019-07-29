<?php include('includes/header.php');?>		
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
 <style>
        .main-top-margin {
            background: #fff none repeat scroll 0 0;
            float: left;
            margin-top: 85px;
            width: 100%;
        }
        .inner-main-top {
            float: left;
            width: 100%;
        }
        #inputEmail {
            background: rgba(0, 0, 0, 0) url("../img/mail-icon.png") no-repeat scroll 96% center;
            float: right;
            width: 80%;
        }
        #inputPassword {
            background: rgba(0, 0, 0, 0) url("../img/lock-icon.png") no-repeat scroll 96% center;
            float: right;
            width: 80%;
        }
.card label span {
    color: #000;
    display: block;
    float: left;
    font-weight: normal;
    margin-top: 11px;
    width: 90px;
}
.card label {
    float: left;
    font-size: 18px;
    width: 100%;
}

.forgot-reg-link {
    float: right;
    margin: 10px 0 0;
    text-align: center;
    width: 80%;
}
        .forgot-reg-link p a {
            color: #00b437;
        }
.forgot-reg-link > p {
    font-size: 18px;
}
.forgot-reg-link {
    margin: 10px 0 0;
    text-align: center;
    width: 100%;
}
.proof .card h1 {
    color: rgb(48, 186, 58);
    font-size: 30px;
    font-weight: bold;
    letter-spacing: 2px;
    margin: 0;
}
        .proof_tbl {
            width: 50%;
            height: auto;
            align: center;
        }
        table,
        tr,
        td {
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
    margin: 30px auto;
    max-width: 556px;
}

.card-container.card {
    padding: 25px;
}
            .btn {
                font-weight: 700;
                height: 36px;
                -moz-user-select: none;
                -webkit-user-select: none;
                user-select: none;
                cursor: default;
            }
            /*
						* Card component
						*/
            
			.card {
			
				background-color: #fff;
				padding: 20px 25px 30px;
				margin: 0 auto 25px;
				border-radius: 4px;
				float: left;
				font-family:  open sans condensed;
				-moz-border-radius: 4px;
				-webkit-border-radius: 4px;
				border-radius: 4px;
				-moz-box-shadow: 0 2px 20px rgba(0, 0, 0, 0.2);
				-webkit-box-shadow: 0 2px 20px rgba(0, 0, 0, 0.2);
				box-shadow: 0 2px 20px rgba(0, 0, 0, 0.2);
			}
				
            .profile-img-card {
                width: 96px;
                height: 96px;
                margin: 0 auto 10px;
                display: block;
                -moz-border-radius: 50%;
                -webkit-border-radius: 50%;
                border-radius: 50%;
            }
            /*
						* Form styles
						*/
            
.profile-name-card {
    font-size: 16px;
    font-weight: bold;
    margin: 0;
    min-height: 1em;
    text-align: left;
}
.ath input#auth {
    float: left;
    width: 75%;
    margin: 10px 0;
}
.card .ath span {
    margin-bottom: 15px;
    width: 25%;
}
.btn.btn-signin.atthh {
    width: 100%;
}
            .reauth-email {
                display: block;
                color: #404040;
                line-height: 2;
                margin-bottom: 10px;
                font-size: 14px;
                text-align: center;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
                -moz-box-sizing: border-box;
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
            }
.form-signin #inputEmail, .form-signin #inputPassword {
    direction: ltr;
    font-family: open sans condensed;
    font-size: 16px;
    font-weight: normal;
    height: 44px;
}
            .form-signin input[type=email],
            .form-signin input[type=password],
            .form-signin input[type=text],
            .form-signin button {
                width: 100%;
                display: block;
                margin-bottom: 10px;
                z-index: 1;
                position: relative;
                -moz-box-sizing: border-box;
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
            }
            .form-signin .form-control:focus {
                border-color: rgb(104, 145, 162);
                outline: 0;
                -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgb(104, 145, 162);
                box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgb(104, 145, 162);
            }
            .btn.btn-signin {
				background: #00b437 none repeat scroll 0 0;
				border: medium none;
				font-family: open sans condensed;
				font-size: 24px;
				height: 44px;
				padding: 0;
				width: 80%;
				float:right;
            }
            .btn.btn-signin:hover,
            .btn.btn-signin:active,
            .btn.btn-signin:focus {
                background-color: rgb(12, 97, 33);
            }
            .forgot-password {
                color: rgb(104, 145, 162);
            }
            .forgot-password:hover,
            .forgot-password:active,
            .forgot-password:focus {
                color: rgb(12, 97, 33);
            }


        @media (max-width: 991px) {
            .top-menu a {
                padding: 2px 11px;
            }
            .header-top-right .social-icons a {
                margin-right: 9px;
            }
        }
        @media (max-width: 768px) {
            .proof {
                margin: 40px 0 0!important;
            }
            .proof_tbl {
                height: auto;
                width: 100%;
            }
            .footer-top .col-sm-4 {
                margin-bottom: 40px;
            }
        }
    </style>
</head>

<body class="">

    <!-- Header end-->

    <div class="clearfix"></div>
    <div class="main-top-margin">
        <div class="container">
            <div class="row">
                <div class="inner-main-top">
                    <div class="main-inner-top">


                        <div class="bd_vont">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="proof">

                                        
                                            <?php if(isset($type)) { ?>
                                            <div class="alert alert-info">
                                                <span style="font-size: 16px;">
															<?php
																if($type == 'f'){
																	echo "Something went wrong";
																}else if($type == 'a'){
																	echo "You are already verified";
																}else if($type == 't'){
																	echo "Your account has been verified. Please login.";
																}
																
															?>
															<span>	
											</div>
											<?php	}
															
											?>
														
											<div class="card card-container">
														<div class="m-l-heading">
															<h1>Verification</h1>
															<b><a class="support-link submit" target="_blank" href="https://t.me/booncoin">Contact us</a></b>
														</div>
															<p id="profile-name" class="profile-name-card"></p>
															<form class="form-signin" method="post" id="submit" action="<?php echo base_url();?>User/twilio/<?php echo $id; ?>">
																<?php  
																$lerror = $this->session->flashdata('error_msg');
																if(isset($lerror)){
																	echo '<div class="alert alert-danger">
																	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$lerror.'</div>';
																}
																?>									
																										
																	<div class="sep">
																	</div>
																	<div id="donate">
																			<label class="green"><input type="button" name="type" id="send_otp" value="twilio"><span>Resend OTP</span></label>
																			<span ><?php echo form_error('type'); ?> </span>
																	</div>
																							
																	<span id="reauth-email" class="reauth-email"></span>
																	<label class="ath"><span>Verification Code</span>
																			<input type="text" id="verification" name="verification" class="form-control" placeholder="Verification Code" required autofocus>
																	</label> 
																	<div id="info" style="font-size:15px"></div>
																	<span><?php echo form_error('verification'); ?> </span>
																	<input type="hidden" name="user_id" value="<?php echo $id; ?>" id="user_id" />
																	<button class="btn btn-lg btn-primary btn-block btn-signin atthh" type="submit" id="verify">Verify</button>
																	<button class="btn btn-lg btn-primary btn-block btn-signin atthh" type="button" id="wait" style="display:none">Please Wait...</button>
															</form>
                                                <!-- /form -->

                                        </div>
                                            <!-- /card-container -->
                                            <br/>
                                            <br/>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
<?php include('includes/footer.php');?>				

<script type="text/javascript">
	/*********function send otp****************/
  $(function(){

    $('#send_otp').click(function(){
    	$('#info').text('');
    	var url = '<?php echo base_url(); ?>';
    	var admin_id = '<?php echo $id; ?>';
    	$('#verify').hide();
    	$('#wait').show();
        $.ajax({
        	url: url + 'User/send_sms',
            type:'post',
            data: {admin_id:admin_id },
            dataType: 'json',
             success: function(result){
             	if(result.status == 1)
             	{
                  $('#info').text('OTP has been sent on your mobile!');
                  $('#verify').show();
				  $('#wait').hide();
             	}
			}
		}); 
   
        
    });          

});
</script>


<style>
#donate {
    margin:4px;
   
    float:left;
}
#donate label {
    float:left;
    width:170px;
    margin:4px;
    background-color:#EFEFEF;
    border-radius:4px;
    border:1px solid #D0D0D0;
    overflow:auto;
       
}

#donate label span {
    text-align:center;
    font-size: 14px;
    padding:5px 0px;
    display:block;
}

#donate label input {
    position:absolute;
    top:-20px;
}

#donate input:checked + span {
    background-color:#404040;
    color:#F7F7F7;
}
#donate .blue {
    background-color:#00BFFF;
    color:#333;
}
#donate .green {
    background-color:#A3D900;
    color:#333;
}
</style>    