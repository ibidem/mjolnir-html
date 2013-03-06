<?php return array
	(
		'allowed_extensions' => ['jpeg', 'jpg', 'png'],
		'max_size' => 1048576, # 1024 * 1024,
	
		// video processing (seconds)
		'video.upload.timeout' => 3600, // 1 hour
		'video.formats' => [ 'mp4', 'webm', 'flv' ],
	);