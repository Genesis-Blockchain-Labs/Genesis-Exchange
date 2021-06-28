<?php include('includes/dashboard_header.php');
$user_data = $this->session->userdata('user_data');
?>
<style>
.error-vlidation p {
    color: red;
}
</style>

<div id="page-wrapper" class="tr_ee">
                <div class="row">
                    <div class="col-lg-12">
                        <div style="position: relative">
                            <ul class="tree desc3">
                                <li class="first-connector">
                                    <div class="img">
									<?php if($userdata['profile_pic']!=""){ ?>
                                        <img src="<?php echo base_url(); ?>uploads/profile_pic/<?php echo $userdata['profile_pic']; ?>" class="img-circle">
										<?php } else{ ?>
										<img src="<?php echo base_url(); ?>assets/dist/img/son.png" class="img-circle">
										<?php } ?>
                                    </div>
                                    <div class="content">
                                        <h4><?php echo $user_data['firstname']; ?></h4>
                                        <a href="mailto:antonia@gmail.com"><?php echo $user_data['email']; ?></a>
                                        <b>Ref.Balance: <?php if(!empty($userdata['referral_coins'])){ echo $userdata['referral_coins'];}else{echo '0';} ?></b>
                                    </div>
                                  </li>  
								<li class="connecting-li">
					<?php if(!empty($refrel_usr)){ ?>
						<ul class="cutt-ul">
								<?php	foreach($refrel_usr as $val){ ?>
								<li>
								 <div class="img">
								 	<img src="<?php echo base_url(); if(!empty($val['profile_pic'])){ echo "uploads/profile_pic/".$val['profile_pic'];}else{ echo "assets/dist/img/son.png"; }?>" class="img-circle">
											</div>
											<div class="content">
												<h4><?php echo $val['firstname']; ?></h4>
												<a href="mailto:antonia@gmail.com"><?php echo $val['email']; ?></a>
												<b>Ref.Balance: <?php echo $val['coins']; ?></b>
											</div>
										</li>
									
					<?php   	  	} ?>
					 </ul>	
					 
							<?php  	}else{					?>
								<ul class="cutt-ul empty-refrl">
										<li>
                                            <div class="img">
                                                <img src="<?php echo base_url(); ?>assets/dist/img/son.png" class="img-circle">
                                            </div>
                                            <div class="content">
                                                <h4>No referral user.</h4>
                                                
                                            </div>
                                        </li>
										
								 </ul>
					<?php   	  	}   ?>
                                      
                                   
                                </li>
								
                            </ul>
                        </div>
                    </div>
                </div>
            </div>














<?php include('includes/dashboard_footer.php');?>

<script>
function copyRefrel(){	
	var copyText = document.getElementById('copyRefrelInput');    
	copyText.select();
	document.execCommand("Copy");
}
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>  

<script>
  $( function() {
    $( "#dob" ).datepicker({ dateFormat: 'mm/dd/yy', changeMonth: true,
      changeYear: true,yearRange: "-100:+0", });
  } );
 
  </script>
  
  