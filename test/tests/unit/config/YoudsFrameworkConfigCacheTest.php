<?php

class YoudsFrameworkConfigCacheTest extends YoudsFrameworkPhpUnitTestCase
{
	/**
	 * Constructs a test case with the given name.
	 *
	 * @param  string $name
	 * @param  array  $data
	 * @param  string $dataName
	 */
	public function __construct($name = NULL, array $data = array(), $dataName = '')
	{
		parent::__construct($name, $data, $dataName);
	}
	
	/**
	 * @dataProvider dataGenerateCacheName 
	 * 
	 */
	public function testGenerateCacheName($configname, $context, $expected)
	{
		$cachename = YoudsFrameworkConfigCache::getCacheName($configname, $context);
		$expected = YoudsFrameworkConfig::get('core.cache_dir').DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.$expected; 
		$this->assertEquals($expected, $cachename);
	}
	
	public function dataGenerateCacheName()
	{
		return array(
			'slashes_null' => array(
				'foo/bar/hash#bang.xml',
				null,
				'hash_bang.xml_'.YoudsFrameworkConfig::get('core.environment').'__'.sha1('foo/bar/hash#bang.xml_'.YoudsFrameworkConfig::get('core.environment').'_').'.php',
			),
			'<contextname>' => array(
				'foo/bar/hash#bang.xml',
				'<contextname>',
				'hash_bang.xml_'.YoudsFrameworkConfig::get('core.environment').'__contextname__'.sha1('foo/bar/hash#bang.xml_'.YoudsFrameworkConfig::get('core.environment').'_<contextname>').'.php',
			),
		);
	}
	
	public function testCheckConfig()
	{
		$config = YoudsFrameworkConfig::get('core.config_dir').DIRECTORY_SEPARATOR.'autoload.xml';
		$config = YoudsFrameworkToolkit::normalizePath($config);
		$expected = YoudsFrameworkConfigCache::getCacheName($config);
		if(file_exists($expected)) {
			unlink($expected);
		}
		$cacheName = YoudsFrameworkConfigCache::checkConfig($config);
		$this->assertEquals($expected, $cacheName);
		$this->assertFileExists($cacheName);
	}
	
	public function testModified()
	{
		$config = YoudsFrameworkConfig::get('core.config_dir').DIRECTORY_SEPARATOR.'autoload.xml';
		$cacheName = YoudsFrameworkConfigCache::getCacheName($config);
		if(!file_exists($cacheName)) {
			$cacheName = YoudsFrameworkConfigCache::checkConfig($config);
		}	
		sleep(1);
		touch($config);
		clearstatcache(); // make shure we don't get fooled by the stat cache
		$this->assertTrue(YoudsFrameworkConfigCache::isModified($config, $cacheName), 'Failed asserting that the config file has been modified.');
	}

	public function testModifiedNonexistantFile()
	{
		$config = YoudsFrameworkConfig::get('core.config_dir').DIRECTORY_SEPARATOR.'autoload.xml';
		$cacheName = YoudsFrameworkConfigCache::getCacheName($config);
		if(file_exists($cacheName)) {
			unlink($cacheName);
		}	
		$this->assertTrue(YoudsFrameworkConfigCache::isModified($config, $cacheName), 'Failed asserting that the config file has been modified.');
	}
	
	public function testWriteCacheFile()
	{
		$expected = 'This is a config cache test.';
		$config = YoudsFrameworkConfig::get('core.config_dir').DIRECTORY_SEPARATOR.'foo.xml';
		$cacheName = YoudsFrameworkConfigCache::getCacheName($config);
		if(file_exists($cacheName)) {
			unlink($cacheName);
		}
		YoudsFrameworkConfigCache::writeCacheFile($config, $cacheName, $expected);
		$this->assertFileExists($cacheName);
		$content = file_get_contents($cacheName);
		$this->assertEquals($expected, $content);
		
		$append = "\nAnd a second line appended.";
		YoudsFrameworkConfigCache::writeCacheFile($config, $cacheName, $append, true);
		$content = file_get_contents($cacheName);
		$this->assertEquals($expected.$append, $content);
	}
	
	public function testload()
	{
		$this->assertFalse( defined('ConfigCacheImportTest_included') );
		YoudsFrameworkConfigCache::load(YoudsFrameworkConfig::get('core.config_dir') . '/tests/importtest.xml');
		$this->assertTrue( defined('ConfigCacheImportTest_included') );

		$GLOBALS["ConfigCacheImportTestOnce_included"] = false;
		YoudsFrameworkConfigCache::load(YoudsFrameworkConfig::get('core.config_dir') . '/tests/importtest_once.xml', true);
		$this->assertTrue( $GLOBALS["ConfigCacheImportTestOnce_included"] );

		$GLOBALS["ConfigCacheImportTestOnce_included"] = false;
		YoudsFrameworkConfigCache::load(YoudsFrameworkConfig::get('core.config_dir') . '/tests/importtest_once.xml', true);
		$this->assertFalse( $GLOBALS["ConfigCacheImportTestOnce_included"] );
	}

	
	public function testClear()
	{
		$cacheDir = YoudsFrameworkConfig::get('core.cache_dir').DIRECTORY_SEPARATOR.'config';
		YoudsFrameworkConfigCache::clear();
		$directory = new DirectoryIterator($cacheDir);
		foreach($directory as $item) {
			if($directory->current()->isDot()) {
				continue;
			}
			$this->fail(sprintf('Failed asserting that the cache dir "%1$s" is empty, it contains at least "%2$s"', $cacheDir, $item->getFileName()));
		}
	}
	
