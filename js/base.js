/**
* @package WordPress Portfolio Theme
* @version 0.5
* @author Aidan Amavi <mail@aidanamavi.com>
* @link https://www.aidanamavi.com Author's Web Site
* @copyright 2012 - 2024, Aidan Amavi
* @license https://www.gnu.org/licenses/agpl.html GNU Affero General Public License
*/

/**
**	To debug, find and uncomment all "// console.log"
**/

/**
**	Globals set by backend:
**	_paq, userId, nonce, siteTitle
**	showcaseAnimationIn, showcaseAnimationOut
**/
jQuery(document).ready( function() {
	// Configurable settings.
	var homepageDiv = 'page_archive_work';
	// Dynamic settings.
	var ajaxurl = window.location.protocol+'//'+window.location.host+'/wp-admin/admin-ajax.php';
	var visiblePage = jQuery('#content_wrapper :visible').attr('id');
	var pageReferrerUrl = document.referrer || document.location.href;
	var isPageLoading = false;
	var isSlideLoading = false;
	var isThumbnailLoading = false;
	var currentProjectType = 'all';
	var isTrackingOn = (typeof _paq === 'undefined') ? false : true;
	var state = window.history.state;

// TODO: Why does state still return null after replacing?
	function initiateState() {
		// console.log('initiateState()');
		// If missing a window history state
		if (!state) {
			var pageUrl = document.location.href;
			var pageTitle = window.document.title;
			var viewType = jQuery('#'+visiblePage).data('viewType');
			var postType = jQuery('#'+visiblePage).data('postType');
			var postId = jQuery('#'+visiblePage).data('postId');
			var pageState = {'pageUrl': pageUrl, 'viewType': viewType, 'postType': postType, 'postId': postId};
			// console.log('Detected missing state');
			// console.log('replaceState({pageUrl: ' + pageUrl + ', viewType: ' + viewType + ', postType: ' + postType + ', postId: ' + postId + '},' + pageTitle + ',' + pageUrl + ')');
			history.replaceState(pageState, pageTitle, pageUrl);
			// console.log('New state');
			var state = window.history.state;
			// console.log(state);
		} else {
			// console.log('Detected set state');
			// console.log(state);
		}
	}
	// Status notification system for automated UX feedback
	function showStatusNotification(message, isError) {
		// Create or update status notification
		if (!jQuery('#loading_status').length) {
			jQuery('body').append('<div id="loading_status" style="position:fixed;top:20px;right:20px;background:rgba(0,0,0,0.8);color:white;padding:10px 15px;border-radius:5px;font-size:12px;z-index:9999;max-width:300px;"></div>');
		}
		var statusEl = jQuery('#loading_status');
		statusEl.html(message);
		statusEl.css('background', isError ? 'rgba(204,0,0,0.8)' : 'rgba(0,0,0,0.8)');
		statusEl.stop().show().animate({'opacity': '1'}, 300);
	}
	
	function hideStatusNotification() {
		jQuery('#loading_status').stop().animate({'opacity': '0'}, 300, function(){
			jQuery(this).hide();
		});
	}

	//  Enables an event to fire after all images are loaded with automated retry
	jQuery.prototype.imagesLoaded = function() {
		// console.log('------ IMAGES LOADING ------');
    // Get all the images (excluding those with no src attribute)
    var $imgs = this.find('img[src!=""]');
    // If there are no images, just return an already resolved promise
    if (!$imgs.length) {return $.Deferred().resolve().promise();}
    
    var totalImages = $imgs.length;
    var loadedImages = 0;
    var failedImages = [];
    
    // Show initial status
    if (totalImages > 3) { // Only show for substantial image loads
    	showStatusNotification('Loading ' + totalImages + ' images...');
    }
    
    // For each image, add a deferred object to the array, which resolves when the image is loaded (or if loading fails)
    var dfds = [];
    $imgs.each(function(){
      var dfd = $.Deferred();
      dfds.push(dfd);
      var imgElement = this;
      var retryCount = 0;
      var maxRetries = 2; // Automated retry limit
      
      function attemptImageLoad() {
        var img = new Image();
        img.onload = function(){
        	loadedImages++;
        	if (totalImages > 3) {
        		showStatusNotification('Loaded ' + loadedImages + '/' + totalImages + ' images...');
        	}
        	dfd.resolve();
        };
        img.onerror = function(){
        	// Automated retry with exponential backoff
        	if (retryCount < maxRetries) {
        		retryCount++;
        		var delay = Math.pow(2, retryCount) * 1000; // 2s, 4s delays
        		if (totalImages > 3) {
        			showStatusNotification('Retrying image ' + retryCount + '/' + maxRetries + '...', false);
        		}
        		setTimeout(attemptImageLoad, delay);
        	} else {
        		// Failed after retries - add placeholder and resolve
        		failedImages.push(imgElement.src);
        		loadedImages++; // Count as "processed"
        		addImagePlaceholder(imgElement);
        		if (totalImages > 3) {
        			showStatusNotification('Loaded ' + loadedImages + '/' + totalImages + ' images (some failed)...', true);
        		}
        		dfd.resolve();
        	}
        };
        // Set a timeout for each image attempt to prevent hanging
        setTimeout(function() {
          if (dfd.state() === 'pending' && retryCount === 0) {
            // console.log('Image loading timeout for:', img.src);
            // Trigger retry mechanism on timeout
            img.onerror();
          }
        }, 8000); // 8 second timeout per image
        img.src = imgElement.src;
      }
      
      attemptImageLoad();
    });
    
    // Return a master promise object, which resolves when all deferred objects have resolved
    var masterPromise = $.when.apply($,dfds);
    masterPromise.then(function() {
    	// Hide status notification after a delay
    	setTimeout(function() {
    		if (failedImages.length > 0 && totalImages > 3) {
    			showStatusNotification(failedImages.length + ' images failed to load', true);
    			setTimeout(hideStatusNotification, 3000);
    		} else {
    			hideStatusNotification();
    		}
    	}, 1000);
    });
    
    return masterPromise;
	}
	
	// Add placeholder for failed images with automated background retry
	function addImagePlaceholder(imgElement) {
		var $img = jQuery(imgElement);
		var originalSrc = $img.attr('src');
		
		// Create placeholder wrapper
		var placeholder = jQuery('<div class="image-placeholder" style="background:#f0f0f0;border:1px dashed #ccc;display:flex;align-items:center;justify-content:center;color:#666;font-size:12px;min-height:100px;width:' + ($img.width() || 200) + 'px;height:' + ($img.height() || 100) + 'px;">Image failed to load<br><small>Retrying in background...</small></div>');
		
		// Replace image with placeholder
		$img.after(placeholder).hide();
		
		// Continue trying to load in background every 30 seconds
		var backgroundRetryTimer = setInterval(function() {
			var bgImg = new Image();
			bgImg.onload = function() {
				// Success! Replace placeholder with actual image
				$img.attr('src', originalSrc).show();
				placeholder.remove();
				clearInterval(backgroundRetryTimer);
			};
			bgImg.onerror = function() {
				// Still failing, continue trying
			};
			bgImg.src = originalSrc + '?' + Date.now(); // Cache busting
		}, 30000);
		
		// Stop trying after 5 minutes
		setTimeout(function() {
			clearInterval(backgroundRetryTimer);
			placeholder.html('Image unavailable');
		}, 300000);
	}
	String.prototype.capitalize = function() {
	  return this.replace(/(?:^|\s)\S/g, function(a) { return a.toUpperCase(); });
	};
	function updateVisiblePage() {
		visiblePage = jQuery('#content_wrapper :visible').attr('id');
		// console.log('updateVisiblePage('+visiblePage+')');
		// Enables checking for new posts since visiblePage was last viewed.
		areAllPostsLoaded = false;
	}
	function showLoadingAnimation() {
		// console.log('showLoadingAnimation()');
		if (isPageLoading) {
			// console.log('isLoading: wants showing');
			return;
		}
		isPageLoading = true;
		jQuery('#loading_animation').stop().show().animate({'opacity': '1'},500, function(){
			jQuery('html').scrollTop(0);
		});
	}
	function hideLoadingAnimation() {
		// console.log('hideLoadingAnimation()');
		// Ensure we don't hide an already hidden animation to prevent issues
		if (!isPageLoading && jQuery('#loading_animation').css('opacity') == '0') {
			// console.log('Loading animation already hidden, skipping...');
			return;
		}
		jQuery('#loading_animation').stop().animate({'opacity': '0'},500, function(){
			isPageLoading = false;
			updateVisiblePage();
			adjustSlideHeight();
			jQuery('#loading_animation').hide();
		});
	}
	function addHighlightSlideCursor() {
		jQuery('div.highlight_slides').each( function(){
			var divs = jQuery(this);
			var the_count = divs.children().length;
			if (the_count > 1) {
				divs.children().css('cursor', 'pointer');
			}
		});
	}
	function transitionSlide(pageId, oldSlide, newSlide) {
		var newSlideElement = jQuery('div#'+pageId+' .highlight_slides div[data-slide='+newSlide+']');
		var oldSlideElement = jQuery('div#'+pageId+' .highlight_slides div[data-slide='+oldSlide+']');
		// Show next slide, and hide visible slide.
		newSlideElement.stop().css('z-index','10').stop().show().animate({'opacity':'1'},250, function() {
			oldSlideElement.stop().animate({'opacity':'0'},250, function(){
				oldSlideElement.hide();
				newSlideElement.css('z-index','5');
				trackAction(pageId, newSlide);
				isSlideLoading = false;
			});
		});
		var buttonList = jQuery('#'+pageId+' .numbers_wrapper .numbers');
		var newButtonImage = buttonList.children('[data-slide='+newSlide+']').children('img.off');
		var oldButtonImage = buttonList.children('[data-slide='+oldSlide+']').children('img.off');
		// Make the off button visible to turn off highlight.
		oldButtonImage.stop().show().animate({'opacity':'1'},300);
		// Make the off button invisible to turn on highlight. Then hide.
		newButtonImage.stop().animate({'opacity':'0'},300, function(){
			newButtonImage.hide();
		});
	}
	function isEmpty( element ){
		return !$.trim( element.html() );
	}
	function loadPage(pageUrl, viewType, postType, postId, isPushHistory) {
		if (isPushHistory === undefined) { isPushHistory = true; }
		// console.log('function loadPage(' + pageUrl + ',' + viewType + ',' + postType + ',' + postId + ',' + isPushHistory + ')');
		if (isPageLoading) { return; }
		var pageDiv = getPageDiv(viewType, postType, postId);
		if (pageDiv === visiblePage) { return; }
		// console.log('function ajax({action: getAjaxData, viewType: '+viewType+', postType: '+postType+', postId: '+postId+', token: '+window.nonce+' })');
		showLoadingAnimation();
		if (isEmpty(jQuery('#'+pageDiv))) {
			jQuery.ajax({
				type: 'POST',
				url: ajaxurl,
				data: {action: 'getAjaxData', viewType: viewType, postType: postType, postId: postId, token: window.nonce },
				success: function(pageContent) {
					displayPage(pageDiv, pageUrl, pageContent);
				},
				error: function(xhr){
					// console.log('AJAX error');
					if (xhr.status === 403) {
						displayPage('page_error_403', false, xhr.responseText);
					} else {
						// console.log(xhr.responseText);
						// console.log(xhr.status);
						hideLoadingAnimation();
					}
				}
			});
		} else {
			// console.log('Detected cached content');
			displayPage(pageDiv, pageUrl);
		}
		// If not going back in history, add new history entry
		if (isPushHistory) {
			var pageTitle = jQuery('#'+pageDiv).data('pageTitle');
			updateBrowserHistory({pageUrl: pageUrl, viewType: viewType, postType: postType, postId: postId}, pageTitle, pageUrl);
		}
	} // loadpage()

	function adjustSlideHeight(){
		postType = jQuery('#'+visiblePage).data('postType');
		if (postType === 'work' || postType === 'about'){
			// TODO: and not page_Archive_work
			var windowHeight = $(window).height();
			var numbersWrapperHeight = 70; // 34.6px
			var slideHeightImg = jQuery('.slide:visible img.highlight').height(); // 529px
				if (!parseInt(slideHeightImg)) { slideHeightImg = 0; }
			var slideHeightText = jQuery('.slide:visible .highlight_text').height(); // 529px
			var slideHeight = jQuery('.slide:visible').height();
			var slideHeight2 = slideHeightImg + slideHeightText;
			// console.log('visiblePage: '+visiblePage);
			// console.log('postType: '+postType);
			// console.log('windowHeight: '+windowHeight);
			// console.log('numbersWrapperHeight: '+numbersWrapperHeight);
			// console.log('slideHeightImg: '+slideHeightImg);
			// console.log('slideHeightText: '+slideHeightText);
			// console.log('slideHeight: '+slideHeight);
			// console.log('slideHeight2: '+slideHeight2);
			var cssHeight = numbersWrapperHeight + slideHeight2;
			// console.log('cssHeight: '+cssHeight);
			jQuery('#'+visiblePage).css('height', cssHeight);
		}
	}

	$(window).on('scroll resize', adjustSlideHeight);
	// TODO: update visible page to fix category workflow
	function displayPage(pageDiv, pageUrl, pageContent) {
		// console.log('function displayPage(' + pageDiv + ',' + pageUrl + ', pageContent)');
		// console.log('Hiding visiblePage: ' + visiblePage);
		jQuery('#'+visiblePage).stop().animate({'opacity':'0'},750, function() {
			jQuery('#'+visiblePage).hide( function() {
				if (pageContent) {
					jQuery('#content_wrapper').css('opacity', '0');
					// Set up a fallback timeout for dynamic content loading
					var displayPageTimeoutId = setTimeout(function() {
						// console.log('Display page timeout triggered - forcing loading animation to hide');
						showStatusNotification('Page loading timeout - continuing with available content', true);
						setTimeout(hideStatusNotification, 3000);
						jQuery('#content_wrapper').animate({'opacity':'1'},1000);
						hideLoadingAnimation();
					}, 8000); // 8 second fallback timeout for dynamic content
					
					jQuery('#content_wrapper').append(pageContent).imagesLoaded().then(function(){
						// console.log('------ IMAGES LOADED ------');
						clearTimeout(displayPageTimeoutId);
						jQuery('#content_wrapper').animate({'opacity':'1'},1000);
						hideLoadingAnimation();
        	}).catch(function(error) {
						// Handle any errors in the image loading process for dynamic content
						// console.log('Error during dynamic content image loading:', error);
						clearTimeout(displayPageTimeoutId);
						showStatusNotification('Some page content failed to load - continuing anyway', true);
						setTimeout(hideStatusNotification, 3000);
						jQuery('#content_wrapper').animate({'opacity':'1'},1000);
						hideLoadingAnimation();
					});
					addHighlightSlideCursor();
				} else {
					// scenario: restart browser with forward history, no div/content
					// TODO: if there is no content & no pagediv loaded
					// if div exists, then..
					jQuery('#'+pageDiv).show().animate({'opacity':'1'},1000);
					hideLoadingAnimation();
					// if div doesnt exist, load. (needed for back history)
				}
				updateCategory(pageDiv);
				updateTitle(pageDiv);
				pageTitle = window.document.title;
				trackPage(pageUrl, pageTitle);
				// hideLoadingAnimation();
			});
		});
	}
	function trackPage(pageUrl, pageTitle) {
		// console.log('trackPage(' + pageUrl + ',' + pageTitle + ')');
		if (!isTrackingOn) {
			// console.log('Tracking Disabled');
			return;
		}
		// console.log('Tracking Enabled');
		pageUrl = pageUrl || document.location.href;
		pageTitle = pageTitle || window.document.title;
		_paq.push(['setCustomUrl', pageUrl]);
		_paq.push(['setDocumentTitle', pageTitle]);
		_paq.push(['setReferrerUrl', pageReferrerUrl]);
		_paq.push(['trackPageView']);
	}
	function trackAction(pageName, slideNumber) {
		// trackEvent(category, action, [name], [value])
		// console.log('trackAction(' + pageName + ',' + slideNumber + ')');
		if (!isTrackingOn) {
			// console.log('Tracking Disabled');
			return;
		}
		pageName = jQuery('#'+pageName).data('pageTitle');
		slideNumber = 'Slide '+slideNumber;
		_paq.push(['trackEvent', 'Slides', pageName, slideNumber]);
	}
	function updateCategory(pageDiv) {
		// console.log('updateCategory(' + pageDiv + ')');
		var postType = jQuery('#'+pageDiv).data('postType');
		var categoryId = jQuery('#'+pageDiv).data('categoryId');
		// console.log('postType(' + postType + ')');
		// console.log('categoryId(' + categoryId + ')');
		if (postType === 'category') {
			window.categoryName = postType;
			window.categoryId = categoryId;
			// console.log('New categoryName: '+window.categoryName);
		} else {
			window.categoryName = postType;
			// console.log('New categoryName: '+window.categoryName);
		}
	}
	function updateTitle(pageDiv) {
		var pageTitle = jQuery('#'+pageDiv).data('pageTitle');
		window.document.title = pageTitle;
	}
	function updateBreadcrumb(pageDiv) {
		// console.log('updateTitle(' + pageDiv + ')');
		var pageTitle = jQuery('#'+pageDiv).data('pageTitle');
		var viewType = jQuery('#'+pageDiv).data('viewType');
		var postType = jQuery('#'+pageDiv).data('postType');
		var pageSeperator = ' › ';
		var newSiteTitle;
		if(viewType === 'category'){
			newSiteTitle = siteTitle+pageSeperator+postType+pageSeperator+viewType+pageSeperator+pageTitle;
		} else if (viewType === 'archive') {
			newSiteTitle = siteTitle+pageSeperator+postType+pageSeperator+viewType;
		} else if (viewType === 'single'){
			newSiteTitle = siteTitle+pageSeperator+postType+pageSeperator+pageTitle;
		}
		window.document.title = newSiteTitle.capitalize();
	}
	function updateBrowserHistory(pageState, pageTitle, pageUrl) {
		// console.log('updateBrowserHistory(' + pageState + ',' + pageTitle + ',' + pageUrl + ')');
		pageStateConsole = JSON.stringify(pageState, null, 4);
		// console.log(pageStateConsole);
		// Update the pageReferrerUrl for tracking functionality
		pageReferrerUrl = document.location.href;
		history.pushState(pageState, pageTitle, pageUrl);
	}
	function getPageDiv(viewType, postType, postId) {
		// console.log('getPageDiv('+viewType+','+postType+','+postId+')');
		var divId = 'page';
		if(viewType && postType){
			divId = divId+'_'+viewType;
			if(viewType !== 'category'){
				divId = divId+'_'+postType;
			}
			if(postId){
				divId = divId+'_'+postId;
			}
		}
		return divId;
	}

	// First page load.
	window.onload = function() {
		// Set up a fallback timeout to ensure loading animation is always hidden
		var loadingTimeoutId = setTimeout(function() {
			// console.log('Loading timeout triggered - forcing loading animation to hide');
			showStatusNotification('Loading timeout - continuing with available content', true);
			setTimeout(hideStatusNotification, 3000);
			hideLoadingAnimation();
		}, 10000); // 10 second fallback timeout

		jQuery('html').animate({'opacity':'1'},1, function(){
			jQuery('#content_wrapper').imagesLoaded().then(function(){
				// After images are loaded
				// console.log('------ IMAGES LOADED ------');
				// TODO: add a show event and add a display none to content wrapper; fixes ovefflow issues when loading animation...
				clearTimeout(loadingTimeoutId); // Clear the fallback timeout since images loaded successfully
				jQuery('#content_wrapper').animate({'opacity':'1'},750);
				hideLoadingAnimation();
			}).catch(function(error) {
				// Handle any errors in the image loading process
				// console.log('Error during image loading:', error);
				clearTimeout(loadingTimeoutId);
				showStatusNotification('Some content failed to load - continuing anyway', true);
				setTimeout(hideStatusNotification, 3000);
				jQuery('#content_wrapper').animate({'opacity':'1'},750);
				hideLoadingAnimation();
			});
		});
		initiateState();
		// List all images for debugging
		// jQuery("img").each(function() {
    //   imgsrc = this.src;
    // 	// console.log('Source: '+imgsrc);
		// });
		postType = jQuery('#'+visiblePage).data('postType');
		jQuery('#navigation_wrapper a.underline[data-post-type='+postType+']').addClass('on');
	};
	addHighlightSlideCursor();
	// Back and forward navigation event handlers.
	window.addEventListener('popstate', function(event) {
		if (isPageLoading) {
			// console.log('HALTED back history');
			return;
		}
		var state = window.history.state;
		event.preventDefault();
		event.stopPropagation();
		if (!state) {
			// console.log('No history state..');
			// console.log(state);
			// TODO: report issue via ajax
		} else if (state) {
			// console.log('Detected history state..');
			// console.log(state); // page_archive_blog
			// console.log('Event:');
			// console.log(event);
			var pageUrl = state.pageUrl;
			var viewType = state.viewType;
			var postType = state.postType;
			var postId = state.postId;
			var isPushHistory = false;
			loadPage(pageUrl, viewType, postType, postId, isPushHistory);
		}
	});
	// Mouse over effects for the navigation.
	jQuery('nav img.off').hover(
		function() {
			// console.log('hover');
			jQuery(this).stop().animate({'opacity': '0'},250); },
		function() {
			jQuery(this).stop().animate({'opacity': '1'},250);
	});
	// Focus effects for the navigation.
	jQuery('nav a').focusin(
		function() {
			jQuery(this).children('img.off').stop().animate({'opacity': '0'},250);
		}
	);
	jQuery('nav a').focusout(
		function() {
			jQuery(this).children('img.off').stop().animate({'opacity': '1'},250);
		}
	);
	// Link click event handlers for pages, posts, categories, and outlinks.
	jQuery(document).on('click', 'a', function(event){
		function internalLink() {
			event.preventDefault();
			event.stopPropagation();
		}
		function updateNavigationUnderline(linkType){
			jQuery('a.underline.on[data-link-type='+linkType+']').removeClass('on');
			link.addClass('on');
		}
		var link = jQuery(this);
		var linkType = link.data('linkType');
		var pageUrl = link.attr('href');
		// console.log('Anchor clicked: ' + pageUrl);
		updateNavigationUnderline(linkType);
		if (linkType === 'headerNavigation') {
			internalLink();
			var postType = link.data('postType');
			var viewType = link.data('viewType');
			loadPage(pageUrl, viewType, postType);
		} else if (linkType === 'workNavigation') {
			internalLink();
			var projectType = link.data('projectType');
			if (!isThumbnailLoading && projectType !== currentProjectType) {
				isThumbnailLoading = true;
				animateIn = showcaseAnimationIn;
				animateOut = showcaseAnimationOut;
				if (!animateIn || !animateOut){
					animateIn = 'animate__fadeIn';
					animateOut = 'animate__fadeOut';
				}
				$('#page_archive_work .column').addClass('animate__animated '+animateOut);
				$('#page_archive_work .row').fadeOut(1000, function() {
					$('#page_archive_work .column').hide().removeClass('animate__animated '+animateOut);
					$('#page_archive_work .column[data-project-type~="'+projectType+'"]').show().addClass('animate__animated '+animateIn);
					$('#page_archive_work .row').fadeIn(1000, function() {
						$('#page_archive_work .column[data-project-type~="'+projectType+'"]').removeClass('animate__animated '+animateIn);
						currentProjectType = projectType;
						isThumbnailLoading = false;
						projectType = projectType.capitalize();
						if (isTrackingOn) {
							_paq.push(['trackEvent', 'Types', 'Work', projectType]);
						}
					});
				});
			}
		} else if (linkType === 'postNavigation') {
			internalLink();
			var viewType = link.data('viewType');
			var postType = link.data('postType');
			var postId = link.data('postId');
			var categoryId = link.data('categoryId');
			var theId = postId || categoryId;
			loadPage(pageUrl, viewType, postType, theId);
		}
	});
	// Link click event handlers for slide navigation.
	jQuery(document).on('click', '#content_wrapper div .numbers_wrapper .numbers div', function(){
		var button = jQuery(this);
		var pageId = button.parent().parent().parent().attr('id');
		var newSlide = button.data('slide');
		var oldSlide = jQuery('#'+pageId+' .highlight_slides > div:visible').data('slide');
		if (oldSlide !== newSlide && !isSlideLoading) {
			isSlideLoading = true;
			transitionSlide(pageId, oldSlide, newSlide);
		}
	});
	jQuery(document).on('click', '#content_wrapper div .highlight_slides div img.highlight', function(){
		var slide = jQuery(this).parent();
		var pageId = slide.parent().parent().attr('id');
		var oldSlide = slide.data('slide');
		var totalDivs = slide.parent().children().length;
		if (totalDivs > 1 && !isSlideLoading) {
			isSlideLoading = true;
			var nextDiv = slide.next('div');
			var newSlide;
			if (nextDiv.length === 0) {
				nextDiv = slide.prevAll('div').last();
				newSlide = nextDiv.data('slide');
			} else {
				newSlide = nextDiv.data('slide');
			}
			transitionSlide(pageId, oldSlide, newSlide);
		}
	});
	/**
	 * Infinite scrolling.
	 *
	 * areAllPostsLoaded resets with function updateVisiblePage.
	 * uses isPageLoading.
	 */
	var categoryId, offsetPosts, areAllPostsLoaded, windowHeight, scrollPosition;
	categoryId = window.categoryId;
	jQuery(window).scroll(function() {
		windowHeight = jQuery(document).height() - jQuery(window).height();
		scrollPosition = jQuery(window).scrollTop() + 200;
		if (scrollPosition >= windowHeight && !areAllPostsLoaded && !isPageLoading) {
			if (jQuery('#page_category_'+categoryId).is(':visible')) {
				showLoadingAnimation();
				offsetPosts = jQuery('#page_category_'+categoryId+' > article').length;
				jQuery.ajax({
					type: 'POST',
					url: ajaxurl,
					data: {action: 'getAjaxData', category: categoryId, offset: offsetPosts, token: window.nonce },
					success: function(response) {
						if (response === '') {
							areAllPostsLoaded = true;
						} else {
							jQuery('#page_category_'+categoryId+':last-child').append(response);
						}
					},
					error: function(xhr){
						if (xhr.status === 403) {
							displayPage('page_error_403', false, xhr.responseText);
						}
					},
					complete: function() {
						hideLoadingAnimation();
					}
				});
			} else if (jQuery('#page_blog').is(':visible')) {
				showLoadingAnimation();
				offsetPosts = jQuery('#page_blog > article').length;
				jQuery.ajax({
					type: 'POST',
					url: ajaxurl,
					data: {action: 'getAjaxData', category: '', offset: offsetPosts, token: window.nonce },
					success: function(response) {
						if (response === '') {
							areAllPostsLoaded = true;
						} else {
							jQuery('#page_blog:last-child').append(response);
						}
					},
					error: function(xhr){
						if (xhr.status === 403) {
							displayPage('page_error_403', false, xhr.responseText);
						}
					},
					complete: function() {
						hideLoadingAnimation();
					}
				});
			}
		}
	});
});
