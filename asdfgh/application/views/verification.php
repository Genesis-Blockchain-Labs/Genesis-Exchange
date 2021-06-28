<!DOCTYPE html>
<html>
<head>
	<title><?php echo DOMAIN_NAME; ?> | Admin</title>
	<meta name="keywords" content="<?php echo DOMAIN_NAME; ?>">
	<meta name="description" content="<?php echo DOMAIN_NAME; ?>">
	<meta name="author" content="<?php echo DOMAIN_NAME; ?>">

	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	  
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="<?php echo base_url()?>assest/img/favicon2.png"/> 
	
	<link href="<?php echo base_url();?>assest/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url();?>assest/normalize.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assest/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
$(function(){

    $('input:radio').change(function(){

    	var type =  $("input:radio:checked").val();
    	if(type == 'google')
    	{
          $('#info').text('Please check the verification code in Google Authenticator App on your device!');
    	}
    	if(type == 'twilio')
    	{
    	$('#info').text('');
    	var url = '<?php echo site_url(); ?>';
    	var admin_id = '<?php echo $id; ?>';
    	$('#submit').val('Please wait..');
    	$('#submit').prop('disabled', true);
        $.ajax({
        	url: url + '/login/send_sms',
            type:'post',
            data: {admin_id:admin_id },
            dataType: 'json',
             success: function(result){
             	if(result.status == 1)
             	{
                  $('#info').text('OTP has been sent on your device!');
                  $('#submit').val('Verify');
                  $('#submit').prop('disabled', false);
             	}
        }
     }); 
   
     }
        
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
</head>
<body>
	<div class="container">
		<div class="log_danger"></div>
        <form id="signup" method="post" action="<?php echo base_url('index.php/Login/verification/'.$id); ?>">
			<div class="header">
				<img src="<?php echo base_url(); ?>assest/images/logo.png" height="50px" width="250px" style="margin-top:2%" > 
			</div>
			<?php  
				$lerror = $this->session->flashdata('error_msg');
				if(isset($lerror)){
					echo '<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$lerror.'</div>';
				}
				
				$data = array(
								'name'          => $this->security->get_csrf_token_name(),
								'value'         => $this->security->get_csrf_hash(),
								'type'         => 'hidden',
						);
				echo form_input($data);	
				?>
			<div class="sep">
			</div>
			<div class="inputs">
				<input type="text" id="inputcode" name="authcode" class="form-control" placeholder="verification Code" autofocus>
                 <span ><?php echo form_error('authcode'); ?> </span>
                <input type="hidden" name="admin_id" value="<?php echo $id; ?>" />
				<input id="submit" type="submit" name="submit" value="Verify">
			</div>
		</form>
	</div>
</body>
</html>