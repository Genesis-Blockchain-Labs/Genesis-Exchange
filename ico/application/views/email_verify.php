<?php include('includes/header.php');
$user_data = $this->session->userdata('user_data');
?>
<div class="verify-email-box">
    <div class="verify-email panel panel-default">
        <div class="panel-body">
			<?php  if($userdata['token'] != ''){  
					if($userdata['active_status'] == '1'){  ?>
						<h2>Allready activate !</h2>
				
					<?php	}
					else{
					?>
            <h2>You're nearly there !</h2>
            <p>We just need to verify your email address to complete your Enpor Account</p>
			<?php 
				$action_url = base_url().'verifyaccount';				
				$attributes = array('class' => 'form-acive-acc', 'id' => 'submit', 'role'=>'form');
				echo form_open($action_url, $attributes);
				$data = array(
							'name'          => $this->security->get_csrf_token_name(),
							'type'         => 'hidden',
							'value'         => $this->security->get_csrf_hash()
							);
			   echo form_input($data);
			   $data = array(
						'name'          => 'id',
						'type'         => 'hidden',
						'value'         => $userdata['token'],
						);
			   echo form_input($data);
			   
			?>
            <a href="javascript:void(0)"> <button type="submit" id="submits">Verify Email Address</button></a>
            <p class="note">
                Please note that link expire 5 days<br>
                If you have not signed up to Enpor please Ignore this small. Thanks
            </p>
		<?php 	echo form_close();    ?>
		<?php	}	?>
		
			<?php 	}else{    ?>
			
				<h2>Link expired !</h2>
			<?php 	}    ?>
		
        </div>
    </div>
</div>



<?php include('includes/footer.php');?>	