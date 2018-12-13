<?php

class YoudsFrameworkExecutionContainerTest extends YoudsFrameworkUnitTestCase
{
	
	public function testSimpleActionWithoutArguments()
	{
		$container = $this->getContext()->getController()->createExecutionContainer('ControllerTests', 'SimpleAction');
		$response = $container->execute();
		
	}
}
