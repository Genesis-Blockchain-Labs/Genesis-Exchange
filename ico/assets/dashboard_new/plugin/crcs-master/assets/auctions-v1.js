jQuery(document).ready(function(){ 			
	
	/* ********* */
	/* COUNTDOWN */
	/* ********* */	
	function get_moment(my_time, crsc_timezone){
		return moment.tz(my_time, crsc_timezone);
	}
	jQuery("[data-countdown]").each(function() {
		
		var crsc_timezone = "Europe/London";
		
		if( jQuery(this).attr("timer-type") == 'auction-timer' ) {
		
			var countdown_format = "%Mm %Ss";
			var jQuerythis = jQuery(this), finalDate = moment.tz( jQuery(this).data("countdown"), crsc_timezone )
			init_countdown( jQuery(this), finalDate, countdown_format, crsc_timezone );
		
		}
		
	});
	
	function init_countdown( counter_container, finalDate, countdown_format, crsc_timezone ){
			
		counter_container.countdown(finalDate.toDate(), function(event) {			
			//jQuery(this).html(event.strftime(countdown_format));			
		})
		.on("update.countdown", function(event) {
			var format = countdown_format;
			if(event.offset.totalHours > 0) {
				format = "%-H hour%!H " + format;
			}
			if(event.offset.totalDays > 0) {
				format = "%-d day%!d " + format;
			}
			if(event.offset.weeks > 0) {
				format = "%-w week%!w " + format;
			}
			counter_container.html(event.strftime(format));
		})
		.on("finish.countdown", function(event) {
			
			counter_container.html("<i class='fa fa-spinner fa-pulse fa-fw'></i>").parent().addClass("disabled");	
			
			var fields = initAjaxAuction.process_auction;
			var auction_id = counter_container.attr("timer-auction-id");
			fields.auction_id = auction_id;

			jQuery.ajax({
				type : "post",
				dataType : "json",
				url : initAjax.ajaxurl,
				data : fields,
				success: function(response) {						
					if(response.type) {
						if( response.auction_ended ) {
							jQuery(".crsc-auction-wrapper-"+auction_id).html(response.auction_ended_display);
						}else{
							var new_finalDate = get_moment( response.auction_end, crsc_timezone);		
							init_countdown( counter_container, new_finalDate, countdown_format, crsc_timezone );
						}
					}
				}
			}) 				
			
		});
				
	}
	/* ********* */
	/* [END] COUNTDOWN */
	/* ********* */	
		
	
	/* ****************************************** */
	/* UPDATING AUCTIONS PAGE ELEMENTS USING AJAX */
	/* ****************************************** */
	function crsc_load_auction_components(){
		jQuery.ajax({
			url      : initAjax.ajaxurl,
			type     : "post",
			data     : initAjaxAuction.load_auction_components,
			dataType : "json",
			success: function(response) {
				//alert("MYBET 2018")
					//alert(response.values.xxx)
				jQuery.each(response.values,function(i, value){
					//alert(value)
					jQuery("."+i).html(value);
				});
			}
		});
	}
	setInterval(function(){
		if( window.location.href == initAjaxAuction.paurl ) {
			crsc_load_auction_components();
		}
	}, 1000);	
	/* ****************************************** */
	/* [END] UPDATING AUCTIONS PAGE ELEMENTS USING AJAX */
	/* ****************************************** */
	




	
	
	
	
	
	
	
	
	
	
	
	

	
});