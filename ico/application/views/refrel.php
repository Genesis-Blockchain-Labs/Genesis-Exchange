<?php include('includes/new_header.php');  
$user_data = $this->session->userdata('user_data');
?>
<div id="primary" class="content-area">
		<main id="main" class="site-main container" role="main">

			
<article id="post-684" class="post-684 page type-page status-publish hentry">
	<header class="entry-header">
		<h1 class="entry-title">Wallets</h1>	</header><!-- .entry-header -->

	<div class="entry-content">
		<div class="ee-wrap">
<div class="ee-section">
<div class="ee-col-1-1">

			<div class="crsh-md-wrapper">
				<div class="crsh-md-row">
					
				</div>
				<div class="crsh-md-row">
					<div class="crsc-dashboard-m1-left">
						<div class="crsc-tabs-container">
						
				
					<div class="crsc-dashboard-m1-coin">
					
						
						<div class="crsc-dashboard-m1-info">
						<div class="row">
						 <div class="col-md-4">
						    <div class="panel panel-primary">
							  <div class="panel-heading">Total Referrals</div>
							  <div class="panel-body">Panel Content</div>
							</div>
							</div>
							<div class="col-md-4">
							<div class="panel panel-primary">
							  <div class="panel-heading">Total Invested</div>
							  <div class="panel-body">Panel Content</div>
							</div>
							</div>
							<div class="col-md-4">
							<div class="panel panel-primary">
							  <div class="panel-heading">Tokens Recieved</div>
							  <div class="panel-body">Panel Content</div>
							</div>
							</div>
							</div>
						  <h2>Basic Table</h2>
							            
							  <table class="table table-bordered">
								<thead>
								  <tr>
									<th>User Referred</th>
									<th>Amount Invested</th>
									<th>Token Recieved </th>
									<th>Date </th>
								  </tr>
								</thead>
								<tbody>
								<?php foreach($refrel_users as $user ): ?>
								  <tr>
									<td><?php echo $user->email ; ?></td>
									<td><?php echo $user->contribution_amount ; ?> <?php echo $user->contributed_currency ; ?></td>
									<td><?php echo $user->boon_coins ; ?></td>
									<td><?php  $date= date_create($user->date);
                                              echo date_format($date,"d M Y"); ?></td>
								  </tr>
								 <?php endforeach; ?>
								</tbody>
							  </table>

						</div>
				
					</div>
						</div>
						
					</div>
					
				</div>
			</div>
		
</div>
</div>
</div>
	</div><!-- .entry-content -->

			
	</article><!-- #post-## -->

		</main><!-- #main -->
	</div>
	
	
	<?php include('includes/new_footer2.php');  ?>


</body>
</html>