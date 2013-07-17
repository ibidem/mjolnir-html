<?php return array
	(

	// ---- Mockup ------------------------------------------------------------

		'mjolnir:html/qq-uploader.route' => array
			(
				'matcher' => \app\URLRoute::instance()
					->urlpattern('qq-uploader/<action>', ['action' => '(upload_image|upload_video)']),
				'enabled' => false,
			// MVC
				'controller' => '\app\Controller_MjolnirQQUploader',
				'action' => 'json_upload_image',
				'prefix' => 'json_',
			),

	);