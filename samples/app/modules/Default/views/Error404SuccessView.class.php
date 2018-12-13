<?php

// +---------------------------------------------------------------------------+
// | This file is part of the YoudsFramework package.                                   |
// | Copyright (c) 2005-2011 the YoudsFramework Project.                                |
// |                                                                           |
// | For the full copyright and license information, please view the LICENSE   |
// | file that was distributed with this source code. You can also view the    |
// | LICENSE file online at http://www.youds.com/LICENSE.txt                   |
// |   vi: set noexpandtab:                                                    |
// |   Local Variables:                                                        |
// |   indent-tabs-mode: t                                                     |
// |   End:                                                                    |
// +---------------------------------------------------------------------------+

class Default_Error404SuccessView extends YoudsFrameworkSampleAppDefaultBaseView
{

	public function executeHtml(YoudsFrameworkRequestDataHolder $rd)
	{
		$this->setupHtml($rd);

		// set the title
		$this->setAttribute('_title', $this->tm->_('404 Not Found', 'default.ErrorActions'));

		$this->container->getResponse()->setHttpStatusCode('404');
	}

	public function executeXmlrpc(YoudsFrameworkRequestDataHolder $rd)
	{
		return array(
			'faultCode' => -32601, // as per http://xmlrpc-epi.sourceforge.net/specs/rfc.fault_codes.php
			'faultString' => 'requested method not found',
		);
	}
	
	public function executeText(YoudsFrameworkRequestDataHolder $rd)
	{
		return
			'Usage: console.php <command> [OPTION]...' . PHP_EOL .
			PHP_EOL .
			'Commands:' . PHP_EOL .
			'  viewproduct <id>' . PHP_EOL .
			'    Retrieves product details given a product ID.' . PHP_EOL .
			'  listproducts' . PHP_EOL .
			'    Lists all products in the application.' . PHP_EOL;
	}
}

?>
