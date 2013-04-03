<?php namespace app;

$max_upload = (int) \ini_get('upload_max_filesize');
$max_post = (int) \ini_get('post_max_size');
$memory_limit = (int) \ini_get('memory_limit');
$current_limit = \min($max_upload, $max_post, $memory_limit);
$limit = CFS::config('mjolnir/uploads')['upload.limit'];

return array
	(
		'mjolnir\html' => array
			(
				 "min(upload_max_filesize, post_max_size, memory_limit) = {$current_limit}M >= {$limit}M" => function () use ($limit, $current_limit)
					{
						if ($current_limit >= $limit)
						{
							return 'satisfied';
						}

						return 'failed';
					},
					
				"memory limit = $memory_limit >= upload limit * 5" => function () use ($limit, $memory_limit)
					{
						if ($memory_limit >= $limit * 5)
						{
							return 'satisfied';
						}
						
						return 'failed';
					},
							
				"upload limit = {$limit}M > 3M" => function () use ($limit)
					{
						if ($limit > 3)
						{
							return 'satisfied';
						}
					
						return 'failed';
					},
			),
	);
