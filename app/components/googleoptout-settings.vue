<template>
    <div class="uk-form uk-form-horizontal">
        <h1>{{ 'Google Opt Out Settings' | trans }}</h1>
        <div class="uk-form-row">
            <label for="form-property" class="uk-form-label">{{ 'Property' | trans }}</label>
            <div class="uk-form-controls">
               <input id="form-property" class="uk-form-width-medium" type="text" v-model="package.config.property">
            </div>
        </div>
        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Manage Tracking Code' | trans }}</label>
            <div class="uk-form-controls uk-form-controls-text">
                <input type="checkbox" v-model="package.config.managetrackingcode">
            </div>
        </div>
        <div class="uk-alert">{{ 'Simply insert a checkbox to your content by adding this code: ' | trans}} <code>(googleoptout){}</code>. {{'Alternatively you can define your own label using this code: ' | trans }}<code>(googleoptout){"label":"Your-Label"}</code></div>
        <div class="uk-form-row uk-margin-top">
            <div class="uk-form-controls">
                <button class="uk-button uk-button-primary" @click="save">{{ 'Save' | trans }}</button>
            </div>
        </div>
    </div>
</template>

<script>

module.exports = {

	settings: true,

	props: ['package'],

	methods: {
		save: function save() {
			this.$http.post ('admin/system/settings/config', {
				name: 'spqr/googleoptout',
				config: this.package.config
			}).then (function () {
				this.$notify ('Settings saved.', '');
			}).catch (function (response) {
				this.$notify (response.message, 'danger');
			}).finally (function () {
				this.$parent.close ();
			});
		}
	}
};

window.Extensions.components['googleoptout-settings'] = module.exports;
</script>