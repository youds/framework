<?php

class YoudsFrameworkLoggerMessageTest extends YoudsFrameworkUnitTestCase
{
	public function testConstructor()
	{
		$message = new YoudsFrameworkLoggerMessage();
		$this->assertNull($message->getMessage());
		$this->assertEquals(YoudsFrameworkLogger::INFO, $message->getLevel());
		$message = new YoudsFrameworkLoggerMessage('test');
		$this->assertEquals('test', $message->getMessage());
		$this->assertEquals(YoudsFrameworkLogger::INFO, $message->getLevel());
		$message = new YoudsFrameworkLoggerMessage('test', YoudsFrameworkLogger::DEBUG);
		$this->assertEquals('test', $message->getMessage());
		$this->assertEquals(YoudsFrameworkLogger::DEBUG, $message->getLevel());
	}

	public function testGetsetappendMessage()
	{
		$message = new YoudsFrameworkLoggerMessage();
		$message->setMessage('my message');
		$this->assertEquals('my message', $message->getMessage());
		$message->setMessage('my message 2');
		$this->assertEquals('my message 2', $message->getMessage());
		$message->appendMessage('my message 3');
		$this->assertEquals(array('my message 2', 'my message 3'), $message->getMessage());
	}

	public function test__toString()
	{
		$message = new YoudsFrameworkLoggerMessage('test message', YoudsFrameworkLogger::INFO);
		$this->assertEquals('test message', $message->__toString());
		$message->appendMessage('another line');
		$this->assertEquals("test message\nanother line", $message->__toString());
	}

	public function testGetsetLevel()
	{
		$message = new YoudsFrameworkLoggerMessage;
		$message->setLevel(YoudsFrameworkLogger::DEBUG);
		$this->assertEquals(YoudsFrameworkLogger::DEBUG, $message->getLevel());
		$message->setLevel(YoudsFrameworkLogger::INFO);
		$this->assertEquals(YoudsFrameworkLogger::INFO, $message->getLevel());
	}

}

?>
