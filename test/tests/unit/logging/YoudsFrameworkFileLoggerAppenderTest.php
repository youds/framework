<?php

class YoudsFrameworkFileLoggerAppenderTest extends YoudsFrameworkUnitTestCase
{
	private $_file, $_fa;

	public function setUp()
	{
		$this->_file = tempnam(YoudsFrameworkConfig::get('core.cache_dir'), 'YoudsFrameworkFileLoggerAppenderTest');
		unlink($this->_file);
		$this->_fa = new YoudsFrameworkFileLoggerAppender();
		$this->_fa->initialize($this->getContext(), array('file'=>$this->_file));
		$this->_fa->setLayout(new YoudsFrameworkPassthruLoggerLayout());
	}

	public function tearDown()
	{
		@unlink($this->_file);
	}

	public function testInitialize()
	{
		$this->assertFalse(file_exists($this->_file));
		$this->_fa->write(new YoudsFrameworkLoggerMessage('my message'));
		$this->assertTrue(file_exists($this->_file));
		$this->_fa->shutdown();
	}

	public function testWrite()
	{
		$this->_fa->write(new YoudsFrameworkLoggerMessage('my message'));
		$this->assertRegexp('/my message/', file_get_contents($this->_file));
		$this->_fa->shutdown();
	}

	/*
	public function testshutdown()
	{
		// how do you test if the file is still open? - flock() and then attempt to remove it (??)
	}
	*/

}

?>
