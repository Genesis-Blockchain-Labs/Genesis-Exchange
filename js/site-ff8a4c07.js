(function() {
	$(function() {
		if ($("#countdown, #countdown-2").each(function() {
				return $(this).countdown("2017/05/18 17:30", function(e) {
					return $(this).text(e.strftime("%D:%H:%M:%S"))
				})
			}), $(".contribute-button").each(function() {
				var e;
				return e = $(this).attr("href"), window.aid && $(this).attr("href", e + "&aid=" + window.aid), $(this).on("click", function() {
					return ga("send", "contribute button", "click", "monaco_event1")
				})
			}), ($("body").hasClass("leaderboard") || $("body").hasClass("cn_leaderboard")) && ("api", "0xace62f87abe9f4ee9fd6e115d91548df24ca0943", "379224", $(window).on("scroll", function() {
				var e, t;
				return e = $(window).height(), t = $(window).scrollTop(), t > .2 * e ? t >= $("#section-widget").offset().top && t <= $("#section-widget").offset().top + $("#section-widget").height() ? $("#contribute").removeClass("in") : $("#contribute").addClass("in") : $("#contribute").removeClass("in")
			}), $(window).scroll()), ($("body").hasClass("referral") || $("body").hasClass("cn_referral")) && $.getJSON("https://monaco-tx.herokuapp.com/referral", function(e) {
				var t;
				return t = Array(), e.forEach(function(e, a) {
					return t.push([a + 1, e.address, e.paid])
				}), $("#referral").DataTable({
					data: t,
					columns: [{
						sortable: !1
					}, {
						sortable: !1
					}, {
						sortable: !1
					}]
				})
			}), ($("body").hasClass("index") || $("body").hasClass("cn_index")) && ($(window).scroll()), ($("body").hasClass("tokensale") || $("body").hasClass("cn_tokensale")) && ($(window).on("scroll", function() {
				var e, t;
				return e = $(window).height(), t = $(window).scrollTop(), t > 1.2 * e ? t >= $("#section-widget").offset().top && t <= $("#section-widget").offset().top + $("#section-widget").height() ? $("#contribute").removeClass("in") : $("#contribute").addClass("in") : $("#contribute").removeClass("in")
			}), $(window).scroll()) ) return
	})
}).call(this);
