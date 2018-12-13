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

class YoudsFrameworkVersionTask extends Task
{
	public function main()
	{
		$youdsPath = realpath(getcwd() . '/src/youds.php');
		
		if(!$youdsPath && !file_exists($youdsPath)) {
			throw new BuildException('YoudsFramework not found.');
		}

		require_once($youdsPath);
		
		$this->project->setUserProperty('youds.version', YoudsFrameworkConfig::get('youds.version'));
		$this->project->setUserProperty('youds.pear.version', sprintf("%d.%d.%d%s", 
			YoudsFrameworkConfig::get('youds.major_version'), 
			YoudsFrameworkConfig::get('youds.minor_version'), 
			YoudsFrameworkConfig::get('youds.micro_version'), 
			YoudsFrameworkConfig::has('youds.status') ? YoudsFrameworkConfig::get('youds.status') : ''
		));
		
		$status = YoudsFrameworkConfig::get('youds.status');
		
		if($status == 'dev') {
			$status = 'devel';
		} elseif(strpos($status, 'alpha') !== false) {
			$status = 'alpha';
		} elseif(strpos($status, 'beta') !== false) {
			$status = 'beta';
		} elseif(strpos($status, 'RC') !== false) {
			$status = 'beta';
		} else {
			$status = 'stable';
		}
		
		$this->project->setUserProperty('youds.status', $status);
	}
}

?>
