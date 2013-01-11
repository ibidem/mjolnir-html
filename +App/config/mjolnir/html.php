<?php

	$mjolnir_base = \app\CFS::config('mjolnir/base');

return array
	(
		'extra_markup' => [],
	// general
		'forcedunload' => false,
		'doctype' => \mjolnir\types\HTML::DOCTYPE,
		'appcache' => null,
		'sitemap' => null,
		'prefetch_domains' => [],
		'body_classes' => [],
		'favicon' => null,
		'stylesheets' => [],
		'scripts' => [],
		'head_scripts' => [],
		'viewport' => 'width=device-width, initial-scale=1.0, maximum-scale=1.0',
	// search
		'title' => 'Untitled',
		'description' => null,
		'keywords' => [],
		'generator' => null,
		'author' => null,
	// social networks
		'facebookmetas' => null,
	// crawlers
		'canonical' => null,
		'crawlers' => true, # allow
	// feeds
		'rssfeed' => null,
		'atomfeed' => null,
		'pingback' => null,
	// pin status
		'application_name' => null,
		'application_tooltip' => null,
		'application_starturl' => null,
	// etc
		'humanstxt' => false,
		'javascript_switch' => true,
		'js-loader' => '//'.$mjolnir_base['domain'].$mjolnir_base['path'].'media/static/yepnope.latest-min.js',
	);
