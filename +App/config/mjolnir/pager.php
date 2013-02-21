<?php return array
	(
		'pager.default' => 'mjolnir/pager/nopages',
		'pager.standards' => array
			(
				'mjolnir' => function (\mjolnir\types\Pager &$pager)
					{
						$pager->file_is('mjolnir/pager/mjolnir');
					},
				'twitter' => function (\mjolnir\types\Pager &$pager)
					{
						$pager->file_is('mjolnir/pager/twitter');
					},
				'nopages' => function (\mjolnir\types\Pager &$pager)
					{
						$pager->file_is('mjolnir/pager/nopages');
					},
			),
	);
