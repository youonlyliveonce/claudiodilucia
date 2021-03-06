/*global me, app*/
import _ from 'underscore';
import View from 'ampersand-view';
import dom from 'ampersand-dom';
import ViewSwitcher from 'ampersand-view-switcher';
// import Hammer from 'hammerjs';

import "ScrollToPlugin";
import "DrawSVGPlugin";
import "TweenMax";
import AOS from "aos";

var MainView = View.extend({

		/* Set Properties */
		props: { },

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
						hide: function (oldView, cb) {
								// Set scope for callback of TweenMax
								var inSwitcher = this;

								// Hide oldView if oldView exits
								if(oldView && oldView.el){
										oldView.hookBeforeHide();
										self.scrollTo(0);
										TweenMax.delayedCall(0.5, function(){
											cb.apply(inSwitcher);
										});
								}
						},
						show: function (newView) {
								self.page.setAttribute('class', newView.model.pageClass);
								TweenMax.set(newView.el, {opacity:0});
								newView.hookToShow();
								TweenMax.to(newView.el, 0.45, {opacity: 1, onComplete:function(){

								}});
						}
				});

				AOS.init();

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
				view.hookToShow(1);

				// Set current view of page switcher (silent)
				this.pageSwitcher.current = view;

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

		scrollTo: function(value) {
			if(window.CM.Loader.mobile) {
					TweenMax.to(window, 0.25, {scrollTo:{y:value, autoKill:false}});
			} else {
					TweenMax.to(window, 0.75, {scrollTo:{x:0, y:value, autoKill:true}, overwrite:true, ease:Power2.easeOut});
			}
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
				// let path = window.location.pathname.slice(1),
				// 		topnavi = this.queryAll('.Navigation a[href]');
				//
				// if (CM.App._params != {} && CM.App._params.section != null){
				// 	path = `${path}?section=${CM.App._params.section}`;
				// }
				//
				// if(path == this.pageSwitcher.current.model.lang + "/"){
				// 	topnavi.forEach(function (aTag) {
				// 		dom.removeClass(aTag, 'active')
				// 	});
				// 	dom.addClass(topnavi[0], 'active')
				// } else {
				// 	topnavi.forEach(function (aTag) {
				// 		if(aTag.href.indexOf(path) != -1){
				// 			dom.addClass(aTag, 'active')
				// 		} else {
				// 			dom.removeClass(aTag, 'active')
				// 		}
				// 	});
				// }
		}

});


export default MainView;
