<?php

class SampleModel extends YoudsFrameworkModel {}

class YoudsFrameworkModelTest extends YoudsFrameworkUnitTestCase
{
	public function testGetContext()
	{
		$context = $this->getContext();
		$model = new SampleModel();
		$model->initialize($context);
		$mContext = $model->getContext();
		$this->assertSame($mContext, $context);
	}

}
?>
