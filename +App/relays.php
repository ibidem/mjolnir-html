<?php namespace app;

$json = \app\CFS::config('mjolnir/layer-stacks')['json'];

\app\Router::process('mjolnir:html/qq-uploader.route', $json);
