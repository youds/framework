<?php

require_once(__DIR__ . '/BaseValidatorTest.php');

class YoudsFrameworkJsonValidatorTest extends BaseValidatorTest
{
	public function testExecute()
	{
		$this->doTestExecute('YoudsFrameworkJsonValidator', json_encode(array('foo' => 'bar')), YoudsFrameworkValidator::SUCCESS);
		
		$errors = array(
			'syntax' => $errorMsg = 'Syntax error',
		);
		$this->doTestExecute('YoudsFrameworkJsonValidator', '{', YoudsFrameworkValidator::ERROR, $errorMsg, $errors);
	}

	public function testExport()
	{
		$value = array('foo' => 'bar');

		$res = $this->executeValidator('YoudsFrameworkJsonValidator', json_encode($value), array(), array(
			'export' => 'test',
		));
		$this->assertEquals($res['rd']->getParameter('test'), $value);

		$res = $this->executeValidator('YoudsFrameworkJsonValidator', json_encode($value), array(), array(
			'export' => 'test',
			'assoc'  => false,
		));
		$this->assertEquals($res['rd']->getParameter('test'), (object)$value);
	}
}

?>
