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
	hookToShow: function(){
		this.el.classList.add('show');
	},
	hookToHide: function(){
		this.el.classList.remove('show');
	}

})

export default Base;
