<?php include('includes/dashboard_header.php');
$user_data = $this->session->userdata('user_data');
?>
  <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default access-history-panel">
                            <div class="panel-heading">
                                <a href="#">TRANSACTION HISTORY</a>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th class="text-center">Transaction ID</th>
                                            <th>Amount</th>
                                            <th>Currency</th>
                                            <th>SafeCardano Tokens</th>
                                            <th>Date</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
										<?php if(isset($transaction_detail) && !empty($transaction_detail)){
											foreach($transaction_detail as $transaction){
											?>
												  <tr>
													<td class="text-center <?php if($transaction['status']==1 || $transaction['status']==2){ ?>confirm_bar <?php } if($transaction['status']==1){ ?>confirm_outof1<?php }
													else if($transaction['status']==2){?>confirm_outof2<?php }?>"> <?php echo $transaction['txn_id']; ?></td>
													
													<td <?php if($transaction['status']==2){?> class="confirm_bar" <?php }?> ><?php echo $transaction['amount']; ?></td>
													
													<td <?php if($transaction['status']==2){?> class="confirm_bar" <?php }?> ><?php echo $transaction['currency']; ?></td>
													
													<td <?php if($transaction['status']==2){?> class="confirm_bar" <?php }?> ><?php echo $transaction['token']; ?>  BDLR</td>
													
													<td><?php echo $transaction['date']; ?></td>
													<td><span class="<?php if($transaction['status']==-1) {
															echo 'cancelled'; 
														}
														else if($transaction['status']==0){
																echo 'pending';
															}
															else if($transaction['status']==1){
																echo 'pending'; 
																}
														else if($transaction['status']==2){
																echo 'pending'; 
																}
														else if($transaction['status']==100){
																	echo 'completed'; 
														} ?>">
																	<?php if($transaction['status']==-1) {
																		echo 'Cancelled'; 
																		}
																		else if($transaction['status']==0){
																			echo 'Pending'; 
																			}
																		else if($transaction['status']==1){
																				echo 'Confirmed'; 
																				}
																		else if($transaction['status']==2){ 
																				echo 'Queued'; 
																		}
																		else if($transaction['status']==100){
																					echo 'Completed';
																		}?>
														</span>
																					
													</td>
												</tr>
										<?php	}
										} else{ ?>
											<tr><td colspan="6">No Transaction</td></tr>
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