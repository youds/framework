<?php

class NonMatchingRoutingCallback extends YoudsFrameworkRoutingCallback
{
	public function onMatched(array &$parameters, YoudsFrameworkExecutionContainer $container)
	{
		return false;
	}
}

?>
