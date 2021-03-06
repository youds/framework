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
 * YoudsFrameworkJsonValidator verifies if a parameter contains a value that is valid
 * JSON and optionally exports the decoded value.
 *
 * @package    youds
 * @subpackage validator
 *
 * @author     Thomas Bachem <mail@thomasbachem.com>
 * @copyright  Authors
 * @copyright  The YoudsFramework Project
 *
 * @since      1.1.0
 *
 * @version    $Id$
 */
class YoudsFrameworkJsonValidator extends YoudsFrameworkValidator
{
	protected $jsonErrors = array(
		'depth',
		'state_mismatch',
		'ctrl_char',
		'syntax',
		'utf8',
		'recursion',
		'inf_or_nan',
		'unsupported_type',
	);
	
	/**
	 * Validates the input.
	 * 
	 * @return     bool The input is valid JSON.
	 * 
	 * @author     Thomas Bachem <mail@thomasbachem.com>
	 * @since      1.1.0
	 */
	protected function validate()
	{
		$json = $this->getData($this->getArgument());
		
		$ret = json_decode($json, $this->getParameter('assoc', true));
		
		if($json !== '' && $ret === null) {
			$jsonError = json_last_error();
			foreach($this->jsonErrors as $errorName) {
				$constName = 'JSON_ERROR_' . strtoupper($errorName);
				if(defined($constName) && constant($constName) === $jsonError) {
					$this->throwError($errorName);
					return false;
				}
			}
			
			$this->throwError();
			return false;
		} else {
			$this->export($ret);
			return true;
		}
	}
}

?>
