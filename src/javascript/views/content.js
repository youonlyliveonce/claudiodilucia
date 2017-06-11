import PageView from './base';
import View from 'ampersand-view';
import SliderView from '../features/slider/slider';
import HeroView from '../features/hero/hero';
import TeaserView from '../features/teaser/teaser';
import dom from 'ampersand-dom';
import _ from 'underscore';


let Content = PageView.extend({

	props:{
		isInitial: ['boolean', true, false]
		,subViews: ['array', true, function(){ return []; }]
	},

	events: {
		'click .Button--down' : 'handleDownClick'
	},

	hookBeforeHide: function() {
		this.subViews.forEach(function(element){
			element.view.hookToHide();
		});
	},

	hookInRender: function () {
		let self = this;
		let elements = this.queryAll('.Element');
		if(elements.length > 0){
			elements.forEach(function(element, index, array){
				let view = null;
				switch(element.dataset.view){
					case "HeroView" :
						view = new HeroView({el:element, id:element.getAttribute('id'), parentview:self});
						view.render();
						break;
					case "TeaserView" :
						view = new TeaserView({el:element, id:element.getAttribute('id'), parentview:self});
						view.render();
						break;
					case "SliderView" :
						view = new SliderView({el:element, id:element.getAttribute('id'), parentview:self});
						view.render();
						break;
					default:
				}
				if(view != null){
					self.registerSubview(view);
					self.subViews.push({id:view.id, view:view});
				}

			});
		}

	},
	hookAfterShow: function(){

	},
	hookToShow: function(delay){
		console.log("hookToShow view");
		TweenMax.delayedCall(delay, function(){
			this.subViews.forEach(function(element){
				element.view.hookToShow();
			});
		}, [], this);
	},
	cleanup: function(){
		console.log("cleanup");
		_.each(this.subViews, function(item){
			item.view.remove(true);
		})
	}

});

export default Content;
