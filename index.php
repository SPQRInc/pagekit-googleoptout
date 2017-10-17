<?php

use Pagekit\Application;
use Spqr\Googleoptout\Plugin\OptoutPlugin;


return [
	'name' => 'spqr/googleoptout',
	'type' => 'extension',
	'main' => function( Application $app ) {
	},
	
	'autoload' => [
		'Spqr\\Googleoptout\\' => 'src'
	],
	
	'routes' => [
		'/api/googleoptout' => [
			'name'       => '@googleoptout/api',
			'controller' => [
				'Spqr\\Googleoptout\\Controller\\GoogleoptoutApiController'
			]
		]
	],
	
	'widgets' => [],
	
	'menu' => [],
	
	'permissions' => [],
	
	'settings' => 'googleoptout-settings',
	
	'resources' => [
		'spqr/googleoptout:' => ''
	],
	
	'config' => [
		'property' => '',
		'managetrackingcode' => true
	],
	
	'events' => [
		'boot'         => function( $event, $app ) {
			$app->subscribe(
				new OptoutPlugin
			);
		},
		'site'         => function( $event, $app ) {
			$app->on(
				'view.content',
				function( $event, $scripts ) use ( $app ) {
					
					if($this->config['managetrackingcode']){
						$property = $this->config['property'];
						$url ="https://www.googletagmanager.com/gtag/js?id=$property";
						$app[ 'scripts' ]->add( 'analytics', $url, [], ['async' => true] );
					}
					$app[ 'scripts' ]->add(
						'optout',
						'spqr/googleoptout:app/bundle/optout.js',
						[ 'vue' ]
					);
				}
			);
		},
		'view.scripts' => function( $event, $scripts ) use ( $app ) {
			$scripts->register(
				'googleoptout-settings',
				'spqr/googleoptout:app/bundle/googleoptout-settings.js',
				[ '~extensions' ]
			);
		}
	]
];