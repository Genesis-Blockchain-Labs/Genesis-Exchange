<?php include('includes/dashboard_header.php');
$user_data = $this->session->userdata('user_data');
?>
  <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default access-history-panel">
                            <div class="panel-heading">
                                <a href="#">BROADCAST HISTORY</a>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
											<tr>
												<th class="text-center">S No.</th>
												<th class="text-center">Message</th>
												<th class="text-center">Date</th>
												<th class="text-center">Action</th>  
											</tr>
                                        </thead>
                                        <tbody>
										<?php  
											
										$start = $pages; 
										 if(isset($user) && !empty($user)){
											foreach($user as $row){	
							
											?>
											<tr>
													
												<td  class="text-center"><?php echo $start+1  ?> </td>
												
											<td  class="text-center"> <?php if(strlen($row['message'])>50){echo substr($row['message'], 0, 50).'...'; }else{  echo substr($row['message'], 0, 50); }?> </td>
												
		
												
												<td class="text-center">
														<?php 
														$brodate = explode(' ',$row['date']);						
														echo $brodate[0];  
														$start++;
														?>
													
												</td>
											<td>
										
											<a href="<?php echo base_url('message/'.$row['id']); ?>" class="btn btn-default" >Details</a>
											</td>  
													
											</tr> 
											
										<?php 	} 
										} else{ ?>
											<tr><td colspan="6">No Message</td></tr>
										<?php } ?>
                                      
                                        </tbody>
                                    </table>
                                </div>
								<div id="pagination">
								<ul class="tsc_pagination">

								<!-- Show pagination links -->
								<?php 
								foreach ($links as $link) {
								echo "<li>". $link."</li>";
								} ?>
							</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<?php include('includes/dashboard_footer.php');?>