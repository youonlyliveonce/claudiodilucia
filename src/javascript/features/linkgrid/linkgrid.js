import Base from '../longbase';

let Linkgrid = Base.extend({
	props: {
		id: ['string', true, '']
		,isscrollable: ['boolean', true, true]
		,parentview: ['object', true, function(){ return {} }]
		,topend: ['boolean', true, true]
		,bottomend: ['boolean', true, false]
		,mousebreak: ['boolean', true, false]
		,timeto: ['array', true, function(){ return [] }]
	},
	events: {
	},
	render: function(){
		this.cacheElements({
				gridBackground: '.Linkgrid__background',
				gridBody: '.Linkgrid__body',
				gridHead: '.Linkgrid__header'
		});
		this.on('change:active', this.onActiveChange, this);
		this.once('remove', this.cleanup, this);
		return this;

	}
})

export default Linkgrid;
