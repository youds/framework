<?php

class Default_SecureSuccessView extends SandboxDefaultBaseView
{
	public function executeHtml(YoudsFrameworkRequestDataHolder $rd)
	{
		$this->setupHtml($rd);
		
		$this->getResponse()->setHttpStatusCode('403');
	}
}

?>
