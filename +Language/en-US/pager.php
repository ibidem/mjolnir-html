<?php return
[
	
'mjolnir:html/pager/page-x-of-y' => function ($in)
	{
		return "Page {$in['currentpage']} of {$in['pagecount']}";
	},

'mjolnir:html/pager/entries-x-to-y' => function ($in)
	{
		return "Entries {$in['number']} to {$in['number_end']}.";
	},

'mjolnir:html/pager/entries-x-to-y-with-bookmark-at-entry' => function ($in)
	{
		return "Entries {$in['number']} to {$in['number_end']}. Bookmark at entry #{$in['bookmark']}.";
	},

'mjolnir:html/pager/page-x' => function ($in)
	{
		return "Page {$in['number']}.";
	},

'mjolnir:html/pager/page-x-bookmark-at-entry' => function ($in)
	{
		return "Page {$in['number']}. Bookmark at entry #{$in['bookmark']}.";
	},

'mjolnir:html/pager/goto' => 'Goto',

'mjolnir:html/pager/go' => 'Go',
		
];