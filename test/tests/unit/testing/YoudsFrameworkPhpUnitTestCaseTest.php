<?php

/**
 * @runTestsInSeparateProcesses
 * @youdsIsolationEnvironment testing.testIsolation	
 * @youdsIsolationDefaultContext web-isolated
 */
class YoudsFrameworkPhpUnitTestCaseTest extends YoudsFrameworkPhpUnitTestCase
{
	/**
	 * Constructs a test case with the given name.
	 *
	 * @param  string $name
	 * @param  array  $data
	 * @param  string $dataName
	 */
	public function __construct($name = NULL, array $data = array(), $dataName = '')
	{
		parent::__construct($name, $data, $dataName);
		$this->setIsolationEnvironment('testing.testIsolation'); // equivalent to the annotation @YoudsFrameworkIsolationEnvironment on the testcase class
	}
	
	public function testIsolationEnvironment()
	{
		$this->assertEquals('testing.testIsolation', YoudsFrameworkConfig::get('testing.environment'));
	}
	
	/**
	 * @youdsIsolationEnvironment testing.testIsolationAnnotated
	 */
	public function testIsolationEnvironmentAnnotated()
	{
		$this->assertEquals('testing.testIsolationAnnotated', YoudsFrameworkConfig::get('testing.environment'));
	}
	
	public function testIsolationDefaultContext()
	{
		$this->assertEquals('web-isolated', YoudsFrameworkConfig::get('core.default_context'));
	}
	
	/**
	 * @youdsIsolationDefaultContext web-isolated-annotated-method
	 */
	public function testIsolationDefaultContextAnnotated()
	{
		$this->assertEquals('web-isolated-annotated-method', YoudsFrameworkConfig::get('core.default_context'));
	}
	
	/**
	 * @preserveGlobalState enabled
	 */
	public function testPreserveGlobalStateOnWorks() {
		// this test just needs to run to signal success
		$this->assertTrue(true);
	}

	/**
	 * @preserveGlobalState disabled
	 */
	public function testPreserveGlobalStateOffWorks() {
		// this test just needs to run to signal success
		$this->assertTrue(true);
	}
	
}

?>
