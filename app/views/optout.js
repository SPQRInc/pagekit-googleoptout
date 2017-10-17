module.exports = {

	el: '#googleoptoout',

	data: {
		config: '',
		disableStr: '',
		checked: false
	},

	created: function created () {
		this.$resource ('api/googleoptout/property').get ().then (function (result) {
			this.property = result.data.property;
			this.managetrackingcode = result.data.managetrackingcode;
			this.disableStr = 'ga-disable-' + this.property;
			if (document.cookie.indexOf (this.disableStr + '=true') > -1) {
				this.disableTracking ();
			} else {
				this.enableTracking ();
			}

			if (this.managetrackingcode) {
				var gtag = function gtag () {
					dataLayer.push (arguments);
				};

				window.dataLayer = window.dataLayer || [];

				gtag ('js', new Date ());
				gtag ('config', result.data.property);
			}
		});
	},

	ready: function ready () {
	},

	computed: {},

	watch: {},

	methods: {
		gaOptout: function gaOptout () {
			if (document.cookie.indexOf (this.disableStr + '=true') > -1) {
				this.enableTracking ();
			}
			else {
				this.disableTracking ();
			}
		},
		disableTracking: function disableTracking () {
			window[this.disableStr] = true;
			document.cookie = this.disableStr + '=true; expires=Thu, 31 Dec 2099 23:59:59 UTC; path=/';
			this.checked = true;
		},
		enableTracking: function enableTracking () {
			window[this.disableStr] = false;
			document.cookie = this.disableStr + '=false; expires=Thu, 31 Dec 2099 23:59:59 UTC; path=/';
			this.checked = false;
		}
	},

	filters: {}
};

Vue.ready (module.exports);