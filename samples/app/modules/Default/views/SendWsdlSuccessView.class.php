<?php

class Default_SendWsdlSuccessView extends YoudsFrameworkSampleAppDefaultBaseView
{
	public function executeWsdl(YoudsFrameworkRequestDataHolder $rd)
	{
		// we return a file pointer; the response will fpassthru() this for us
		return fopen($this->getAttribute('wsdl'), 'r');
	}
}

?>
