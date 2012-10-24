if (navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i)) {
var viewportmeta = document.querySelectorAll('meta[name="viewport"]')[0];
if (viewportmeta) {
viewportmeta.content = 'width=device-width, minimum-scale=1.0, maximum-scale=1.0';
document.body.addEventListener('gesturestart', function() {
viewportmeta.content = 'width=device-width, minimum-scale=0.25, maximum-scale=1.6';
}, false);
}
}
var Site = window.Site || {};

(function($) {

	$(function() {

		//
		// ISOTOPE
		//
		$.Isotope.prototype._getCenteredMasonryColumns = function() {
			this.width = this.element.width();

			var parentWidth = this.element.parent().width();

						  // i.e. options.masonry && options.masonry.columnWidth
			var colW = this.options.masonry && this.options.masonry.columnWidth ||
							// or use the size of the first item
							this.$filteredAtoms.outerWidth(true) ||
							// if there's no items, use size of container
							parentWidth;

			var cols = Math.floor( parentWidth / colW );
			cols = Math.max( cols, 1 );

			// i.e. this.masonry.cols = ....
			this.masonry.cols = cols;
			// i.e. this.masonry.columnWidth = ...
			this.masonry.columnWidth = colW;
		};

		$.Isotope.prototype._masonryReset = function() {
			// layout-specific props
			this.masonry = {};
			// FIXME shouldn't have to call this again
			this._getCenteredMasonryColumns();
			var i = this.masonry.cols;
			this.masonry.colYs = [];
			while (i--) {
				this.masonry.colYs.push( 0 );
			}
		};

		$.Isotope.prototype._masonryResizeChanged = function() {
			var prevColCount = this.masonry.cols;
			// get updated colCount
			this._getCenteredMasonryColumns();
			return ( this.masonry.cols !== prevColCount );
		};

		$.Isotope.prototype._masonryGetContainerSize = function() {
			var unusedCols = 0,
				i = this.masonry.cols;
			// count unused columns
			while ( --i ) {
				if ( this.masonry.colYs[i] !== 0 ) {
				break;
				}
				unusedCols++;
			}

			return {
					height : Math.max.apply( Math, this.masonry.colYs ),
					// fit container to columns that have been used;
					width : (this.masonry.cols - unusedCols) * this.masonry.columnWidth
				};
		};

		var $container   = $('body.list_page #main'),
			$body          = $('body'),
			colW           = 335,
			columns        = null
		;

		$container.imagesLoaded(function () {
			$container.isotope({
				resizable: false,
				animationEngine : 'best-available',
				itemSelector    : 'article',
				transformsEnabled: false,
				masonry: {
					columnWidth: colW
				}
			});
		});

		// Force Isotope to 'reLayout' on window resize
		function isotopeResize() { $container.isotope( 'reLayout' ); }
		var TO = false;
		$(window).resize(function(){
			if(TO !== false)
			clearTimeout(TO);
			TO = setTimeout(isotopeResize, 200); //200 is time in miliseconds
		});

		// Filter the Isotope items
		$('#nav a.filter').click(function () {
			var $this = $(this);
			// don't proceed if already selected
			if ( $this.hasClass('selected') ) {
				return false;
			}
			var selector = $(this).attr('data-filter');
			$container.isotope({ filter: selector });
			$this.addClass('active').parent().siblings().find('a').removeClass('active');

			return false;
		});


		//
		// INFINITE SCROLL
		//
		var counter = 1;
		$container.infinitescroll({
			navSelector  : '#older_newer',    // selector for the paged navigation
			nextSelector : '#older_newer a.older',  // selector for the NEXT link (to page 2)
			itemSelector : 'article',     // selector for all items you'll retrieve
			bufferPx: 40,
			donetext: "No more items to load.",
			loading: {
				finishedMsg: 'No more pages to load.',
				img: '/-/img/ajaxLoader.gif'
			},
			errorCallback: function() {
				$("#older_newer").hide();
			}},
			// call Isotope as a callback

			function( newElements ) {
				counter++;
				$container.imagesLoaded(function () {
					$container.isotope('insert', $( newElements ) ).isotope( 'reLayout' );
					$(newElements).first().attr('id', 'page' + counter );
					$('#paging').find('a:last').after('<a href="#page' + counter + '" title="Click here to navigate to page' + counter + '">Page '+ counter + '</a>');
				});
			});
		//
		// LIGHTBOX
		//
		var
			article         =  $('article'),
			container       =  $('#container'),
			title           =  article.find('a[rel=ajax]'),
			body            =  $('body'),
			html            =  $('html'),
			level1          =  $('#level_1'),
			level1container =  $('#level_1_container'),
			backdrop        =  $('#backdrop'),
			ajax_load       =  '<img src="/-/img/ajaxLoader.gif" alt="loading..." class="spinner" />'
		;
		title.live('click', function() {
			//event.preventDefault();
			var
				titleHref = $(this).attr('href'),
				topPos    = body.scrollTop()
			;
			container.css({
				'top'   : -topPos,
				'left'  : 0,
				'right' : 0
			});
			body.addClass('levels');

			resizeStuff();
			//window.resize
			var TO = false;
			$(window).resize(function(){
				if(TO !== false)
				clearTimeout(TO);
				TO = setTimeout(resizeStuff, 200);
			});

			// level #1 / lightbox
			level1.html(ajax_load).load(titleHref + ' #article', function(){
				$container.infinitescroll('pause');
				//var parent = $(this).parent();
				$('#level_1_container,#backdrop').css('top', '0').fadeIn('slow');

				// Load Level #1 Next/Prev
				var neighbour = $('#neighbours a');
				neighbour.live('click', function() {
					level1.unload();
					var This = $(this),
							href = This.attr('href');
					level1.load(href + ' #article');
					return false;
				});

				// Unload Level #1
				$('#backdrop, #nav a').click(function() {
					$('#backdrop').fadeOut(20);
					level1.unload()
						.parent()
						.fadeOut(200, function() {
							body.scrollTop(topPos).removeClass('levels');
							$container.infinitescroll('resume');
					});
					return false;
				});

			});//.load
			return false;
		});//.click

		//
		// BLOCK CLICKABLE
		//
		var listArticle = $('article.list');
		listArticle.live('click', function(event){
			event.preventDefault();
			window.location=$(this).find(title).click();
		});

		function resizeStuff() {
			var windowHeight =  $(window).height();
			body.height(windowHeight);
		}

	});//End Doc Ready

})(jQuery);