<?php return array
	(
		'mjolnir:pager/page-x-of-y' => function ($in)
			{
				return "Page {$in['currentpage']} of {$in['pagecount']}";
			},
					
		'mjolnir:pager/entries-x-to-y' => function ($in)
			{
				return "Entries {$in['number']} to {$in['number_end']}.";
			},
		
		'mjolnir:pager/entries-x-to-y-with-bookmark-at-entry' => function ($in)
			{
				return "Entries {$in['number']} to {$in['number_end']}. Bookmark at entry #{$in['bookmark']}.";
			},
					
		'page-x' => function ($in)
			{
				return "Page {$in['number']}.";
			},
					
		'page-x-bookmark-at-entry' => function ($in)
			{
				return "Page {$in['number']}. Bookmark at entry #{$in['bookmark']}.";
			},
					
		'mjolnir:pager/goto' => 'Goto',
					
		'mjolnir:pager/go' => 'Go',
		
	);
