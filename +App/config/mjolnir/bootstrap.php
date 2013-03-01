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
					),
			),
		
	); # config
