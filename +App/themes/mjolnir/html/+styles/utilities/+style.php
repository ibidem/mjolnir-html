<?php require 'library/extras.php';

return array
	(
		'version' => '1.0.0',
		'root' => 'root/',
		'sources' => 'src/',
		'mode' => 'complete',

	# Complete mode

		'complete-mapping' => [ ],

	# Targetted mode

		// common files used in targeted mapping
		'targeted-common' => [ ],

		// mapping targets to files; if a target is not mapped it won't have
		// any style associated
		'targeted-mapping' => array
			(
				'qq-uploader' => array
					(
						'+lib/qq-uploader/fileuploader'
					),
			),

	); # config
