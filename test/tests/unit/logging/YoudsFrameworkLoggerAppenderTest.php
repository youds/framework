<?php

class Sample2Layout extends YoudsFrameworkLoggerLayout
{
	public function format(YoudsFrameworkLoggerMessage $message)
	{
	}
}

class SampleAppender extends YoudsFrameworkLoggerAppender
{
	public function initialize(YoudsFrameworkContext $context, array $params = array()) {}
	public function shutdown() {}
	public function write(YoudsFrameworkLoggerMessage $message) {}
}

class YoudsFrameworkLoggerAppenderTest extends YoudsFrameworkUnitTestCase
{
	public function testGetSetLayout()
	{
		$a = new SampleAppender();
		$this->assertNull($a->getLayout());
		$l = new Sample2Layout();
		$a_test = $a->setLayout($l);
		$this->assertSame($a, $a_test);
		$this->assertEquals($l, $a->getLayout());
	}

}

?>
