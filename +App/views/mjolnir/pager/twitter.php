<?
	namespace app;

	/**
	 * This is a twitter bootstrap friendly version of the pager.
	 * It can also be considred an extremely simplified version.
	 *
	 * While not standard, bookmark functionality is maintained.
	 *
	 * [!!] Class structure is not compatible and conforms to Twitter Pagination
	 * [!!] Not all features of the default are supported.
	 */
?>

<div class="pagination" role="navigation">

	<ul>

		<? if ($currentpage > 1): ?>
			<li>
				<a href="<?= $baseurl.$query ?><?= $querykey ?>=<?= $currentpage - 1 ?>" rel="prev"><span><?= $prev ?></span></a>
			</li>
		<? else: # current page is 1 ?>
			<li class="disabled">
				<a><span><?= $prev ?></span></a>
			</li>
		<? endif; ?>

<? # ---- Pager ----------------------------------------------------------- # ?>

	<?
		#
		# In the case where 1 item is displayed at a time (like some cases of
		# pictures in a gallery) the page count can go over a million. It's
		# very inneficient to iterate 1mil+ times so we pre-compute the
		# targets.
		#
		
		$targets = [];
		// inject first pages
		for ($i = 1; $i <= $startpoint; ++$i) $targets[] = $i;
		// inject last pages
		for ($i = $pagecount; $i > $endpoint; --$i) $targets[] = $i;
		// inject pages near current
		for ($i = $currentpage - $pagediff + 1; $i <= $currentpage + $pagediff - 1; ++$i):
			$targets[] = $i;
		endfor;
		// inject other targets
		$targets[] = $startellipsis;
		$targets[] = $endellipsis;
		$targets[] = $bookmark_page;
		// tidy up everything and guarantee integrity
		$targets = array_unique($targets);
		\sort($targets);

		foreach ($targets as $i):
			if (1 <= $i && $i <= $pagecount):

				// compute title
				if ($pagelimit > 1):
					if ($order === 'asc'):
						$number = ($i * $pagelimit - $pagelimit + 1);
						$number_end = $i * $pagelimit > $totalitems ? $totalitems : $i * $pagelimit;
					else: # Pager::ascending
						$number = ($pagecount - $i + 1) * $pagelimit > $totalitems ? $totalitems : ($pagecount - $i + 1) * $pagelimit;
						$number_end = ($pagecount - $i + 1) * $pagelimit - $pagelimit + 1;
					endif;
					$title = "{$langprefix}entries-x-to-y";
					if ($i == $bookmark_page):
						$title .= "-with-bookmark-at-entry";
					endif;
				else: # single entry pages
					$number = $i;
					if ($i == $bookmark_page):
						$title = "{$langprefix}page-x-bookmark-at-entry";
					else:
						$title = "{$langprefix}page-x";
					endif;
				endif;

				if ($startellipsis == $i || $endellipsis == $i):

					if ($i == $bookmark_page):
						?><li class="bookmarked"><?
							?><a href="<?= $baseurl.$query ?><?= $querykey ?>=<?= $i ?><?= '#'.$bookmark_anchor ?>" <?
							?>title="<?= Lang::key($title, ['number' => $number, 'number_end' => $number_end, 'bookmark' => $bookmark_entry]) ?>"><?= $i ?></a><?
						?></li><?
					endif;
					?><li class="ellipsis"><a href="#">&#8230;</a></li><?

				elseif ($i == $bookmark_page):

					?><li class="bookmarked"><?
						?><a href="<?= $baseurl.$query ?><?= $querykey ?>=<?= $i ?><?= '#'.$bookmark_anchor ?>" <?
						?>title="<?= Lang::key($title, ['number' => $number, 'number_end' => $number_end, 'bookmark' => $bookmark_entry]) ?>"><?= $i ?></a><?
					?></li><?

				else: # standard page

					// check if current page
					if ($i == $currentpage):
						?><li class="active<?= ($bookmark_page == $i ? ' bookmarked' : '') ?>"><?
							?><a href="<?= $baseurl.$query ?><?= $querykey ?>=<?= $i ?><?= ($bookmark_page == $i ? '#'.$bookmark_anchor : '') ?>" <?
							?>title="<?= Lang::key($title, ['number' => $number, 'number_end' => $number_end, 'bookmark' => $bookmark_entry]) ?>"><?= $i ?></a><?
						?></li><?
					else: # $i != $currentpage
						?><li class="<?= ($bookmark_page == $i ? ' bookmarked' : '') ?>"><?
							?><a href="<?= $baseurl.$query ?><?= $querykey ?>=<?= $i ?><?= ($bookmark_page == $i ? '#'.$bookmark_anchor : '') ?>" <?
							?>title="<?= Lang::key($title, ['number' => $number, 'number_end' => $number_end, 'bookmark' => $bookmark_entry]) ?>"><?= $i ?></a><?
						?></li><?
					endif;

				endif;

			endif;
		endforeach; # targets
	?>

<? # ---- /Pager ---------------------------------------------------------- # ?>

		<? if ($currentpage < $pagecount && $currentpage >= 1): ?>
			<li>
				<a href="<?= $baseurl.$query ?><?= $querykey ?>=<?= $currentpage + 1 ?>" rel="next"><span><?= $next ?></span></a>
			</li>
		<? else: # last page ?>
			<li class="disabled">
				<a><span><?= $next ?></span></a>
			</li>
		<? endif; ?>

	</ul>

</div>
