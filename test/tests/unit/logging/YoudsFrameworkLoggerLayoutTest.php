<?php

class SampleLayout extends YoudsFrameworkLoggerLayout
{
	public function format(YoudsFrameworkLoggerMessage $message)
	{
	}
}

class YoudsFrameworkLoggerLayoutTest extends YoudsFrameworkUnitTestCase
{
	public function testGetSetLayout()
	{
		$layout = new SampleLayout;
		$this->assertNull($layout->getLayout());
		$layout->setLayout('something');
		$this->assertEquals('something', $layout->getLayout());
	}
}

?>
