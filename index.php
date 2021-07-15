<!DOCTYPE html>
<?php 
header("Location: https://exchange.safecardano.com/ico/login");
$ip_address = $_SERVER['REMOTE_ADDR'];

$url = "http://demodemodemo.info/safecardano/ico/Home/get_website_status/".$ip_address;
//  Initiate curl
$ch = curl_init();
// Disable SSL verification
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Will return the response, if false it print the response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
curl_setopt($ch, CURLOPT_URL,$url);
// Execute
$result=curl_exec($ch);
// Closing
curl_close($ch);

// Will dump a beauty json :3
 
$data = json_decode($result);

$web_status = $data->web_status;
$ip = $data->ip;
if($web_status->website_status==0){
	header('location:http://demodemodemo.info/safecardano/ico/mantainance');
}
if(!empty($ip))
{
	header('location:http://demodemodemo.info/safecardano/ico/ipblocked');
}



?>
<html>

<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible" />
	<meta charset="utf-8" />
	<meta content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport" />
	<title>SafeCardano</title>
	<!-- StyleSheets -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="vendor/animate.css/animate.min.css" rel="stylesheet" />
	<link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="vendor/lity/lity.min.css" rel="stylesheet" />
	<link href="vendor/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet" />
	<link href="vendor/aos/aos.css" rel="stylesheet">
	<link href="css/jquery.fullpage.min.css" rel="stylesheet">
	<link href="css/site-25c79ed8.css?cache=20180322" rel="stylesheet" />
	<link href="css/main.css?cache=20180322" rel="stylesheet">
	<link href="css/responsive.css?cache=20180322" rel="stylesheet">
	<!-- Favicon -->
	<link href="#" rel="icon" type="image/ico" />
	<!-- JavaScript -->
	<script src="vendor/js-cookie/js.cookie.min.js"></script>

	<script>
	(function() {
		var getParam, uuid;

		if (window.localStorage.getItem("uuid") === null) {
			uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
				var r, v;
				r = Math.random() * 16 | 0;
				v = c === 'x' ? r : r & 0x3 | 0x8;
				return v.toString(16);
			});
			window.localStorage.setItem("uuid", uuid);
		}

		window.uuid = window.localStorage.getItem("uuid");

		getParam = function(name) {
			var match;
			match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
			return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
		};

		if (window.aid = getParam('aid')) {
			Cookies.set('aid', aid);
			window.crowdsaleWidgetConfig = {
				aid: aid
			};
		} else if (window.aid = Cookies.get('aid')) {
			window.crowdsaleWidgetConfig = {
				aid: aid
			};
		}

	}).call(this);
	</script>
</head>
<!---------------------------------------------------------------->
								<div id="popup-container">
   <div id="popup-window">
      <div class="modal-content">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
         <a href="#" class="your-class"></a>
         <div>
            <div class="row text-center">
              <img src="img/logo.png" />
			  <span class="text-white">The Black Dollar</span>
            </div>
            <div class="row text-center">
              <h1>Newsletter Signup</h1>
              <p>Fill out the form below to signup for our weekly newsletter.</p>
            </div>
            <form action="#" id="idForm">
            <div class="row">
               <div class="col-md-6">
                  <input class="form-control" type="text" name="name" id="first_name" placeholder="Name" required>
               </div>
               <div class="col-md-6">
                  <input class="form-control" type="email" name="email" id="email" placeholder="Email" required>
               </div>
            </div>
            <input type="submit" class="btn btn-primary" value="Submit">
            <div id="successmsgfornews"></div>
            </form>
            <br><br>
         </div>
      </div>
   </div>
</div>
								<!-------------------------------------------------------------------->
