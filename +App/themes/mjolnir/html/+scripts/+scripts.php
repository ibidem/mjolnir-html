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
						'+lib/qq-uploader/fileuploader',
						'shadows/qq-uploader',
					),
			),

	); # config
