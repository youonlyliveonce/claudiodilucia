import Base from '../base';

let Slider = Base.extend({
	props: {
		id: ['string', true, '']
		,active: ['boolean', true, false]
		,parentview: ['object', true, function(){ return {} }]
		,swiper: ['object', true, function(){ return undefined }]
		,swiperFullscreen: ['object', true, function(){ return undefined }]
		,activeindex: ['number', true, -1]
		,settings: ['object', true, function(){ return {
						speed: 600,
						loop: false,
						slidesPerView: 1.5,
						centeredSlides: true,
						keyboardControl: true,
						spaceBetween: "0%",
						pagination: '.Slider .swiper-pagination',
						paginationClickable: true,
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
						pagination: '.Slider .swiper-pagination',
						paginationClickable: true,
						grabCursor: true,
						touchEventsTarget: 'container'
					}
		}]
	},

	events: {
		'click .Slider__body .Slider__item':'handleClickItem',
		'click .Slider__fullscreen .Button--close':'handleClickClose',
	},

	render: function(){

		TweenMax.delayedCall(0.15, function(){
				this.swiper = new Swiper('#'+this.id+' .Slider__body .swiper-container', this.settings);
				this.swiperFullscreen = new Swiper('#'+this.id+' .Slider__fullscreen .swiper-container', this.settingsFullscreen);
				this.swiper.params.control = this.swiperFullscreen;
				this.swiperFullscreen.params.control = this.swiper;
		}, [], this);
		this.once('remove', this.cleanup, this);
		return this;

	},
	handleClickItem: function(){
		document.body.classList.add('Slider--fullscreen')
	},
	handleClickClose: function(){
		document.body.classList.add('Slider--hidefullscreen')
		TweenMax.delayedCall(0.5, function(){
				document.body.classList.remove('Slider--fullscreen')
				document.body.classList.remove('Slider--hidefullscreen')
		})
	},
	hookToShow: function(){
		this.el.classList.add('show');
	},
	hookToHide: function(){
		this.el.classList.remove('show');
	},
	cleanup: function(){
		this.swiper.kill();
		this.swiperFullscreen.kill();
		console.log("cleanup slider");
	}
})

export default Slider;
