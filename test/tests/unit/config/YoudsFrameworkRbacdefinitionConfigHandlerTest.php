<?php
require_once(__DIR__ . '/ConfigHandlerTestBase.php');

class YoudsFrameworkRbacDefinitionConfigHandlerTest extends ConfigHandlerTestBase
{
	public function testHandler()
	{
		$document = $this->parseConfiguration(
			YoudsFrameworkConfig::get('core.config_dir') . '/tests/rbac_definitions.xml',
			YoudsFrameworkConfig::get('core.youds_dir') . '/config/xsl/rbac_definitions.xsl'
		);
		
		$handler = new YoudsFrameworkRbacDefinitionConfigHandler();
		$cfg = $this->includeCode($handler->execute($document));
		
		$expected = array(
			'administrator' => 
			array (
				'parent' => NULL,
				'permissions' => 
				array (
					'admin',
				),
			),
			'photographer' => 
			array (
				'parent' => 'member',
				'permissions' => 
				array (
					0 => 'photos.edit-own',
					1 => 'photos.add',
					2 => 'photos.lock',
				),
			),
			'photomoderator' => 
			array (
				'parent' => 'member',
				'permissions' => 
				array (
					0 => 'photos.edit',
					1 => 'photos.delete',
					2 => 'photos.unlock',
				),
			),
			'member' => 
			array (
				'parent' => 'guest',
				'permissions' => 
				array (
					0 => 'photos.comments.view',
					1 => 'photos.comments.add',
					2 => 'photos.rate',
					3 => 'lightbox',
					4 => 'tags.suggest',
				),
			),
			'guest' => 
			array (
				'parent' => NULL,
				'permissions' => 
				array (
					0 => 'photos.list',
					1 => 'photos.detail',
				),
			),
		);
		$this->assertEquals($expected, $cfg);
	}
}
