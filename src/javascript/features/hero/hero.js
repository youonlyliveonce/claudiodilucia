import Base from '../base';

let Hero = Base.extend({
	props: {
		id: ['string', true, '']
		,active: ['boolean', true, false]
		,parentview: ['object', true, function(){ return {} }]
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

	events: { },

	render: function(){
		this.cacheElements({
			heroBody : '.Hero__body'
		});
		TweenMax.delayedCall(0.15, function(){
				this.swiper = new Swiper('#'+this.id+' .Hero__body .swiper-container', this.settings);
		}, [], this);
		this.once('remove', this.cleanup, this);
		return this;
	},
	hookToShow: function(){
		this.el.classList.add('show');
	},
	hookToHide: function(){
		this.el.classList.remove('show');
	},
	cleanup: function(){
		this.swiper.destroy();
		console.log("cleanup hero");
	}
})

export default Hero;
