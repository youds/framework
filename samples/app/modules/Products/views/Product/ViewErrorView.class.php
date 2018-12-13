<?php

class Products_Product_ViewErrorView extends YoudsFrameworkSampleAppProductsBaseView
{
	/**
	 * Execute any presentation logic and set template attributes.
	 *
	 */
	public function executeHtml(YoudsFrameworkRequestDataHolder $rd)
	{
		return $this->createForwardContainer(YoudsFrameworkConfig::get('actions.error_404_module'), YoudsFrameworkConfig::get('actions.error_404_action'));
	}

	/**
	 * Execute any presentation logic for JSON requests.
	 */
	public function executeJson(YoudsFrameworkRequestDataHolder $rd)
	{
		return json_encode(
			array(
				'_error' => 404,
			)
		);
	}
	
	public function executeText(YoudsFrameworkRequestDataHolder $rd)
	{
		$this->getResponse()->setExitCode(1);
		
		return 'No such product';
	}

	/**
	 * Execute any presentation logic for SOAP requests.
	 */
	public function executeSoap(YoudsFrameworkRequestDataHolder $rd)
	{
		// fault code must be "Server", check the SOAP spec
		// do not throw the exception please. it can be done with some fiddling, but returning it is a much better idea
		return new SoapFault('Server', 'Unknown Product ' . $rd->getParameter('id'));
	}

	/**
	 * Execute any presentation logic for XMLRPC requests.
	 */
	public function executeXmlrpc(YoudsFrameworkRequestDataHolder $rd)
	{
		return array('faultCode' => 101, 'faultString' => 'Unknown Product ' . $rd->getParameter('id'));
	}
}

?>
