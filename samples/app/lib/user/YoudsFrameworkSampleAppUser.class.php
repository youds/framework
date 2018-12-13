<?php

// +---------------------------------------------------------------------------+
// | This file is part of the YoudsFramework package.                                   |
// | Copyright (c) 2005-2011 the YoudsFramework Project.                                |
// | Based on the Mojavi3 MVC Framework, Copyright (c) 2003-2005 Sean Kerr.    |
// |                                                                           |
// | For the full copyright and license information, please view the LICENSE   |
// | file that was distributed with this source code. You can also view the    |
// | LICENSE file online at http://www.youds.com/LICENSE.txt                   |
// |   vi: set noexpandtab:                                                    |
// |   Local Variables:                                                        |
// |   indent-tabs-mode: t                                                     |
// |   End:                                                                    |
// +---------------------------------------------------------------------------+

class YoudsFrameworkSampleAppUser extends YoudsFrameworkRbacSecurityUser
{
	/**
	 * Let's pretend this is our database. For the sake of example ;)
	 */
	static $users = array(
		'Chuck Norris' => array(
			'password' => '$2a$10$2/Gmc4XpwAytFgy3wfrW9OUnkzd6ahgcMqrm4cEc4zD3IFD1GB6IG', // bcrypt, 10 rounds, "kick"
			'roles' => array(
				'photographer',
			)
		),
	);
	
	public function startup()
	{
		parent::startup();
		
		$reqData = $this->getContext()->getRequest()->getRequestData();
		
		if(!$this->isAuthenticated() && $reqData->hasCookie('autologon')) {
			$login = $reqData->getCookie('autologon');
			try {
				$this->login($login['username'], $login['password'], true);
			} catch(YoudsFrameworkSecurityException $e) {
				$response = $this->getContext()->getController()->getGlobalResponse();
				// login didn't work. that cookie sucks, delete it.
				$response->setCookie('autologon[username]', false);
				$response->setCookie('autologon[password]', false);
			}
		}
	}
	
	public function login($username, $password, $isPasswordHashed = false)
	{
		if(!isset(self::$users[$username])) {
			throw new YoudsFrameworkSecurityException('username');
		}
		
		if(!$isPasswordHashed) {
			$password = self::computeSaltedHash($password, self::$users[$username]['password']);
		}
		
		if($password != self::$users[$username]['password']) {
			throw new YoudsFrameworkSecurityException('password');
		}
		
		$this->setAuthenticated(true);
		$this->clearCredentials();
		$this->grantRoles(self::$users[$username]['roles']);
	}
	
	public static function computeSaltedHash($secret, $salt)
	{
		return crypt($secret, $salt);
	}
	
	public static function getPassword($username)
	{
		if(self::$users[$username]) {
			return self::$users[$username]['password'];
		}
	}
	
	public function logout()
	{
		$this->clearCredentials();
		$this->setAuthenticated(false);
	}
}

?>
