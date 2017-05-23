/*global app, me, $*/
import _ from 'underscore';
import Router from './router';
import MainView from './main-view';

// Responive Images
import lsRias from './vendor/lazysizes-gh-pages/plugins/rias/ls.rias.min.js';
import lazySizes from './vendor/lazysizes-gh-pages/lazysizes.min.js';

window.lazySizesConfig = window.lazySizesConfig || {};
window.lazySizesConfig.rias = window.lazySizesConfig.rias || {};
window.lazySizesConfig.rias.widths = [340, 640, 940, 1200];
window.lazySizesConfig.rias.widthmap = {
		340: '/small/',
		640: '/medium/',
		940: '/large/',
		1200: '/'
};
Number.prototype.toHHMMSS = function () {
    var sec_num = parseInt(this, 10); // don't forget the second param
    var hours   = Math.floor(sec_num / 3600);
    var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
    var seconds = sec_num - (hours * 3600) - (minutes * 60);

    if (hours   < 10) {hours   = "0"+hours;}
    if (minutes < 10) {minutes = "0"+minutes;}
    if (seconds < 10) {seconds = "0"+seconds;}
    return minutes+':'+seconds;
}
/* Class Defintion */
class App {

		_version = 1.0
		_mobile = false

		constructor (el) {
				this._sayHello()

				// Singleton Object
				if(window.CM == null) window.CM = {};
				window.CM.App = this;

				// init
				this._initial = true;
				this._params = {};

				this.router = new Router();
				this.mainView = new MainView({
						el: el
				});
		}
		// this is the the whole app initter
		blastoff (options) {
				let self = this;
				this._mobile = options.mobile;
				// Render Main View
				this.mainView.render();

				// watch for changes
				this.router.on("page", function(view, params){

						// save params in App or kill all if none where set in url
						self._setParams(params);

						// set listener on model
						view.model.on("sync", function(model, resp){
								if(!self._initial){
										self.mainView.handleNewView(view);
								} else {
										self.mainView.handleInitialView(view);
										self._initial = false;
								}
						});
						view.model.on("error", function(model, resp){
								console.warn("failed to load: ", model.url);
						});
						// load html in model
						view.model.fetch();
				});

				// watch for Updates
				this.router.on("update", function(params){
					self._setParams(params);
					self.mainView.handleUpdateView();

				})

				// we have what we need, we can now start our router and show the appropriate page
				this.router.history.start();
				this.addEvents();
		}
		showPage() {
			TweenMax.to(this.mainView.page, 0.35, {scale:1, ease:Cubic.easeOut});
			TweenMax.to(this.mainView.headerlogo, 0.45, {opacity:1, ease:Cubic.easeOut, delay:0.1});
		}
		addEvents () {
			let self = this;

			if(window.attachEvent) {
				if(!this._mobile) {
					window.attachEvent('onresize', self.mainView.handleResize);
					// IE 6/7/8
					document.body.attachEvent("onmousewheel", self.mainView.handleMouseWheel);
					window.attachEvent("keydown", self.mainView.handleKeyDown);

				}
			}
			else if(window.addEventListener) {
				if(!this._mobile) {
					window.addEventListener('resize', self.mainView.handleResize, true);

					window.addEventListener('keydown', self.mainView.handleKeyDown, true);

					// IE9, Chrome, Safari, Opera
					document.body.addEventListener('mousewheel', self.mainView.handleMouseWheel, false);
					// Firefox
					document.body.addEventListener('DOMMouseScroll', self.mainView.handleMouseWheel, false);
				} else {

				}
			}
		}

		// This is how you navigate around the app.
		// this gets called by a global click handler that handles
		// all the <a> tags in the app.
		// it expects a url without a leading slash.
		// for example: "costello/settings".
		navigate (page) {
				var url = (page.charAt(0) === '/') ? page.slice(1) : page;
				this.router.history.navigate(url, {trigger: true});
		}

		_setParams (params) {
			this._params = [];
			this._paramsString = params;
			if(params != null){
				let paramlist = params.split('&');
				for (let i = 0; i < paramlist.length; i++ ) {
						let parampair = paramlist[i].split('=')
						this._params[parampair[0]] = parampair[1];
				}
			}
		}

		_sayHello () {
			if (navigator.userAgent.toLowerCase().indexOf('chrome') > -1)
				{
						var args = [
								'\n %c %c ### YOLO Webapp by DK for - ♥♥♥ - http://matteng.de/ %c - ♥♥♥ -	%c\n\n',
								'background: #000; padding:15px 0;',
								'color: #e400ff; background: #000; padding:15px 0px;',
								'color: #e400ff; background: #000; padding:15px 0px;',
								'color: #e400ff; background: #000; padding:15px 0px;'
						];

						window.console.log.apply(console, args); //jshint ignore:line
				}
				else if (window.console)
				{
						window.console.log('YOLO Webapp by DK for - // // // - http://matteng.de/'); //jshint ignore:line
				}
		}

};
// Construct the APP in window
export default new App(document.body);
