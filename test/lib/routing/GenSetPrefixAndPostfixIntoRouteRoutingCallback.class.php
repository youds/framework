<?php

class GenSetPrefixAndPostfixIntoRouteRoutingCallback extends YoudsFrameworkRoutingCallback
{
	public function onGenerate(array $defaultParameters, array &$userParameters, array &$userOptions)
	{
		$this->route['opt']['defaults']['number'] = array('pre' => 'prefix-', 'val' => 'value', 'post' => '-postfix');
		return true;
	}
}

?>