	/**
	 * @expectedException YoudsFrameworkUnreadableException
	 * this does not seem to work in isolation
	 */
	public function testAddNonexistantConfigHandlersFile()
	{
		$this->setExpectedException('YoudsFrameworkUnreadableException');
		YoudsFrameworkConfigCache::addConfigHandlersFile('does/not/exist');
	}
	
	public function testAddConfigHandlersFile()
	{
		$config = YoudsFrameworkConfig::get('core.module_dir').'/Default/config/config_handlers.xml';
		YoudsFrameworkTestingConfigCache::addConfigHandlersFile($config);
		$this->assertTrue(YoudsFrameworkTestingConfigCache::handlersDirty(), 'Failed asserting that the handlersDirty flag is set after adding a config handlers file.');
		$handlerFiles = YoudsFrameworkTestingConfigCache::getHandlerFiles();
		$this->assertFalse($handlerFiles[$config], sprintf('Failed asserting that the config file "%1$s" has not been loaded.', $config));
	}
	
	public function testCallHandlers()
	{
		$this->markTestIncomplete();
	}
	
	public function testSetupHandlers()
	{	
		// this is not possible to test with the youds unit tests as this needs
		// a really clean env with no framework bootstrapped. Need to think about that.
		//$this->markTestIncomplete();
		YoudsFrameworkTestingConfigCache::resetHandlers();
		$this->assertEquals(null, YoudsFrameworkTestingConfigCache::getHandlers());
		YoudsFrameworkTestingConfigCache::setUpHandlers();
		$handlers = YoudsFrameworkTestingConfigCache::getHandlers();
		$this->assertNotEquals(null, $handlers);
	}
	
	public function testGetHandlerInfo()
	{
		$handlerInfo = YoudsFrameworkTestingConfigCache::getHandlerInfo('notregistered');
		$this->assertEquals(null, $handlerInfo);
		
		$expected = array(
			'class' => 'YoudsFrameworkReturnArrayConfigHandler',
			'parameters' => array(),
			'transformations' => array(
				'single' => array('confighandler-testing.xsl',),
				'compilation' => array(),
			),
			'validations' => array(
				'single' => array(
					'transformations_before' => array(
						'relax_ng' => array(),
						'schematron' => array(),
						'xml_schema' => array(),
					),
					'transformations_after' => array(
						'relax_ng' => array('confighandler-testing.rng'),
						'schematron' => array(),
						'xml_schema' => array(),
					),
				),
				'compilation' => array(
					'transformations_before' => array(
						'relax_ng' => array(),
						'schematron' => array(),
						'xml_schema' => array(),
					),
					'transformations_after' => array(
						'relax_ng' => array(),
						'schematron' => array(),
						'xml_schema' => array(),
					),
				),
			),
		);
		$handlerInfo = YoudsFrameworkTestingConfigCache::getHandlerInfo('confighandler-testing');
		$this->assertEquals($expected, $handlerInfo);
	}
	
	public function testTicket931()
	{
		$config = 'project/foo.xml';
		$context = 'with/slash';
		$cachename = YoudsFrameworkConfigCache::getCacheName($config, $context);
		
		$expected = YoudsFrameworkConfig::get('core.cache_dir').DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR;
		$expected .= 'foo.xml';
		$expected .= '_'.preg_replace('/[^\w-_]/i', '_', YoudsFrameworkConfig::get('core.environment'));
		$expected .= '_'.preg_replace('/[^\w-_]/i', '_', $context).'_';
		$expected .= sha1($config.'_'.YoudsFrameworkConfig::get('core.environment').'_'.$context).'.php'; 
		
		$this->assertEquals($expected, $cachename);
	}
	
	public function testTicket932()
	{
		$config1 = 'project/foo.xml';
		$config2 = 'project_foo.xml';
		
		$this->assertNotEquals(YoudsFrameworkConfigCache::getCacheName($config1), YoudsFrameworkConfigCache::getCacheName($config2));
	}
	
	public function testTicket941()
	{
		if(!extension_loaded('xdebug')) {
			$this->markTestSkipped('This test check for an infinite loop, you need xdebug as protection.');
		}
		
		$config = YoudsFrameworkConfig::get('core.module_dir').'/Default/config/config_handlers.xml';
		YoudsFrameworkTestingConfigCache::addConfigHandlersFile($config);
		YoudsFrameworkConfigCache::checkConfig(YoudsFrameworkConfig::get('core.module_dir').'/Default/config/autoload.xml');
	}
}
