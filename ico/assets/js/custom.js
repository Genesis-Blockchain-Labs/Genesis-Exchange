
jQuery(function($) {'use strict',

	//Menu Start
	$(document).ready(function() {
	
	  function toggleSidebar() {
		$(".button").toggleClass("active");
		$("main").toggleClass("move-to-left");
		$('body').toggleClass("move-menu-active");
		$(".sidebar-item").toggleClass("active");
	  }
	
	  $(".button").on("click tap", function() {
		toggleSidebar();
	  });
	
	  $(document).keyup(function(e) {
		if (e.keyCode === 27) {
		  toggleSidebar();
		}
	  });
	
	});

	//menu animation

	$(document).ready(function(){
	  // Add smooth scrolling to all links
	  $(".sidebar-list li a").on('click', function(event) {
	
		// Make sure this.hash has a value before overriding default behavior
		if (this.hash !== "") {
		  // Prevent default anchor click behavior
		  event.preventDefault();
	
		  // Store hash
		  var hash = this.hash;
	
		  // Using jQuery's animate() method to add smooth page scroll
		  // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
		  $('html, body').animate({
			scrollTop: $(hash).offset().top
		  }, 800, function(){
	   
			// Add hash (#) to URL when done scrolling (default click behavior)
			window.location.hash = hash;
		  });
		} // End if
	  });
	});

	$(document).ready(function(){
	  // Add smooth scrolling to all links
	  $(".logo-warp a").on('click', function(event) {
	
		// Make sure this.hash has a value before overriding default behavior
		if (this.hash !== "") {
		  // Prevent default anchor click behavior
		  event.preventDefault();
	
		  // Store hash
		  var hash = this.hash;
	
		  // Using jQuery's animate() method to add smooth page scroll
		  // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
		  $('html, body').animate({
			scrollTop: $(hash).offset().top
		  }, 800, function(){
	   
			// Add hash (#) to URL when done scrolling (default click behavior)
			window.location.hash = hash;
		  });
		} // End if
	  });
	});
	
	
	$(document).ready(function(){
	  // Add smooth scrolling to all links
	  $(".mouse-icon-a").on('click', function() {
		// Make sure this.hash has a value before overriding default behavior
		if (this.hash !== "") {
		  // Prevent default anchor click behavior
		  //event.preventDefault();
		  // Store hash
		  var hash = this.hash;
		  // Using jQuery's animate() method to add smooth page scroll
		  // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
		  $('html, body').animate({
			scrollTop: $(hash).offset().top
		  }, 800, function(){
			// Add hash (#) to URL when done scrolling (default click behavior)
			window.location.hash = hash;
		  });
		} // End if
	  });
	});


	//trigger menu
	
	$(".sidebar-anchor").on('click',function(){
		$(".button").trigger("click");
	});
	
	$(".close-menu").on('click',function(){
		$(".button").trigger("click");
	});
	
	$(".close-menu").on('click',function(){
		$(".navbar-toggle").trigger("click");
	});
					
	$(".sidebar-anchor").on('click',function(){
		$(".navbar-toggle").trigger("click");
	});				
	
					
	
	
	
	// menu scrol
	
	
	$(window).scroll(function() {
        if($(window).scrollTop()>50)
		{
			$('.header').css({
			   'background-color': '#000',
			   'border' : 'rgba(36,36,36,0.35)'
		    });
			
			$('.main-logo').css({
			   'width': '150px'
			});
			
			$('.logo-warp').css({
			   'margin-top': '8px'
			});
			
			$('.navbar-toggle').css({
				'margin-top' : '0px'	
			});
			
			$('.social-icons-svg').css({
				'width' : '30px'	
			});
			
			$('.navbar-nav>li>a').css({
				'padding-top' : '21px',
				'padding-bottom' : '20px'	
			});
			
			$('.header-top-right .social-icons').css({
				'padding': '17px 0 14px 20px'
			});
		}
		
		else
		{
			
			$('.header').css({
			   'background-color': 'transparent',
			   'border' : 'none',
		    });
			
			$('.main-logo').css({
				'width': '190px',
			});
			
			$('.social-icons-svg').css({
				'width' : '35px'	
			});
			
			$('.navbar-toggle').css({
				'margin-top' : '8px'	
			});
			
			$('.logo-warp').css({
			   'margin-top': '8px'
			});
			
			/* 	$('.navbar-nav>li>a').css({
				'padding-top' : '30px',
				'padding-bottom' : '15px'	
			}); */
			
			$('.header-top-right .social-icons').css({
				'padding': '27px 0px 26px 20px'	
			});
		}
    });
	
	// menu toggle icon
	
	$(document).ready(function(){
		$('#nav-icon1,#nav-icon2,#nav-icon3,#nav-icon4').click(function(){
			$(this).toggleClass('open');
		});
	});
	
	// time counter
	
	
	$('document').ready(function() {
        'use strict';
		
		var start = Date.parse('Wed Feb 20 19:20:00 +0000 2017')/1000;
		var end = Date.parse('Tue Jan 16 05:00:04 +0000 2018')/1000;
		var now = new Date().getTime('America/New_York') / 1000;  
		
    	$('.countdown').final_countdown({
            'start': start,
            'end': end,
            'now': now        
        });
    });
	
	// popUp video
	
	$('.custom-play-button').on('click', function() {
		//$('#popup-youtube-player').stopVideo();
		$('.videowrapper iframe')[0].contentWindow.postMessage('{"event":"command","func":"' + 'playVideo' + '","args":""}', '*');    
	});
	
		
	$('.close').on('click', function() {
		//$('#popup-youtube-player').stopVideo();
		$('.videowrapper iframe')[0].contentWindow.postMessage('{"event":"command","func":"' + 'pauseVideo' + '","args":""}', '*');    
	});
	
				
   //popup video height

    $('.videowrapper').css('height', $(window).height());
   		
	// background video				
			
	function playVideo() {
		var video=document.getElementById("video_background");
		video.width=window.innerWidth; 
		video.height=window.innerHeight;
	}	
					
    // window height
					
	if ($(window).width() < 767) { 

	}
	else {
		$('.window-height').css('min-height', $(window).height());	
		

	}
		
    // tabel coentent center
					
	$(function() {
		$('.table-content-center').css({
			'position' : 'absolute',
			'left' : '50%',
			'top' : '50%',
			'margin-left' : -$('.window-height').outerWidth()/2,
			'margin-top' : -$('.window-height').outerHeight()/2
		});
	});
					
	// ToolTip
					
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip();   
	});
	
//back to top
	
	if ($('#back-to-top').length) {
    var scrollTrigger = 100, // px
        backToTop = function () {
            var scrollTop = $(window).scrollTop();
            if (scrollTop > scrollTrigger) {
                $('#back-to-top').addClass('show');
            } else {
                $('#back-to-top').removeClass('show');
            }
        };
    backToTop();
    $(window).on('scroll', function () {
        backToTop();
    });
    $('#back-to-top').on('click', function (e) {
        e.preventDefault();
        $('html,body').animate({
            scrollTop: 0
        }, 700);
    });
}

});