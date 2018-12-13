<?php

class YoudsFrameworkSessionStorageTest extends YoudsFrameworkUnitTestCase
{
	
	/**
	 * @runInSeparateProcess
	 */
	public function testStartupSetsCookieSecureFlag()
	{
		// test for bug #1541
		ini_set('session.cookie_secure', 0);
		$context = YoudsFrameworkContext::getInstance('youds-session-storage-test::tests-startup-sets-cookie-secure-flag');
		$storage = new YoudsFrameworkSessionStorage();
		$storage->initialize($context);
		$storage->startup();
		$cookieParams = session_get_cookie_params();
		$this->assertTrue($cookieParams['secure']);
	}

	/**
	 * @runInSeparateProcess
	 */
	public function testStaticSessionId()
	{
		$context = YoudsFrameworkContext::getInstance('youds-session-storage-test::tests-static-session-id');
		$storage = new YoudsFrameworkSessionStorage();
		$storage->initialize($context);
		$storage->startup();
		$this->assertEquals(session_id(), 'foobar');
	}
	
}
