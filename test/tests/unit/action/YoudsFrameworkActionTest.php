<?php

class SampleAction extends YoudsFrameworkAction {
	public function execute(YoudsFrameworkParameterHolder $parameters)
	{
	}
}

class ActionTest extends YoudsFrameworkUnitTestCase
{
	private $_action = null;

	public function setUp()
	{
		$this->_action = new SampleAction();
		$this->_action->initialize($this->getContext()->getController()->createExecutionContainer('Foo', 'Bar'));
	}

	public function tearDown()
	{
		$this->_action = null;
	}

	public function testgetContext()
	{
		$context = $this->getContext();
		$actionContext = $this->_action->getContext();
		$this->assertSame($context, $actionContext);
	}

	public function testCredentials()
	{
		$this->assertNull($this->_action->getCredentials());
	}

	public function testgetDefaultViewName()
	{
		$this->assertEquals('Input', $this->_action->getDefaultViewName());
	}

	public function testhandleError()
	{
		$this->assertEquals('Error', $this->_action->handleError(new YoudsFrameworkRequestDataHolder()));
	}

	public function testisSecure()
	{
		$this->assertFalse($this->_action->isSecure());
	}

	public function testvalidate()
	{
		$this->assertTrue($this->_action->validate(new YoudsFrameworkRequestDataHolder()));
	}
}
?>
