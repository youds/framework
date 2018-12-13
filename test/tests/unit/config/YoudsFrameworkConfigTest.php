<?php

require_once(__DIR__ . '/../../../../src/config/YoudsFrameworkConfig.class.php');

/**
 * @youdsBootstrap off
 * @preserveGlobalState disabled
 * @runTestsInSeparateProcesses
 */
class YoudsFrameworkConfigTest extends YoudsFrameworkPhpUnitTestCase
{
	public function testInitiallyEmpty()
	{
		$this->assertEquals(array(), YoudsFrameworkConfig::toArray());
		$this->assertNull(YoudsFrameworkConfig::get('something'));
	}

	/**
	 * @dataProvider providerGetSet
	 */
	public function testGetSet($key, $value)
	{
		$this->assertTrue(YoudsFrameworkConfig::set($key, $value));
		$this->assertEquals($value, YoudsFrameworkConfig::get($key));
		$this->assertTrue(YoudsFrameworkConfig::has($key));
		$this->assertFalse(YoudsFrameworkConfig::isReadonly($key));
		$this->assertTrue(YoudsFrameworkConfig::remove($key));
	}
	public function providerGetSet()
	{
		return array(
			'string key'                => array('foobar', 'baz'),
			'string key with period'    => array('some.thing', 'ohai'),
			// 'string key with null byte' => array("f\0oo", 'nullbyte'), // can't do this because PHPUnit doesn't do var_export(serialize(...)), so the null byte fucks everything up
			'integer key'               => array(123, 'qwe'),
			'octal number key'          => array(0123, 'yay'),
		);
	}

	public function testHas()
	{
		YoudsFrameworkConfig::set('fubar', '123qwe');
		$this->assertTrue(YoudsFrameworkConfig::has('fubar'));
	}

	public function testClear()
	{
		YoudsFrameworkConfig::clear();
		$this->assertEquals(array(), YoudsFrameworkConfig::toArray());
	}

	public function testRemove()
	{
		YoudsFrameworkConfig::set('opa', 'yay');
		$this->assertTrue(YoudsFrameworkConfig::remove('opa'));
		$this->assertFalse(YoudsFrameworkConfig::remove('blu'));
		$this->assertFalse(YoudsFrameworkConfig::has('opa'));
		$this->assertFalse(YoudsFrameworkConfig::has('blu'));
	}

	public function testFromArray()
	{
		$data = array('foo' => 'bar', 'bar' => 'baz');
		YoudsFrameworkConfig::clear();
		YoudsFrameworkConfig::fromArray($data);
		$this->assertEquals($data, YoudsFrameworkConfig::toArray());
	}

	public function testFromArrayMerges()
	{
		$data = array('foo' => 'bar', 'bar' => 'baz');
		YoudsFrameworkConfig::clear();
		YoudsFrameworkConfig::set('baz', 'lol');
		YoudsFrameworkConfig::fromArray($data);
		$this->assertEquals(array('baz' => 'lol') + $data, YoudsFrameworkConfig::toArray());
	}

	public function testFromArrayMergesAndOverwrites()
	{
		$data = array('foo' => 'bar', 'bar' => 'baz', 'baz' => 'qux');
		YoudsFrameworkConfig::clear();
		YoudsFrameworkConfig::set('baz', 'lol');
		YoudsFrameworkConfig::fromArray($data);
		$this->assertEquals(array('baz' => 'qux') + $data, YoudsFrameworkConfig::toArray());
	}

	public function testFromArrayMergesAndReindexes()
	{
		$data = array('zomg', 'lol');
		YoudsFrameworkConfig::clear();
		YoudsFrameworkConfig::set(2, 'yay');
		YoudsFrameworkConfig::set(1, 'aha');
		YoudsFrameworkConfig::set(0, 'omg', true, true);
		YoudsFrameworkConfig::fromArray($data);
		$this->assertEquals(array(2 => 'yay', 0 => 'omg', 1 => 'lol'), YoudsFrameworkConfig::toArray());
	}

