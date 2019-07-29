<!-- Left Panel -->
<?php 
$user_data = $this->session->userdata('user_data');
if(empty($active_class)){
	      $active_class = 'dashboard';     
		  
}?>
<?php 
$id = $user_data['id'];
$ci = &get_instance();
	$ci->load->model('user_model');
	$data = $ci->user_model->get_usr_data($id);
?>
<body>
<div class="wrapper">
     <nav id="sidebar" class="">
            <div class="sidebar-header">
                <img src="<?php echo base_url(); ?>assets/dashboard/dist/img/logo.png">
            </div>
            <div class="user-profile">
			<?php if(!empty($user_data['profile_pic'])) {  ?>
			<img src="<?php echo base_url(); ?>uploads/profile_pic/<?php echo $data['profile_pic']; ?>">
		<?php	}
			else{ ?>
			<img src="<?php echo base_url(); ?>assets/dashboard/dist/img/yilmaz.jpg" class="img-responsive img-circle">
            <?php } ?>
                
                <h4><?php echo $user_data['firstname'].' '.$user_data['lastname']; ?></h4>
            </div>
            <ul class="list-unstyled components">
                <li class="<?php if($active_class == 'dashboard'){ echo 'active'; }?>">
                    <a href="<?php echo base_url(); ?>dashboard">
                        <img src="<?php echo base_url(); ?>assets/dashboard/dist/img/menu-icons/dashboard.png">
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="<?php if($active_class == 'invest'){ echo 'active'; }?>">
                    <a href="<?php echo base_url('invest'); ?>">
                        <img src="<?php echo base_url(); ?>assets/dashboard/dist/img/menu-icons/invest.png">
                        <span>Invest</span>
                    </a>
                </li>
                <li class="<?php if($active_class == 'transaction_detail'){ echo 'active'; }?>">
                    <a href="<?php echo base_url('transaction_detail'); ?>">
                        <img src="<?php echo base_url(); ?>assets/dashboard/dist/img/menu-icons/transaction-history.png">
                        <span>Transaction History</span>
                    </a>
                </li>
                <li class="<?php if($active_class == 'referral'){ echo 'active'; }?>">
                    <a href="<?php echo base_url('referral'); ?>">
                        <img src="<?php echo base_url(); ?>assets/dashboard/dist/img/menu-icons/referral-statistics.png">
                        <span>Referral Statistics</span>
                    </a>
                </li>
            </ul>
            <ul class="list-unstyled components">
                <li class="<?php if($active_class == 'sec_setting'){ echo 'active'; }?>">
                    <a href="<?php echo base_url(); ?>security_setting">
                        <img src="<?php echo base_url(); ?>assets/dashboard/dist/img/menu-icons/security-settings.png">
                        <span>Security Settings</span>
                    </a>
                </li>
				
                <li class="<?php if($active_class == 'acc_hist'){ echo 'active'; }?>">
                    <a href="<?php echo base_url(); ?>access_history">
                        <img src="<?php echo base_url(); ?>assets/dashboard/dist/img/menu-icons/access-history.png">
                        <span>Access History</span>
                    </a>
                </li>
                <li class="<?php if($active_class == 'support'){ echo 'active'; }?>">
					<a href="<?php echo base_url(); ?>supports">
                      <i class="fa fa-envelope-o fa-fw"></i>
                        <span>Support</span>
                    </a>
                  
                </li>
			
            </ul>     
            <ul class="list-unstyled components">
                <li>
                    <a href="<?php echo base_url('logout'); ?>">
                        <img src="<?php echo base_url(); ?>assets/dashboard/dist/img/menu-icons/logout.png">
                        <span>Log Out</span>
                    </a>
                </li>
            </ul>
        </nav>
