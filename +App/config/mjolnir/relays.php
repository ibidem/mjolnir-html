<?php return array
	(

	// ---- Mockup ------------------------------------------------------------

		'mjolnir:html/qq-uploader.route' => array
			(
				'matcher' => \app\URLRoute::instance()
					->urlpattern('qq-uploader/<action>', ['action' => 'upload']),
				'enabled' => false,
			// MVC
				'controller' => '\app\Controller_MjolnirQQUploader',
				'action' => 'json_upload',
				'prefix' => 'json_',
			),
	
	);