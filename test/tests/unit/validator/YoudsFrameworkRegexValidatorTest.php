<?php

require_once(__DIR__ . '/BaseValidatorTest.php');

class YoudsFrameworkRegexValidatorTest extends BaseValidatorTest
{

	public function testExecute()
	{
		$good = array(
			'nnbb',
			'nbb',
			'nnnbb'
		);
		$bad = array(
			'bb',
			'nnnnbb',
			'jdsakl'
		);
		$parameters = array('pattern' => '/^[n]{1,3}bb$/', 'match' => true);
		$errors = array('' => $errorMsg = 'Some other error');
		foreach($good as $value) {
			$this->doTestExecute('YoudsFrameworkRegexValidator', $value, YoudsFrameworkValidator::SUCCESS, null, $errors, $parameters);
		}
		foreach($bad as $value) {
			$this->doTestExecute('YoudsFrameworkRegexValidator', $value, YoudsFrameworkValidator::ERROR, $errorMsg, $errors, $parameters);
		}

		$parameters['match'] = false;
		foreach($bad as $value) {
			$this->doTestExecute('YoudsFrameworkRegexValidator', $value, YoudsFrameworkValidator::SUCCESS, null, $errors, $parameters);
		}
		foreach($good as $value) {
			$this->doTestExecute('YoudsFrameworkRegexValidator', $value, YoudsFrameworkValidator::ERROR, $errorMsg, $errors, $parameters);
		}
	}
}

?>
