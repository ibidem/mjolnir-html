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

		<? if ($currentpage > 1): ?>
			<div class="previous-page enabled">
				<a href="<?= $baseurl.$query ?><?= $querykey ?>=<?= $currentpage - 1 ?>" rel="prev"><span><?= $prev ?></span></a>
			</div>
		<? else: # current page is 1 ?>
			<div class="previous-page disabled">
				<a><span><?= $prev ?></span></a>
			</div>
		<? endif; ?>

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

</div>
