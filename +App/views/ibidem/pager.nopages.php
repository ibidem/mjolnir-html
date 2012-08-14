<? namespace app; ?>

<nav class="pager">
	
	<? if ($pagecount > 0 && $show_pageindex): ?>
		<div class="pager-currentnav">
			<?= Lang::msg
				(
					'pager.pages', 
					array
						(
							':currentpage' => $currentpage != null ? $currentpage : 1,
							':pagecount'   => $pagecount
						)
				) ?>
		</div>
	<? endif; ?>
	
	<div class="pager-pagenav">
	
		<? if ($currentpage != 1): ?>
			<div class="previous-page enabled">
				<a href="<?= $url_base.$querie ?><?= $page_query ?>=<?= $currentpage - 1 ?>" rel="prev"><span><?= $buttons['prev'] ?></span></a>
			</div>
		<? else: # current page is 1 ?>
			<div class="previous-page disabled">
				<a><span><?= $buttons['prev'] ?></span></a>
			</div>	
		<? endif; ?>

		<? if ($currentpage != $pagecount): ?>
			<div class="next-page enabled">
				<a href="<?= $url_base.$querie ?><?= $page_query ?>=<?= $currentpage + 1 ?>" rel="next"><span><?= $buttons['next'] ?></span></a>
			</div>	
		<? else: # last page ?>
			<div class="next-page disabled">
				<a><span><?= $buttons['next'] ?></span></a>
			</div>
		<? endif; ?>

	</div>
	
</nav>
