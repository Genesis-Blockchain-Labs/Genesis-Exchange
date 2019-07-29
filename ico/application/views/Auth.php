<?php include_once('includes/header.php');
?>
<div class="login-box">
    <div class="login-panel panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title veri_tit">Google verification Code</h3>    
        </div>
        <div class="panel-body user-settings">
										<?php
											$attributes = array('class' => 'form-signin', 'id' => 'submit', 'method'=>'post', 'autocomplete'=>'off');
											echo form_open('authenticate/'.$id, $attributes);
											
										?>
										<?php  
											$lerror = $this->session->flashdata('error_msg');
											if(isset($lerror)){
												echo '<div class="alert alert-danger boon-alert-danger">
												<a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$lerror.'</div>';
											}
										?>
				<input type="hidden" name="admin_id" value="<?php echo $id; ?>" id="admin_id" /></td>
                <table class="table table-user-information">
                    <tbody>
                    <tr>
                        <!--<th>Authentication Code</th>-->
                        <td><?php
											$data = array(
											'name'          => 'authcode',
											'id'            => 'authcode',
											'required'     => 'required',
											'type'         => 'text',
											'value'         => '',
											'class'         => 'form-control',
											'placeholder'   => 'Authentication Code',
											);
											
											echo form_input($data);
											
							?>				
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center">
                            <input type="submit" class="btn btn-login" id="submits" value="Verify">			
                        </td>
                    </tr>
                    </tbody>
                </table>
               
            <?php 
		echo form_close();
		?>
        </div>
    </div>
</div>
<?php include('includes/footer.php');?>	 
