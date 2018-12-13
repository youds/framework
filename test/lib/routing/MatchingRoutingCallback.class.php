<?php

class MatchingRoutingCallback extends YoudsFrameworkRoutingCallback
{
	public function onMatched(array &$parameters, YoudsFrameworkExecutionContainer $container)
	{
		$parameters['callback'] = 'set';
		return true;
	}
}

?>
