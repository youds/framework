<?php

class OnNotMatchedRoutingCallback extends YoudsFrameworkRoutingCallback
{
	/**
	 * Gets executed when the route of this callback route did not match.
	 *
	 * @param      YoudsFrameworkExecutionContainer The original execution container.
	 *
	 * @author     Dominik del Bondio <ddb@bitxtender.com>
	 * @since      0.11.0
	 */
	public function onNotMatched(YoudsFrameworkExecutionContainer $container)
	{
		throw new YoudsFrameworkException('Not Matched');
		return;
	}
}

?>
