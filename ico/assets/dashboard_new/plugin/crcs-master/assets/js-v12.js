jQuery(document).ready(function(){
		
	
	/* ***************** */
	/* SUBMIT AJAX FORMS */
	/* ***************** */
	jQuery('.crsc_ajax_submit_form').submit(crsc_form_ajaxSubmit);
	
	function crsc_form_ajaxSubmit(){
		
		var ajax_form = jQuery(this);
		
		var crsc_submit_btn = jQuery(this).find(':submit');
		var crsc_submit_btn_txt = crsc_submit_btn.attr("value");
		if( crsc_submit_btn_txt == '' ) 
			crsc_submit_btn_txt = 'Submit';		
		crsc_submit_btn.attr('disabled','disabled');
		crsc_submit_btn.attr('value',initAjax.buttonspinner);
		
		var crsc_ajax_form_data = jQuery(this).serialize();
		
		var crsc_ajax_feedback_cont = jQuery("#crsc-form-ajax-submit-feedback");
		
		jQuery.ajax({
			url      : initAjax.ajaxurl,
			type     : "post",
			data     : crsc_ajax_form_data,
			dataType : "json",
			success: function(response) {
				
				crsc_submit_btn.removeAttr('disabled');
				crsc_submit_btn.attr('value',crsc_submit_btn_txt);
				crsc_ajax_feedback_cont.html(response.msg);
				
				if(response.type){
					crsc_ajax_feedback_cont.removeClass( initAjax.ajaxFeedbackSuccess ).addClass( initAjax.ajaxFeedbackError );
				}else{
					crsc_ajax_feedback_cont.removeClass( initAjax.ajaxFeedbackError ).addClass( initAjax.ajaxFeedbackSuccess );
				}
				
				if(response.hide_form){
					ajax_form.hide();
				}
				
				if( !jQuery.isArray(response.values) ||  !response.values.length ) {
					//alert(response.values.hello)
					jQuery.each(response.values,function(i, value){
						jQuery("."+i).html(value);
					});
				}
							
				crsc_load_page_components() // NOT NEEDED BECAUSE PAGE COMPONENTS ARE BEING CHECKED EVERY SENCOND ANYWAY
				//window.location.replace(window.location.href);
			}
		});
		
		return false;
	}
	/* ***************** */
	/* [END] SUBMIT AJAX FORMS */
	/* ***************** */ 

	/* **** */
	/* TABS */
	/* **** */
	jQuery('ul.crsc-tabs li').click(function(){
		
		var tab_id = jQuery(this).attr('data-tab');

		jQuery('ul.crsc-tabs li').removeClass('crsc-tab-current');
		jQuery('.crsc-tab-content').removeClass('crsc-tab-current');

		jQuery(this).addClass('crsc-tab-current');
		jQuery("#"+tab_id).addClass('crsc-tab-current');
		
	});
	/* **** */
	/* [END] TABS */
	/* **** */
		
	
	/* ********* */
	/* COUNTDOWN */
	/* ********* */	
	jQuery("[data-countdown]").each(function() {
		
		var crsc_timezone = "Europe/London";
		
		if( jQuery(this).attr("timer-type") == 'user-can-buy-next-timer' ) {
		
			var countdown_format = "%Hh %Mm %Ss";
			var jQuerythis = jQuery(this), finalDate = moment.tz( jQuery(this).data("countdown"), crsc_timezone )
			var current_time = moment();
			
			jQuerythis.countdown(finalDate.toDate(), function(event) {			
				jQuerythis.html(event.strftime(countdown_format));			
			})
			.on("update.countdown", function(event) {
				var format = countdown_format;
				if(event.offset.totalHours > 0) {
					//format = "%-H hour%!H " + format;
				}
				if(event.offset.totalDays > 0) {
					format = "%-d day%!d " + format;
				}
				if(event.offset.weeks > 0) {
					format = "%-w week%!w " + format;
				}
				jQuery(this).html(event.strftime(format));
			})
			.on("finish.countdown", function(event) {
				
				jQuery(this).html("NOW!").parent().addClass("disabled");			
				
			});
			
		}

	});
	/* ********* */
	/* [END] COUNTDOWN */
	/* ********* */	
		
	
	/* ********************************* */
	/* UPDATING PAGE ELEMENTS USING AJAX */
	/* ********************************* */
	setInterval(function(){	
		//crsc_load_page_components()		
	}, 1000);	// EVERY SECOND 
	function crsc_load_page_components(){
		jQuery.ajax({
			url      : initAjax.ajaxurl,
			type     : "post",
			data     : initAjax.load_page_components,
			dataType : "json",
			success: function(response) {
				jQuery.each(response.values,function(i, value){
					jQuery("."+i).html(value);
				});
			}
		});
	}	
	/* ********************************* */
	/* [END] UPDATING PAGE ELEMENTS USING AJAX */
	/* ********************************* */
	
	
	/* ************************************************************************* */
	/* UPDATING USER EXTERNAL TOKEN DEPOSIT TABLE ON THE CORRESPONDING PAGE ONLY */
	/* ************************************************************************* */
	if( jQuery( ".crsc-user-tk-deposit-txns" ).length ) {
		
		setInterval(function(){
		
			jQuery.ajax({
				url      : initAjax.ajaxurl,
				type     : "post",
				data     : initAjax.load_user_tk_deposits,
				dataType : "json",
				success: function(response) {
					jQuery.each(response.values,function(i, value){
						jQuery("."+i).html(value);
					});
				}
			});
			
		}, 60000);	// EVERY MINUTE / 60 SECONDS
	
	}
	/* ************************************************************************* */
	/* [END] UPDATING USER EXTERNAL TOKEN DEPOSIT TABLE ON THE CORRESPONDING PAGE ONLY */
	/* ************************************************************************* */













	
	
	

	
});