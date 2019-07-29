<div class="right_col" role="main">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
						<li class="active">Support Detail</li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
				   <?php  
						$lerror = $this->session->flashdata('ip_error_msg');
						  if(isset($lerror)){
							  if($lerror['code']=='1'){
									echo '<div class="alert alert-success">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$lerror['mess'].'</div>';
							  }else{
									echo '<div class="alert alert-error">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$lerror['mess'].'</div>';
							  }					  
						  }
						  
					 ?>	
					<div id="my-tab-content" class="tab-content">			
						<div class="tab-pane active" id="orange">
							<div class="section_1">
								<p><label>Ticket No.: </label> <span><?php echo $support->id; ?></span></p>  
								<p><label>Subject: </label> <span><?php echo $support->subject;  ?></span></p>
								<p><label>Message: </label> <span><?php echo $support->message; ?></span></p>
								<p><label>From: </label> <span><?php echo $support->firstname.' '.$support->lastname;  ?></span></p>
								<p><label>Email: </label> <span><?php echo $support->email;  ?></span></p>
							</div>
							<div class="chat_support">
							 <?php if(!empty($support_reply)){ 
							 foreach($support_reply as $reply){
							  if($reply->user_id!=0){ ?>
									<div class="left_chat">
										<span class="left_name"><?php echo $reply->firstname.' '.$reply->lastname; ?></span>
										<div class="left-wrap">
											<?php echo $reply->message; ?><br/><span><?php echo $reply->date; ?></span>
										</div>
									</div>
							 <?php }
							 else { ?>
									<div class="right_chat">
									<span class="right_name">You</span>
										<div class="right_wrap">
											<?php echo $reply->message; ?><br/><span><?php echo $reply->date; ?></span>
										</div>
									</div>
						
							 <?php 
							 } } } ?>
							</div>
							 <?php if($support->status==1) { ?>
							 <div class="section_2">
								 <form action="<?php echo base_url(); ?>reply" method="post" autocomplete="off">
									 <p>
									 <textarea name="message" id="message" class="form-control" ></textarea>
									 <div class="error-form-dv"><?php echo form_error('message');  ?></div>
									 <input type="hidden" name="admin" value="0" />
									 <input type="hidden" id="" name="<?php echo  $this->security->get_csrf_token_name() ?>" class="form-control" value="<?php echo  $this->security->get_csrf_hash() ?>">
									 <input type="hidden" name="ticket_no" value="<?php echo $support->id; ?>"/>
									 <button type="submit" class="btn btn-primary">Reply</button>
									 </p>
								 </form>
							 </div>
							 <?php } ?>
					</div>			
				</div>  
			</div>