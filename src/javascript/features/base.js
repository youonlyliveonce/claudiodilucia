import View from 'ampersand-view';

let Base = View.extend({
	props: {
		id: ['string', true, '']
		,active: ['boolean', true, true]
		,isscrollable: ['boolean', true, false]
		,parentview: ['object', true, function(){ return {} }]
	},
	events: {},

	render: function(){
		this.on('change:active', this.onActiveChange, this);
		this.once('remove', this.cleanup, this);
		return this;
	},

	onActiveChange: function(value){
		console.log(value)
	},
	cleanup: function(){
		console.log("cleanup child");
	},
	hookToHide: function(){
		console.log("hook To Hide Feature");
	},
	hookToShow: function(){
		console.log("hook To Show Feature");
	}

})

export default Base;
