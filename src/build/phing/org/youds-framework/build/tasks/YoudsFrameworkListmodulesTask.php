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

require_once(__DIR__ . '/YoudsFrameworkTask.php');

/**
 * Lists all modules in an YoudsFramework project.
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
class YoudsFrameworkListmodulesTask extends YoudsFrameworkTask
{
	protected $property = null;
	protected $path = null;
	
	/**
	 * Sets the property that this task will modify.
	 *
	 * @param      string The property to modify.
	 */
	public function setProperty($property)
	{
		$this->property = $property;
	}
	
	/**
	 * Sets the path to the project directory from which this task will read.
	 *
	 * @param      PhingFile Path to the project directory.
	 */
	public function setPath(PhingFile $path)
	{
		$this->path = $path;
	}
	
	/**
	 * Executes this task.
	 */
	public function main()
	{
		if($this->property === null) {
			throw new BuildException('The property attribute must be specified');
		}
		if($this->path === null) {
			throw new BuildException('The path attribute must be specified');
		}
		
		$check = new YoudsFrameworkProjectFilesystemCheck();
		$check->setAppDirectory($this->project->getProperty('project.directory.app'));
		$check->setPubDirectory($this->project->getProperty('project.directory.pub'));
		
		$check->setPath($this->path->getAbsolutePath());
		if(!$check->check()) {
			throw new BuildException('The path attribute must be a valid project base directory');
		}
		
		$modules = array();
		foreach(new DirectoryIterator($this->path->getAbsolutePath() . DIRECTORY_SEPARATOR . $this->project->getProperty('project.directory.app.modules')) as $file) {
			if($file->isDot()) {
				continue;
			}
			
			$check = new YoudsFrameworkModuleFilesystemCheck();
			$check->setConfigDirectory($this->project->getProperty('module.config.directory'));
			
			$check->setPath($file->getPathname());
			if($check->check()) {
				$modules[] = (string)$file;
			}
		}
		
		$list = new YoudsFrameworkArraytostringTransform();
		$list->setInput($modules);
		$list->setDelimiter(' ');
		
		$this->project->setUserProperty($this->property, $list->transform());
	}
}

?>
