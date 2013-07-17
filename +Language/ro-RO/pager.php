<?php return
[

'mjolnir:html/pager/page-x-of-y' => function ($in)
	{
		return "Pagina {$in['currentpage']} din {$in['pagecount']}";
	},

'mjolnir:html/pager/entries-x-to-y' => function ($in)
	{
		return "Intrările {$in['number']} la {$in['number_end']}.";
	},

'mjolnir:html/pager/entries-x-to-y-with-bookmark-at-entry' => function ($in)
	{
		return "Intrările {$in['number']} la {$in['number_end']}. Semn la intrarea #{$in['bookmark']}.";
	},

'mjolnir:html/pager/page-x' => function ($in)
	{
		return "Pagina {$in['number']}.";
	},

'mjolnir:html/pager/page-x-bookmark-at-entry' => function ($in)
	{
		return "Pagina {$in['number']}. Semn la intrarea #{$in['bookmark']}.";
	},

'mjolnir:html/pager/goto' => 'Sari la',

'mjolnir:html/pager/go' => 'Reactualizează',

];
