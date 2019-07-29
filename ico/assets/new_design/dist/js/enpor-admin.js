$(document).ready(function () {

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

});


$( ".sidehover").hover(function() {
    $(this).css({"pointer-events": "none", "opacity": "0.5"});
    $('.passivenote').css('display','block');
});


jQuery(function($) {
    var currentMousePos = { x: -1, y: -1 };
    $(document).mousemove(function(event) {
        currentMousePos.x = event.pageX;
        currentMousePos.y = event.pageY;
        //console.log("X: "+currentMousePos.x+"  Y : "+currentMousePos.y);

        if (currentMousePos.x > 215) {
            $( ".sidehover").css({"pointer-events": "visible", "opacity": "1"});
            $('.passivenote').css('display','none');
        } else {
            if (currentMousePos.y < 80) {
                $(".sidehover").css({"pointer-events": "visible", "opacity": "1"});
                $('.passivenote').css('display','none');
            } else {
                $(".sidehover").css({"pointer-events": "none", "opacity": "0.5"});
                $('.passivenote').css('display','block');
            }
        }
    });

});