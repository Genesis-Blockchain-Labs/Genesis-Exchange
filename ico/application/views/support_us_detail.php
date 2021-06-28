<?php include('includes/dashboard_header.php');?>
<style>
.rightside
{
	text-align:right;
}
.leftside
{
	text-align:left;
}
</style>
<?php	$message = $this->session->flashdata('success_msg'); 
			if(!empty($message)){    ?>
				<div class="col-sm-12">
					<div class="alert green-alert alert-info fade in" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					  <?php echo $message;     ?>
					</div>
				</div>
	<?php     	}     ?>
	<div id="page-wrapper">
	<div class="row">
                <div class="col-lg-12">
							<div class="section_1">
                               <p><strong>Ticket No: </strong><?php echo $support_question['id']; ?></p>
							   <p><strong>Subject: </strong><?php echo $support_question['subject']; ?></p>
							   <p><strong>Message: </strong><?php echo $support_question['message']; ?></p>
							</div>
                        </div>
                    </div>
    </div>
	<div id="page-wrapper">
	<div id="chat-wrapper">
		<?php if(isset($support_reply) && !empty($support_reply)){
		foreach($support_reply as $reply){
			if($reply['user_id'] == 0) { $class = 'left_chat'; $name = 'Admin'; } else { $class = 'right_chat'; $name = 'You';}
		?>
		
		
		<div class="row">
                <div class="col-lg-12">
					<div class="panel-body">
						<div class=<?php echo $class; ?>>
							<span class="name"><?php echo $name; ?></span>
							<div class="common_wrap">
								<?php echo $reply['message'];?><br/><span><?php echo $reply['date'];?></span>
							</div>
						</div>
					</div>
                </div>
        </div>
        
        
		<?php	} }?>
		</div>
		</div>
		<div id="page-wrapper">
		<?php $attributes = array('class' => 'form-horizontal personel-infomation', 'role'=>"form", 'method'=>'post', 'enctype' => 'multipart/form-data', 'autocomplete'=>'off');
						
						$action_url = base_url().'sendReply';
						
						echo form_open($action_url, $attributes);
						
						$data = array(
						'name'          => $this->security->get_csrf_token_name(),
						'type'         => 'hidden',
						'value'         => $this->security->get_csrf_hash()
						);
						echo form_input($data); 
						
						$data = array(
													'name'          => 'message',
													'id'            => 'message',
													'class'         => 'form-control',
													'rows'        => '5',
													'cols'        => '10',
													'required' => 'required',
													);
												
													echo form_textarea($data);
						?>
						<input type="submit" class="btn btn-save btn-grey  pull-right" value="Reply">
						<input type="hidden" name="ticket_no" value="<?php echo $support_question['id']; ?>">
						<?php    echo form_close();      ?>	
		</div>
<?php include('includes/dashboard_footer.php');?>
