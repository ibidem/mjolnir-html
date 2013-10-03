<?php

$basictype = function ($type)
	{
		return function (\mjolnir\types\HTMLForm $form) use ($type)
			{
				return \app\HTMLFormField::instance()
					->set('tabindex', $form->is_unsigned() ? null : \app\HTML::tabindex())
					->set('type', $type);
			};
	};

$numericbasictype = function ($type)
	{
		return function (\mjolnir\types\HTMLForm $form) use ($type)
			{
				return \app\HTMLFormField::instance()
					->set('tabindex', $form->is_unsigned() ? null : \app\HTML::tabindex())
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
				'mjolnir:twbs3' => function (\mjolnir\types\HTMLForm $form)
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
									'
										<div class="form-group">
											<label class="col-lg-2 control-label" for=":id">:label</label>
											<div class="col-lg-10">
												:field :hints :errors
											</div>
										</div>
									'
								)
							->addfieldtemplate
								(
									'
										<div class="form-group">
											<div class="col-lg-offset-2 col-lg-10">
												<div class="checkbox">
													<label>:field :label</label>
												</div>
												:hints :errors
											</div>
										</div>
									',
									'checkbox'
								)
							->addfieldconfigurer
								(
									function (\mjolnir\types\HTMLFormField $field)
										{
											$field->add('class', 'form-control');
										},
									[
										'select',
										'date',
										'text',
										'password',
										'image',
										'search',
										'number',
										'identifier',
										'currency',
										'phonenumber',
										'url',
										'email',
										'month',
										'week',
										'color',
										'range',
										'datetime',
										'localdatetime',
									]
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
							->set('tabindex', $form->is_unsigned() ? null : \app\HTML::tabindex());
					},

				'imageuploader' => function (\mjolnir\types\HTMLForm $form)
					{
						return \app\HTMLFormField_ImageUploader::instance()
							->set('tabindex', $form->is_unsigned() ? null : \app\HTML::tabindex());
					},

				'videouploader' => function (\mjolnir\types\HTMLForm $form)
					{
						return \app\HTMLFormField_VideoUploader::instance()
							->set('tabindex', $form->is_unsigned() ? null : \app\HTML::tabindex());
					},

				'checkbox' => function (\mjolnir\types\HTMLForm $form)
					{
						return \app\HTMLFormField_Checkbox::instance()
							->set('tabindex', $form->is_unsigned() ? null : \app\HTML::tabindex());
					},

				'radio' => function (\mjolnir\types\HTMLForm $form)
					{
						return \app\HTMLFormField_Radio::instance()
							->set('tabindex', $form->is_unsigned() ? null : \app\HTML::tabindex());
					},

				'hidden' => function (\mjolnir\types\HTMLForm $form)
					{
						return \app\HTMLFormField_Hidden::instance();
					},

				'textarea' => function (\mjolnir\types\HTMLForm $form)
					{
						return \app\HTMLFormField_Textarea::instance()
							->set('tabindex', $form->is_unsigned() ? null : \app\HTML::tabindex());
					},

				'imageuploader' => function (\mjolnir\types\HTMLForm $form)
					{
						return \app\HTMLFormField_ImageUploader::instance()
							->form_is($form)
							->initialize();
					},

				'date' => function (\mjolnir\types\HTMLForm $form)
					{
						return \app\HTMLFormField_Date::instance()
							->set('tabindex', $form->is_unsigned() ? null : \app\HTML::tabindex());
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
				'datetime'      => $basictype('datetime'),
				'localdatetime' => $basictype('datetime-local'),
			),
	);
