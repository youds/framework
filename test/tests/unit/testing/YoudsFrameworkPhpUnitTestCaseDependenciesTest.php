<?php

class YoudsFrameworkPhpUnitTestCaseDependenciesTestDummy extends SandboxTestingChildClass {} 

/**
 * @runTestsInSeparateProcesses
 */
class YoudsFrameworkPhpUnitTestCaseDependenciesTest extends YoudsFrameworkPhpUnitTestCase
{
	/**
	 * @preserveGlobalState enabled
	 */
	public function testDependenciesAreLoadedWithGlobalState()
	{
		// this test is successful as soon as the test runs.
		// It would fail way before if any of the dependencies 
		// from SandboxTestingChildClass didn't load
		$this->assertTrue(true);
	}
	
	/**
	 * @preserveGlobalState disabled
	 */
	public function testDependenciesAreLoadedWithoutGlobalState()
	{
		// this test is successful as soon as the test runs.
		// It would fail way before if any of the dependencies 
		// from SandboxTestingChildClass didn't load
		$this->assertTrue(true);
	}
	
}

?>
