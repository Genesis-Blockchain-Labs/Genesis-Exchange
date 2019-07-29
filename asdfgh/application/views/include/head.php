  <?php
$sessiondata=$this->session->userdata('user_data');

 if(empty($sessiondata))
  {
  header('location:'.base_url('index.php/login')); 
  } 
  ?>

  <!-- /menu footer buttons -->
<!--           <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
              <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
              <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
              <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout">
              <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
          </div> -->
          <!-- /menu footer buttons -->
        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">
      
        <div class="nav_menu">
          <nav class="" role="navigation">
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">

              <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                 <!--  <img src="images/img.jpg" alt=""> -->Admin Settings
                  <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                  <!-- <li><a href="javascript:;">  Profile</a>
                  </li> -->
                <!--  <li>
                    <a href="<?php // echo base_url(); ?>/admin/Dashboard/commission">
                      <!-- <span class="badge bg-red pull-right">50%</span> -->
                    <!--  <span>Settings</span>
                    </a>
                  </li> -->
                  <!-- <li>
                    <a href="javascript:;">Help</a>
                  </li> -->
				  
				  <li><a href="<?php echo base_url('changepassword'); ?>"> <i class="fa fa-undo pull-right"></i></i>Change Password</a> 
                  </li>
				  
				   <li><a href="<?php echo base_url('authentication'); ?>"><i class="fa fa-lock pull-right"></i>Second Factor</a> 
                  </li>
				  
				   <li><a href="<?php echo base_url('ip'); ?>"><i class="fa fa-ban pull-right"></i>IP Restrictions</a> 
                  </li>
				  
                  <li><a href="<?php echo base_url('index.php/login/logout'); ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                  </li>
				  
                </ul>
              </li>


              <li role="presentation" class="dropdown">
               <!--  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-envelope-o"></i>
                  <span class="badge bg-green">6</span>
                </a> -->
                <!--ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                  <li>
                    <a>
                      <span class="image">
                                        <img src="<?php echo base_url();?>images/img.jpg" alt="Profile Image" />
                                    </span>
                      <span>
                                        <span>John Smith</span>
                      <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where...
                                    </span>
                    </a>
                  </li>
                  <li>
                    <a>
                      <span class="image">
                                        <img src="images/img.jpg" alt="Profile Image" />
                                    </span>
                      <span>
                                        <span>John Smith</span>
                      <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where...
                                    </span>
                    </a>
                  </li>
                  <li>
                    <a>
                      <span class="image">
                                        <img src="images/img.jpg" alt="Profile Image" />
                                    </span>
                      <span>
                                        <span>John Smith</span>
                      <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where...
                                    </span>
                    </a>
                  </li>
                  <li>
                    <a>
                      <span class="image">
                                        <img src="images/img.jpg" alt="Profile Image" />
                                    </span>
                      <span>
                                        <span>John Smith</span>
                      <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where...
                                    </span>
                    </a>
                  </li>
                  <li>
                    <div class="text-center">
                      <a href="inbox.html">
                        <strong>See All Alerts</strong>
                        <i class="fa fa-angle-right"></i>
                      </a>
                    </div>
                  </li>
                </ul-->
              </li>
            </ul>
          </nav>
        </div>

      </div>
      <!-- /top navigation -->
  <script type="text/javascript">
  function change_mod (val) {
    $('#website_mode').val(val);
    $('#chage_mode').submit();
  }

  </script>