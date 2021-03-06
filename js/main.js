$(document).ready(function() {

	/** =============
	 * STICKY MENU
	 * ==============*/
	
	$('#sticky-menu').sticky({topSpacing: 0, responsiveWidth: true, zIndex: 100});

	/** =============
	 * END STICKY MENU
	 * ==============*/



	/** =============
	 * SMOOTH SCROLLING
	 * ==============*/

	$('body').off('click', '.smoothscroll');
	$('body').on('click', '.smoothscroll', function(e) {
		e.preventDefault();
		$('html, body').animate({scrollTop: $(this.hash).offset().top - 70}, 800);
	});

	/** =============
	* END SMOOTH SCROLLING
	* ==============*/



	/** =============
	 * CAROUSEL
	 * ==============*/

	$('.carousel').each(function(i, c) {
		var that = $(c);
		var w = that.width();
		var h = w/16*7;
		var time_constant = 500;
		var dist = -30;
		var shift = -20;
		var vpadding = 50;
		var full_width = 0;
		var padding = 20;

		if (vpadding !== 0) {
			that.css({"margin-top":vpadding, "margin-bottom":vpadding});
		}

		var atts = {
			time_constant: parseInt(time_constant, 10),
			dist: parseInt(dist, 10),
			padding: parseInt(padding, 10),
			shift: parseInt(shift, 10),
			full_width: full_width
		};

		that.carousel(atts);

		that.find('.carousel-item').on('mouseenter touchstart', function(e) {
			var itemElem = $(this);
			itemElem.addClass('active');
			if ($('body').hasClass('mobile')) {
				setTimeout(
					function() {
						itemElem.removeClass('active');
					}, 3000);
				that.find('a').on('touchstart', function(e) {
					window.location.href = $(this).attr('href');
				});
			}
		}).on('mouseleave', function() {
			$(this).removeClass('active');
		});
	});

	/** =============
	* END CAROUSEL
	* ==============*/



	/** =============
	 * IMAGES LOADED
	 * ==============*/

	$.fn.imagesLoaded = function() {
		var $imgs = this.find('img[src!=""]');
		if (!$imgs.length) {return $.Deferred().resolve().promise();}
		var dfds = [];
		$imgs.each(function() {
			var dfd = $.Deferred();
			dfds.push(dfd);
			var img = new Image();
			img.onload = function(){dfd.resolve();}
			img.onerror = function(){dfd.resolve();}
			img.src = this.src;
		});
		return $.when.apply($,dfds);
	}

	/** =============
	* END IMAGES LOADED
	* ==============*/



	/** =============
	 * SOUNDCLOUD IFRAME
	 * ==============*/

	$('.modal-trigger').on('click', function(e) {
		e.preventDefault();
		if ($(this).data('iframe') !== undefined) {
			$('#soundcloud-frame').removeClass('playlist-iframe');
			if ($(this).data('playlist')) {
				$('#soundcloud-frame').addClass('playlist-iframe');
			}
			$('#soundcloud-frame').attr('src', $(this).data('iframe'));
		}
		return true;
	});

	var iframeElement = 'soundcloud-frame';
	var widget = SC.Widget(iframeElement);

	$('.modal').modal();

	$('.soundcloud-modal').modal({
		complete: function() {
			widget.pause();		
			$('#minimized-controls').modal('open');
			$('.modal-overlay').hide();
		}
	});

	$('.toggle-play').click(function(e) {
		e.preventDefault();
		$(this).toggleClass('fa-play fa-pause');
		widget.toggle();
	});

	$('.fa-previous').click(function(e) {
		e.preventDefault();
		widget.prev();
	});
	$('.fa-forward').click(function(e) {
		e.preventDefault();
		widget.next();
	});
	$('.close-audio-controls').click(function(e) {
		e.preventDefault();
		$('#minimized-controls').hide();
		$('#modal').modal('close');
		$('#soundcloud-frame').attr('src', '');
	});



	/** =============
	* END SOUNDCLOUD IFRAME
	* ==============*/



	/** =============
	 * SIDE NAV
	 * ==============*/

	$('.button-collapse').sideNav({
		menuWidth: 300,
		edge: 'right',
		closeOnClick: true
	});

	/** =============
	* END SIDE NAV
	* ==============*/

	$('ul.tabs li a[href="#contacts"]').click(function(e) {
		$('.indicator').removeClass('unshift');
		$('.indicator').addClass('shift');
	});
	$('ul.tabs li a[href="#form"]').click(function(e) {
		$('.indicator').removeClass('shift');
		$('.indicator').addClass('unshift');
	});



	$('form').on('submit', function(e) {

		var first_name = $('#first_name').val();
		var last_name = $('#last_name').val();
		var email = $('#email').val();
		var message = $('#message').val();

		if (first_name != '' && last_name != '' && email != '' && message != '') {
			$(this).submit();
			/*$('#feedback').html('Your message has been sent successfully! I\'ll get back to you ASAP!');
			$('#form-feedback-modal').modal('open');*/
		} else {
			$('#feedback').html('Please fill in all of the fields!');
			$('#form-feedback-modal').modal('open');
			e.preventDefault();
			return false;
		}
	});


});
