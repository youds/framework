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

class Default_LoginSuccessView extends YoudsFrameworkSampleAppDefaultBaseView
{

	public function executeHtml(YoudsFrameworkRequestDataHolder $rd)
	{
		$res = $this->getResponse();

		// set the autologon cookie if requested
		if($rd->hasParameter('remember')) {
			$res->setCookie('autologon[username]', $rd->getParameter('username'), '+14 days');
			$res->setCookie('autologon[password]', $this->us->getPassword($rd->getParameter('username')), '+14 days');
		}

		if($this->us->hasAttribute('redirect', 'org.youds.SampleApp.login')) {
			$this->getResponse()->setRedirect($this->us->removeAttribute('redirect', 'org.youds.SampleApp.login'));
			return;
		}

		$this->setupHtml($rd);

		// set the title
		$this->setAttribute('_title', $this->tm->_('Login Successful', 'default.Login'));
	}

}

?>
