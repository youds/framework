<?php

/**
 * @runTestsInSeparateProcesses
 * @youdsIsolationEnvironment testing-use_database_on
 */
class YoudsFrameworkDatabaseManagerTest extends YoudsFrameworkUnitTestCase
{
	private $_dbm = null;
	
	public function setUp()
	{
		$this->_dbm = $this->getContext()->getDatabaseManager();
	}

	public function tearDown()
	{
		$this->_dbm = null;
	}

	public function testInitialization()
	{
		$this->assertInstanceOf('YoudsFrameworkDatabaseManager', $this->_dbm);
	}

}
?>
