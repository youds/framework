<?php

class Default_WelcomeSuccessView extends YoudsFrameworkView
{
	public function execute(YoudsFrameworkRequestDataHolder $rd)
	{
		/* Create a PHP renderer and corresponding layer for this action. This way,
		   it is guaranteed to work across output type or renderer changes. */
		$renderer = new YoudsFrameworkPhpRenderer();
		$renderer->initialize($this->context, array());
		$this->appendLayer($this->createLayer('YoudsFrameworkFileTemplateLayer', 'content', $renderer));
	}
}

?>
