<?php

class Products_IndexSuccessView extends YoudsFrameworkSampleAppProductsBaseView
{
	public function executeHtml(YoudsFrameworkRequestDataHolder $rd)
	{
		$this->setupHtml($rd);
		
		// set the title
		$this->setAttribute('_title', $this->tm->_('Our Fine Products', 'default.SearchEngineSpam'));
	}

	public function executeText(YoudsFrameworkRequestDataHolder $rd)
	{
		$products = $this->getAttribute('products');
		
		$ret = array();
		$ret[] = sprintf('+%\'-12s+%\'-32s+%\'-12s+', '', '', '');
		$ret[] = sprintf('| %-10s | %-30s | %-10s |', 'ID:', 'Name:', 'Price:');
		$ret[] = sprintf('+%\'-12s+%\'-32s+%\'-12s+', '', '', '');
		
		foreach($products as $product) {
			$ret[] = sprintf('| %-10d | %-30s | %10.2f |', $product->getId(), $product->getName(), $product->getPrice());
			$ret[] = sprintf('+%\'-12s+%\'-32s+%\'-12s+', '', '', '');
		}
		
		return implode(PHP_EOL, $ret);
	}
	
	public function executeSoap(YoudsFrameworkRequestDataHolder $rd)
	{
		return $this->getAttribute('products');
	}
}

?>
