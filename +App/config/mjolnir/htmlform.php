<?php 

$basictype = function ($type)
	{
		return function ($form) use ($type)
			{
				return \app\HTMLFormField::instance()
					->set('tabindex', \app\HTML::tabindex())
					->set('type', $type);
			};
	};
	
$numericbasictype = function ($type)
	{
		return function ($form) use ($type)
			{
				return \app\HTMLFormField::instance()
					->set('tabindex', \app\HTML::tabindex())
					->set('type', $type)
					->set('placeholder', '#');
			};
	};


return array
	(
		'form.standards' => array
			(
				// empty
			),
	
		'field.standards' => array
			(
				// empty
			),
	
		'fieldtypes' => array
			(
				'select' => function ($form)
					{
						return \app\HTMLFormField_Select::instance()
							->set('tabindex', \app\HTML::tabindex());
					},
			
				'hidden' => function ($form)
					{
						return \app\HTMLFormField::instance()
							->set('type', 'hidden');
					},
				
				'text'          => $basictype('text'),
				'password'      => $basictype('password'),
				'file'          => $basictype('file'),
				'image'         => $basictype('image'),
				'search'        => $basictype('search'),
				'number'        => $numericbasictype('number'),
				'identifier'    => $numericbasictype('text'),
				'currency'      => $basictype('text'),
				'phonenumber'   => $basictype('tel'),
				'url'           => $basictype('url'),
				'email'         => $basictype('email'),
				'month'         => $basictype('month'),
				'week'          => $basictype('week'),
				'color'         => $basictype('color'),
				'date'          => $basictype('date'),
				'datetime'      => $basictype('datetime'),
				'localdatetime' => $basictype('datetime-local'),
			),
	);
