<?php

class Products_Product_ViewSuccessView extends YoudsFrameworkSampleAppProductsBaseView
{

	/**
	 * Execute any presentation logic and set template attributes.
	 *
	 */
	public function executeHtml(YoudsFrameworkRequestDataHolder $rd)
	{
		$this->setupHtml($rd);

		// set the title
		$this->setAttribute('_title', $this->tm->_('Congratulations!', 'default.SearchEngineSpam'));
	}

	public function executeText(YoudsFrameworkRequestDataHolder $rd)
	{
		$product = $this->getAttribute('product');
		
		return
			'ID:    ' . $product->getId() . PHP_EOL .
			'Name:  ' . $product->getName() . PHP_EOL .
			'Price: ' . sprintf('%01.2f', $product->getPrice());
	}

	/**
	 * Execute any presentation logic for SOAP requests.
	 */
	public function executeSoap(YoudsFrameworkRequestDataHolder $rd)
	{
		return $this->getAttribute('product');
	}

	/**
	 * Execute any presentation logic for XMLRPC requests.
	 */
	public function executeXmlrpc(YoudsFrameworkRequestDataHolder $rd)
	{
		$product = $this->getAttribute('product');
		
		return array(
			'id'    => $product->getId(),
			'name'  => $product->getName(),
			'price' => $product->getPrice(),
		);
	}
}

?>
