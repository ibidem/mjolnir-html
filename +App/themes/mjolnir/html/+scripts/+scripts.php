<?php require 'library/extras.php';

return array
	(
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
						'+vendor/qq-uploader/client/fileuploader',
						'shadows/qq-uploader',
					),
			),

	); # config
