<?php

class YoudsFrameworkPassthruLoggerLayoutTest extends YoudsFrameworkUnitTestCase
{
	public function testFormat()
	{
		$layout = new YoudsFrameworkPassthruLoggerLayout;
		$message = new YoudsFrameworkLoggerMessage('something');
		$this->assertEquals('something', $layout->format($message));
	}
}

?>
