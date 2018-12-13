<?php
require_once(__DIR__ . '/ConfigHandlerTestBase.php');

class MyAutoloader {
	public static $classes;
	public static $namespaces;
	
	public static function addClasses($classes) {
		static::$classes = $classes;
	}
	
	public static function addNamespaces($namespaces) {
		static::$namespaces = $namespaces;
	}
}

class YoudsFrameworkAutoloadConfigHandlerTest extends ConfigHandlerTestBase
{
	protected function runHandler($environment = null) {
		$ACH = new YoudsFrameworkAutoloadConfigHandler();

		$document = $this->parseConfiguration(
			YoudsFrameworkConfig::get('core.config_dir') . '/tests/autoload_simple.xml',
			YoudsFrameworkConfig::get('core.youds_dir') . '/config/xsl/autoload.xsl',
			$environment
		);
		// YoudsFrameworkAutoloader will have all of YoudsFramework's as well, so let's replace it with our "mock"
		$code = str_replace('YoudsFrameworkAutoloader::', 'MyAutoloader::', $ACH->execute($document));
		$this->includeCode($code);
	}
	
	public function testBasic()
	{
		$this->runHandler();
		$expected = array(
			'YoudsFrameworkConfigAutoloadClass1' => YoudsFrameworkConfig::get('core.app_dir') . '/lib/config/autoload/YoudsFrameworkConfigAutoloadClass1.class.php',
			'YoudsFrameworkConfigAutoloadClass2' => YoudsFrameworkConfig::get('core.app_dir') . '/lib/config/autoload/YoudsFrameworkConfigAutoloadClass2.class.php',
			'YoudsFrameworkConfigAutoloadClass3' => YoudsFrameworkConfig::get('core.app_dir') . '/lib/config/autoload/YoudsFrameworkConfigAutoloadClass3.class.php',
		);

		$this->assertEquals($expected, MyAutoloader::$classes);
		
		$expected = array(
			'YoudsFramework\TestAbsolute' => YoudsFrameworkConfig::get('core.app_dir') . '/lib/config/autoload',
			'YoudsFramework\TestRelative' => YoudsFrameworkConfig::get('core.app_dir') . '/lib/config/autoload',
		);

		$this->assertEquals($expected, MyAutoloader::$namespaces);
	}

	public function testOverwrite()
	{
		$this->runHandler('test-overwrite');
		$expected = array(
			'YoudsFrameworkConfigAutoloadClass1' => YoudsFrameworkConfig::get('core.app_dir') . '/lib/config/autoload/YoudsFrameworkConfigAutoloadClass1.class.php',
			'YoudsFrameworkConfigAutoloadClass2' => YoudsFrameworkConfig::get('core.app_dir') . '/lib/config/autoload/YoudsFrameworkConfigAutoloadClass3.class.php',
			'YoudsFrameworkConfigAutoloadClass3' => YoudsFrameworkConfig::get('core.app_dir') . '/lib/config/autoload/YoudsFrameworkConfigAutoloadClass3.class.php',
		);

		$this->assertEquals($expected, MyAutoloader::$classes);
		
		$expected = array(
			'YoudsFramework\TestAbsolute' => YoudsFrameworkConfig::get('core.app_dir') . '/lib/config',
			'YoudsFramework\TestRelative' => YoudsFrameworkConfig::get('core.app_dir') . '/lib/config/autoload',
		);

		$this->assertEquals($expected, MyAutoloader::$namespaces);
	}

	/**
	 * @expectedException YoudsFrameworkParseException
	 */
	public function testClassMissing() {
		$this->runHandler('test-class-missing');
	}

	/**
	 * @expectedException YoudsFrameworkParseException
	 */
	public function testNamespaceMissing() {
		$this->runHandler('test-namespace-missing');
	}

}
?>
