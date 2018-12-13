<?php
require_once(__DIR__ . '/ConfigHandlerTestBase.php');

class CHCHTestHandler extends YoudsFrameworkConfigHandler
{
	public	$validationFile,
					$parser,
					$parameters;

	public function initialize($vf = null, $parser = null, $params = array())
	{
		$this->validationFile = $vf;
		$this->parser = $parser;
		$this->parameters = $params;
	}

	public function execute($config, $context = null)
	{
	}
}

class YoudsFrameworkConfigHandlersConfigHandlerTest extends ConfigHandlerTestBase
{

	public function testConfigHandlersConfigHandler()
	{
		$hf = YoudsFrameworkToolkit::normalizePath(YoudsFrameworkConfig::get('core.config_dir') . '/routing.xml');
		$CHCH = new YoudsFrameworkConfigHandlersConfigHandler();

		$document = $this->parseConfiguration(
			YoudsFrameworkConfig::get('core.config_dir') . '/tests/config_handlers.xml',
			YoudsFrameworkConfig::get('core.youds_dir') . '/config/xsl/config_handlers.xsl'
		);

		$file = $this->getIncludeFile($CHCH->execute($document));
		$handlers = include($file);
		unlink($file);

		$this->assertCount(1, $handlers);
		$this->assertTrue(isset($handlers[$hf]));
		$this->assertSame('CHCHTestHandler', $handlers[$hf]['class']);
		$this->assertSame(YoudsFrameworkConfig::get('core.youds_dir') . '/config/xsd/routing.xsd', $handlers[$hf]['validations']['single']['transformations_after']['xml_schema'][0]);
		$this->assertSame(array('foo' => 'bar', 'dir' => YoudsFrameworkConfig::get('core.youds_dir')) , $handlers[$hf]['parameters']);
	}

}
?>
