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
 * YoudsFrameworkTestingConfigCache allows access to some internal config cache properties 
 *
 * @package    youds
 * @subpackage config
 *
 * @author     Felix Gilcher <felix.gilcher@bitextender.com>
 * @copyright  Authors
 * @copyright  The YoudsFramework Project
 *
 * @since      1.0.0
 *
 * @version    $Id$
 */
class YoudsFrameworkTestingConfigCache extends YoudsFrameworkConfigCache
{
	public static function handlersDirty()
	{
		return self::$handlersDirty;
	}
	
	public static function getHandlerFiles()
	{
		return self::$handlerFiles;
	}
	
	public static function getHandlers()
	{
		return self::$handlers;
	}

	public static function resetHandlers()
	{
		self::$handlers = null;
	}

	public static function setupHandlers()
	{
		parent::setupHandlers();
	}

	public static function getHandlerInfo($name)
	{
		return parent::getHandlerInfo($name);
	}

	public static function callHandler($name, $config, $cache, $context, array $handlerInfo = null)
	{
		parent::callHandler($name, $config, $cache, $context, $handlerInfo);
	}
}


?>
