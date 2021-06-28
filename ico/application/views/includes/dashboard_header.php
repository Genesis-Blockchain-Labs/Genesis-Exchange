<!doctype html>
<?php 
$ci = &get_instance();
	$ci->load->model('Dashboard_model');
	$data = $ci->Dashboard_model->get_website_status();
	if($data->website_status==0){
		redirect(base_url("mantainance"));
	}
?>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <title><?php echo DOMAIN_NAME; ?></title>		
		<meta name="keywords" content="<?php echo DOMAIN_NAME; ?>">
		<meta name="description" content="<?php echo DOMAIN_NAME; ?>">
		<meta name="author" content="<?php echo DOMAIN_NAME; ?>">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- Favicon -->
		<link rel="shortcut icon" href="<?php echo base_url()?>assets/img/favicon2.png" type="image/x-icon">
		<link rel="apple-touch-icon" href="http://creightiveplus.com/project/qtm/v2/img/apple-touch-icon.png">

		<link href="<?php echo base_url(); ?>assets/dashboard/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<!-- Custom CSS -->
		<link href="<?php echo base_url(); ?>assets/dashboard/dist/css/enpor-admin.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/dashboard/dist/css/responsive.css" rel="stylesheet">
		<!-- Morris Charts CSS -->
		<link href="<?php echo base_url(); ?>assets/dashboard/vendor/morrisjs/morris.css" rel="stylesheet">
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
		
		<!-- Custom Fonts -->
		<link href="<?php echo base_url(); ?>assets/dashboard/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

		

</head>
<?php include('dashboard_sidebar.php');  ?>
<?php $ci = &get_instance();
	$ci->load->model('Dashboard_model');
	$session_data = $this->security->xss_clean($this->session->userdata('user_data'));
	$user_id = $session_data['id'];
	$data = $ci->Dashboard_model->soft_delete($this->security->xss_clean($user_id));
	$total_coins = ($data['total_coins']!="")?$data['total_coins']:0;
	$broadcast = $ci->Dashboard_model->get_broadcast();//get broadcast messages
	
	$total_count = count($broadcast);
	$bedge = $ci->Dashboard_model->bedge($this->security->xss_clean($user_id));
	//print_r($bedge);die;
	?>
<!-- Page Content Holder -->
<div id="content">
	 <nav class="navbar navbar-default">
                <div class="container-fluid">

                    <div class="navbar-header">
                        <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                            <i class="glyphicon glyphicon-align-left"></i>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <!--li><a href="<?php echo base_url('dashboard'); ?>">Dashboard</a></li>
                            <li><a href="<?php echo base_url('invest'); ?>">Invest</a></li>
                            <li><a href="<?php echo base_url('transaction_detail'); ?>">Transaction History</a></li>
                            <li><a href="<?php echo base_url('referral'); ?>">Referral Statistics</a></li-->

							<?php if(total_coins!=""){ ?>
							<li class="per-info">
							<a href="javascript:void(0);">Account Balance:  <?php echo $total_coins; ?> SafeAda</a>
							</li>
							<?php } ?>
							<!--li class="per-info">
                                <a href="<?php //echo base_url(); ?>profile">
                                   Personal Information<i class="fa fa-id-card-o fa-fw " aria-hidden="true"></i>


                                </a>
								</li-->
								
                            <!--li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">   
                                    <i class="fa fa-bell fa-fw"></i>
                                </a>                
                                <ul class="dropdown-menu dropdown-alerts">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-comment fa-fw"></i> New Comment
                                        </a>
                                    </li>        
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-envelope fa-fw"></i> Message Sent
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-tasks fa-fw"></i> New Task
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                        </a>
                                    </li>
                                </ul>
                            </li-->
                            <li class="notify-set dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="" onclick="hidebedge(<?php echo $user_id; ?>)">
                                    <!--i class="fa fa-envelope-o fa-fw"></i-->
									 <i class="fa fa-bell fa-fw"></i>
                                    
									<?php if(!empty($bedge))
									{
										if($bedge['notification'] != 0)
										{
											?>
											<div class="badge">
											<?php
											echo $bedge['notification'];
											?>
											</div>
											<?php
										}
										
									}
									?>
									
                                </a>
                                <?php if(!empty($broadcast)){ ?>
								<ul class="dropdown-menu dropdown-messages">
								<?php 
								foreach($broadcast as $broadcasts) { 
								?>
                                    <li>
                                        <a href="<?php echo base_url('message/'.$broadcasts->id); ?>">
                                            <div>
                                                <strong>SafeCardano</strong>
												<span class="pull-right text-muted">
													<em><?php 
													$brodate = explode(' ',$broadcasts->date);
													
													echo $brodate[0]; ?></em>
												</span>
                                            </div>
											<div class="message-del"><?php echo $broadcasts->message; ?></div>
                                        </a>
                                    </li>
                                    <li class="divider"></li>
								<?php }  ?>
								<li>
                                    <a class="text-center" href="<?php echo base_url('broadcastlist'); ?>">
                                        <strong>Read All Messages</strong>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
								</li>
                                    <!--li>
                                        <a href="#">
                                            <div>
                                                <strong>Consectetur adipiscing elit.</strong>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="#">
                                            <div>
                                                <strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</strong>
                                            </div>
                                        </a>
                                    </li-->

                                </ul>
								<?php } ?>
                                <!-- /.dropdown-messages -->
                            </li>		
							<!--li>
                                <a href="<?php// echo base_url(); ?>profile">
                                     <i class="fa fa-id-card-o" aria-hidden="true"></i>
                                </a>	
								</li-->								
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    Personal Information <i class="fa fa-id-card-o" aria-hidden="true"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-user">
                                    <li><a href="<?php echo base_url(); ?>profile">Personal Information</a></li>
                                    <li><a href="<?php echo base_url(); ?>security_setting">Security Setting</a></li>
                                    <li><a href="<?php echo base_url(); ?>access_history">Access History</a></li>
                                    <li><a href="<?php echo base_url(); ?>logout">Log out</a></li>
                                </ul>
                             
                            </li>
							   <!-- /.dropdown-user -->
                        </ul>
                    </div>
                </div>
            </nav>
	<script>
	function hidebedge(id)
	{
		$.ajax({
		type: "POST",
		url: '<?php echo base_url();?>bedge',
		data: {'id':id},
		dataType:'json',
		success:function(res){
			return true;
		}
	});	
	}
	</script>