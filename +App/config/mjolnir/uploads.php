<?php return array
	(
		'image.formats' => array
			(
				'jpeg' => 'image/jpeg',
				'jpg' => 'image/jpeg',
				'png' => 'image/png'
			),

		// video format uploaded files will be converted to,
		// see: mjolnir/video-converter configuration for conversion settings
		'video.formats' => array
			(
				'mp4' => 'video/mp4',
				'ogv' => 'video/ogg',
				'webm' => 'video/webm',
				'flv' => 'video/flv',
			),

		// video formats allowed for upload
		'video.formats.upload' => array
			(
				'mp4' => true,
				'ogv' => true,
				'webm' => true,
				'mov' => true,
			),

		// max file size of uploaded files
		'upload.limit' => 50, # Megabytes

		// video processing (seconds)
		'video.timeout' => 3600, // 1 hours

	); # config
