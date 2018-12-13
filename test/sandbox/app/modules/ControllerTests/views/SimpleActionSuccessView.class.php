<?php

class ControllerTests_SimpleActionSuccessView extends SandboxControllerTestsBaseView
{
	public function executeHtml(YoudsFrameworkRequestDataHolder $rd)
	{
		$this->setupHtml($rd);

		$this->setAttribute('_title', 'SimpleAction');
	}
}

?>
