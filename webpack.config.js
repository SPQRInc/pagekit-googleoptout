module.exports = [
	{
		entry: {
			"googleoptout-settings": "./app/components/googleoptout-settings.vue",
			"optout": "./app/views/optout.js"
		},
		output: {
			filename: "./app/bundle/[name].js"
		},
		module: {
			loaders: [
				{test: /\.vue$/, loader: "vue"},
				{test: /\.js$/, exclude: /node_modules/, loader: "babel-loader"}
			]
		}
	}
];