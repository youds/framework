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
 * Implements a default adapter for listening for target events.
 *
 * @package    youds
 * @subpackage build
 *
 * @author     Noah Fontes <noah.fontes@bitextender.com>
 * @copyright  Authors
 * @copyright  The YoudsFramework Project
 *
 * @since      1.0.0
 *
 * @version    $Id$
 */
class YoudsFrameworkPhingTargetAdapter implements YoudsFrameworkIPhingTargetListener
{
	/**
	 * Invoked when a target is entered.
	 *
	 * @param      YoudsFrameworkPhingTargetEvent The raised event.
	 *
	 * @author     Noah Fontes <noah.fontes@bitextender.com>
	 * @since      1.0.0
	 */
	public function targetEntered(YoudsFrameworkPhingTargetEvent $event)
	{
		
	}
	
	/**
	 * Invoked when a target is left.
	 *
	 * @param      YoudsFrameworkPhingTargetEvent The raised event.
	 *
	 * @author     Noah Fontes <noah.fontes@bitextender.com>
	 * @since      1.0.0
	 */
	public function targetLeft(YoudsFrameworkPhingTargetEvent $event)
	{
		
	}
}

?>
