<?php

class Ticket958Test extends YoudsFrameworkUnitTestCase
{
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testTicket958()
	{
		$tm = $this->getContext()->getTranslationManager();
		$tz = YoudsFrameworkTimeZone::createCustomTimeZone($tm, '+01:00');
	}
}

?>
