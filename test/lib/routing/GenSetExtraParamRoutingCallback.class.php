<?php

class GenSetExtraParamRoutingCallback extends YoudsFrameworkRoutingCallback
{
	/**
	 * Gets executed when the route of this callback is about to be reverse 
	 * generated into an URL.
	 *
	 * @param      array The default parameters stored in the route.
	 * @param      array The parameters the user supplied to YoudsFrameworkRouting::gen().
	 * @param      array The options the user supplied to YoudsFrameworkRouting::gen().
	 *
	 * @return     bool  Whether this route part should be generated.
	 *
	 * @author     Dominik del Bondio <ddb@bitxtender.com>
	 * @since      0.11.0
	 */
	public function onGenerate(array $defaultParameters, array &$userParameters, array &$userOptions)
	{
		$userParameters['id'] = 12345;
		return true;
	}
}

?>
