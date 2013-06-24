<?php require 'library/extras.php';

return array
	(
		'version' => '1.0.0',
		'root' => 'root/',
		'sources' => 'src/',
		'mode' => 'targeted',

	# complete mode

		'complete-mapping' => [ ],

	# targeted mode

		'targeted-common' => [ ],

		'targeted-mapping' => array
			(
				'qq-uploader' => array
					(
						'+lib/qq-uploader/fileuploader',
						'shadows/qq-uploader',
					),
			),

	); # config
