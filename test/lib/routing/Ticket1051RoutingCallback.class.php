<?php

class Ticket1051RoutingCallback extends YoudsFrameworkRoutingCallback
{
	public function onGenerate(array $defaultParameters, array &$userParameters, array &$userOptions)
	{
		$userOptions['authority'] = 'www.youds.com';
		
		return true;
	}
}

?>
