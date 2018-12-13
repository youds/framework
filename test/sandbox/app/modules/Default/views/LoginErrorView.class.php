<?php

class Default_LoginErrorView extends SandboxDefaultBaseView
{
	public function executeHtml(YoudsFrameworkRequestDataHolder $rd)
	{
		$this->setupHtml($rd);

		$this->setAttribute('title', 'Login');
	}
}

?>
