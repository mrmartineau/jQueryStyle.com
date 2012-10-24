/*!
	cbs_live_search v0.8 for jQuery 1.2
	(c) 2006-2008 Christophe Beyls <http://www.digitalia.be>
	MIT-style licence
*/

var cbs_live_search = (function($) {

	var oldValue = "", data, visible, checkTimer, showTimer, ajaxOptions, request,

	// DOM elements
	textBox, resetImage, waitImage, results, clone;


	function clear() {
		textBox.value = "";
		check();
		textBox.focus();
	}

	function hide() {
		clearTimeout(showTimer);
		setVisible(waitImage);
		if (visible) {
			visible = 0;
			$(results).slideUp(100);
		}
	}

	function setVisible(jQuery, value) {
		if (jQuery) return jQuery.css("visibility", value ? "" : "hidden");
	}

	function check() {
		var currentValue = textBox.value;
		if (currentValue != oldValue) {
			oldValue = currentValue;
			setVisible(resetImage, currentValue);
			currentValue = $.trim(currentValue);
			if (currentValue != data.q) {
				if (request) request.abort();
				if ((data.q = currentValue).length < 3) {
					hide();
				} else {
					setVisible(waitImage, 1);
					request = $.ajax($.extend(ajaxOptions, {data: data}));
				}
			}
		}
	}

	function show() {
		var css = {width: clone.clientWidth, height: clone.clientHeight};
		if (!visible) {
			visible = 1;
			$(results).queue(function() { $(results).css(css).dequeue(); }).slideDown(200);
		} else {
			$(results).animate(css, 600);
		}
	}


	return function(form, defaultValue, noResults, safari, _data) {
		safari = safari && /Apple Computer/.test(navigator.vendor) && (parseInt(navigator.productSub) >= 20020000);
		noResults = "<p>" + noResults + "</p>";
		data = _data;

		form = $("#"+form).append(
			$([
				clone = setVisible($("<div />")).css("position", "absolute")[0],
				results = $("<div />").css("display", "none")[0]
			]).addClass("ls_results")
		)[0];
		textBox = $("input", form).focus(function() {
			if ($(textBox).hasClass("ls_inactive")) {
				$(textBox).removeClass("ls_inactive");
				textBox.value = "";
			}
			checkTimer = setInterval(check, 1000);
		}).blur(function() {
			clearInterval(checkTimer);
			check();
			if (!safari && (textBox.value == "")) {
				$(textBox).addClass("ls_inactive")
				textBox.value = defaultValue;
			}
		}).keydown(function(event) {
			if (event.keyCode == 27) clear();	// Clear the field when ESC is pressed
		})[0];

		waitImage = setVisible($('<span class="ls_wait_image" />')).insertAfter(textBox);
		resetImage = !safari && setVisible($('<span class="ls_reset_image" />')).click(clear).insertAfter(textBox);
		// inline-block display fix for Gecko < 1.9
		if ($.browser.mozilla && !document.getElementsByClassName) waitImage.add(resetImage).css("display", "-moz-inline-stack");

		if (safari) {
			$(form).addClass("ls_safari");
			textBox.type = "search";
			$(textBox).attr({autosave: form.action, results: "5", placeholder: defaultValue});
		} else {
			$(textBox).attr({autocomplete: "off", value: defaultValue}).addClass("ls_inactive");
		}

		ajaxOptions = {
			url: form.action,
			type: "POST",
			dataType: "html",
			success: function(response) {
				clearTimeout(showTimer);
				setVisible(waitImage);
				$([clone, results]).html((response == "<none />") ? noResults : response);
				showTimer = setTimeout(show, 50);
			},
			error: hide
		};
	};

})(jQuery);
