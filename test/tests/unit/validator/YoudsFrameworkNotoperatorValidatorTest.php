<?php

class YoudsFrameworkNotoperatorValidatorTest extends YoudsFrameworkUnitTestCase
{
	public function testvalidate()
	{
		$vm = $this->getContext()->createInstanceFor('validation_manager');
		$vm->clear();
		$o = $vm->createValidator('YoudsFrameworkNotoperatorValidator', array(), array(), array('severity' => 'error'));
		
		$val1 = $vm->createValidator('DummyValidator', array(), array(), array('severity' => 'error'));
		$o->registerValidators(array($val1));
		
		// 1st test: successful
		$val1->val_result = true;
		$this->assertEquals($o->execute(new YoudsFrameworkRequestDataHolder()), YoudsFrameworkValidator::ERROR);
		$this->assertTrue($val1->validated);
		$val1->clear();

		// 2nd test: failure
		$val1->val_result = false;
		$this->assertEquals($o->execute(new YoudsFrameworkRequestDataHolder()), YoudsFrameworkValidator::SUCCESS);
		$this->assertTrue($val1->validated);
		$val1->clear();

		// 3rd test: critical
		$val1->val_result = false;
		$val1->setParameter('severity', 'critical');
		$this->assertEquals($o->execute(new YoudsFrameworkRequestDataHolder()), YoudsFrameworkValidator::CRITICAL);
		$this->assertTrue($val1->validated);
		$val1->clear();
	}
	
	public function testcheckValidSetup()
	{
		$vm = $this->getContext()->createInstanceFor('validation_manager');
		$vm->clear();
		$o = $vm->createValidator('YoudsFrameworkNotoperatorValidator', array(), array(), array('severity' => 'error'));
		
		$val1 = $vm->createValidator('DummyValidator', array(), array(), array('severity' => 'error'));
		$val2 = $vm->createValidator('DummyValidator', array(), array(), array('severity' => 'error'));
		
		try {
			$o->execute(new YoudsFrameworkRequestDataHolder());
			$this->fail();
		} catch(YoudsFrameworkValidatorException $e) {
			$this->assertEquals($e->getMessage(), 'NOT allows only 1 child validator');
		}
		$o->addChild($val1);
		
		$o->addChild($val2);
		try {
			$o->execute(new YoudsFrameworkRequestDataHolder());
			$this->fail();
		} catch(YoudsFrameworkValidatorException $e) {
			$this->assertEquals($e->getMessage(), 'NOT allows only 1 child validator');
		}
	}
}
?>
