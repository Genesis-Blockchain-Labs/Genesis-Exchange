$(function(){

	/**
	 * Fullpage init
	 */
	var $fullpage = $('#fullpage');
	var responsiveWidth = 992;
	$fullpage.fullpage({
		//'anchors': ['home', 'prod', 'comp', 'ico-roadmap', 'team1', 'ref-prog', 'evnt', 'faq1'],
		verticalCentered: false,
		css3: true,
		//autoScrolling: false,
		controlArrows: false,
		responsiveWidth: responsiveWidth,
		fixedElements: '.branding',
		slideSelector: '.fp-slide',
		paddingTop: $('.branding').outerHeight()+'px',
		onLeave: function(index, nextIndex, direction) {
			fixNavbar(nextIndex);
			moveCard(index, nextIndex, direction);
		}
	});

	/**
	 * fullscreen.js callback: move #monaco-card
	 * https://github.com/alvarotrigo/fullPage.js/
	 *
	 * @param  {number} index     Current screen number
	 * @param  {number} nextIndex Next screen number
	 * @param  {string} direction Slide direction: 'up' or 'down'
	 */
	function moveCard(index, nextIndex, direction) {
		var $cardWrap = $('#monaco-card');
		var $card = $('#monaco-card img');

		// 3 screen: disable tabs when scrolling the page
		var $tabsWrapper = $('.feature-area');
		if( document.documentElement.clientWidth >= responsiveWidth )
			$tabsWrapper.find('a:first').click();
		$tabsWrapper.addClass('js-tabs-disabled');
		setTimeout( function() {
			$tabsWrapper.removeClass('js-tabs-disabled');
		}, 800);

		if( document.documentElement.clientWidth >= responsiveWidth ) {
			$('.tabHeader .tabHeader-tab:first').click();
		}
		$('#oneImg').css('visibility', 'hidden');

		switch (nextIndex) {

			/* First screen */
			case 1:
				$cardWrap.removeAttr('style');
				$card.removeAttr('style');
				$cardWrap.removeClass('hidden');
				break;

			/* Second screen */
			case 2:
				var $oneImg = $('#oneImg');
				$cardWrap.css('width', $oneImg.innerWidth() * 0.83 + 'px'); // 17.83% empry width
				$cardWrap.pos = getRealOffset($cardWrap);
				$cardWrap.addClass('hidden');
				$oneImg.pos = {
					top: $oneImg.offset().top + ($oneImg.innerHeight() * 0.073), // 7.5% empty offset on left
					left: $oneImg.offset().left + ($oneImg.innerWidth() * 0.035) // 3.8% empty offset on top
				};
				var translate = getDistance($oneImg);
				$cardWrap.css({
					opacity: '0',
					transform: 'translate3d(' + translate.left + 'px, ' + translate.top + 'px, 0)'
				});
				setTimeout(function() {
					$oneImg.css('visibility', '');
				}, 790);
				$card.css('transform', 'rotate(0)');
				break;

			/* Third screen */
			case 3:
				var $iphone = $('#app-iphone img:gt(0):visible');
				$cardWrap.css('width', $iphone.innerWidth() * 0.7 + 'px');
				$cardWrap.pos = getRealOffset($cardWrap);
				$iphone.pos = $iphone.offset();
				$iphone.pos.top += $iphone.innerHeight() * 0.165;
				$iphone.pos.left += $iphone.innerWidth() * 0.16;
				var translate = getDistance($iphone);
				$cardWrap.css({
					opacity: '1',
					transform: 'translate3d(' + translate.left + 'px, ' + translate.top + 'px, 0)'
				});
				$card.css('transform', 'rotate(0)');
				$cardWrap.removeClass('hidden');
				break;

			/* Another screen */
			default:
				break;
		}

		/**
		 * Get distance $elem <---> #monaco-card
		 * @param  {object} $elem jQuery element object
		 * @return {object}       shift on top and left
		 */
		function getDistance($elem) {
			var translate = getElementTranslate($fullpage);
			return {
				top: $elem.pos.top - $cardWrap.pos.top - translate.top,
				left: $elem.pos.left - $cardWrap.pos.left - translate.left
			};
		}

		/**
		 * Get CSS property "transform: translate3d(this, this, -);
		 * @param  {object} $elem jQuery element object
		 * @return {object}       translate3d x (top) and y (left)
		 */
		function getElementTranslate($elem) {
			var match = /^matrix\(.+?, .+?, .+?, .+?, ([0-9.-]+), ([0-9.-]+)\)/;
			var matrix = $elem.css('transform').match(match);
			return {
				top: (matrix ? matrix[2] : 0),
				left: (matrix ? matrix[1] : 0 )
			};
		}

		/**
		 * fullpage.js fix: get element offset top and left
		 * @param  {object} $elem jQuery element object
		 * @return {object}       object = { top: (int), left: (int) }
		 */
		function getRealOffset($elem) {
			var fullpageTranslate = getElementTranslate($fullpage);
			var elemTranslate = getElementTranslate($elem);
			var elemOffset = $elem.offset();
			return {
				top: -fullpageTranslate.top - elemTranslate.top + elemOffset.top,
				left: -fullpageTranslate.left - elemTranslate.left + elemOffset.left
			}
		}
	}

	/**
	 * fullpage.js callback: make navbar fixed
	 * @param  {number} nextIndex Screen number
	 */
	function fixNavbar(nextIndex) {
		$('.branding').toggleClass('fixed', nextIndex != 1);
	}

	/**
	 * fullpage.js: Make hash-links working
	 */
	$('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {
		if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
			if( !$(this.hash) ) return;
			var id = this.hash.substr(1);
			$.fn.fullpage.moveTo(id);
		}
	});

	/**
	 * Third screen: change mobile screen when hovering over info
	 */
	$('#app-iphone img:gt(0)').each(function() {
		new Image().src = this.getAttribute('src');
	});
	$('.feature-area a').on('click', function (e) {
		e.preventDefault();
		var isTabsDisabled = $('.feature-area').hasClass('js-tabs-disabled');
		if( isTabsDisabled ) return;
		var isFirstTab = ( $(this).attr('href') == '#feature1' );
		$('#monaco-card').toggle(isFirstTab);
		$('.ht').removeClass('active');
		$('.fade').removeClass('active');
		$(this).tab('show');
	});

	/**
	 * Mobile hamburger-menu
	 */
	$(".navMobil").addClass("noNe");
	$(".navBar").on("click", function() {
		$(".navMobil").toggleClass("noNe");
	});

	/**
	 * Second screen: switching tabs on click
	 */
	$("ul.tabHeader li").on("click", function() {
		var ind = $(this).index();
		$("ul.tabHeader li").removeClass("active");
		$(this).addClass("active");

		if( document.documentElement.clientWidth >= 768 ) {
			$(".tabContent .tabItem").hide();
			$(".tabContent .tabItem").eq(ind).show();
		} else {
			var offsetTop = $('.tabContent .tabItem').eq(ind).offset().top;
			offsetTop -= document.querySelector('.branding').offsetHeight;
			$("html").stop().animate({ scrollTop: offsetTop }, 500, 'swing');
		}
	});
	window.addEventListener('resize', function() {
		$('.tabContent .tabItem').css('display', '');
	});

	$('.contentInner .comContent:gt(0)').css('display', 'none');
	$('.contentInner .comContent:gt(0) img').each(function() {
		new Image().src = this.getAttribute('src');
	});
	$('.tabHeaderTwo li').click(function() {
		// Active tab
		var index = $(this).index();
		$('.tabHeaderTwo li').removeClass('active');
		$(this).addClass('active');

		var $elems = $('.contentInner .comContent');
		var $elem = $elems.eq(index);

		$elems.find('.animated').removeClass('fadeInLeft fadeInRight');
		$elems.css('display', 'none');

		$elem.css('display', 'block');
		$elem.find('.animated:eq(0)').addClass('fadeInLeft');
		$elem.find('.animated:eq(1)').addClass('fadeInRight');
	});

	/**
	 * Show large photo and full desctiption when clicked over a photo
	 */
	$(".teamContent .sr-contact").on("click",function(){
		var indTwo = $(this).index();
		$(".team-big-main .team-pane").hide();
		$(".team-big-main .team-pane").eq(indTwo).show();
	});

	/**
	 * FAQ hiders
	 */
	$(".panel-group .sr-contact").on("click",function(){
		var index = $(this).index();
		var $currentHider = $(this).find('.panel-collapse');
		if( $currentHider.is(':visible') == true ) {
			$currentHider.hide('fast');
		} else {
			var $faqs = $('.panel-group .sr-contact .panel-collapse');
			$faqs.hide('fast');
			$faqs.eq(index).show('fast');
		}
	});

	/**
	 * Animation event end name
	 */
	function whichAnimationEvent(){
		var t, el = document.createElement("fakeelement");
		var animations = {
			"animation"      : "animationend",
			"OAnimation"     : "oAnimationEnd",
			"MozAnimation"   : "animationend",
			"WebkitAnimation": "webkitAnimationEnd"
		}
		for (t in animations){
			if (el.style[t] !== undefined){
				return animations[t];
			}
		}
	}

	/**
	 * Set <img> src="..." slider
	 * @param  {string} selector CSS-selector
	 * @param  {object} urls     images urls
	 * @param  {number} delay    slides delay
	 * @param  {bool}   animate  fade images
	 */
	function imgSlider(selector, urls, delay, animate) {
		if( typeof urls == 'string' )
			urls = array(urls);

		var $selector = $(selector);
		var imagesToLoad = urls.length;
		var currentSlide = 0;

		for(var i = 0; i < urls.length; i++) {
			var img = new Image();
			img.onload = imageLoaded;
			img.onerror = imageLoaded;
			img.src = urls[i];
		}

		function imageLoaded() {
			imagesToLoad--;
			if( !imagesToLoad )
				startSlider();
		}

		function startSlider() {
			setTimeout(function() {
				if( $selector.is(':visible') == true ) {
					if( urls.length <= currentSlide )
						currentSlide = 0;
					if( animate == true ) {
						$selector.stop().animate({opacity: '0'}, 300, function() {
							$selector.attr('src', urls[currentSlide++]);
							$selector.stop().animate({opacity: '1'}, 300)
						});
					} else {
						$selector.attr('src', urls[currentSlide++]);
					}
				}
				startSlider();
			}, delay);
		}
	}

	imgSlider('.js-imgslider', [
		'img/cardicons/red.png',
		'img/cardicons/blue-final.png'
	], 5000, true);

	$('a[href="#feature6"]').one('click', function() {
		imgSlider('#feature6 img', [
			'img/feature/map/geo-copy.png',
			'img/feature/map/side-menu.png',
			'img/feature/map/support.png',
			'img/feature/map/view-transactions.png',
			'img/feature/map/withdraw.png',
			'img/feature/map/block-card.png',
			'img/feature/map/change-pin.png',
			'img/feature/map/card-stolen-report.png',
			'img/feature/map/deposit.png',
			'img/feature/map/exchange.png'
		], 2000);
	});

});
