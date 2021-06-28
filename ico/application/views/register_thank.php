<?php include('includes/header.php');
$user_data = $this->session->userdata('user_data');
?>
</head>
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/mycustom.css">
<body class="thank">
   

			<div class="clearfix"></div>
			<div class="main-top-margin">
            <div class="bd_vont">
                <div class="container">
                    <div class="row">    
                        <div class="col-sm-12">
							<div class="proof">
                    
								<h1>Thank you</h1> <p class="bck"></p>
								<hr>
								<div class="thanks-section"><p>Your registration is successful. An email has been sent to your email address with a verification link to verify your email address. Please login to your email address and open the email and click on the verification link.</p></div>
								<br/>

						</div>
					</div>
				</div>
			</div>
		</div>     

        

	
<style>


*[role="form"] {
    max-width: 530px;
    padding: 15px;
    margin: 0 auto;
    background-color: #eee;
    border-radius: 0.3em;
}

*[role="form"] h2 {
    margin-left: 5em;
    margin-bottom: 1em;
}		
</style>		
		
<!--script>
	 var timer = setTimeout(function() {
		window.location.href="<?php  echo base_url();?>login";
	}, 6000);
</script-->


        
       
        <!--/slider_s-->
        
    </main>
	</div>
</body>
</html>


<?php include('includes/footer.php');?>	