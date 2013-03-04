<?php

$basictype = function ($type)
	{
		return function (\mjolnir\types\HTMLForm $form) use ($type)
			{
				return \app\HTMLFormField::instance()
					->set('tabindex', \app\HTML::tabindex())
					->set('type', $type);
			};
	};

$numericbasictype = function ($type)
	{
		return function (\mjolnir\types\HTMLForm $form) use ($type)
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
				'mjolnir:barebone' => function (\mjolnir\types\HTMLForm $form)
					{
						return $form->addfieldtemplate(':field');
					},
				'mjolnir:inline' => function (\mjolnir\types\HTMLForm $form)
					{
						return $form->apply('mjolnir:barebone')
							->set('style', 'display: inline');
					},
				'mjolnir:twitter' => function (\mjolnir\types\HTMLForm $form)
					{
						return $form
							->adderrorrenderer
								(
									function (array $errors = null)
									{
										if ($errors)
										{
											$out = '';
											foreach ($errors as $error)
											{
												$out .= "<span class=\"help-block\"><span class=\"text-error\">$error</span></span>";
											}

											return $out.'';
										}
										else # no errors
										{
											return '';
										}
									}
								)
							->addhintrenderer
								(
									function (array $hints = null)
									{
										if ($hints)
										{
											$out = '';
											foreach ($hints as $hint)
											{
												$out .= "<span class=\"help-block\">$hint</span>";
											}

											return $out;
										}
										else # no hints
										{
											return '';
										}
									}
								)
							->addfieldtemplate
								(
									'<div class="control-group"><label class="control-label" for=":id">:label</label><div class="controls">:field :hints :errors</div></div>'
								)
							->addfieldtemplate
								(
									'<div class="control-group"><label class="control-label" for=":id">:label</label><div class="controls"><div class="checkbox inline">:field</div> :hints :errors</div></div>',
									'checkbox'
								);
					},
			),

		'field.standards' => array
			(
				// empty
			),

		'fieldtypes' => array
			(
				'select' => function (\mjolnir\types\HTMLForm $form)
					{
						return \app\HTMLFormField_Select::instance()
							->set('tabindex', \app\HTML::tabindex());
					},
							
				'imageuploader' => function (\mjolnir\types\HTMLForm $form)
					{
						return \app\HTMLFormField_ImageUploader::instance()
							->set('tabindex', \app\HTML::tabindex());
					},

				'checkbox' => function (\mjolnir\types\HTMLForm $form)
					{
						return \app\HTMLFormField_Checkbox::instance()
							->set('tabindex', \app\HTML::tabindex());
					},

				'radio' => function (\mjolnir\types\HTMLForm $form)
					{
						return \app\HTMLFormField_Radio::instance()
							->set('tabindex', \app\HTML::tabindex());
					},

				'hidden' => function (\mjolnir\types\HTMLForm $form)
					{
						return \app\HTMLFormField_Hidden::instance();
					},

				'textarea' => function (\mjolnir\types\HTMLForm $form)
					{
						return \app\HTMLFormField_Textarea::instance()
							->set('tabindex', \app\HTML::tabindex());
					},
							
				'imageuploader' => function (\mjolnir\types\HTMLForm $form)
					{
						return \app\HTMLFormField_ImageUploader::instance()
							->form_is($form)
							->initialize();
					},

				'button'        => $basictype('submit'),
				'submit'        => $basictype('submit'),
				'reset'         => $basictype('reset'),

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
				'range'         => $basictype('range'),
				'date'          => $basictype('date'),
				'datetime'      => $basictype('datetime'),
				'localdatetime' => $basictype('datetime-local'),
			),
	);
