/*global me, app*/
import _ from 'underscore';
import View from 'ampersand-view';
import dom from 'ampersand-dom';
import ViewSwitcher from 'ampersand-view-switcher';
// import Hammer from 'hammerjs';

import "ScrollToPlugin";
import "DrawSVGPlugin";
import "TweenMax";

var MainView = View.extend({

		/* Set Properties */
		props: {
			isSticky: ['boolean', true, false],
			isSwiping: ['boolean', true, false],
			hammerSwipe: ['object', true, function(){ return []; } ],
		},

		/* Bind basic Events, all link clicks, toggle Navigation, etc. */
		events: {
				'click a[href]': 'handleLinkClick'
				,'click .Button--toggle': 'handleClickToggle'
				// ,'keydown': 'handleKeyDown'
				// ,'keyup': 'handleKeyDown'
				// 'click .Button--close': 'handleClickToggle',
		},

		/* Render Main View */
		render: function () {

				/* Set scope for callbacks */
				var self = this;

				/* Cache Elements */
				this.cacheElements({
						page: '.Page',
						pageinner: '.Page__inner',
						main: '[role="main"]',
						header: '.Header',
						headerlogo: '.Header__logo',
						nav: '.Navigation',
						switcher: '[data-hook=switcher]'
				});

				// Init and configure our page switcher
				this.pageSwitcher = new ViewSwitcher(this.main, {
						waitForRemove: true,
						hide: function (oldView, cb) {
								// Set scope for callback of TweenMax
								var inSwitcher = this;

								// Hide oldView if oldView exits
								if(oldView && oldView.el){
										oldView.hookBeforeHide();
										TweenMax.to(oldView.el, 0.4, {opacity:0, onComplete:function(){
												// scroll to top
												// TweenMax.to(window, 0.3, {scrollTo:{y:0}});
												// cb triggers the show function in ViewSwitcher
												cb.apply(inSwitcher);
										}});
								}
						},
						show: function (newView) {

								TweenMax.set(newView.el, {opacity:0});
								// Set newView opacity to 0
								// Handle resize
								if(!CM.App._mobile){
									newView.handleResize();
								}
								self.scrollTo(0);

								TweenMax.to(newView.el, 0.8, {opacity:1, onComplete:function(){
									// Scroll to paramter 'section'
									self.scrollTo(0);
									newView.hookAfterShow();
								}, delay:0.3});
						}
				});
				return this;

		},

		/*

			Function for the inital Handling of the Page

		*/

		handleInitialView: function (view) {

				var self = this;

				// Set child view as initial
				view.isInitial = true;

				// Set the el of the child view
				view.el = this.query('.View');

				// Render child view
				view.render();

				// After transition Stuff
				view.hookAfterShow();

				// Set current view of page switcher (silent)
				this.pageSwitcher.current = view;

				// Handle resize
				// if(!CM.App._mobile){
				// 	view.handleResize();
				// }

				// Scroll to paramter 'section'
				TweenMax.delayedCall(0.15, function(){ self.handleUpdateView() });

				// Handle active stuff in navigation
				this.updateActiveNav();
		},

		/*

			Function for the Handling of a new Page loaded via Ajax

		*/

		handleNewView: function (view) {

				document.title = _.result(view.model, 'pageTitle');

				// TRACKING
				if(typeof ga != 'undefined'){
						ga('send', 'pageview', {
								'page': CM.App.router.history.location.pathname,
								'title': view.model.pageTitle
						});
				}

				this.page.setAttribute('class', 'Page');

				// SWICTH THE VIEW
				this.pageSwitcher.set(view);

				// UPDATE PAG NAV
				this.updateActiveNav();

		},

		/*
			Updates current View if something changes but no url
		*/
		handleUpdateView: function(){
			this.scrollTo();
		},

		/*
			Toggle functions for mobile or Desktop Navigation
		*/

		handleClickToggle: function (e){
			var body = document.body;
			if( dom.hasClass(body, 'Navigation--show') || e == undefined){
					dom.removeClass(body, 'Navigation--show');
			} else {
					dom.addClass(body, 'Navigation--show');
			}
		},

		handleClickClose: function (e){
			var body = document.body;
			dom.removeClass(body, 'Navigation--show');
		},

		handleClickOpen: function (e){
			var body = document.body;
			dom.addClass(body, 'Navigation--show');
		},

		handleResize: function(e){
			if(CM.App.mainView && CM.App.mainView.pageSwitcher.current){
				CM.App.mainView.pageSwitcher.current.handleResize();
			}
			if (CM.App._params != {} && CM.App._params.section != null){
					let id = CM.App.mainView.query('#'+CM.App._params.section);
					TweenMax.set(CM.App.mainView.main, {y:-1*id.offsetTop, overwrite:true});
			}
		},

		handleKeyDown: function(event){
			event.preventDefault ? event.preventDefault() : (event.returnValue = false);
			if(CM.App.mainView.pageSwitcher.current){
				CM.App.mainView.pageSwitcher.current.handleKeyDown(event);
			}
		},
		/*

		Click Handler for each a[href]

		*/

		handleLinkClick: function (e) {

			var aTag = e.delegateTarget,
					self = this,
					path = aTag.getAttribute("href"),
					params = path.split("?")[1];

				var local = aTag.host === window.location.host;
				if (local && !e.ctrlKey && !e.shiftKey && !e.altKey && !e.metaKey && aTag.getAttribute("target") !== "_blank") {
						// no link handling via Browser
						e.preventDefault ? e.preventDefault() : (e.returnValue = false);

						// Update View without reloading view
						if (CM.App._params != {} && CM.App.router.history.location.pathname == e.delegateTarget.pathname && CM.App._paramsString == params){
							this.handleUpdateView();
						} else {
							CM.App.navigate(path);
						}
						// Close Navigation
						this.handleClickClose();
				}
		},


		updateActiveNav: function () {
				let path = window.location.pathname.slice(1),
						topnavi = this.queryAll('.Navigation a[href]'),
						if (CM.App._params != {} && CM.App._params.section != null){
							path = `${path}?section=${CM.App._params.section}`;
						}
				if(path == this.pageSwitcher.current.model.lang + "/"){

					topnavi.forEach(function (aTag) {
						dom.removeClass(aTag, 'active')
					});

					dom.addClass(topnavi[0], 'active')
				} else {
					topnavi.forEach(function (aTag) {
						if(aTag.href.indexOf(path) != -1){
							dom.addClass(aTag, 'active')
						}else {
							dom.removeClass(aTag, 'active')
						}
					});

				}

		}

});


export default MainView;