<?php
require_once(__DIR__ . '/ConfigHandlerTestBase.php');

class DCHTestDatabase
{
	public $params;

	public function initialize($dbm, $params)
	{
		$this->params = $params;
	}
}

class YoudsFrameworkDatabaseConfigHandlerTest extends ConfigHandlerTestBase
{
	protected $databases;
	protected $defaultDatabaseName;

	public function setUp()
	{
		$this->databases = array();
	}
	
	protected function loadTestConfig($env = null) {
		$DBCH = new YoudsFrameworkDatabaseConfigHandler();
		
		$document = $this->parseConfiguration(
			YoudsFrameworkConfig::get('core.config_dir') . '/tests/databases.xml',
			YoudsFrameworkConfig::get('core.youds_dir') . '/config/xsl/databases.xsl',
			$env
		);

		$this->includeCode($DBCH->execute($document));
		
	}

	public function testDatabaseConfigHandler()
	{
		$this->loadTestConfig();

		$this->assertInstanceOf('DCHTestDatabase', $this->databases['test1']);
		$paramsExpected = array(
			'host' => 'localhost1',
			'user' => 'username1',
			'config' => YoudsFrameworkConfig::get('core.app_dir') . '/config/project-conf.php',
		);
		$this->assertSame($paramsExpected, $this->databases['test1']->params);

		$this->assertSame($this->databases['test1'], $this->databases[$this->defaultDatabaseName]);
	}

	public function testOverwrite()
	{
		$this->loadTestConfig('env2');

		$this->assertInstanceOf('DCHTestDatabase', $this->databases['test1']);
		$paramsExpected = array(
			'host' => 'localhost1',
			'user' => 'testuser1',
			'config' => YoudsFrameworkConfig::get('core.app_dir') . '/config/project-conf.php',
		);
		$this->assertSame($paramsExpected, $this->databases['test1']->params);

		$this->assertSame($this->databases['test2'], $this->databases[$this->defaultDatabaseName]);
	}
	
	public function testMissingDefaultDoesNotReset() {
		// see https://github.com/youds/youds/issues/1533
		$this->loadTestConfig('missing-default-does-not-reset');

		$this->assertSame('test1', $this->defaultDatabaseName);
	}

	public function testDefaultDatabase() {
		$this->loadTestConfig('test-default');
		
		$this->assertSame('test2', $this->defaultDatabaseName);
	}

	public function testDefaultDatabase1_0() {
		$this->loadTestConfig('test-default-1.0');
		
		$this->assertSame('test1', $this->defaultDatabaseName);
	}
	
	/**
	 * @expectedException YoudsFrameworkConfigurationException
	 */
	public function testNonExistentDefault() {
		$this->loadTestConfig('nonexistent-default');
	}
}
?>
