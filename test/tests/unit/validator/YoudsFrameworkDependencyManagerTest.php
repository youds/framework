<?php

class MyDependencyManager extends YoudsFrameworkDependencyManager
{
	public function setDepData($data) { $this->depData = $data; }
}

class YoudsFrameworkDependencyManagerTest extends YoudsFrameworkUnitTestCase
{
	public function testclear()
	{
		$m = new MyDependencyManager;
		
		$m->setDepData(array(1));
		$m->clear();
		$this->assertEquals($m->getDependTokens(), array());
	}
	
	public function testcheckDependencies()
	{
		$m = new MyDependencyManager;
		$m->setDepData(array('foo' => true, 'bar' => true));
		
		$this->assertEquals($m->checkDependencies(array('foo', 'bar'), new YoudsFrameworkVirtualArrayPath('')), true);
		$this->assertEquals($m->checkDependencies(array('foo'), new YoudsFrameworkVirtualArrayPath('')), true);
		$this->assertEquals($m->checkDependencies(array('foo', 'bar', 'foobar'), new YoudsFrameworkVirtualArrayPath('')), false);
		$this->assertEquals($m->checkDependencies(array('foo'), new YoudsFrameworkVirtualArrayPath('')), true);
		$this->assertEquals($m->checkDependencies(array('%s[foo]'), new YoudsFrameworkVirtualArrayPath('bar')), false);
		
		$m->setDepData(array('foo' => array('bar' => true)));
		$this->assertEquals($m->checkDependencies(array('foo'), new YoudsFrameworkVirtualArrayPath('')), true);
		$this->assertEquals($m->checkDependencies(array('%s[bar]'), new YoudsFrameworkVirtualArrayPath('foo')), true);
		$this->assertEquals($m->checkDependencies(array(), new YoudsFrameworkVirtualArrayPath('')), true);
	}
	
	public function testaddDependTokens()
	{
		$m = new MyDependencyManager;
		
		$m->addDependTokens(array('foo', 'bar'), new YoudsFrameworkVirtualArrayPath(''));
		$this->assertEquals($m->getDependTokens(), array('foo' => true, 'bar' => true));
		$m->addDependTokens(array('%s[test]', '%s[test2]'), new YoudsFrameworkVirtualArrayPath('foobar'));
		$this->assertEquals($m->getDependTokens(), array('foo' => true, 'bar' => true, 'foobar' => array('test' => true, 'test2' => true)));
	}
}
?>
