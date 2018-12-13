<?php

class Default_ModuleDisabledSuccessView extends SandboxDefaultBaseView
{
	public function executeHtml(YoudsFrameworkRequestDataHolder $rd)
	{
		$this->setupHtml($rd);
		
		$this->getResponse()->setHttpStatusCode('503');
	}
}

?>
