<?php include('includes/header.php');
$user_data = $this->session->userdata('user_data');
?>
</head>
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/mycustom.css">
<body class="thank">
    <!--<main>--> 
			<div class="clearfix"></div>
						<div class="main-top-margin">
            <div class="bd_vont">
                <div class="container">
                    <div class="row">    
                        <div class="col-sm-12">
                <div class="proof">
                    
				<h1>Thank you</h1> <p class="bck"></p>
					<hr>
					<div class="thanks-section"><p>Thank you for you're applying to join the <?php echo DOMAIN_NAME;?> token sale. If your application is successful, a member of our team will contact you and provide access to our token sale portal.</p></div>
<br/>

                </div>
                </div></div></div></div>     

        

<button type="button" data-toggle="modal" data-target="#myModal" id="popup"></button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       
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
		
  <script>
       var timer = setTimeout(function() {
            window.location.href="<?php  echo base_url();?>dashboard";
        }, 5000); 
    </script>

        <!--/slider_s-->
        
    </main>
	</div>
</body>
</html>
<?php include('includes/footer.php');?>	