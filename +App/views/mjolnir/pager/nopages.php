<? namespace app; ?>

<div class="pager" role="navigation">

	<? if ($pagecount > 0 && $pageindex): ?>
		<div class="pager-currentnav">
			<?= Lang::key
				(
					"{$langkey}pager-pages",
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
				<a href="<?= $baseurl.$querie ?><?= $querykey ?>=<?= $currentpage - 1 ?>" rel="prev"><span><?= $prev ?></span></a>
			</div>
		<? else: # current page is 1 ?>
			<div class="previous-page disabled">
				<a><span><?= $prev ?></span></a>
			</div>
		<? endif; ?>

		<? if ($currentpage != $pagecount): ?>
			<div class="next-page enabled">
				<a href="<?= $baseurl.$querie ?><?= $querykey ?>=<?= $currentpage + 1 ?>" rel="next"><span><?= $next ?></span></a>
			</div>
		<? else: # last page ?>
			<div class="next-page disabled">
				<a><span><?= $next ?></span></a>
			</div>
		<? endif; ?>

	</div>

</div>
