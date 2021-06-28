<?php //include_once('includes/header.php');
   //echo'<pre>';print_r($email_verify);exit;
   ?>	

</head>
<body>
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/mycustom.css">
   <div class="clearfix"></div>
   <div class="main-top-margin">
      <div class="bd_vont">
         <div class="container">
            <div class="row">
               <div class="col-sm-12">
                  <div class="proof registration-page sett">
                     <div class="team-content-wrapper">
                        <?php if(!empty($email_verify)) { ?>
                       <?php
                           
                           $attributes = array('class' => 'form-horizontal', 'id' => 'register','role'=>"form", 'method'=>'post');
						   
						   $action_url = base_url().'user/new_set_password';
                           echo form_open($action_url, $attributes);
                           
                           $data = array(
                           'name'          => 'user_id',
                           'id'            => 'user_id',
                           'type'         => 'hidden',
                           'value'         => $email_verify['id'],
                           );
                           
                           echo form_input($data);
                           
                           $csrf = array(
											'name' => $this->security->get_csrf_token_name(),
											'hash' => $this->security->get_csrf_hash()
									);
									?>
					<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" /> 
					
                        <div class="m-l-heading">
                           <h2>Set Password</h2>
                           
                        </div>
						<div class="form-group">
							<label class="col-xs-3 control-label"></label>
								<?php if(!empty($pass_errror)){  
										echo '<div class="col-xs-9 meg-div">'.$pass_errror.'</div>';
									?>
									<?php }else{   ?>
									<div class="col-xs-9 meg-div tt">Please enter your new password</div>
									<?php }   ?>
						</div>
                        <div class="form-group">
                           <label for="password" class="col-xs-3 control-label">Password</label>
                           <div class="col-xs-9">
                             <?php
                                 $data = array(
                                 'name'          => 'password',
                                 'id'            => 'password',
                                 'placeholder'   => 'Max length 20 characters',
                                 //'required'     => 'required',
                                 'type'         => 'password',
                                 //'value'         => set_value('password'),
                                 'maxlength'     =>  "20",
                                 'class'         => 'form-control',
                                 );
                                 
                                 echo form_input($data);
                                 
                                 ?>
                              <div class="error-vlidation"><?php echo form_error('password'); ?></div>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="password" class="col-xs-3 control-label">Confirm Password</label>
                           <div class="col-xs-9">
                              <?php
                                 $data = array(
                                 'name'          => 'Confirm-Password',
                                 'id'            => 'cpassword',
                                 'placeholder'   => 'Max length 20 characters',
                                 //'required'     => 'required',
                                 'type'         => 'password',
                                 //'value'         => set_value('cpassword'),
                                 'maxlength'     =>  "20",
                                 'class'         => 'form-control',
                                 );
                                 
                                 echo form_input($data);
                                 
                                 ?>
                              <div class="error-vlidation"><?php echo form_error('Confirm-Password'); ?></div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="col-sm-9 col-sm-offset-3">
                              <button type="submit" class="btn btn-primary btn-block" id="submits">Update</button>
                              <button type="button" class="btn btn-primary btn-block" id="buttons" style="display:none">Please Wait...</button>
                              <a href="<?php echo base_url(); ?>login" class="login-register-link"  >Already have an account? <span style="color: rgb(14, 108, 253); font-weight: 300;">Login</span></a>						
                           </div>
                        </div>
                        <!--/form-->
                        <?php
                           echo form_close();
                           
                        }
                           ?>
                        <br/>
                        <br/>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <button type="button" data-toggle="modal" data-target="#myModal" id="popup"></button>
      <!-- Modal -->
      <div id="myModal" class="modal fade" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
               </div>
               <div class="modal-body">
                  <p></p>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>
      <!--/slider_s-->
      </main>
   </div>
</body>
</html>	
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		       
<script>
   $(function(){
   $('#phone').click(function(){
   	$("#ph_error").html(" ");	
   }); 
   });	
   
   $(function(){
   	$("#mail_very_fy").css("display",'block');	
   });	       
</script>		       
<?php include('includes/footer.php');?>