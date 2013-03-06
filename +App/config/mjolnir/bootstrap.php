<?php return array
	(
		'mjolnir' => array
			(
				'routes' => array
					(
						'thumbnail' => \app\URL::href
							(
								'mjolnir:thumbnail.route', 
								[
									'image' => ':image', 
									'width' => ':width', 
									'height' => ':height'
								]
							),
						'video' => \app\URL::href
							(
								'mjolnir:video.route', 
								[
									'video' => ':video', 
								]
							),
					),
				'uploads' => array
					(
						'video' => array
							(
								'formats' => \app\CFS::config('mjolnir/uploads')['video.formats'],
							),
					),
			),
		
	); # config
