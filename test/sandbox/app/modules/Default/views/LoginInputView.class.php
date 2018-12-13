<?php

class Default_LoginInputView extends SandboxDefaultBaseView
{
	public function executeHtml(YoudsFrameworkRequestDataHolder $rd)
	{
		$this->setupHtml($rd);

		$this->setAttribute('title', 'Login');
	}
}

?>