	public function testHasNullValue()
	{
		YoudsFrameworkConfig::set('fubar', null);
		$this->assertTrue(YoudsFrameworkConfig::has('fubar'));
		$this->assertFalse(YoudsFrameworkConfig::has('fubaz'));
	}

	public function testGetDefault()
	{
		YoudsFrameworkConfig::set('some.where', 'ohai');
		$this->assertEquals('ohai', YoudsFrameworkConfig::get('some.where'));
		$this->assertEquals('ohai', YoudsFrameworkConfig::get('some.where', 'bai'));
		$this->assertEquals('bai', YoudsFrameworkConfig::get('not.there', 'bai'));
	}

	public function testSetOverwrite()
	{
		YoudsFrameworkConfig::set('foo.bar', '123');
		$this->assertEquals('123', YoudsFrameworkConfig::get('foo.bar'));
		$this->assertFalse(YoudsFrameworkConfig::set('foo.bar', '456', false));
		$this->assertEquals('123', YoudsFrameworkConfig::get('foo.bar'));
		$this->assertTrue(YoudsFrameworkConfig::set('foo.bar', '456', true));
		$this->assertEquals('456', YoudsFrameworkConfig::get('foo.bar'));
		$this->assertTrue(YoudsFrameworkConfig::set('foo.bar', '789'));
		$this->assertEquals('789', YoudsFrameworkConfig::get('foo.bar'));
	}

	public function testSetReadonly()
	{
		YoudsFrameworkConfig::set('bulletproof', 'abc', true, true);
		$this->assertEquals('abc', YoudsFrameworkConfig::get('bulletproof'));
		$this->assertFalse(YoudsFrameworkConfig::set('bulletproof', '123'));
		$this->assertEquals('abc', YoudsFrameworkConfig::get('bulletproof'));
		$this->assertFalse(YoudsFrameworkConfig::set('bulletproof', '123', true));
		$this->assertEquals('abc', YoudsFrameworkConfig::get('bulletproof'));
		$this->assertFalse(YoudsFrameworkConfig::set('bulletproof', '123', true, true));
		$this->assertEquals('abc', YoudsFrameworkConfig::get('bulletproof'));
	}

	public function testIsReadonly()
	{
		YoudsFrameworkConfig::set('WORM', 'yay', true, true);
		YoudsFrameworkConfig::set('WMRM', 'yay');
		$this->assertTrue(YoudsFrameworkConfig::isReadonly('WORM'));
		$this->assertFalse(YoudsFrameworkConfig::isReadonly('WMRM'));
	}

	public function testReadonlySurvivesClear()
	{
		YoudsFrameworkConfig::set('WORM', 'yay', true, true);
		YoudsFrameworkConfig::set('WMRM', 'yay');
		YoudsFrameworkConfig::clear();
		$this->assertTrue(YoudsFrameworkConfig::has('WORM'));
		$this->assertFalse(YoudsFrameworkConfig::has('WMRM'));
	}

	public function testFromArrayMergesButDoesNotOverwriteReadonlies()
	{
		$data = array('foo' => 'bar', 'bar' => 'baz', 'baz' => 'qux');
		YoudsFrameworkConfig::clear();
		YoudsFrameworkConfig::set('baz', 'lol', true, true);
		YoudsFrameworkConfig::fromArray($data);
		$this->assertEquals(array('baz' => 'lol') + $data, YoudsFrameworkConfig::toArray());
	}

	public function testReadonlySurvivesRemove()
	{
		YoudsFrameworkConfig::set('bla', 'goo', true, true);
		$this->assertFalse(YoudsFrameworkConfig::remove('bla'));
		$this->assertTrue(YoudsFrameworkConfig::has('bla'));
	}

	public function testGetSetStringInteger() {
		YoudsFrameworkConfig::set('10', 'ten');
		$this->assertEquals('ten', YoudsFrameworkConfig::get(10));
		YoudsFrameworkConfig::set(21, 'twentyone');
		$this->assertEquals('twentyone', YoudsFrameworkConfig::get('21'));
	}

}
