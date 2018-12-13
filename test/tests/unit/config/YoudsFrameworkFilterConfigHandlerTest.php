<?php
require_once(__DIR__ . '/ConfigHandlerTestBase.php');

class FCHTestFilter1 implements YoudsFrameworkIFilter
{
	public $context;
	public $params;

	public function initialize(YoudsFrameworkContext $ctx, array $params = array())
	{
		$this->context = $ctx;
		$this->params = $params;
	}

	public function executeOnce(YoudsFrameworkFilterChain $filterChain, YoudsFrameworkExecutionContainer $container) {}
	public function execute(YoudsFrameworkFilterChain $filterChain, YoudsFrameworkExecutionContainer $container) {}
	public final function getContext() {}
}

class FCHTestFilter2 extends FCHTestFilter1
{
}

class YoudsFrameworkFilterConfigHandlerTest extends ConfigHandlerTestBase
{
	protected $context;

	public function setUp()
	{
		$this->context = $this->getContext();
	}

	public function testFilterConfigHandler()
	{
		$ctx = $this->getContext();
		
		$FCH = new YoudsFrameworkFilterConfigHandler();
		
		$document = $this->parseConfiguration(
			YoudsFrameworkConfig::get('core.config_dir') . '/tests/filters.xml',
			YoudsFrameworkConfig::get('core.youds_dir') . '/config/xsl/filters.xsl'
		);

		$filters = array();

		$file = $this->getIncludeFile($FCH->execute($document));
		include($file);
		unlink($file);

		$this->assertCount(2, $filters);

		$this->assertInstanceOf('FCHTestFilter1', $filters['filter1']);
		$this->assertSame(array('comment' => true), $filters['filter1']->params);
		$this->assertSame($ctx, $filters['filter1']->context);

		$this->assertInstanceOf('FCHTestFilter2', $filters['filter2']);
		$this->assertSame(array(), $filters['filter2']->params);
		$this->assertSame($ctx, $filters['filter2']->context);
	}
}
?>
