<?php include('includes/header.php'); ?>
<div class="clearfix"></div>
<section class="intro">
    <div class="background"> </div>
    <div class="top-bg"> </div>
	 
    <div class="copy">
        <div>
            <div class="cloud cloud2"></div>
            <div class="cloud-header cloud3">
                <div class="container">
                    <div class="row">
                        
                        <div class="col-sm-7">
                        
                      <div class="yellow-qui"> 
                      <img src="<?php echo base_url()?>assets/img/pat_t.png" class="img-responsive yell_1" alt="ban_logo">
                      <img src="<?php echo base_url()?>assets/img/ban_logo.png" class="img-responsive yell_2" alt="yellow-qui">
                      
                      
                       </div>
                            <h1 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.0s"><strong>Boon.Tech</strong>
                                <span class="sf">will Instantly revolutionize the Freelance Job MarketPlace </span></h1>
                            <p class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s">A Free and remarkable decentralized platform for both Employers and Freelancers
                                <br>
                            </p>
                            <div class="countdown-timer-wrapper">
                                <div class="timer" id="countdown"></div>
                            </div>
                            <div class="clearfix"></div>
                           
                            <!-- New Registration Section Code -->
                            <div class="clearfix"></div>
                            <?php
                                $attributes = array('class' => 'form-horizontal banner-reg-btn', 'id' => 'registration','role'=>"form", 'method'=>'post');
                                echo form_open(' ', $attributes);
                                                                
                             $csrf = array(
											'name' => $this->security->get_csrf_token_name(),
											'hash' => $this->security->get_csrf_hash()
									);
									?>  
							  
							<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                            <?php
								$refid = isset($refid)?$refid:'';
								$data = array(
											'name'          => 'user_id',
											'id'            => 'user_id',
											'type'         => 'hidden',
											'value'         => $refid,
									);
									 echo form_input($data);
                           
                                            
							
							
                            $data = array(
                                        'name'          => 'email',
                                        'id'            => 'email',
                                        'placeholder'   => 'Email',
                                        'required'     => 'required',
                                        'type'         => 'email',
                                        'value'         => '',
                                        'class'         => 'form-control',
                                );

                            echo form_input($data);
                                            
                            ?>

                            <button type="submit" class="btn btn-primary btn-block" id="register_submit">Register to get 25% bonus</button>
                            <?php
                                    echo form_close();
                            ?>

                            <!-- New Registration Section Code Ends-->
                            <div class="outer_low"><div class="low_text">PROUD MEMBER<br /> OF ENTERPRISE<br /> ETHEREUM ALLIANCE</div></div>
							
                        </div>
						
                        <div class="col-sm-5">
                            <div class="banner-img"> <img src="<?php echo base_url()?>assets/img/phone-coin1.png" class="img-responsive center-block mp" alt="banner"> </div>
                        </div>
						<center class="pp-more"><a href="<?php echo base_url(); ?>#patent"><span>Learn More</span></a></center>
                    </div>
                </div>
            </div>
        </div>
			
    </div>

    <a href="<?php echo base_url(); ?>#patent"><span class="mouse-icon trs"></span></a>
</section>
</div>
<div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Coming Soon</h4>
                            </div>
                            <div class="modal-body">
                                <p>Apple is reviewing our App, it will be live before November 15. Apple takes couple of weeks to review any App before they make the App live. </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>
<script>
 jQuery(window).load(function() {
        jQuery("#loading").fadeOut();
    });
    jQuery(document).ready(function($) {
        $('.counter').counterUp({
            delay: 10,
            time: 1000
        });
    });
    $(document).ready(function() {
        // Set the date we're counting down to
        var countDownDate = new Date("Dec 15, 2017 00:00:00").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get todays date and time
            var now = new Date().getTime();

            // Find the distance between now an the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById("countdown").innerHTML = '<div class="timer-wrapper"><div class="time">' + days + '</div><span class="text">days</span></div><div class="timer-wrapper"><div class="time">' + hours + '</div><span class="text">hrs</span></div><div class="timer-wrapper"><div class="time">' + minutes + '</div><span class="text">mins</span></div><div class="timer-wrapper"><div class="time">' + seconds + '</div><span class="text">sec</span></div>';




            // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "EXPIRED";
            }
        }, 1000);



    });
	
	
</script>
<script>
 $("#registration").submit(function( event ){
	 
	 var live_url = "<?php  echo base_url();?>";
	//if(live_url == "https://boon.vc/"){
	// gtag_report_conversion(live_url);
	//}
  $("#pass_error").html(" ");
  $("#c_pass_error").html(" ");    
  $("#buttons").show();
  $("#submits").hide();
  event.preventDefault();
  var request = $.ajax({
      url: "<?php  echo base_url();?>user/register_ajax",
     method: "POST",
     data: new FormData(this),
     processData: false,
     contentType: false,
   }); 
    
	request.done(function(msg){
		$("#buttons").hide();
		$("#submits").show();
		if(msg == "0"){
			$("#myModal").modal('show');
			$(".modal-title").html(" ");
			$(".modal-body").html("<p>Email is already exist</p>");
			$("#popup").trigger("click");
		}else if(msg == "2"){
			$("#myModal").modal('show');
			$(".modal-title").html(" ");
			$(".modal-body").html("<p>Something went wrong</p>");
			$("#popup").trigger("click");
		}else{  
			  if(live_url == "https://boon.vc/"){
	          gtag_report_conversion(live_url+"user/register_thank");
            }else
			{
			window.location = "<?php  echo base_url();?>user/register_thank";
			}
		}
	});
   
  event.preventDefault(); 
 });
</script>
<script>
function gtag_report_conversion(url) {
  var callback = function () {
    if (typeof(url) != 'undefined') {
      window.location = url;
    }
  };
  gtag('event', 'conversion', {
      'send_to': 'AW-826936146/n8ayCIWn0XkQ0paoigM',
      'event_callback': callback
  });
  return false;
}
</script>