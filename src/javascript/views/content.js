import PageView from './base';
import View from 'ampersand-view';
import YoutubeView from '../features/youtube/youtube';
import FilterGridView from '../features/filtergrid/filtergrid';
import LinkGridView from '../features/linkgrid/linkgrid';
import SliderView from '../features/slider/slider';
import CaseView from '../features/case/case';
import TextpageView from '../features/textbox/textbox';
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
					case "SliderView" :
						view = new SliderView({el:element, id:element.getAttribute('id'), parentview:self});
						view.render();
						break;
					case "TextpageView" :
						view = new TextpageView({el:element, id:element.getAttribute('id'), parentview:self});
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

	handleResize: function(){
		this.subViews.forEach(function(element){
			element.view.handleResize();
		});
	},
	hookAfterShow: function(){

	},
	cleanup: function(){
		console.log("cleanup");
		_.each(this.subViews, function(item){
			item.view.remove(true);
		})
	}

});

export default Content;
