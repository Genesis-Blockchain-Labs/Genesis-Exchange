 <?php include('includes/dashboard_header.php');
$user_data = $this->session->userdata('user_data');
?>
 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default access-history-panel">
                        <div class="panel-heading">
                            <a href="#">ACCESS HISTORY</a>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">	
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Country Code</th>
                                        <th>Country</th>
                                        <th>IP Address</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
											<?php if(!empty($history))
											{
												foreach($history as $his)
												{										
													if($his['status'] == 'success'){
														$class = 'success';
													}
													else
													{
														$class = 'fail';
													}
													$date = date('d-D-Y h:i A',strtotime($his['login_date']));
												 ?>
												<tr>
													<td><?php echo $date; ?></td>
													<td><?php echo $his['country_code']; ?></td>
													<td><?php echo $his['country']; ?></td>
													<td><?php echo $his['ip_address']; ?></td>
													<td class="<?php echo $class; ?>"><?php echo $his['status']; ?></td>
												</tr>
											<?php }	
											}
										else{ ?>
											<tr>No Records</tr>
									<?php  }	?>		
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