jQuery(document).ready(function ($) {
	var isMobile = $(window).width() <= 690;

	// -----------------------------------------------------------------------------
	//! Toggle Mobile Nav
	// -----------------------------------------------------------------------------

	$('body').on('click', '.hamburger', function (e) {
		$(e.delegateTarget).toggleClass('nav-open');
		$(this).toggleClass('is-active');
	});

	$('.mobile-nav-inner-nav .sub-menu').each(function (index) {
		$(this).before('<button type="button" class="sub-menu-toggle"></button>');
	});

	$('.sub-menu-toggle').on('click', function (e) {
		$(this).next().slideToggle(200);
		$(this).toggleClass('is-active');
	});

	$('.mobile-nav').on('click', '.menu-item-has-children > span', function() {
		var button = $(this).next('button');
		if (button.is(':visible')) {
			button.trigger('click');
		}
	});


	// -----------------------------------------------------------------------------
	//! Sticky Nav
	// -----------------------------------------------------------------------------

	var mastheadHeight = $('#masthead').outerHeight();
	var utilityHeight = $('#utility-navigation').outerHeight();
	var headerHeight = mastheadHeight + utilityHeight;

	$(window).on('scroll', function () {
		var header = $('#masthead');
		scrollPosition = $(this).scrollTop();
		if (scrollPosition >= headerHeight) {
			if (!header.hasClass('out-of-view')) {
				$('#masthead').addClass('out-of-view');
			}
		} else {
			if (header.hasClass('out-of-view')) {
				$('#masthead').removeClass('out-of-view');
			}
		}
	});

	//On Load
	var header = $('#masthead');
	scrollPosition = $(this).scrollTop();
	if (scrollPosition >= headerHeight) {
		if (!header.hasClass('out-of-view')) {
			$('#masthead').addClass('out-of-view');
		}
	} else {
		if (header.hasClass('out-of-view')) {
			$('#masthead').removeClass('out-of-view');
		}
	}

	if (document.getElementById('nav-waypoint')) {
		var navWP = new Waypoint({
			element: document.getElementById('nav-waypoint'),
			handler: function (direction) {
				if (direction === 'down') {
					$("body").addClass('sticky-nav');

				} else {
					$("body").removeClass('sticky-nav');
				}
			}
		});
	}


	// -----------------------------------------------------------------------------
	//! CTAs responsive positioning
	// -----------------------------------------------------------------------------
	if ($('.ctas').length) {
		if ($(window).width() >= 1000) {
			var waypointTop = $('#nav-waypoint').offset().top;
			var ctasTop = $('.ctas').offset().top;
			if (waypointTop > ctasTop) {
				$('.ctas').css({
					position: 'absolute',
					top: waypointTop + 100
				});
			}
			$('.ctas').addClass('show');
			$(window).on('scroll', function () {
				var windowHeight = $(window).height();
				scrollPosition = $(this).scrollTop();
				if ((scrollPosition + (windowHeight * 0.75)) >= (waypointTop + 100)) {
					$('.ctas').css({
						position: 'fixed',
						top: '75vh'
					});
				} else {
					$('.ctas').css({
						position: 'absolute',
						top: waypointTop + 100
					});
				}
			});
		}
	}


	// -----------------------------------------------------------------------------
	//! Content grid mobile functionality
	// -----------------------------------------------------------------------------
	if (isMobile) {
		$('.grid-item', '.team-grid').click(function () {
			$(this).toggleClass('hover');
		});

		$('.grid-item', '.content-block--feature-grid').click(function () {
			$(this).toggleClass('hover');
		});
	}


	// -----------------------------------------------------------------------------
	//! Slick the Industry slider
	// -----------------------------------------------------------------------------
	var industrySlider = $('.content-block--industry-slider-slick');

	industrySlider
		.on('init', function (slick) {
			// do something
		})
		.on('beforeChange', function (slick, currentSlide, nextSlide) {
			// do something
		})
		.on('afterChange', function (slick, currentSlide, nextSlide) {
			// do something
		})
		.slick({
			adaptiveHeight: isMobile,
			dots: true,
		});



	// -----------------------------------------------------------------------------
	//! Autocomplete
	// -----------------------------------------------------------------------------

	if ($('.library-list').length) {
		$.ui.autocomplete.prototype._renderItem = function (ul, item) {
			var term = $.ui.autocomplete.escapeRegex(this.term)
			return $('<li></li>')
				.data('item.autocomplete', item)
				.append(item.label)
				.appendTo(ul);
		};
	}


	// -----------------------------------------------------------------------------
	//! Filters
	// -----------------------------------------------------------------------------

	$('.library-wrap').on('click', '.library-list-menu-toggle', function (e) {
		$('.library-filters').slideToggle();
		$(this).toggleClass('is-active');
		if ($(this).hasClass('is-active')) {
			$(this).html('<span>Close Filters</span>');
		} else {
			$(this).html('<span>Filter Projects</span>');
		}
	});

	// -----------------------------------------------------------------------------
	//! disable 'empty' links in navigation
	// -----------------------------------------------------------------------------
	$('a[href="#"]', '.main-navigation')
		.each(function () {
			$(this).replaceWith('<span>' + $(this).text() + '</span>');
		});

	$('a[href="#"]', '.footer-navigation')
		.each(function () {
			$(this).replaceWith('<span>' + $(this).text() + '</span>');
		});

	$('a[href="#"]', '.mobile-nav')
		.each(function () {
			$(this).replaceWith('<span>' + $(this).text() + '</span>');
		});


	// -----------------------------------------------------------------------------
	//! Customer Successes Slick Slider
	// -----------------------------------------------------------------------------
	var customerSuccessesSlider = $('.customer-successes--slider');

	customerSuccessesSlider
		.on('init', function (slick) {
			customerSuccessesSlider.parents('section.customer-successes').removeClass('slick--loading');
		})
		.on('beforeChange', function (slick, currentSlide, nextSlide) {
			$('.customer-successes--slider--nav li').removeClass('active');
		})
		.on('afterChange', function (slick, currentSlide, nextSlide) {
			$('.customer-successes--slider--nav li:eq(' + nextSlide + ')').addClass('active');
		})
		.slick({
			adaptiveHeight: isMobile
		});

	$('.customer-successes--slider--nav li').click(function () {
		var index = $('.customer-successes--slider--nav li').index(this);
		customerSuccessesSlider.slick('slickGoTo', index);
	});


	// -----------------------------------------------------------------------------
	//! Product Info Slick Slider
	// -----------------------------------------------------------------------------
	var productInfoSlider = $('.product-info--slider');

	productInfoSlider
		.on('init', function (slick) {
			productInfoSlider.parents('section.product-info').removeClass('slick--loading');
		})
		.on('beforeChange', function (slick, currentSlide, nextSlide) {
			$('.product-info--slider--nav li').removeClass('active');
		})
		.on('afterChange', function (slick, currentSlide, nextSlide) {
			$('.product-info--slider--nav li:eq(' + nextSlide + ')').addClass('active');
		})
		.slick({
			adaptiveHeight: isMobile
		});

	$('.product-info--slider--nav li').click(function () {
		var index = $('.product-info--slider--nav li').index(this);
		productInfoSlider.slick('slickGoTo', index);
	});


	// -----------------------------------------------------------------------------
	//! Integration Slider
	// -----------------------------------------------------------------------------
	var integrationSlider = $('.better-integration-slider');

	integrationSlider
		.on('init', function (slick) {
			integrationSlider.parents('section.better-integration').removeClass('slick--loading');
		})
		.slick({
			  infinite: true,
			  arrows: true,
			  adaptiveHeight: false,
			  slidesToShow: 5,
			  slidesToScroll: 5,
			  responsive: [ {
			      breakpoint: 1024,
			      settings: {
			        slidesToShow: 3,
			        slidesToScroll: 3,
			      }
			    },
			    {
			      breakpoint: 600,
			      settings: {
			        slidesToShow: 2,
			        slidesToScroll: 2
			      }
			    },
			    {
			      breakpoint: 480,
			      settings: {
			        slidesToShow: 1,
			        slidesToScroll: 1
			      }
			    }
			    ]
		});


	// -----------------------------------------------------------------------------
	//! Slick the Integration slider
	// -----------------------------------------------------------------------------


	// -----------------------------------------------------------------------------
	//! Search form
	// -----------------------------------------------------------------------------
	$('input[name="s"]', '.search-form')
		.on('focus', function () {
			$(this).addClass('focus');
		})
		.on('blur', function () {
			if ($(this).val() == '') {
				$(this).removeClass('focus');
			}
		});

	if ($('input[name="s"]', '.search-form').val() !== '') {
		$('input[name="s"]', '.search-form').addClass('focus');
	}


	// -----------------------------------------------------------------------------
	//! Accordion
	// -----------------------------------------------------------------------------
	var accordions = $('.content-block--accordion--wrap');

	accordions
		.each(function() {
			$('.content-block--accordion--section', this)
				.each(function() {
					var trigger = $('.section-title', this);
					var section = $(this);
					var content = $('.section-copy', this);

					trigger.click(function (event) {
						if (section.hasClass('collapsed')) {
							section.removeClass('collapsed');
							content.stop().slideDown({ duration: 'fast' });
							accordions.find('.content-block--accordion--section .section-copy').not(content).slideUp({
								duration: 'fast',
								complete: function () {
									accordions.find('.content-block--accordion--section').not(section).addClass('collapsed');
								}
							});
						} else {
							content.stop().slideUp({
								duration: 'fast',
								complete: function() {
									section.addClass('collapsed');
								}
							});
						}
					});
				});
		});
});
