<?php

class Confidential_SecretSuccessView extends YoudsFrameworkSampleAppConfidentialBaseView
{

	public function executeHtml(YoudsFrameworkRequestDataHolder $rd)
	{
		$this->setupHtml($rd);

		// set the title
		$this->setAttribute('_title', $this->tm->_('Secure Action', 'default.Login'));

	}

}

?>
