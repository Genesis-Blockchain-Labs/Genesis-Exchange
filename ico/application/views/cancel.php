<?php include('includes/header.php');
$user_data = $this->session->userdata('user_data');
?>
	<style>
	.proof_tbl{
		width:50%;
		height:auto;
		align:center;
	}

	table, tr, td {
		border: 1px solid black;
		font-size: 17px;
		text-align: left;
	}
	.header-right {
		float: right;
		padding-right: 0;
		width: auto;
	}
	.proof {
		margin: 140px 0 0!important;
	}
	.bck {
		float: right;
	}
	.proof h1 {
		float: left;
		margin: 0;
	}
	.main-top-margin {
		margin-top: 0;
	}
	.thanks-section {
		float: left;
		width: 100%;
	}
	.proof hr {
		float: left;
		width: 100%;
	}
	.bck > a {
		background: #00b437 none repeat scroll 0 0;
		border-radius: 2px;
		color: #fff;
		height: 44px;
		padding: 8px 40px;
	}
	.thanks-section > p {
		color: #545454;
		font-size: 21px;
		text-align: center;
	}
	@media (max-width: 991px) {
	.top-menu a { padding: 2px 11px;}	
	.header-top-right .social-icons a { margin-right: 9px;}
	}

	@media (max-width: 768px) {
	.proof {
		margin: 40px 0 0!important;
	}
	.proof_tbl {
		height: auto;
		width: 100%;
	}
		.footer-top .col-sm-4 { 
		margin-bottom:40px;
	}
	}
	.bd_vont .proof > p {
		font-family: 'Source Sans Pro', sans-serif;
	}
	h1 {
		font-family: 'Source Sans Pro', sans-serif;
	}
	</style>
</head>
<body class="">
		<a href="<?php echo base_url()?>login" class="trs button top_menu_button">Proof of Confidence</a>                         
               
		<div class="clearfix"></div>
		<div class="main-top-margin">
            <div class="bd_vont">
                <div class="container">
                    <div class="row">    
                        <div class="col-sm-12">
							<div class="proof">
								<h1>Thank you</h1> 
								<p class="bck"><a href="reward">Back</a></p>
								<hr>
								<div class="thanks-section">
									<p>Your Payment is cancel.</p>
								</div>
								<br/>
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