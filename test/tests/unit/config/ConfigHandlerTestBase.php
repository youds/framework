<?php

abstract class ConfigHandlerTestBase extends YoudsFrameworkUnitTestCase
{
	protected function getIncludeFile($code)
	{
		$file = tempnam(YoudsFrameworkConfig::get('core.cache_dir'), 'cht');
		file_put_contents($file, $code);
		return $file;
	}

	protected function includeCode($code, $env = array())
	{
		extract($env);
		$file = $this->getIncludeFile($code);
		$ret = include($file);
		unlink($file);
		return $ret;
	}
	
	protected function parseConfiguration($configFile, $xslFile = null, $environment = null) {
		return YoudsFrameworkXmlConfigParser::run(
			$configFile,
			$environment ? $environment : YoudsFrameworkConfig::get('core.environment'),
			'',
			array(
				YoudsFrameworkXmlConfigParser::STAGE_SINGLE => $xslFile ? array($xslFile) : array(),
				YoudsFrameworkXmlConfigParser::STAGE_COMPILATION => array(),
			),
			array(
				YoudsFrameworkXmlConfigParser::STAGE_SINGLE => array(
					YoudsFrameworkXmlConfigParser::STEP_TRANSFORMATIONS_BEFORE => array(),
					YoudsFrameworkXmlConfigParser::STEP_TRANSFORMATIONS_AFTER => array(),
				),
				YoudsFrameworkXmlConfigParser::STAGE_COMPILATION => array(
					YoudsFrameworkXmlConfigParser::STEP_TRANSFORMATIONS_BEFORE => array(),
					YoudsFrameworkXmlConfigParser::STEP_TRANSFORMATIONS_AFTER => array()
				),
			)
		);
		
	}
}
