<?php

class Ticket1051Test extends YoudsFrameworkPhpUnitTestCase
{
	protected $routing;
	protected $parameters = array('enabled' => true);
	
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
	
	public function setUp()
	{
		// otherwise, the full URI wouldn't work
		$_SERVER['REQUEST_URI'] = '/index.php';
		$_SERVER['SCRIPT_NAME'] = '/index.php';
		
		$this->routing = new YoudsFrameworkTestingWebRouting();
		$this->routing->initialize(YoudsFrameworkContext::getInstance(null), $this->parameters);
		$this->routing->startup();
	}
	
	public function testCallbackOnGenerateCanSetOptions()
	{
		$this->assertEquals('http://www.youds.com/index.php/ticket_1051', $this->routing->gen('ticket_1051'));
	}
}


?>
