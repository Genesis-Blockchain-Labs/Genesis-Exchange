<?php include('includes/dashboard_header.php');
$user_data = $this->session->userdata('user_data');

?>
<style>


.form-group.error-vlidation p {
	color: red;
	font-size: 15px;
	font-family: monospace;
}
</style>
	<div id="page-wrapper">
 
		<div class="row">
			<div class="col-lg-12">
                <div class="panel panel-default access-history-panel br-message">
				
					<div class="panel-heading">
						<!--a href="#">BROADCAST MESSAGE </a-->
						<div>
							<strong>BROADCAST MESSAGE </strong>
							<span class="pull-right text-muted">
								<em><?php 
								$brodate = explode(' ',$user[0]->date);
								
								echo $brodate[0]; ?></em>
							</span>
						</div>
					</div>
                    <div class="panel-body">
					<i class="fa fa-bullhorn" aria-hidden="true"></i>
						<h3>From Enpor</h3>
						<hr>
						<p class="lead">	<?php echo $user[0]->message; ?>
						</p>		
					</div>
				</div>
			</div>
		</div>
	</div>
<script>

</script>


<?php include('includes/dashboard_footer.php');?>

<script>

</script>