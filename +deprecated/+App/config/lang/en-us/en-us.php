<?php return array
	(
		'Entries :number to :number_end.' => function ($in) 
			{
				return \strtr('Entries :number to :number_end.', $in);
			},
	);