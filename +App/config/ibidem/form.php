<?php return array
	(
		'standards' => array
			(
				'twitter' => function ($form)
					{
						$form->field_template
							(
								'<div class="control-group"><span class="control-label">:name</span><div class="controls">:field</div></div>'
							);
					},
				'twitter.general' => function ($form)
					{
						$form
							->standard('twitter')
							->method(\mjolnir\types\HTTP::POST)
							->classes(['form-horizontal']);
					},
				'twitter.table-controls' => function ($form)
					{
						$form
							->standard('twitter')
							->method(\mjolnir\types\HTTP::POST)
							->field_template(':field');
					},
			),
		
		'secure.default' => true, # all forms are fully secured; by default
		'method.default' => \mjolnir\types\HTTP::POST,
		'template.field' => '<dt>:name</dt><dd>:field</dd>',
		'template.group' => '<fieldset><legend>:legend</legend>:fields</fieldset>',
	
		'textarea.rows.default' => 3,
		'textarea.cols.default' => 80,
	);
