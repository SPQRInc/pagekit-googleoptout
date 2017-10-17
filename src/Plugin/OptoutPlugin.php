<?php

namespace Spqr\Googleoptout\Plugin;

use Pagekit\Application as App;
use Pagekit\Content\Event\ContentEvent;
use Pagekit\Event\EventSubscriberInterface;

class OptoutPlugin implements EventSubscriberInterface
{
	
	/**
	 * @param \Pagekit\Content\Event\ContentEvent $event
	 */
	public function onContentPlugins( ContentEvent $event )
	{
		$event->addPlugin(
			'googleoptout',
			[
				$this,
				'applyPlugin'
			]
		);
		
	}
	
	/**
	 * @param array $options
	 *
	 * @return string
	 */
	public function applyPlugin( array $options )
	{
		if ( isset( $options[ 'label' ] ) ) {
			$label = $options[ 'label' ];
			$code  =
				"<div id='googleoptoout'> <p class='uk-form-controls-condensed'><label><input type='checkbox' id='googleoptoout' v-model='checked' @click='gaOptout(checked)'> $label</label></p></div>";
			
		} else {
			$code =
				"<div id='googleoptoout'> <p class='uk-form-controls-condensed'><label><input type='checkbox' id='googleoptoout' v-model='checked' @click='gaOptout(checked)'> {{'Disable tracking' | trans }}</label></p></div>";
		}
		
		return $code;
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function subscribe()
	{
		return [
			'content.plugins' => [ 'onContentPlugins', 25 ],
		];
	}
	
}