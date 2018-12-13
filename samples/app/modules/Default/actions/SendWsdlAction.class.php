<?php

class Default_SendWsdlAction extends YoudsFrameworkSampleAppDefaultBaseAction
{
	public function execute(YoudsFrameworkRequestDataHolder $rd)
	{
		if(YoudsFrameworkConfig::get('core.debug')) {
			ini_set('soap.wsdl_cache_enabled', 0);
		}
		
		try {
			$sc = YoudsFrameworkContext::getInstance('soap');
			$wsdl = $sc->getRouting()->getWsdlPath();
			if($wsdl && is_readable($wsdl)) {
				$this->setAttribute('wsdl', $wsdl);
				return 'Success';
			}
		} catch(YoudsFrameworkException $e) {
		}
		return 'Error';
	}
}

?>
