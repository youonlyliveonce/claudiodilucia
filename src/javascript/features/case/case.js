import Base from '../base';
import dom from 'ampersand-dom';

let Case = Base.extend({
	props: {
		id: ['string', true, '']
		,isscrollable: ['boolean', true, true]
		,parentview: ['object', true, function(){ return {} }]
		,player: ['object', true, function(){ return {}; }]
		,swiper: ['object', true, function(){ return undefined }]
		,settings: ['object', true, function(){ return {
						speed: 600,
						// effect: 'fade',
						pagination: '.Case .swiper-pagination',
						paginationClickable: true,
						nextButton: '.Case .swiper-button-next',
						prevButton: '.Case .swiper-button-prev',
						loop: true
					}
		}]
		,topend: ['boolean', true, true]
		,bottomend: ['boolean', true, false]
		,watchvideo: ['number', true, 0]
		,caseBoardVideo: ['object', true, function(){ return undefined }]
		,mute: ['boolean', true, false]
	},

	events: {
		'click .Playbar' : '_handlePlayerClick',
		'click .Controlbar__state--clickzone' : '_handleStateClick',
		'click .Controlbar__play' : '_handlePlayerClick',
		'click .Controlbar__audio' : '_handleAudioClick'

	},

	render: function(){
		let self = this;
		this.cacheElements({
				caseBody: '.Case__body',
				caseVideo : '.Videobox__background',
				totalTime: '[data-hook=total-time]',
				currentTime: '[data-hook=current-time]',
				statePlayed: '.Controlbar__state--played',
				stateLoaded: '.Controlbar__state--loaded'
		});
		if(this.queryAll('#'+this.id+' .swiper-slide').length > 1){
			TweenMax.delayedCall(0.15, function(){
					this.swiper = new Swiper('#'+this.id+' .swiper-container', this.settings);
			}, [], this);
		}
		if(this.caseVideo != undefined){
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
					self.onYouTubeIframeAPIReady();
				})
			}
			TweenMax.set(this.stateLoaded, {transformOrigin:"0% 0%"});
			TweenMax.set(this.statePlayed, {transformOrigin:"0% 0%"});
			this.caseBoardVideo = this.queryAll('.Case__item--youtube > div');
			this.on('change:mute', this.onMuteChange, this);
		}
		this.once('remove', this.cleanup, this);

		return this;

	},

	onYouTubeIframeAPIReady: function(){
		this.player = new YT.Player('casevideo', {
					events: {
						'onReady': this.onPlayerReady.bind(this),
						'onStateChange': this.onPlayerStateChange.bind(this)
					}
				});
		if(this.player.B){
			this.onPlayerReady();
		};
	},
	onPlayerReady: function(){
		this.ready = true;
		this.totalTime.innerHTML = this.player.getDuration().toHHMMSS();
		this.currentTime.innerHTML = Number(0).toHHMMSS();
		if(this.active && !CM.App._mobile){
			this.playVideo();
		}
	},
	playVideo: function(){
		if(typeof this.player.playVideo == 'function'){
			dom.addClass(this.caseVideo, 'playing');
			this.player.playVideo();
			this.watchvideo = setInterval(this._watchVideo.bind(this), 100);
		}
	},
	pauseVideo: function(){
		if(typeof this.player.pauseVideo == 'function'){
			dom.removeClass(this.caseVideo, 'playing');
			this.player.pauseVideo();
			clearInterval(this.watchvideo);
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
			dom.addClass(this.caseVideo, 'muted');
		} else {
			if(this.ready){
				this.unmuteVideo();
				dom.removeClass(this.caseVideo, 'muted');
			}
		}
	},
	onPlayerStateChange: function(event){
		switch(this.player.getPlayerState()){
			case 0:
				dom.removeClass(this.caseVideo, 'playing');
				break;
			case 1:

				break;
			case 2:
				dom.removeClass(this.caseVideo, 'playing');
				break;
			case 3:

				break;
			default:

		}

	},
	_watchVideo: function(){
		let total = this.player.getDuration(),
				current = this.player.getCurrentTime(),
				loaded = this.player.getVideoLoadedFraction();
		// this.totalTime.innerHTML = this.player.getDuration().toHHMMSS();
		this.currentTime.innerHTML = current.toHHMMSS();
		TweenMax.set(this.stateLoaded, {css:{scaleX:loaded}});
		TweenMax.set(this.statePlayed, {css:{scaleX:(current/total)}});
	},
	_handleStateClick: function(e){
		let prozent = e.layerX/this.caseVideo.offsetWidth;
		console.log("prozent:", prozent);
		console.log("e:", e);
		console.log("e.offsetX:", e.offsetX);
		console.log("e.layerX:", e.clientX);
		console.log("this.caseVideo.offsetWidth:", this.caseVideo.offsetWidth);
		console.log("this.player.getDuration():", this.player.getDuration());

		this.player.seekTo(this.player.getDuration()*prozent, true)
		this.playVideo();
		e.stopPropagation();
		e.preventDefault();

	},
	_handlePlayerClick: function(e) {
		switch(this.player.getPlayerState()){
			case 0:
				this.playVideo();
				break;
			case 1:
				this.pauseVideo();
				break;
			case 2:
				this.playVideo();
				break;
			case 3:
				this.pauseVideo();
				break;
			default:
				this.pauseVideo();
		}
	},
	_handleAudioClick: function(){
		this.mute = !this.mute;
	},
	cleanup: function(){
		clearInterval(this.watchvideo);
	},
	handleResize: function(){
		if(!CM.App._mobile) {
			this.el.setAttribute("style", "height:"+document.body.clientHeight+"px");
			if(this.caseVideo != undefined){
				let newWidth = this.caseVideo.clientWidth,
						newHeight = newWidth/16*9;
				this.caseVideo.setAttribute("style", "height:"+newHeight+"px;");
			}
			if(this.caseBoardVideo != undefined){
				for(let i=0; i<this.caseBoardVideo.length; i++){
					let newWidth = this.caseBoardVideo[i].clientWidth,
							newHeight = newWidth/16*9;
					this.caseBoardVideo[i].setAttribute("style", "height:"+newHeight+"px;");
				}
			}
		}
	},
	handleMouseWheel: function(event){
		let self = this;
		let e = window.event || event || event.originalEvent;
		let delta = e.deltaY || -1*e.wheelDelta;

		// FF Y-Achse
		if(e.axis == 2){
			delta = e.detail*e.detail*(e.detail/2);
		}
		if(delta < 0){
			self.bottomend = false;
			if(self.caseBody._gsTransform && self.caseBody._gsTransform.y-delta > 0){
					TweenMax.to(self.caseBody, 0.1, {y:0, overwrite:true});
			} else {
				TweenMax.set(this.caseBody, {y:`-=${delta}`});
			}
		} else if(delta > 0) {
			self.topend = false;
			let cH = document.body.clientHeight,
					bH = self.caseBody.clientHeight,
					dH = cH-bH;
			if(self.caseBody._gsTransform && self.caseBody._gsTransform.y-delta < cH-bH){
					TweenMax.to(self.caseBody, 0.1, {y:dH, overwrite:true});
			} else {
				TweenMax.set(self.caseBody, {y:`-=${delta}`});
			}
		}

	}
})

export default Case;
