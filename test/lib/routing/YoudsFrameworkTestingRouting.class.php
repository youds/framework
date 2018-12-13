<?php

// +---------------------------------------------------------------------------+
// | This file is part of the YoudsFramework package.                                   |
// | Copyright (c) 2005-2011 the YoudsFramework Project.                                |
// |                                                                           |
// | For the full copyright and license information, please view the LICENSE   |
// | file that was distributed with this source code. You can also view the    |
// | LICENSE file online at http://www.youds.com/LICENSE.txt                   |
// |   vi: set noexpandtab:                                                    |
// |   Local Variables:                                                        |
// |   indent-tabs-mode: t                                                     |
// |   End:                                                                    |
// +---------------------------------------------------------------------------+

/**
 * YoudsFrameworkTestingRouting allows access to some internal routing properties and
 * extends the abtract base class to make it testable.
 *
 * @package    youds
 * @subpackage routing
 *
 * @author     Felix Gilcher <felix.gilcher@bitextender.com>
 * @copyright  Authors
 * @copyright  The YoudsFramework Project
 *
 * @since      1.0.0
 *
 * @version    $Id$
 */
class YoudsFrameworkTestingRouting extends YoudsFrameworkRouting
{
	public function setInput($input)
	{
		$this->input = $input;
	}
	
	public function setRoutingSource($name, $data, $type = null)
	{
		if(null === $type) {
			$type = 'YoudsFrameworkRoutingArraySource';
		}
		$this->sources[$name] = new $type($data);
	}
	
	public function parseRouteString($str)
	{
		return parent::parseRouteString($str);
	}
}

?>
