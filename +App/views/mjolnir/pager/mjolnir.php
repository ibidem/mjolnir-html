<?
	namespace app;
?>
<div class="pager" role="navigation">

	<? if ($pagecount > 0 && $pageindex): ?>
		<div class="pager-currentnav">
			<?= Lang::key
				(
					"{$langprefix}page-x-of-y",
					[
						'currentpage' => $currentpage != null ? $currentpage : 1,
						'pagecount'   => $pagecount
					]
				) ?>
		</div>
	<? endif; ?>

	<div class="pager-pagenav">

		<? if ($currentpage != 1): ?>
			<div class="previous-page enabled">
				<a href="<?= $baseurl.$query ?><?= $querykey ?>=<?= $currentpage - 1 ?>" rel="prev"><span><?= $prev ?></span></a>
			</div>
		<? else: # current page is 1 ?>
			<div class="previous-page disabled">
				<a><span><?= $prev ?></span></a>
			</div>
		<? endif; ?>

<? # ---- Pager ----------------------------------------------------------- # ?>

		<?
		/* [!!] extremly sensitive to whitespace! html doesn't completely ignore
			* whitespace, and even 1 white space can thorw things off by a few
			* pixels when working on a very tight pager design.
			*/
		?>

		<? if ($pagecount >= 1): ?>
		<span class="pager<?= ($ruler ? ' has-ruler' : '') ?>">

			<? if ( ! empty($currentpage)): ?>
				<span class="ruler">
			<? endif ?>

			<?
			/* In the case where 1 item is displayed at a time (like some cases of
				* pictures in a gallery) the page count can go over a million. It's
				* very inneficient to iterate 1mil+ times so we pre-compute the
				* targets.
				*/
			$targets = array();
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
							$number_end = $i * $pagelimit > $itemcount ? $itemcount : $i * $pagelimit;
						else: # Pager::ascending
							$number = ($pagecount - $i + 1) * $pagelimit > $itemcount ? $itemcount : ($pagecount - $i + 1) * $pagelimit;
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
							?><span class="target pager-page"><?
								?><a href="<?= $baseurl.$query ?><?= $querykey ?>=<?= $i ?><?= '#'.$bookmark_anchor ?>" <?
								?>title="<?= Lang::key($title, ['number' => $number, 'number_end' => $number_end, 'bookmark' => $bookmark_entry]) ?>"><?= $i ?></a><?
							?></span><?
						endif;
						?><span class="ellipsis pager-page">&#8230;</span><?

					elseif ($i == $bookmark_page):

						?><span class="target pager-page"><?
							?><a href="<?= $baseurl.$query ?><?= $querykey ?>=<?= $i ?><?= '#'.$bookmark_anchor ?>" <?
							?>title="<?= Lang::key($title, ['number' => $number, 'number_end' => $number_end, 'bookmark' => $bookmark_entry]) ?>"><?= $i ?></a><?
						?></span><?

					else: # standard page

						// check if current page
						if ($i == $currentpage):
							?><span class="this<?= ($bookmark_page == $i ? ' target' : '') ?> pager-page"><?
								?><a href="<?= $baseurl.$query ?><?= $querykey ?>=<?= $i ?><?= ($bookmark_page == $i ? '#'.$bookmark_anchor : '') ?>" <?
								?>title="<?= Lang::key($title, ['number' => $number, 'number_end' => $number_end, 'bookmark' => $bookmark_entry]) ?>"><?= $i ?></a><?
							?></span></span><?
						else: # $i != $currentpage
							?><span class="pager-page<?= ($bookmark_page == $i ? ' target' : '') ?>"><?
								?><a href="<?= $baseurl.$query ?><?= $querykey ?>=<?= $i ?><?= ($bookmark_page == $i ? '#'.$bookmark_anchor : '') ?>" <?
								?>title="<?= Lang::key($title, ['number' => $number, 'number_end' => $number_end, 'bookmark' => $bookmark_entry]) ?>"><?= $i ?></a><?
							?></span><?
						endif;

					endif;

				endif;
			endforeach; # targets
			?>

		</span>
		<? endif; ?>

<? # ---- /Pager ---------------------------------------------------------- # ?>

		<? if ($currentpage < $pagecount && $currentpage >= 1): ?>
			<div class="next-page enabled">
				<a href="<?= $baseurl.$query ?><?= $querykey ?>=<?= $currentpage + 1 ?>" rel="next"><span><?= $next ?></span></a>
			</div>
		<? else: # last page ?>
			<div class="next-page disabled">
				<a><span><?= $next ?></span></a>
			</div>
		<? endif; ?>

	</div>

	<div class="pager-jumpto">
		<? if ($pagecount < 1000 && $jumpto): ?>

			<?= $goto_form = HTML::queryform($baseurl)
				->addfieldtemplate(':field') ?>

			<div class="pager-jumpto-form">
				<div>
					<label>
						<span><?= Lang::key('mjolnir:pager/goto') ?> </span>
						<select <?= $goto_form->mark() ?> name="page" onchange="this.form.submit()">
							<? for ($i = 1; $i <= $pagecount; ++$i): ?>
								<? if ($i != $currentpage): ?>
									<option value="<?= $i ?>"><?= $i ?></option>
								<? else: ?>
									<option value="<?= $i ?>" selected><?= $i ?></option>
								<? endif; ?>
							<? endfor; ?>
						</select>
					</label>
				</div>
				<button type="submit" class="btn noscript" <?= $goto_form->mark() ?>>
					<?= Lang::key('mjolnir:pager/go') ?>
				</button>
			</div>
		
		<? endif; ?>
	</div>

</div>
