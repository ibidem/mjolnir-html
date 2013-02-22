<?php return array
	(
		'mjolnir:pager/page-x-of-y' => function ($in)
			{
				return "Pagina {$in['currentpage']} din {$in['pagecount']}";
			},
					
		'mjolnir:pager/entries-x-to-y' => function ($in)
			{
				return "Intrările {$in['number']} la {$in['number_end']}.";
			},
		
		'mjolnir:pager/entries-x-to-y-with-bookmark-at-entry' => function ($in)
			{
				return "Intrările {$in['number']} la {$in['number_end']}. Semn la intrarea #{$in['bookmark']}.";
			},
					
		'page-x' => function ($in)
			{
				return "Pagina {$in['number']}.";
			},
					
		'page-x-bookmark-at-entry' => function ($in)
			{
				return "Pagina {$in['number']}. Semn la intrarea #{$in['bookmark']}.";
			},
					
		'mjolnir:pager/goto' => 'Sari la',
					
		'mjolnir:pager/go' => 'Reactualizează',
		
	);
