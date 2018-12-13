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

class Default_LoginInputView extends YoudsFrameworkSampleAppDefaultBaseView
{
	public function executeHtml(YoudsFrameworkRequestDataHolder $rd)
	{
		$this->setupHtml($rd);
		
		// set the title
		$this->setAttribute('_title', $this->tm->_('Login', 'default.Login'));
		
		// our login form is displayed. so let's remove that cookie thing there
		$this->getResponse()->setCookie('autologon[username]', false);
		$this->getResponse()->setCookie('autologon[password]', false);
		
		if($this->getContainer()->hasAttributeNamespace('org.youds.controller.forwards.login')) {
			// we were redirected to the login form by the controller because the requested action required security
			// so store the input URL in the session for a redirect after login
			$this->us->setAttribute('redirect', $this->rq->getUrl(), 'org.youds.SampleApp.login');
		} else {
			// clear the redirect URL just to be sure
			// but only if request method is "read", i.e. if the login form is served via GET!
			$this->us->removeAttribute('redirect', 'org.youds.SampleApp.login');
		}
	}
}

?>
