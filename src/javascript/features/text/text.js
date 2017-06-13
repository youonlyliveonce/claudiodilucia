import Base from '../base';

let Text = Base.extend({
	props: {
		id: ['string', true, '']
		,active: ['boolean', true, false]
		,parentview: ['object', true, function(){ return {} }]
	},

	events: { },

	render: function(){
		this.cacheElements({ });
		this.once('remove', this.cleanup, this);
		return this;
	}
})

export default Text;
