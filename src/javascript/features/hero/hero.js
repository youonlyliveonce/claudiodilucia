import Base from '../base';

let Hero = Base.extend({
	props: {
		id: ['string', true, '']
		,active: ['boolean', true, false]
		,parentview: ['object', true, function(){ return {} }]
		,videoslides: ['array', true, function(){ return [] }]
		,activevideo: ['object', true, function(){ return {} }]
		,swiper: ['object', true, function(){ return undefined }]
		,settings: ['object', true, function(){ return {
						speed: 600,
						loop: false,
						slidesPerView: 1,
						centeredSlides: true,
						keyboardControl: true,
						spaceBetween: "0%",
						pagination: '.Hero__body .swiper-pagination',
						paginationClickable: true,
						grabCursor: true,
						touchEventsTarget: 'container'
					}
		}]
	},

	events: {
		'click .Awards':'handleClickAwards'

	},

	render: function(){
		this.cacheElements({
			heroBody : '.Hero__body'
		});
		let self = this;
		let iframes = Array.from(this.queryAll('iframe'));

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
				// this.settings.onSlideChangeEnd = .bind(this);
				this.swiper = new Swiper('#'+this.id+' .Hero__body .swiper-container', this.settings);
				this.swiper.on('slideChangeEnd', this.onSwiperCheck.bind(this));
				this.swiper.on('slideChangeStart', this.onSwiperChange.bind(this));
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
		if(this.videoslides.length > 0){
			let videoSlides = this.videoslides.find(function(item){
				return item.index == swiper.activeIndex;
			});
			if(videoSlides != undefined){
				this.playVideo(videoSlides.player);
			}
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
		if(typeof player.playVideo == 'function'){
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
	handleClickAwards:function(){
		if(this.el.classList.contains('openAwards')){
			this.el.classList.remove('openAwards');
		}else{
			this.el.classList.add('openAwards');
		}
	},
	cleanup: function(){
		console.log("cleanup hero");
		if(typeof this.swiper.destroy == 'function'){
			this.swiper.destroy();
		}

	}
})

export default Hero;
