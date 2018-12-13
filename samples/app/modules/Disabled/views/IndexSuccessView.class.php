<?php

class Disabled_IndexSuccessView extends YoudsFrameworkSampleAppDisabledBaseView
{
	public function executeHtml(YoudsFrameworkRequestDataHolder $rd)
	{
		$this->setupHtml($rd);

		// set the title
		$this->setAttribute('_title', 'Index Action');
	}
}

?>
