<?php include('includes/dashboard_header.php');?>
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
                    <div class="panel panel-default user-settings">
                        <div class="panel-heading">
                            <a href="#">SUPPORT</a>
                        </div>
                        <div class="panel-body">
						<?php $attributes = array('class' => 'form-horizontal personel-infomation', 'id' => 'personal_info','role'=>"form", 'method'=>'post', 'enctype' => 'multipart/form-data', 'autocomplete'=>'off');
						
						$action_url = base_url().'sendSupports';
						
						echo form_open($action_url, $attributes);
						
						$data = array(
						'name'          => $this->security->get_csrf_token_name(),
						'type'         => 'hidden',
						'value'         => $this->security->get_csrf_hash()
						);
						
						echo form_input($data); ?>
						
                                
    
                                <table class="table table-user-information">
                                    <tbody>
                                    <tr>
                                       
                                        <td>
										<?php
											$data = array(
													'name'          => 'subject',
													'id'            => 'subject',
													'type'         => 'text',
													'class'         => 'form-control',
													'required' => 'required',
													'placeholder'         => 'Subject',
													);
											
													echo form_input($data);
													
										?>
								
										</td>
                                    </tr>
                                    <tr>
                                   
                                        <td>
										<?php	
										
													$data = array(
													'name'          => 'message',
													'id'            => 'message',
													'class'         => 'form-control',
													'rows'        => '5',
													'cols'        => '10',
													'required' => 'required',
													'placeholder'         => 'Message',
													
													);
												
													echo form_textarea($data);
													
										?>
										
										</td>
                                    </tr>
									</tbody>
                                </table>
                                <input type="submit" class="btn btn-save" value="Send">
								<?php    echo form_close();      ?>	
                         </div>
                    </div>
                </div>
				
				<div class="col-lg-12">
                        <div class="panel panel-default access-history-panel">
                            <div class="panel-heading">
                                <a href="#">TICKET HISTORY</a>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th class="text-center">Ticket No</th>
                                            <th>Subject</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
										<?php if(isset($support_questions) && !empty($support_questions)){
											foreach($support_questions as $support){
											 if($support['status'] == 1) { $class = "green-text"; } if($support['status'] == 0) { $class = "red-text";}
											?>
												  <tr>
													<td class="text-center"><?php echo $support['id']; ?></td>
													<td><?php echo $support['subject']; ?></td>
													<td class="<?php echo $class ; ?>"><?php if($support['status'] == 1) { echo "Open"; $disable = ''; } if($support['status'] == 0) { echo "Closed"; $disable = 'disabled'; }?></td>
													
													<td><?php echo $support['date']; ?></td>
													<?php  if($support['status'] == 1) {  ?>
													<td style="text-align: center;"><a  href="<?php echo base_url();?>supportDetail/<?php echo $support['id']; ?>" class="btn btn-default" <?php echo $disable; ?> >Detail</a></td>
													<?php } ?>
													
													<?php  if($support['status'] == 0) {  ?>
													<td style="text-align: center;"><a  href="javascript:void(0);" class="btn btn-default" <?php echo $disable; ?> >Detail</a></td>
													<?php } ?>
													
													
												</tr>
										<?php	}
										} else{ ?>
											<tr><td colspan="6">No Tickets Found </td></tr>
										<?php } ?>
                                      
                                        </tbody>
                                    </table>
                                </div>
								<div id="pagination">
								<ul class="tsc_pagination">
								<!-- Show pagination links -->
								<?php foreach ($links as $link) {
								echo "<li>". $link."</li>";
								} ?>
								
							</div>
                            </div>
                        </div>
                    </div>
             </div>
        </div>
	
<?php include('includes/dashboard_footer.php');?>
