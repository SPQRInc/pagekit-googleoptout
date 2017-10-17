<?php

namespace Spqr\Googleoptout\Controller;

use Pagekit\Application as App;


class GoogleoptoutApiController
{
	/**
	 * @Route("/property", methods="GET")
	 *
	 * @return static
	 */
	public function getAction( )
	{
		$config = App::module( 'spqr/googleoptout' )->config();
		$property = $config['property'];
		$managetrackingcode = $config['managetrackingcode'];
		
		return compact('property', 'managetrackingcode');
	}
}