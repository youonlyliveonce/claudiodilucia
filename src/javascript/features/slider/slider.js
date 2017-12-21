import Base from '../base';

let Slider = Base.extend({
	props: {
		id: ['string', true, '']
		,active: ['boolean', true, false]
		,mie: ['boolean', true, false]
		,parentview: ['object', true, function(){ return {} }]
		,videoslides: ['array', true, function(){ return [] }]
		,activevideo: ['object', true, function(){ return {} }]
		,swiper: ['object', true, function(){ return undefined }]
		,swiperFullscreen: ['object', true, function(){ return undefined }]
		,swiperThumbs: ['object', true, function(){ return undefined }]
		,activeindex: ['number', true, -1]
		,settings: ['object', true, function(){ return {
						speed: 600,
						loop: false,
						slidesPerView: 1.5,
						centeredSlides: true,
						keyboardControl: true,
						spaceBetween: "1%",
						// pagination: '.Slider .swiper-pagination',
						// paginationClickable: true,
						grabCursor: true,
						touchEventsTarget: 'container'
					}
		}]
		,settingsFullscreen: ['object', true, function(){ return {
						speed: 600,
						loop: false,
						slidesPerView: 1,
						centeredSlides: true,
						spaceBetween: "0%",
						// pagination: '.Slider .swiper-pagination',
						// paginationClickable: true,
						nextButton: '.Slider__fullscreen .swiper-button-next',
						prevButton: '.Slider__fullscreen .swiper-button-prev',
						grabCursor: true,
						touchEventsTarget: 'container'
					}
		}]
		,settingsThumbs: ['object', true, function(){ return {
						// speed: 600,
						loop: false,
						touchRatio: 0.2,
						slideToClickedSlide: true,
						centeredSlides: true,
						slidesPerView: 'auto',
						spaceBetween: "0%",
						grabCursor: true,
						touchEventsTarget: 'container'
					}
		}]
	},

	events: {
		'click .Slider__body .Slider__item':'handleClickItem',
		'click .Slider__fullscreen .Button--close':'handleClickClose',
		'mouseover .Slider__icon--zoom':'handleMouseOverZoom',
		'mouseout .Slider__icon--zoom':'handleMouseOutZoom',
		'mousemove .Slider': 'handleMouseMove'
	},

	render: function(){
		this.cacheElements({
			sliderBody : '.Slider__body'
		});
		let self = this;
		let iframes = Array.from(this.queryAll('iframe'));
		this.mie = (navigator.appName == "Microsoft Internet Explorer") ? true : false;

		if(iframes.length > 0) {
			iframes.forEach(function(item){
				self.videoslides.push({index:item.getAttribute('data-key'), id:item.getAttribute('id'), player:null});
			})
			if(window.YT === undefined){
				window.onYouTubeIframeAPIReady = this.onYouTubeIframeAPIReady.bind(this);
				// INSERT YOUTUBE API
				let tag = document.createElement('script');
				tag.src = "https://www.youtube.com/iframe_api";
				tag.id = "youtubeapi";
				let firstScriptTag = document.getElementsByTagName('script')[0];
				firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
			} else {
				TweenMax.delayedCall(0.25, function(){
					this.onYouTubeIframeAPIReady();
				}, [], this);
			}
		}

		TweenMax.delayedCall(0.15, function(){
				this.swiper = new Swiper('#'+this.id+' .Slider__body .swiper-container', this.settings);
				this.swiperFullscreen = new Swiper('#'+this.id+' .Slider__fullscreen .swiper-container', this.settingsFullscreen);
				this.swiperThumbs = new Swiper('#'+this.id+' .Slider__thumbs .swiper-container', this.settingsThumbs);

				this.swiper.params.control = this.swiperThumbs;
				// this.swiperFullscreen.params.control = this.swiper;
				this.swiperThumbs.params.control = this.swiper;

				this.swiper.on('slideChangeStart', this.onSwiperToFullscreen.bind(this));
				this.swiperFullscreen.on('slideChangeEnd', this.onSwiperCheck.bind(this));
				this.swiperFullscreen.on('slideChangeStart', this.onSwiperChange.bind(this));

		}, [], this);

		this.once('remove', this.cleanup, this);
		return this;

	},
	onYouTubeIframeAPIReady: function(){
		let self = this;
		this.videoslides.forEach(function(item){
			item.player = new YT.Player(item.id, {
						events: {
							'onReady': self.onPlayerReady.bind(self),
							'onStateChange': self.onPlayerStateChange.bind(self)
						}
					});
					if(item.player.B){
						self.onPlayerReady({target:item.player});
					};
		})
	},
	onSwiperChange: function(swiper){
		if(this.videoslides.length > 0){
			this.pauseVideo(this.activevideo);
		}
	},
	onSwiperCheck: function(swiper){

		// if last
		if(swiper.isEnd){
			this.sliderBody.classList.add('Slider--islast')
		} else {
			this.sliderBody.classList.remove('Slider--islast')
		}
		// => to normal swiper
		this.swiper.slideTo(swiper.activeIndex)
		// => check for video
		if(this.videoslides.length > 0){
			let videoSlides = this.videoslides.find(function(item){
				return item.index == swiper.activeIndex;
			});
			if(videoSlides != undefined){
				this.playVideo(videoSlides.player);
			}
		}
	},
	onSwiperToFullscreen: function(swiper){
		if(!document.body.classList.contains('Slider--fullscreen')){
			this.swiperFullscreen.slideTo(swiper.activeIndex);
		}
	},
	onPlayerReady: function(event){
		let iframe = event.target.a,
				key = iframe.getAttribute('data-key');
		if(key == this.swiper.activeIndex && !CM.App._mobile){
			this.playVideo(event.target);
		}
	},
	onPlayerStateChange: function(event){
		// console.log("onPlayerStateChange", event);
	},
	playVideo: function(player){
		if(typeof player.playVideo == 'function' && document.body.classList.contains('Slider--fullscreen')){
			this.activevideo = player;
			player.playVideo();
		}
	},
	pauseVideo: function(player){
		if(typeof player.pauseVideo == 'function'){
			this.activevideo = [];
			player.pauseVideo();
		}
	},
	muteVideo: function(){
		if(typeof this.player.mute == 'function'){
			this.player.mute();
		}
	},
	unmuteVideo: function(){
		if(typeof this.player.unMute == 'function'){
			this.player.unMute();
		}
	},

	onMuteChange: function(model, value){
		if(value) {
			this.muteVideo();
			dom.addClass(this.mutebutton, 'mute');
		} else {
			if(this.ready){
				this.unmuteVideo();
				dom.removeClass(this.mutebutton, 'mute');
			}
		}
	},
	handleMouseMove: function(event){
		let e = window.event || event || event.originalEvent;
		let mouseY = 0;
		if (!this.mie) {
				//  mouseX = e.pageX;
				mouseY = e.pageY;
		}
		else {
				//  mouseX = event.clientX + document.body.scrollLeft;
				mouseY = event.clientY + document.body.scrollTop;
		}
		if(mouseY > this.el.offsetHeight/4*3){
			this.el.classList.add('Slider--showthumbs');
		}else {
			this.el.classList.remove('Slider--showthumbs');
		}
	},
	handleClickItem: function(){
		document.body.classList.add('Slider--fullscreen')
		this.onSwiperCheck(this.swiperFullscreen)
	},
	handleClickClose: function(){
		document.body.classList.add('Slider--hidefullscreen')
		TweenMax.delayedCall(0.5, function(){
				document.body.classList.remove('Slider--fullscreen')
				document.body.classList.remove('Slider--hidefullscreen')
				this.onSwiperCheck(this.swiperFullscreen)
		})
	},
	handleMouseOverZoom: function(event){
		event.delegateTarget.parentNode.classList.add('hover');
		console.log('enter', event);
	},
	handleMouseOutZoom: function(event){
		event.delegateTarget.parentNode.classList.remove('hover');
		console.log('leave', event);
	},
	cleanup: function(){
		console.log("cleanup slider");
		if(typeof this.swiper.destroy == 'function'){
			this.swiper.destroy();
		}
		if(typeof this.swiperFullscreen.destroy == 'function'){
			this.swiperFullscreen.destroy();
		}
		if(typeof this.swiperThumbs.destroy == 'function'){
			this.swiperThumbs.destroy();
		}
	}
})

export default Slider;
