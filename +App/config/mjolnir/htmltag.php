<?php return array
	(
		'metarenderers' => array
			(
				'class' => function (\mjolnir\types\HTMLTag $tag)
					{
						$classes = $tag->get('class');

						if (\is_array($classes))
						{
							return \implode(' ', \array_unique($classes));
						}
						else # assume string
						{
							return $classes;
						}
					},

				'style' => function (\mjolnir\types\HTMLTag $tag)
					{
						$styles = $tag->get('style');

						if (\is_array($styles))
						{
							return \app\Arr::implode
								(
									' ',
									$styles,
									function ($key, $style)
									{
										return \rtrim($style, ';').';';
									}
								);
						}
						else # non array
						{
							return $styles;
						}
					},
			),
	);
