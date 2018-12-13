<?php

class Default_SendWsdlErrorView extends YoudsFrameworkSampleAppDefaultBaseView
{
	public function executeWsdl(YoudsFrameworkRequestDataHolder $rd)
	{
		$this->getResponse()->setHttpStatusCode(404);
	}
}

?>
