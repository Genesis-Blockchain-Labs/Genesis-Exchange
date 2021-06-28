(function($) {
    $.fn.slideToCAPTCHA = function(options) {
        options = $.extend({
            handle: '.handle',
            cursor: 'move',
            direction: 'x', //x or y
            customValidation: false,
            completedText: 'Veryfied '
        }, options);
        var $handle = this.find(options.handle),
            $slide = this,
            handleOWidth,
            xPos,
            yPos,
            slideXPos,
            slideWidth,
            slideOWidth,
            $activeHandle,
            timer,
            $formEl = $slide.parents('form');

        startSlider();

        $handle.css('cursor', options.cursor)
            .on('mousedown touchstart', function(e){ slideOn(e); });

        function startSlider() {
            $formEl.attr('data-valid', 'false');

            if(options.customValidation === false) {
                $formEl.attr('onsubmit', "return $(this).attr('data-valid') === 'true';");
            }

            $slide.addClass('slide-to-captcha');
            $handle.addClass('slide-to-captcha-handle');

            handleOWidth = $handle.outerWidth();
            slideWidth = $slide.width();
            slideOWidth = $slide.outerWidth();
        }

        function slideOn(e) {
            //bind events 
            //clear timer
            clearTimeout(timer);
            //set timer
            timer = setTimeout(function () {

                //determine where to look for pageX by the event type
                var pageX = (e  .type.toLowerCase() === 'mousedown')
                    ? e.pageX
                    : e.originalEvent.touches[0].pageX;


            }, 50);

            $activeHandle = $handle.addClass('active-handle');

            if (e.type.toLowerCase() === 'touchstart'){
                xPos = $handle.offset().left + handleOWidth - e.originalEvent.touches[0].pageX;
            } else {
                xPos = $handle.offset().left + handleOWidth - e.pageX;
            }

            //if(options.direction === 'y') {
            //    yPos = $handle.offset().top + handleHeight = e.pageY;
            //}
            slideXPos = $slide.offset().left + ((slideOWidth - slideWidth) / 2);

            //modified element trigger for more sensibility (usability tip)
            $formEl.on('mousemove touchmove', function(e){ slideMove(e); })
                .on('mouseup touchend', function(e){ slideOff(); });

            e.preventDefault();
        }

        function slideMove(e) {
            //bind events 
            //clear timer
            clearTimeout(timer);
            //set timer
            timer = setTimeout(function () {

                //determine where to look for pageX by the event type
                var pageX = (e  .type.toLowerCase() === 'mousemove')
                    ? e.pageX
                    : e.originalEvent.touches[0].pageX;


            }, 50);

            if (e.type.toLowerCase() === 'touchmove'){

                var handleXPos = (e.originalEvent.touches[0].pageX) + xPos - handleOWidth;
            } else {
                var handleXPos = e.pageX + xPos - handleOWidth;
            }


            if(handleXPos > slideXPos && handleXPos < slideXPos + slideWidth - handleOWidth) {

                if ($handle.hasClass('active-handle')) {
                    $('.active-handle').offset({left: handleXPos});
                }
            } else {
                if(handleXPos <= slideXPos === false) {
                    sliderComplete();
                }
                $formEl.mouseup();
            }
        }

        function sliderComplete() {
			//alert('sliderComplete');
            $activeHandle.offset({left: slideXPos + slideWidth - handleOWidth});
            $activeHandle.off();
            slideOff();
            $formEl.attr('data-valid', 'true');
            $slide.addClass('valid');
            $('.slide-to-captcha').attr('data-content', options.completedText);


        }
        function slideOff() {
			//alert('slideOff');
            $activeHandle.removeClass('active-handle');
			$('#hidden_value').val('1');
        }
    }
})(jQuery);
