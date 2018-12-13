<?php
class MyTestConfigHandler extends YoudsFrameworkConfigHandler
{
	public function execute($config, $context = null)
	{
		return '';
	}
}

class YoudsFrameworkConfigHandlerTest extends YoudsFrameworkUnitTestCase
{
	protected $ch = null;
	public function setUp()
	{
		$this->ch = new MyTestConfigHandler();
		$this->ch->initialize('MyValidationFile.mvf');
	}

	public function tearDown()
	{
		$this->ch = null;
	}

	public function testGetValidationFile()
	{
		$this->assertSame('MyValidationFile.mvf', $this->ch->getValidationFile());
	}

}
