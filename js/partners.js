jQuery(function ($) {

	// -----------------------------------------------------------------------------
	//! Reset on load
	// -----------------------------------------------------------------------------

	$('.category').prop('checked', false);

	// -----------------------------------------------------------------------------
	//! REST API Controller
	// -----------------------------------------------------------------------------

	function PostsArchive() {
		var markedForRemoval = [];

		this.state = {
			per_page: -1,
			orderby: 'title', // 'menu_order',
			order: 'ASC',
			tags: null,
			search: null,
			page: 1,
			totalPages: null,
			totalPosts: null,
			numFiltersApplied: 0,
			numKeywordsApplied: 0,
			tax_queries: [],
			init: false,
			paused: false
		};

		/*
		*	INIT
		*/
		this.init = function () {
			var self = this;

			// Bind pagination clicks
			$('.library-list-pagination-pages a').on('click', function (e) {
				var newPage = Number($(this).attr('data-page'));
				var target = $('.hero').outerHeight();
				$('html, body').scrollTop(target);

				self.state.page = newPage;
				self.getPosts();

				e.preventDefault();
			});

			// Bind checkboxes
			this.watchForChanges();

			// Get initial posts
			this.getPosts();
		};



		/*
		 *	REMOVE ALL FILTERS
		 */
		this.removeAllFilters = function () {

			// Pause
			this.state.paused = true;

			// Remove active state from filter clearKeywords
			$('.filter-card').removeClass('has-filters');
			$('.library-filters').removeClass('has-filters');

			// Un-check all checkboxes
			$('.category:checked').each(function () {
				$(this).removeAttr('checked').trigger('change');
			});

			// Get posts
			this.state.paused = false;
			this.getPosts();
		};


		/*
		 *	WATCH CHECKBOXES FOR CHANGES
		 */
		this.watchForChanges = function () {
			var self = this;

			$('.category').on('change', function () {
				var isChecked = $(this).attr('checked');
				var name = $(this).next().text();
				var id = $(this).val();
				var numFilters = 0;

				// Reset state
				self.state.tax_queries = [];
				self.state.page = 1;

				// Rebuild tax queries
				$('.category-group').each(function () {
					var checked = $(this).find('.category:checked').length;
					var filterName = $(this).attr('data-filter');
					if (checked) {
						$(this).addClass('has-filters');
						// Create the meta query object
						var obj = {
							//taxonomy: 'category',
							taxonomy: filterName,
							field: 'term_id',
							terms: []
						};

						$(this).find('.category:checked').each(function () {
							obj.terms.push(Number($(this).val()));
							numFilters++;
						});

						self.state.tax_queries.push(obj);
					} else {
						//
						$(this).removeClass('has-filters');
					}
				});

				// Set the number of applied filters
				self.state.numFiltersApplied = numFilters;

				if (numFilters != 0) {
					$('.library-filters').addClass('has-filters');
				} else {
					$('.library-filters').removeClass('has-filters');
				}

				// Get posts if not paused
				if (!self.state.paused) {
					self.getPosts();
				}
			});
		};

		/*
		 *	GET POSTS
		 */
		this.getPosts = function () {
			var self = this;
			var url = localized.siteUrl + '/wp-json/databasics/v2/partners';
			var numFilters = this.state.numFiltersApplied;
			var args = {
				per_page: this.state.per_page,
				orderby: this.state.orderby,
				order: this.state.order,
				search: this.state.search,
				page: this.state.page,
				tax_queries: this.state.tax_queries
			};


			// Freeze the grid
			$('.archive-grid').addClass('is-loading');

			// Get posts
			$.get(url, args).done(function (data) {

				data = JSON.parse(data);
				console.log('data', data);
				self.state.totalPosts = data.total_posts;
				self.state.totalPages = Math.ceil(data.total_posts / self.state.per_page);

				self.displayPosts(data.posts, data.terms);
				self.updatePagination();
				//self.bindGaEvent();
			});

		};

		/*
		 *	DISPLAY POSTS
		 */
		this.displayPosts = function (posts, terms) {
			var cards = '';
			for (var t = 0; t < terms.length; t++) {
				var type = '';

				type += '<h2>' + terms[t] + '</h2>';
				type += '<div class="trio">';

				for (var p = 0; p < posts.length; p++) {
					if (posts[p].types.includes(terms[t])) {
						var card = '';
						var title = posts[p].title;

						card += '<div class="trio-block">';

						card += posts[p].link ? '<a href="' + posts[p].link + '"' : '<span';

						card += ' class="trio-block-inner">';
						card += '<div class="trio-block-photo">';
						card +=     '<img src="' + posts[p].photo + '" class="trio-image" alt="">';
						card += '</div>';
						card += '<div class="trio-block-content">';
						card +=     '<div class="trio-block-title">' + title + '</div>';
						card +=     '<div class="trio-block-blurb"><p>' + posts[p].blurb + '</p></div>';
						card += '</div>';
						card += posts[p].link ? '<div class="trio-block-button">Learn More</div>' : '';

						card += posts[p].link ? '</a>' : '</span>';

						card += '</div>';

						type += card;
					}
				}

				// type += '<div class="integration-cta trio-block"><div class="integration-cta-inner"><span>Get Your App Here</span></div></div>';
				type += '</div>';

				cards += type;
			}

			$('.archive-grid').html(cards).removeClass('is-loading');
			// $('.archive-grid').append('<div class="integration-cta trio-block"><div class="integration-cta-inner"><span>Get Your App Here</span></div></div>');
		};

		/*
		 *	UPDATE PAGINATION
		 */
		this.updatePagination = function () {
			var current = this.state.page;
			var last = this.state.totalPages;
			var resultsStart = (this.state.page - 1) * this.state.per_page + 1;
			var resultsEnd = (this.state.totalPosts < this.state.per_page) ? this.state.totalPosts : this.state.page * this.state.per_page;
			var untilEnd = last - current;
			var links = {
				prevFirst: 1,
				prevThree: current - 3,
				prevTwo: current - 2,
				prevOne: current - 1,
				current: current,
				nextOne: current + 1,
				nextTwo: current + 2,
				nextThree: current + 3,
				nextLast: last
			};


			// Set data-page attributes
			for (var key in links) {
				$('.' + key).attr('data-page', links[key]).text(links[key]);
			}
			$('.next').attr('data-page', current + 1);
			$('.prev').attr('data-page', current - 1);


			if (current >= 2) {
				$(' .prev').addClass('visible');
			} else {
				$(' .prev').removeClass('visible');
			}

			// Advancing
			if (untilEnd >= 1) {
				$('.next').addClass('visible');
			} else {
				$('.next').removeClass('visible');
			}


		};
	}

	if ($('.archive').length) {
		var Archive = new PostsArchive();
		Archive.init();
	}


	// -----------------------------------------------------------------------------
	//! SEARCH FUNCTIONAILTY
	// -----------------------------------------------------------------------------


	// Submit keyword search
	$('.library-list-search').on('submit', function (e) {
		Archive.state.page = 1;
		e.preventDefault();
		searchString = $(this).find('input').val();
		Archive.state.search = searchString;
		Archive.getPosts();
	});

	$('.library-list-search-input').on('keyup', function (e) {
		searchString = $(this).val();
		if (searchString === '') {
			Archive.state.search = searchString;
			Archive.getPosts();
		}
	});

	$('.ui-menu').on('click', '.ui-menu-item', function (e) {
		Archive.state.page = 1;
		e.preventDefault();
		searchString = $('.library-list-search-input').val();
		Archive.state.search = searchString;
		Archive.getPosts();
	});


	// -----------------------------------------------------------------------------
	//! CLEAR CARD FILTERS
	// -----------------------------------------------------------------------------

	$('.library-list-filter-box-clear').on('click', function (e) {
		var $card = $(this).closest('.filter-card');

		// Pause post loading
		Archive.state.paused = true;

		// Un-check boxes and
		$card.find('.category:checked').each(function () {
			var id = $(this).val();

			$(this).removeAttr('checked').trigger('change');
		});

		// Un-pause
		Archive.state.paused = false;

		// Get posts
		Archive.getPosts();

		e.preventDefault();
	});


	// -----------------------------------------------------------------------------
	//! CLEAR ALL FILTERS
	// -----------------------------------------------------------------------------

	$('.clear-all-filters').on('click', function (e) {
		Archive.removeAllFilters();
		e.preventDefault();
	});


	// -----------------------------------------------------------------------------
	//! Check for URL params from Ind. librarys links
	// -----------------------------------------------------------------------------

	var getUrlParameter = function getUrlParameter(sParam) {
		var sPageURL = window.location.search.substring(1),
			sURLVariables = sPageURL.split('&'),
			sParameterName,
			i;

		for (i = 0; i < sURLVariables.length; i++) {
			sParameterName = sURLVariables[i].split('=');

			if (sParameterName[0] === sParam) {
				return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
			}
		}
	};

	var checkbox = getUrlParameter('category');

	var expand = getUrlParameter('expand');

	if (expand) {
		$('.library-list-filter-box').find('.library-filter-checkboxes').hide();
		$('.library-list-filter-box').find('.library-list-filter-box-title').addClass('is-collapsed');

		var expandDiv = $('.library-list-filter-box[data-filter="library-' + expand + '"]');
		$(expandDiv).find('.library-filter-checkboxes').show();
		$(expandDiv).find('.library-list-filter-box-title').removeClass('is-collapsed');

	}

	if (checkbox) {
		$('.checkbox-' + checkbox).prop('checked', true);
		triggerChange();
	}

	function triggerChange() {
		var checkbox = getUrlParameter('category');
		$('.checkbox-' + checkbox).trigger('change');
	}


});