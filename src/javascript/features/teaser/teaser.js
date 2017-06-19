import Base from '../base';

let Teaser = Base.extend({
	props: {
		id: ['string', true, '']
		,active: ['boolean', true, false]
		,parentview: ['object', true, function(){ return {} }]
		,tiles: ['array', true, function(){ return [] }]
	},

	events: { },

	render: function(){
		this.tiles = Array.from(this.queryAll('.Teaser__item'));
		this.once('remove', this.cleanup, this);
		return this;
	},
	hookToShow: function(){
		this.tiles.forEach(function(item, index){
			setTimeout(function(){ item.classList.add('show'); }, index*300);
		})
	},
	cleanup: function(){
		console.log("cleanup teaser");
	}
})

export default Teaser;
