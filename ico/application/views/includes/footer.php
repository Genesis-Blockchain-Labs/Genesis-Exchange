



<!-- Trigger the modal with a button -->

<!-- Modal -->
<div id="videoModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><img src="<?php echo base_url()?>assets/img/icon/close.svg" alt="close" /></button>
      </div>
      <div class="modal-body text-center">
      	<div class="videowrapper" id="you-vid">
      		<iframe src="https://www.youtube.com/embed/8rprnWl_zao?;enablejsapi=1&version=3&playerapiid=ytplayer" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
      	</div>
                      
      
      </div>
    </div>

  </div>
</div>

<script type="text/javascript" src="<?php echo base_url()?>assets/js/kinetic.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.final-countdown.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/custom.js"></script> 

<script type="text/javascript" src="<?php echo base_url()?>assets/new_design/dist/js/bootstrap-select.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>assets/js/slider/slide-to-captcha.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>assets/js/slider/modernizr.custom.20910.js"></script> 
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/slider/slide-to-captcha.css">


<script>
function hide_veryfy_div(){
	//$('#mail_very_fy').css('display','none');
	$('#mail_very_fy').hide('slow');
	$('#forgot_mail').hide('slow');
	$('#new_pass_confrm').hide('slow');
	$('#sucess_msg_change_pass').hide('slow');
	//$('.alert alert-info').css('display','none');
}
</script>



<!-- Google Code for Remarketing Tag -->
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<script type="text/javascript">
/ <![CDATA[ /
var google_conversion_id = 826936146;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/ ]]> /
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/826936146/?guid=ON&amp;script=0"/>
</div>
</noscript>



<!--new code-->
<script src="<?php echo base_url()?>assets/new_design/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url()?>assets/new_design/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/new_design/dist/js/enpor-admin.js"></script>
<!--end-->
</body>
</html>

