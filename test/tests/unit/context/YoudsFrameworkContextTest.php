<?php

class YoudsFrameworkContextTest extends YoudsFrameworkPhpUnitTestCase
{
	public function testGetInstance()
	{
		$instance = YoudsFrameworkContext::getInstance('foo');
		$this->assertNotNull($instance);
		$this->assertInstanceOf('YoudsFrameworkContext', $instance);
	}
	
	public function testSameInstanceForSameProfile()
	{
		$instance1 = YoudsFrameworkContext::getInstance('foo');
		$instance2 = YoudsFrameworkContext::getInstance('foo');
		$this->assertSame($instance1, $instance2);
	}
	
	public function testDifferentInstanceForDifferentProfile()
	{
		$instance1 = YoudsFrameworkContext::getInstance('foo');
		$instance2 = YoudsFrameworkContext::getInstance('bar');
		$this->assertNotSame($instance1, $instance2);
	}
	
	public function testGetName()
	{
		$this->assertSame(YoudsFrameworkConfig::get('core.default_context'), YoudsFrameworkContext::getInstance()->getName());
		$this->assertSame('test1', YoudsFrameworkContext::getInstance('test1')->getName());
	}
	
	/**
	 * @dataProvider dataGetModel
	 */
	public function testGetModel($modelName, $className, $isSingleton, $module = null)
	{
		$ctx = YoudsFrameworkContext::getInstance();
		$model1 = $ctx->getModel($modelName, $module);
		$model2 = $ctx->getModel($modelName, $module);
		$this->assertInstanceOf($className, $model1);
		$this->assertInstanceOf($className, $model2);
		if($isSingleton) {
			$this->assertSame($model1, $model2);
		} else {
			$this->assertNotSame($model1, $model2);
		}
	}
	
	public function dataGetModel() {
		return array(
			'global normal model' => array('ContextTest', 'ContextTestModel', false),
			'global singleton model' => array('ContextTestSingleton', 'ContextTestSingletonModel', true),
			'global model in child path' => array('ContextTest.Child.Test', 'ContextTest_Child_TestModel', false),
			'module normal model' => array('Test', 'ContextTest_TestModel', false, 'ContextTest'),
			'module singleton model' => array('TestSingleton', 'ContextTest_TestSingletonModel', true, 'ContextTest'),
			'module model in child path' => array('Parent.Child.Test', 'ContextTest_Parent_Child_TestModel', false, 'ContextTest'),
		);
	}
	


	public function testGetFactoryInfo()
	{
		$ctx = YoudsFrameworkContext::getInstance('test');
		$expected = array('class' => 'YoudsFrameworkWebResponse', 'parameters' => array());
		$this->assertSame($expected, $ctx->getFactoryInfo('response'));
	}

	public function testGetController()
	{
		$this->assertInstanceOf('YoudsFrameworkController', YoudsFrameworkContext::getInstance()->getController());
	}

	/**
	 * @runInSeparateProcess
	 * @youdsIsolationEnvironment testing-use_database_off
	 */
	public function testGetDatabaseManagerOff()
	{
		$this->assertNull(YoudsFrameworkContext::getInstance()->getDatabaseManager());
	}

	/**
	 * @runInSeparateProcess
	 * @youdsIsolationEnvironment testing-use_database_on
	 */
	public function testGetDatabaseManagerOn()
	{
		$this->assertInstanceOf('YoudsFrameworkDatabaseManager', YoudsFrameworkContext::getInstance()->getDatabaseManager());
	}
	
	/**
	 * @runInSeparateProcess
	 * @youdsIsolationEnvironment testing-use_security_off
	 */
	public function testGetUserSecurityOff()
	{
		$this->assertInstanceOf('YoudsFrameworkUser', YoudsFrameworkContext::getInstance()->getUser());
		$this->assertNotInstanceOf('YoudsFrameworkSecurityUser', YoudsFrameworkContext::getInstance()->getUser());
	}

	/**
	 * @runInSeparateProcess
	 * @youdsIsolationEnvironment testing-use_security_on
	 */
	public function testGetUserSecurityOn()
	{
		$this->assertInstanceOf('YoudsFrameworkSecurityUser', YoudsFrameworkContext::getInstance()->getUser());
	}

	/**
	 * @runInSeparateProcess
	 * @youdsIsolationEnvironment testing-use_translation_off
	 */
	public function testGetTranslationManagerOff()
	{
		$this->assertNull(YoudsFrameworkContext::getInstance()->getTranslationManager());
	}

	/**
	 * @runInSeparateProcess
	 * @youdsIsolationEnvironment testing-use_logging_on
	 */
	public function testGetTranslationManagerOn()
	{
		$this->assertInstanceOf('YoudsFrameworkTranslationManager', YoudsFrameworkContext::getInstance()->getTranslationManager());
	}

	public function testGetLoggerManager()
	{
		$this->assertInstanceOf('YoudsFrameworkLoggerManager', YoudsFrameworkContext::getInstance()->getLoggerManager());
	}

	public function testGetRequest()
	{
		$ctx = YoudsFrameworkContext::getInstance();
		$this->assertInstanceOf('YoudsFrameworkRequest', $ctx->getRequest());
	}

	public function testGetRouting()
	{
		$ctx = YoudsFrameworkContext::getInstance();
		$this->assertInstanceOf('YoudsFrameworkRouting', $ctx->getRouting());
	}

	public function testGetStorage()
	{
		$ctx = YoudsFrameworkContext::getInstance();
		$this->assertInstanceOf('YoudsFrameworkStorage', $ctx->getStorage());
	}
}

?>
