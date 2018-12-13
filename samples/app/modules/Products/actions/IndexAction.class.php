<?php

class Products_IndexAction extends YoudsFrameworkSampleAppProductsBaseAction
{
	public function execute(YoudsFrameworkRequestDataHolder $rd)
	{
		$products = $this->getContext()->getModel('ProductFinder')->retrieveAll();
		
		$this->setAttribute('products', $products);
		
		return 'Success';
	}
}

?>
