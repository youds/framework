<?php

class Default_LoginSuccessView extends SandboxDefaultBaseView
{
	public function executeHtml(YoudsFrameworkRequestDataHolder $rd)
	{
		$this->setupHtml($rd);

		$this->setAttribute('title', 'Login');
	}
}

?>