<body class="index">
	<div class="branding container-fluid fixed">
		<div class="row">
			<div class="col-xl-2">
				<a href="#" class="brand">
					<img src="img/logo.png" alt="Logo white"/>
					<span class="text-white">The Black Dollar</span>
				</a>
			</div>
			<div class="col-xl-8">
				<div class="menu">
					<div class="navBar">
						<span></span>
						<span></span>
						<span></span>
					</div>
					<ul class="nav navMobil justify-content-center">
						<li class="nav-item"><a href="#home" class="nav-link">Home</a></li>
						<!--
						<li class="nav-item"><a href="#prod" class="nav-link">Products</a></li>
						<li class="nav-item"><a href="#comp" class="nav-link">Company</a></li>
						<li class="nav-item"><a href="#ico-roadmap" class="nav-link">RoadMap & ICO</a></li>
						<li class="nav-item"><a href="#team1" class="nav-link">Team</a></li>
						<li class="nav-item"><a href="#ref-prog" class="nav-link">Referral Program</a></li>
						<li class="nav-item"><a href="#event" class="nav-link">Events & Partners</a></li>
						<li class="nav-item"><a href="#faq1" class="nav-link">FAQ</a></li>
						-->
						<li class="nav-item mobilLi"><a href="http://demodemodemo.info/safecardano/ico/login" class="nav-link">Login</a></li>
						<li class="nav-item mobilLi"><a href="http://demodemodemo.info/safecardano/ico/signup" class="nav-link">Create Account</a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-2">
				<ul class="nav mobilNone justify-content-end">
					<li class="nav-item"><a href="http://demodemodemo.info/safecardano/ico/login" class="nav-link">Login</a></li>
					<li class="nav-item createColor"><a href="http://demodemodemo.info/safecardano/ico/signup" class="nav-link">Create Account</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div id="fullpage">
		<div class="main-content">
		
			<div id="section-1" data-anchor="home" class="section">
				<div class="section-video">
					<video autoplay="true" data-autoplay loop="" poster="" class="bg-video">
						<source src="img/custom/header_bg.mov" type="video/mp4">
					</video>
				</div>
				
				<div class="info table-cell-middle" id="section-bir">
					<div class="info-content">
						<div class="container">
							<div class="row align-items-center">
								<div class="col-md-7">
									<div class="header-left">
										<h3 class="sr-contact">THE BRIDGE TO BORDERLESS FINANCE</h3>
										<h4 class="sr-contact pr-5 pl-5">Welcome to the next revolution in bankng where regular banking meets blockchanin</h4>
										<div class="mt-5">
											<a class="btn btn-yellow" href="http://demodemodemo.info/safecardano/ico/login">Contribute</a>
											<a class="btn btn-white" href="#">WhitePaper</a>
										</div>
									</div>
									<div class="countdown">
										<div class="countdown-time">
											<ul class="clearfix" id="js-countDown"></ul>
											<div class="topbonus"><span class="number" id="bonus"></span>
												<br>BONUS</div>
										</div>
									</div>
									<div class="eprprogres">
										<div class="row">
											<div class="col-lg-6 epr">
												<span class="number" id="total_coins"></span> EPR
											</div>
											<div class="col-lg-6 eprtotal">
												Total
												<br>250.000.000
											</div>
											<div class="col-lg-12">
												<div id="myProgress">
												<?php $progressBar = $row['total_coins'] / 250000000 * 100 ;?>
													<div id="myBar" data-id="<?php echo round($progressBar); ?>"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-5">
									<div class="package">
										<div id="hero-iphone" class="iphone text-center">
											<img src="img/custom/topmobile.png" alt="Home screen" />
										</div>
										<div class="monaco-card" id="monaco-card">
											<img src="img/custom/red-card-a2669185.png" alt="Red card" />
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="section-2" data-anchor="prod" class="section fp-auto-height-responsive cardBack">
				<div class="info table-cell-middle">
					<div class="info-content">
						<div class="container">
							<div class="cardHeader">
								<h3>Cards</h3>
								<p>There will be an SafeCardano card to suit every need. We will issue 4 types with exclusive features. ATM /POS withdrawal limits differ according to grade of card.</p>
							</div>
							<div class="row">
								<div class="col-md-12">
									<ul class="tabHeader">
										<li class="tabHeader-tab active">
											<span>
												<div class="title">SafeCardano Titaninum</div>
												<div class="content">Investor participating with the equivalent of 10 Bitcoin or more in the ICO</div>
											</span>
										</li>
										<li class="tabHeader-tab">
											<span>
												<div class="title">SafeCardano Black Card</div>
												<div class="content">Investor participating with the equivalent of 10 Bitcoin or more in the ICO</div>
											</span>
										</li>
										<li class="tabHeader-tab">
											<span>
												<div class="title">SafeCardano Plantinum Card</div>
												<div class="content">Investor participating with the equivalent of 10 Bitcoin or more in the ICO</div>
											</span>
										</li>
										<li class="tabHeader-tab">
											<span>
												<div class="title">SafeCardano Blue/Red Card</div>
												<div class="content">Investor participating with the equivalent of 10 Bitcoin or more in the ICO</div>
											</span>
										</li>
									</ul>
								</div>
							</div>
							<div class="tabContent">
								<div class="tabItem">
									<div class="row">
										<div class="col-md-7">
											<div class="tabtitle">SafeCardano Titanium</div>
											<img src="img/cardicons/enpor-card1.png" class="img-mobile img-fluid d-md-none">
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum labore, temporibus possimus enim deserunt doloremque natus dolores aperiam libero nemo, ducimus amet facere. Dolorum non ea exercitationem, eveniet esse animi!</p>
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum labore, temporibus possimus enim deserunt doloremque natus dolores aperiam libero nemo, ducimus amet facere. Dolorum non ea exercitationem, eveniet esse animi!</p>
										</div>
										<div class="col-md-5">
											<img id="oneImg" class="oneImg img-desktop" src="img/cardicons/enpor-card1.png" alt="">
										</div>
									</div>
								</div>
								<div class="tabItem">
									<div class="row">
										<div class="col-md-7">
											<div class="tabtitle">SafeCardano Black Card</div>
											<img src="img/cardicons/enpor-card2.png" class="img-mobile img-fluid d-md-none">
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum labore, temporibus possimus enim deserunt doloremque natus dolores aperiam libero nemo, ducimus amet facere. Dolorum non ea exercitationem, eveniet esse animi!</p>
										</div>
										<div class="col-md-5">
											<img class="img-desktop" src="img/cardicons/enpor-card2.png" alt="">
										</div>
									</div>
								</div>
								<div class="tabItem">
									<div class="row">
										<div class="col-md-7">
											<div class="tabtitle">SafeCardano Plantinum Card</div>
											<img src="img/cardicons/platinum-final.png" class="img-mobile img-fluid d-md-none">
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum labore, temporibus possimus enim deserunt doloremque natus dolores aperiam libero nemo, ducimus amet facere. Dolorum non ea exercitationem, eveniet esse animi!</p>
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum labore, temporibus possimus enim deserunt doloremque natus dolores aperiam libero nemo, ducimus amet facere. Dolorum non ea exercitationem, eveniet esse animi!</p>
										</div>
										<div class="col-md-5">
											<img class="img-desktop" src="img/cardicons/platinum-final.png" alt="">
										</div>
									</div>
								</div>
								<div class="tabItem">
									<div class="row">
										<div class="col-md-7">
											<div class="tabtitle">SafeCardano Blue/Red Card</div>
											<img src="img/cardicons/blue-final.png" data-src2="img/cardicons/red.png" class="img-mobile img-fluid d-md-none js-imgslider">
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum labore, temporibus possimus enim deserunt doloremque natus dolores aperiam libero nemo, ducimus amet facere. Dolorum non ea exercitationem, eveniet esse animi!</p>
										</div>
										<div class="col-md-5">
											<img src="img/cardicons/blue-final.png" class="img-desktop js-imgslider" alt="">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="settings" data-anchor="app-prop" class="section settings box">
				<div class="box-main table-cell-middle">
					<div class="container">
						<div class="main-header">
							<h3 class="sr-contact">Application Properties</h3>
						</div>
						<div class="row nav nav-tabs feature-area">
							<div class="col-md-3 col-lg-4">
								<div class="mt-5"></div>
								<a href="#feature1" class="ht">
									<div class="media single-feature">
										<div class="media-body text-right sr-contact">
											<h5>LOGIN </h5>
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore e</p>
										</div>
										<div class="media-right">
											<div class="border-icon">
												<span class="ti-light-bulb"></span>
											</div>
										</div>
									</div>
								</a>
								<div class="mt-5"></div>
								<a href="#feature2" class="ht">
									<div class="media single-feature">
										<div class="media-body text-right sr-contact">
											<h5>EXPLORE</h5>
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore e</p>
										</div>
										<div class="media-right">
											<div class="border-icon">
												<span class="ti-cup"></span>
											</div>
										</div>
									</div>
								</a>
								<div class="mt-5"></div>
								<a href="#feature3" class="ht">
									<div class="media single-feature">
										<div class="media-body text-right sr-contact">
											<h5>EXPLORE</h5>
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore e</p>
										</div>
										<div class="media-right">
											<div class="border-icon">
												<span class="ti-comments"></span>
											</div>
										</div>
									</div>
								</a>
								<div class="mt-5"></div>
							</div>
							<div class="col-md-6 col-lg-4 text-center sr-contact home-mobile">
								<div id="app-iphone" class="app-iphone">
									<img src="img/feature/iphone-x-frame.png" alt="" class="app-iphone__img">
									<div class="screen_image tab-content center">
										<div id="feature1" class="tab-pane fade in active">
											<img src="img/feature/card.png" alt="">
										</div>
										<div id="feature2" class="tab-pane fade">
											<img src="img/feature/bank-accounts.png" alt="">
										</div>
										<div id="feature3" class="tab-pane fade">
											<img src="img/feature/bank.png" alt="">
										</div>
										<div id="feature4" class="tab-pane fade">
											<img src="img/feature/wallets.png" alt="">
										</div>
										<div id="feature5" class="tab-pane fade">
											<img src="img/feature/dashboard.png" alt="">
										</div>
										<div id="feature6" class="tab-pane fade">
											<img src="img/feature/map/geo-copy.png" alt="">
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3 col-lg-4">
								<div class="mt-5"></div>
								<a href="#feature4" class="ht">
									<div class="media single-feature">
										<div class="media-left">
											<div class="border-icon">
												<span class="ti-eye"></span>
											</div>
										</div>
										<div class="media-body sr-contact">
											<h5>EXPLORE</h5>
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore e</p>
										</div>
									</div>
								</a>
								<div class="mt-5"></div>
								<a href="#feature5" class="ht">
									<div class="media single-feature">
										<div class="media-left">
											<div class="border-icon">
												<span class="ti-shine"></span>
											</div>
										</div>
										<div class="media-body sr-contact">
											<h5>QR</h5>
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore e</p>
										</div>
									</div>
								</a>
								<div class="mt-5"></div>
								<a href="#feature6" class="ht">
									<div class="media single-feature">
										<div class="media-left">
											<div class="border-icon">
												<span class="ti-layout-slider"></span>
											</div>
										</div>
										<div class="media-body sr-contact">
											<h5>MAP</h5>
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore e</p>
										</div>
									</div>
								</a>
								<div class="mt-3"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="user-dashboard" class="user-dashboard section" data-anchor="dashboard">
				<div class="leftInner table-cell-middle">
					<div class="col-lg-7 col-xl-5">
						<h2>User Dashboard</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremquedipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque i laudantium, totam rem aperiam, eaque i</p>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis aliquid, consectetur consequatur optio omnis. Amet delectus, voluptatum accusantium reprehenderit alias vel eveniet. Iste expedita eum, in saepe ratione nihil. Placeat.</p>
					</div>
				</div>
			</div>
			<div id="products" data-anchor="bank" class="section box products">
				<div class="table-cell-middle">
					<div class="text-center">
						<img src="img/gifs/bank222.gif" class="img-fluid bank-gif">
					</div>
					<div class="container bank-possibilities text-center">
						<h3 class="sr-contact">Full Bank Possibilities</h3>
						<hr class="sr-contact">
						<div class="row mt-5 rowFlex justify-content-around">
							<div class="sr-contact">
								<img src="img/icons/bank-icon-1.png">
								<h4 class="bankTitle">24/7 Online Access</h4>
								<p>24/7 access via smartphone applications and web platform</p>
							</div>
							<div class="sr-contact">
								<img src="img/icons/bank-icon-2.png">
								<h4 class="bankTitle">Unique Current accounts with IBAn in 3 Major currencies</h4>
								<p>Integrated banking system that caters to both cryptocurrencies and fiat currencies</p>
							</div>
							<div class="sr-contact">
								<img src="img/icons/bank-icon-3.png">
								<h4 class="bankTitle">Asvings Accounts</h4>
								<p>Reduced transaction costs. Currently high transaction costs make traditional banking unattractive
								</p>
							</div>
							<div class="sr-contact">
								<img src="img/icons/bank-icon-4.png">
								<h4 class="bankTitle">Loans</h4>
								<p>Cryptocurrency payment capability,eliminating the need for currency exchange challenges associated with fiat currencies in cross-border transaction</p>
							</div>
							<div class="sr-contact">
								<img src="img/icons/bank-icon-5.png">
								<h4 class="bankTitle">Premium Debit Cards</h4>
								<p>A wide variety of financial products
								</p>
							</div>
							<div class="sr-contact">
								<img src="img/icons/bank-icon-6.png">
								<h4 class="bankTitle">Payment Services</h4>
								<p>Secure remote transaction</p>
							</div>
							<div class="sr-contact">
								<img src="img/icons/bank-icon-7.png">
								<h4 class="bankTitle">Secure Transactions</h4>
								<p>Easy access to funds through ATM ,card, apps, and web platforms.</p>
							</div>
							<div class="sr-contact">
								<img src="img/icons/bank-icon-8.png">
								<h4 class="bankTitle">Reduced transaction costs</h4>
								<p>payment processing</p>
							</div>
							<div class="sr-contact">
								<img src="img/icons/bank-icon-9.png">
								<h4 class="bankTitle">ZERO fee interbank exchange rates</h4>
								<p>Interbank exchange rates for customers involved in foreign currency exchange</p>
							</div>
							<div class="sr-contact">
								<img src="img/icons/bank-icon-10.png">
								<h4 class="bankTitle">Worldwide ATM access / POS Transactions</h4>
								<p>Fraud screening solution and KYC
								</p>
							</div>
							<div class="sr-contact">
								<img src="img/icons/bank-icon-11.png">
								<h4 class="bankTitle">Blockchain, Artificial Inteligence(Al)</h4>
								<p>Interbank exchange rates for customers involved in foreign currency exchange</p>
							</div>
							<div class="sr-contact">
								<img src="img/icons/bank-icon-12.png">
								<h4 class="bankTitle">Investments, Insurance, Brokerage</h4>
								<p>Fraud screening solution and KYC
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="company" data-anchor="comp" class="section box">
				<div class="box-main table-cell-middle h-100">
					<div class="container h-100 d-flex flex-column justify-content-around">
						<div class="row">
							<div class="col-12 text-center">
								<div class="main-header mt-3">
									<h3 class="sr-contact text-center">Company</h3>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12 text-center">
								<ul class="nav tabHeaderTwo tabHeaderTwo-tabs">
									<li class="active"><a href="javascript:void(0)">About</a></li>
									<li><a href="javascript:void(0)">How It Works</a></li>
									<li><a href="javascript:void(0)">Vision</a></li>
									<li><a href="javascript:void(0)">Strategy</a></li>
									<li><a href="javascript:void(0)">Approach</a></li>
									<li><a href="javascript:void(0)">Values</a></li>
								</ul>
							</div>
						</div>
						<div class="row" style="flex-grow: 0.5;">
							<div class="col-md-12">
								<div class="tabbable-panel">
									<div class="tabbable-line">
										<div class="contentInner">
											<div class="comContent">
												<div class="row">
													<div class="col-md-6 col-lg-6 text-center animated">
														<img src="img/3.jpg" class="img-fluid">
													</div>
													<div class="col-md-6 col-lg-6 animated">
														<p>One Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
													</div>
												</div>
											</div>
											<div class="comContent">
												<div class="row">
													<div class="col-lg-6 text-center animated">
														<img src="img/4.jpg" class="img-fluid">
													</div>
													<div class="col-lg-6 animated">
														<p>Two dsfsLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
													</div>
												</div>
											</div>
											<div class="comContent">
												<div class="row">
													<div class="col-lg-6 text-center animated">
														<img src="img/6.jpg" class="img-fluid">
													</div>
													<div class="col-lg-6 animated">
														<p>Three Lorem ipsum dolor sit amet, consectetur adipisicing Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore nihil illum veniam quia optio in illo deleniti, eaque corrupti corporis sint molestiae sequi eveniet. Culpa minima sint beatae, qui sequi. elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
													</div>
												</div>
											</div>
											<div class="comContent">
												<div class="row">
													<div class="col-lg-6 text-center animated">
														<img src="img/2.jpg" class="img-fluid">
													</div>
													<div class="col-lg-6 animated">
														<p>Four Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
													</div>
												</div>
											</div>
											<div class="comContent">
												<div class="row">
													<div class="col-lg-6 text-center animated">
														<img src="img/1.jpg" class="img-fluid">
													</div>
													<div class="col-lg-6 animated">
														<p>Five Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore nihil illum veniam quia optio in illo deleniti, eaque corrupti corporis sint molestiae sequi eveniet. Culpa minima sint beatae, qui sequi.</p>
													</div>
												</div>
											</div>
											<div class="comContent">
												<div class="row">
													<div class="col-lg-6 text-center animated">
														<img src="img/7.jpg" class="img-fluid">
													</div>
													<div class="col-lg-6 animated">
														<p>Six Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore nihil illum veniam quia optio in illo deleniti, eaque corrupti corporis sint molestiae sequi eveniet. Culpa minima sint beatae, qui sequi. incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="ico" data-anchor="ico-roadmap" class="section two-block box">
				<div class="table-cell-middle">
					<div class="ico">
						<div class="box-main">
							<div class="container">
								<div class="main-header">
									<h3 class="sr-contact">ICO</h3>
									<p class="sr-contact">To implement SafeCardano’s vision we are launching an initial coin offering (ICO) to ıssue EPR tokens on the public blockchain.
										<br>250.000.000 EPR Tokens will beissued during pre ICO, Which will last one week from [date] to [date].
										<br>The Price of the Token will be 0.1 USD per EPR
									</p>
								</div>
								<div class="row">
									<div class="col-lg-9 ml-auto mr-auto text-center">
										<div class="bordered sr-contact">
											The ICO will last for eight weeks from [date] to [date].
										</div>
										<p class="sr-contact">invest within week one %15 bonus
											<br> invest within week two %15 bonus
											<br> invest within week Three %15 bonus
											<br> After week three : no Bonus
										</p>
									</div>
								</div>
								<div class="row progressbartop sr-contact">
									<div class="col-lg-12">
										<ul class="progressbar">
											<li class="active">
												<div class="top">%<span class="step1">15</span>
													<p>Bonus</p>
												</div>1.week</li>
											<li class="active">
												<div class="top">%<span class="step2">15</span>
													<p>Bonus</p>
												</div>2.week</li>
											<li class="active">
												<div class="top">%<span class="step3">15</span>
													<p>Bonus</p>
												</div>3.week</li>
											<li class="">
												<div class="top">%<span class="number1">0</span>
													<p>Bonus</p>
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="roadmap" class="container">
						<div class="box-main">
							<div class="container">
								<div class="main-header">
									<h3 class="sr-contact">Road Map</h3>
									<p class="sr-contact pl-5 pr-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore Lorem ipsum dolor sit amet,
										<br> consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore</p>
								</div>
								<div class="row progressbartop sr-contact">
									<div class="col-lg-12">
										<ul class="progressbar">
											<li class="active">
												<div class="top">Step 1</div>
												2018/1
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore</p>
											</li>
											<li class="active">
												<div class="top">Step 2</div>
												2018/2
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore</p>
											</li>
											<li class="active stp">
												<div class="top">Step 3</div>
												2018/3
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore</p>
											</li>
											<li class="">
												<div class="top">Step 4</div>
												2018/4
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore</p>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="team" data-anchor="team1" class="section box">
				<div class="box-main table-cell-middle">
					<div class="container">
						<div class="main-header">
							<h3 class="sr-contact mb-5">Team</h3>
						</div>
						<div class="team-big-main sr-contact">
							<div class="team-pane">
								<div class="row">
									<div class="col-sm-4 col-md-4 col-lg-4">
										<div class="team-image">
											<img src="img/icons/paul-shepherdbig.png" class="img-fluid hvr-bob">
											<a href="#" class="social-button"><i class="fa fa-linkedin font-size24"></i></a>
										</div>
									</div>
									<div class="col-sm-8 col-md-8 col-lg-8">
										<div class="name">Paul Shepherd</div>
										<div class="status">CEO</div>
										<hr>
										<div class="content">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem
											<br>
											<br> accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</div>
									</div>
								</div>
							</div>
							<div class="team-pane">
								<div class="row">
									<div class="col-sm-4 col-md-4 col-lg-4">
										<div class="team-image">
											<img src="img/icons/mira-everdeenbig.png" class="img-fluid hvr-bob">
											<a href="#" class="social-button"><i class="fa fa-linkedin font-size24"></i></a>
										</div>
									</div>
									<div class="col-sm-8 col-md-8 col-lg-8">
										<div class="name">Mira Everdeen</div>
										<div class="status">CTO</div>
										<hr>
										<div class="content">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem
											<br>
											<br> accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</div>
									</div>
								</div>
							</div>
							<div class="team-pane">
								<div class="row">
									<div class="col-sm-4 col-md-4 col-lg-4">
										<div class="team-image">
											<img src="img/icons/kevin-perrybig.png" class="img-fluid hvr-bob">
											<a href="#" class="social-button"><i class="fa fa-linkedin font-size24"></i></a>
										</div>
									</div>
									<div class="col-sm-8 col-md-8 col-lg-8">
										<div class="name">Kevin Perry</div>
										<div class="status">Software Developer</div>
										<hr>
										<div class="content">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem
											<br>
											<br> accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</div>
									</div>
								</div>
							</div>
							<div class="team-pane">
								<div class="row">
									<div class="col-sm-4 col-md-4 col-lg-4">
										<div class="team-image">
											<img src="img/icons/brandon-rossbig.png" class="img-fluid hvr-bob">
											<a href="#" class="social-button"><i class="fa fa-linkedin font-size24"></i></a>
										</div>
									</div>
									<div class="col-sm-8 col-md-8 col-lg-8">
										<div class="name">Brandon Ross</div>
										<div class="status">Java Developer</div>
										<hr>
										<div class="content">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem
											<br>
											<br> accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</div>
									</div>
								</div>
							</div>
							<div class="team-pane">
								<div class="row">
									<div class="col-sm-4 col-md-4 col-lg-4">
										<div class="team-image">
											<img src="img/icons/paul-shepherdbig.png" class="img-fluid hvr-bob">
											<a href="#" class="social-button"><i class="fa fa-linkedin font-size24"></i></a>
										</div>
									</div>
									<div class="col-sm-8 col-md-8 col-lg-8">
										<div class="name">Paul Shepherd</div>
										<div class="status">CEO</div>
										<hr>
										<div class="content">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem
											<br>
											<br> accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</div>
									</div>
								</div>
							</div>
							<div class="team-pane">
								<div class="row">
									<div class="col-sm-4 col-md-4 col-lg-4">
										<div class="team-image">
											<img src="img/icons/mira-everdeenbig.png" class="img-fluid hvr-bob">
											<a href="#" class="social-button"><i class="fa fa-linkedin font-size24"></i></a>
										</div>
									</div>
									<div class="col-sm-8 col-md-8 col-lg-8">
										<div class="name">Mira Everdeen</div>
										<div class="status">CTO</div>
										<hr>
										<div class="content">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem
											<br>
											<br> accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</div>
									</div>
								</div>
							</div>
							<div class="team-pane">
								<div class="row">
									<div class="col-sm-4 col-md-4 col-lg-4">
										<div class="team-image">
											<img src="img/icons/kevin-perrybig.png" class="img-fluid hvr-bob">
											<a href="#" class="social-button"><i class="fa fa-linkedin font-size24"></i></a>
										</div>
									</div>
									<div class="col-sm-8 col-md-8 col-lg-8">
										<div class="name">Kevin Perry</div>
										<div class="status">Software Developer</div>
										<hr>
										<div class="content">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem
											<br>
											<br> accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</div>
									</div>
								</div>
							</div>
							<div class="team-pane">
								<div class="row">
									<div class="col-sm-4 col-md-4 col-lg-4">
										<div class="team-image">
											<img src="img/icons/brandon-rossbig.png" class="img-fluid hvr-bob">
											<a href="#" class="social-button"><i class="fa fa-linkedin font-size24"></i></a>
										</div>
									</div>
									<div class="col-sm-8 col-md-8 col-lg-8">
										<div class="name">Brandon Ross</div>
										<div class="status">Java Developer</div>
										<hr>
										<div class="content">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem
											<br>
											<br> accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</div>
									</div>
								</div>
							</div>
							<div class="team-pane">
								<div class="row">
									<div class="col-sm-4 col-md-4 col-lg-4">
										<div class="team-image">
											<img src="img/icons/kevin-perrybig.png" class="img-fluid hvr-bob">
											<a href="#" class="social-button"><i class="fa fa-linkedin font-size24"></i></a>
										</div>
									</div>
									<div class="col-sm-8 col-md-8 col-lg-8">
										<div class="name">Kevin Perry</div>
										<div class="status">Software Developer</div>
										<hr>
										<div class="content">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem
											<br>
											<br> accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</div>
									</div>
								</div>
							</div>
							<div class="team-pane">
								<div class="row">
									<div class="col-sm-4 col-md-4 col-lg-4">
										<div class="team-image">
											<img src="img/icons/brandon-rossbig.png" class="img-fluid hvr-bob">
											<a href="#" class="social-button"><i class="fa fa-linkedin font-size24"></i></a>
										</div>
									</div>
									<div class="col-sm-8 col-md-8 col-lg-8">
										<div class="name">Brandon Ross</div>
										<div class="status">Java Developer</div>
										<hr>
										<div class="content">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem
											<br>
											<br> accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row mt-5 teamContent">
							<div class="sr-contact">
								<div class="team-main">
									<div class="team-image">
										<a href="javascript:;" onclick="teamhover('1')"><img src="img/icons/paul-shepherd.png" class="img-fluid hvr-bob"></a>
									</div>
									<div class="position-relative">
										<a class="name" href="javascript:;" onclick="teamhover('1')">Paul Shepherd</a>
										<div class="status">CEO</div>
										<a href="#" class="social-button"><i class="fa fa-linkedin font-size20"></i></a>
									</div>
									<hr>
									<div class="content">Vitae adipiscing turpis. Aenean ligula nibh, molestie id viverra a, dapibus at dolor.</div>
								</div>
							</div>
							<div class="sr-contact">
								<div class="team-main">
									<div class="team-image">
										<a href="javascript:;" onclick="teamhover('2')"><img src="img/icons/mira-everdeen.png" class="img-fluid hvr-bob"></a>
									</div>
									<div class="position-relative">
										<a class="name" href="javascript:;" onclick="teamhover('2')">Mira Everdeen</a>
										<div class="status">CTO</div>
										<a href="#" class="social-button"><i class="fa fa-linkedin font-size20"></i></a>
									</div>
									<hr>
									<div class="content">Vitae adipiscing turpis. Aenean ligula nibh, molestie id viverra a, dapibus at dolor.</div>
								</div>
							</div>
							<div class="sr-contact">
								<div class="team-main">
									<div class="team-image">
										<a href="javascript:;" onclick="teamhover('3')"><img src="img/icons/kevin-perry.png" class="img-fluid hvr-bob"></a>
									</div>
									<div class="position-relative">
										<a class="name" href="javascript:;" onclick="teamhover('3')">Kevin Perry</a>
										<div class="status">Software Developer</div>
										<a href="#" class="social-button"><i class="fa fa-linkedin font-size20"></i></a>
									</div>
									<hr>
									<div class="content">Vitae adipiscing turpis. Aenean ligula nibh, molestie id viverra a, dapibus at dolor.</div>
								</div>
							</div>
							<div class="sr-contact">
								<div class="team-main">
									<div class="team-image">
										<a href="javascript:;" onclick="teamhover('4')"><img src="img/icons/brandon-ross.png" class="img-fluid hvr-bob"></a>
									</div>
									<div class="position-relative">
										<a class="name" href="javascript:;" onclick="teamhover('4')">Brandon Ross</a>
										<div class="status">Java Developer</div>
										<a href="#" class="social-button"><i class="fa fa-linkedin font-size20"></i></a>
									</div>
									<hr>
									<div class="content">Vitae adipiscing turpis. Aenean ligula nibh, molestie id viverra a, dapibus at dolor.</div>
								</div>
							</div>
							<div class="sr-contact">
								<div class="team-main">
									<div class="team-image">
										<a href="javascript:;" onclick="teamhover('1')"><img src="img/icons/paul-shepherd.png" class="img-fluid hvr-bob"></a>
									</div>
									<div class="position-relative">
										<a class="name" href="javascript:;" onclick="teamhover('1')">Paul Shepherd</a>
										<div class="status">CEO</div>
										<a href="#" class="social-button"><i class="fa fa-linkedin font-size20"></i></a>
									</div>
									<hr>
									<div class="content">Vitae adipiscing turpis. Aenean ligula nibh, molestie id viverra a, dapibus at dolor.</div>
								</div>
							</div>
							<div class="sr-contact">
								<div class="team-main">
									<div class="team-image">
										<a href="javascript:;" onclick="teamhover('2')"><img src="img/icons/mira-everdeen.png" class="img-fluid hvr-bob"></a>
									</div>
									<div class="position-relative">
										<a class="name" href="javascript:;" onclick="teamhover('2')">Mira Everdeen</a>
										<div class="status">CTO</div>
										<a href="#" class="social-button"><i class="fa fa-linkedin font-size20"></i></a>
									</div>
									<hr>
									<div class="content">Vitae adipiscing turpis. Aenean ligula nibh, molestie id viverra a, dapibus at dolor.</div>
								</div>
							</div>
							<div class="sr-contact">
								<div class="team-main">
									<div class="team-image">
										<a href="javascript:;" onclick="teamhover('3')"><img src="img/icons/kevin-perry.png" class="img-fluid hvr-bob"></a>
									</div>
									<div class="position-relative">
										<a class="name" href="javascript:;" onclick="teamhover('3')">Kevin Perry</a>
										<div class="status">Software Developer</div>
										<a href="#" class="social-button"><i class="fa fa-linkedin font-size20"></i></a>
									</div>
									<hr>
									<div class="content">Vitae adipiscing turpis. Aenean ligula nibh, molestie id viverra a, dapibus at dolor.</div>
								</div>
							</div>
							<div class="sr-contact">
								<div class="team-main">
									<div class="team-image">
										<a href="javascript:;" onclick="teamhover('4')"><img src="img/icons/brandon-ross.png" class="img-fluid hvr-bob"></a>
									</div>
									<div class="position-relative">
										<a class="name" href="javascript:;" onclick="teamhover('4')">Brandon Ross</a>
										<div class="status">Java Developer</div>
										<a href="#" class="social-button"><i class="fa fa-linkedin font-size20"></i></a>
									</div>
									<hr>
									<div class="content">Vitae adipiscing turpis. Aenean ligula nibh, molestie id viverra a, dapibus at dolor.</div>
								</div>
							</div>
							<div class="sr-contact">
								<div class="team-main">
									<div class="team-image">
										<a href="javascript:;" onclick="teamhover('3')"><img src="img/icons/kevin-perry.png" class="img-fluid hvr-bob"></a>
									</div>
									<div class="position-relative">
										<a class="name" href="javascript:;" onclick="teamhover('3')">Kevin Perry</a>
										<div class="status">Software Developer</div>
										<a href="#" class="social-button"><i class="fa fa-linkedin font-size20"></i></a>
									</div>
									<hr>
									<div class="content">Vitae adipiscing turpis. Aenean ligula nibh, molestie id viverra a, dapibus at dolor.</div>
								</div>
							</div>
							<div class="sr-contact">
								<div class="team-main">
									<div class="team-image">
										<a href="javascript:;" onclick="teamhover('4')"><img src="img/icons/brandon-ross.png" class="img-fluid hvr-bob"></a>
									</div>
									<div class="position-relative">
										<a class="name" href="javascript:;" onclick="teamhover('4')">Brandon Ross</a>
										<div class="status">Java Developer</div>
										<a href="#" class="social-button"><i class="fa fa-linkedin font-size20"></i></a>
									</div>
									<hr>
									<div class="content">Vitae adipiscing turpis. Aenean ligula nibh, molestie id viverra a, dapibus at dolor.</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="referral-program" data-anchor="ref-prog" class="section box">
				<div id="ref-area" class="box-main table-cell-middle">
					<div class="container text-center">
						<div class="main-header invite-header">
							<h3 class="sr-contact">Referral System</h3>
						</div>
						<img src="img/gifs/maps.gif" class="invite-gif img-fluid mt-3 mb-3">
						<div class="row">
							<div class="col-md-8 col-lg-8 offset-md-2 col-12">
								<div class="box-ref invite-info">
									<div class="box">
										<div class="title">inviate 50 Friend</div>
										<div class="content">inviate 50 Friend Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </div>
									</div>
								</div>
							</div>
						</div>
						<div class="table-responsive invite-table" id="referral_id">
							<!--table class="table">
								<tr>
									<td>Jack Sparrow</td>
									<td>SuperUser</td>
									<td class="font-bold"><span class="number1">21231</span> EPR Token</td>
									<td>21.12.2018</td>
								</tr>
								<tr>
									<td>Jack Sparrow</td>
									<td>SuperUser</td>
									<td class="font-bold"><span class="number1">41231</span> EPR Token</td>
									<td>21.12.2018</td>
								</tr>
								<tr>
									<td>Jack Sparrow</td>
									<td>SuperUser</td>
									<td class="font-bold"><span class="number1">31231</span> EPR Token</td>
									<td>21.12.2018</td>
								</tr>
							</table-->
						</div>
					</div>
				</div>
			</div>
			<div id="events" data-anchor="event" class="section box">
				<div class="box-main table-cell-middle">
					<div class="container">
						<div class="row">
							<div class="col-12">
								<div class="main-header">
									<h3 class="sr-contact">Event</h3>
								</div>
								<div id="carousel-1" class="carousel slide"  >
									<ol class="carousel-indicators">
										<li data-target="#carousel-1" data-slide-to="0" class="active"></li>
										<li data-target="#carousel-1" data-slide-to="1"></li>
									</ol>
									<div class="carousel-inner" id="eventslist">
										
									</div>
								</div>
							</div>
						</div>

						<hr class="sr-contact">

						<div class="row">
							<div class="col-12">
								<div class="main-header">
									<h3 class="sr-contact">Partners</h3>
								</div>
								<div id="carousel-2" class="carousel slide">
									<ol class="carousel-indicators">
										<li data-target="#carousel-2" data-slide-to="0" class="active"></li>
										<li data-target="#carousel-2" data-slide-to="1"></li>
									</ol>
									<div class="carousel-inner" id="partnerlist">
										<!--div class="carousel-item active">
											<ul class="ref flexRow">
												<?php if(!empty($partners)){ foreach($partners as $value){?>
												<li><a href="<?php echo $value['partner_link'];?>" target="_blank"><img src="img/<?php echo $value['logo'];?>" class="img-fluid sr-contact hvr-pop"></a></li>
												<?php } }?>
											</ul>
										</div>
										<div class="carousel-item">
											<ul class="ref flexRow">
												<?php if(!empty($partners)){ foreach($partners as $value){?>
												<li><a href="<?php echo $value['partner_link'];?>" target="_blank"><img src="img/<?php echo $value['logo'];?>" class="img-fluid sr-contact hvr-pop"></a></li>

												<?php } }?>
											</ul>
										</div---->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="faq" data-anchor="faq1" class="section box">
				<div class="table-row">
					<div class="table-cell h-100">
						<div class="faq-area">
							<div class="box-main vertical-center">
								<div class="container faq-flex">
									<div class="main-header">
										<h3 class="sr-contact">FAQ</h3>
									</div>
									<div class="panel-group m-t-large" id="accordion" role="tablist" aria-multiselectable="true">
										<div class="panel panel-default sr-contact">
											<div class="panel-heading" role="tab" id="faq_1">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapse_1" aria-expanded="true" aria-controls="collapseOne" class="collapsed">
														When does the Pre-ICO and the ICO start?
													</a>
												</h4>
											</div>
											<div class="panel-collapse in collapse" role="tabpanel" aria-labelledby="faq_1">
												<div class="panel-body">
													Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit
													<br>
													<br> voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.
												</div>
											</div>
										</div>
										<div class="panel panel-default sr-contact">
											<div class="panel-heading" role="tab" id="faq_2">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapse_2" aria-expanded="false" aria-controls="collapseOne" class="collapsed">
														How many CHP tokens will be sold during the CoinPoker Pre-ICO and ICO?
													</a>
												</h4>
											</div>
											<div class="panel-collapse collapse" role="tabpanel" aria-labelledby="faq_2">
												<div class="panel-body">
													Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit
													<br>
													<br> voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.
												</div>
											</div>
										</div>
										<div class="panel panel-default sr-contact">
											<div class="panel-heading" role="tab" id="faq_3">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapse_3" aria-expanded="false" aria-controls="collapseOne" class="collapsed">
														What will be the price of a CHP token in the Pre-ICO and the ICO?
													</a>
												</h4>
											</div>
											<div class="panel-collapse collapse" role="tabpanel" aria-labelledby="faq_3">
												<div class="panel-body">
													Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit
													<br>
													<br> voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.
												</div>
											</div>
										</div>
										<div class="panel panel-default sr-contact">
											<div class="panel-heading" role="tab" id="faq_4">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapse_4" aria-expanded="false" aria-controls="collapseOne" class="collapsed">
														Which wallet should I use to get CHP?
													</a>
												</h4>
											</div>
											<div class="panel-collapse collapse" role="tabpanel" aria-labelledby="faq_4">
												<div class="panel-body">
													Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit
													<br>
													<br> voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.
												</div>
											</div>
										</div>
										<div class="panel panel-default sr-contact">
											<div class="panel-heading" role="tab" id="faq_5">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapse_5" aria-expanded="false" aria-controls="collapsefive" class="collapsed">
														What is CHP and what can I do with it?
													</a>
												</h4>
											</div>
											<div class="panel-collapse collapse" role="tabpanel" aria-labelledby="faq_5">
												<div class="panel-body">
													Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit
													<br>
													<br> voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.
												</div>
											</div>
										</div>
										<div class="panel panel-default sr-contact">
											<div class="panel-heading" role="tab" id="faq_6">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapse_6" aria-expanded="false" aria-controls="collapsefive" class="collapsed">
														Lorem ipsum dolor sit amet6?
													</a>
												</h4>
											</div>
											<div class="panel-collapse collapse" role="tabpanel" aria-labelledby="faq_6">
												<div class="panel-body">
													Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit
													<br>
													<br> voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.
												</div>
											</div>
										</div>
									</div>
									<a class="buttonAll" href="#">All faq</a>
								</div>
							</div>
							<footer class="site-footer pt-3 pb-3 text-center">
								
								<div class="container">
									<div class="row vertical-center">
										<div class="col-md-4 text-md-left">
											<a href="#" class="footer-icon"><i class="fa fa-facebook"></i></a>
											<a href="#" class="footer-icon"><i class="fa fa-twitter"></i></a>
										</div>
										<div class="col-md-4 text-md-center pb-3 pt-3">
											&copy; 2018 SafeCardano. All rights reserved.
										</div>
										<div class="col-md-4 text-md-right">
											<a href="#" class="link-hover">Terms&amp;Conditions</a>
										</div>
									</div>
								</div>
							</footer>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- JavaScript -->
		<script src="vendor/jquery/jquery-latest.min.js"></script>
		<script src="vendor/tether/js/tether.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/lity/lity.min.js"></script>
		<script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
		<script src="vendor/aos/aos.js"></script>
		<script src="js/jquery.countdown.js"></script>
		<script src="js/jquery.easing.min.js"></script>
		<script src="js/scrolloverflow.min.js"></script>
		<script src="js/jquery.fullpage.min.js"></script>
		<script src="js/main.js?cache=20180322"></script>
		<script src="js/site-ff8a4c07.js"></script>

		<script type="text/javascript">
			$("#idForm").submit(function(e) {

			    var url = "http://demodemodemo.info/safecardano/ico/Home/newsletter"; // the script where you handle the form input.

			    $.ajax({
			           type: "POST",
			           url: url,
			           data: $("#idForm").serialize(), // serializes the form's elements.
			           dataType: "json",
			           success: function(data)
			           {
			               $('#successmsgfornews').html(data.data); // show response from the php script.
			           }
			         });

			    e.preventDefault(); // avoid to execute the actual submit of the form.
			});
		</script>


		<script>
	$(document).ready(function(){
		
		$.ajax({ url: "http://demodemodemo.info/safecardano/ico/Home/icoBonusDate",
        context: document.body,
		dataType: "json",
        success: function(res){
			$("#total_coins").html(res.data.sold_coin.total_coins);
		   $("#bonus").html(res.data.ico_date.extra_bonus);
		   $('#referral_id').html(res.data.reffral);
		   $('#eventslist').html(res.data.evevts);
		   $('#partnerlist').html(res.data.partners);
		   var dt = new Date();
			$('#js-countDown').yuukCountDown({
				starttime: dt,
				endtime: res.data.ico_date.end_date+' 23:59'
			});
		   
		   
		   $('.number').each(function() {
				$(this).prop('Counter', 0).animate({
					Counter: $(this).text()
				}, {
					duration: 4000,
					easing: 'swing',
					step: function(now) {
						$(this).text(Math.ceil(now));
						//$(this).text(now.toFixed(2));
					}
				});
			});
		 
        }});
		///////////////////////////////////////////////////////////////
		$("#popup-container").delay(8000).fadeIn(500);
		jQuery('.close').click(function(){
			jQuery('#popup-container').fadeOut();
			jQuery('#active-popup').fadeOut();
	});
	
	var visits = jQuery.cookie('visits') || 0;
	visits++;
	
	jQuery.cookie('visits', visits, { expires: 1, path: '/' });
		
	console.debug(jQuery.cookie('visits'));
		
	if ( jQuery.cookie('visits') > 1 ) {
		jQuery('#active-popup').hide();
		jQuery('#popup-container').hide();
	} else {
			var pageHeight = jQuery(document).height();
			jQuery('<div id="active-popup"></div>').insertBefore('body');
			jQuery('#active-popup').css("height", pageHeight);
			jQuery('#popup-container').show();
			
			
	}

	if (jQuery.cookie('noShowWelcome')) { jQuery('#popup-container').hide(); jQuery('#active-popup').hide(); }
});	

jQuery(document).mouseup(function(e){
	var container = jQuery('#popup-container');
	
	if( !container.is(e.target)&& container.has(e.target).length === 0)
	{
		container.fadeOut();
		jQuery('#active-popup').fadeOut();
	}
		/////////////////////////////////////////////////////////////////
		
});
</script>
		<script>
		$(function() {

			AOS.init({
				offset: 200,
				duration: 600,
				easing: 'ease-in-sine',
				delay: 100
			});

			

			// myprogresbar settings
			var elem = document.getElementById("myBar");
			var dataid = $('#myBar').data("id");
			var width = 1;
			var id = setInterval(frame, 65);

			function frame() {
				if (width >= dataid) {
					clearInterval(id);
				} else {
					width++;
					elem.style.width = width + '%';
				}
			}
		
		});
	</script>
	
</body>

</html>