<?php

class TRTestSampleRenderer extends YoudsFrameworkRenderer
{
	public function render(YoudsFrameworkTemplateLayer $layer, array &$attributes = array(), array &$slots = array(), array &$moreAssigns = array())
	{
	}
}

class YoudsFrameworkRendererTest extends YoudsFrameworkUnitTestCase
{
	protected $_r = null, $_v = null;

	public function setUp()
	{
		$this->_r = new TRTestSampleRenderer();
		$this->_r->initialize($this->getContext());
	}

	public function testGetContext()
	{
		$c1 = $this->getContext();
		$c2 = $this->_r->getContext();
		$this->assertSame($c1, $c2);
	}
}
?>
