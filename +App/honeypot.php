<?php namespace app;

// This is an IDE honeypot. It tells IDEs the class hirarchy, but otherwise has
// no effect on your application. :)

// HowTo: order honeypot -n 'mjolnir\html'


/**
 * @method \app\Controller_MjolnirQQUploader channel_is($channel)
 * @method \app\Channel channel()
 * @method \app\Controller_MjolnirQQUploader add_preprocessor($name, $processor)
 * @method \app\Controller_MjolnirQQUploader add_postprocessor($name, $processor)
 * @method \app\Controller_MjolnirQQUploader preprocess()
 * @method \app\Controller_MjolnirQQUploader postprocess()
 */
class Controller_MjolnirQQUploader extends \mjolnir\html\Controller_MjolnirQQUploader
{
	/** @return \app\Controller_MjolnirQQUploader */
	static function instance() { return parent::instance(); }
}

class FileUploader_QQUploader extends \mjolnir\html\FileUploader_QQUploader
{
}

class FileUploader extends \mjolnir\html\FileUploader
{
}

class HH extends \mjolnir\html\HH
{
}

class HTML extends \mjolnir\html\HTML
{
	/** @return \app\HTMLTag */
	static function anchor($tagbody, $href = null) { return parent::anchor($tagbody, $href); }
	/** @return \app\HTMLForm */
	static function form($action, $standard = null) { return parent::form($action, $standard); }
	/** @return \app\HTMLForm */
	static function queryform($action = '', $standard = null) { return parent::queryform($action, $standard); }
}

/**
 * @method \app\HTMLFormField field($label, $fieldname, $fieldtype)
 * @method \app\HTMLFormField_Composite composite($label)
 * @method \app\HTMLForm autocomplete(array  & $hints = null)
 * @method \app\HTMLForm basicuploader()
 * @method \app\HTMLForm nonuploader()
 * @method \app\HTMLForm tagname_is($tagname)
 * @method \app\HTMLForm tagbody_is($string)
 * @method \app\HTMLForm tagbody_render($renderable)
 * @method \app\HTMLForm appendtagbody($tagbody)
 * @method \app\HTMLForm set($name, $value)
 * @method \app\HTMLForm add($name, $value)
 * @method \app\HTMLForm metadata_is(array $metadata = null)
 * @method \app\HTMLForm addmetarenderer($key, $metarenderer)
 * @method \app\HTMLForm injectmetarenderers(array $metarenderers = null)
 * @method \app\HTMLFormField_Select select($label, $fieldname = null)
 * @method \app\HTMLFormField_AjaxUploader imageuploader($label, $fieldname = null)
 * @method \app\HTMLFormField_AjaxUploader videouploader($label, $fieldname = null)
 * @method \app\HTMLFormField hidden($fieldname = null)
 * @method \app\HTMLFormField submit($label, $fieldname = null, $tagvalue = null)
 * @method \app\HTMLFormField button($label, $fieldname = null, $tagbody = null)
 * @method \app\HTMLFormField reset($label, $fieldname = null, $tagvalue = null)
 * @method \app\HTMLFormField text($label, $fieldname = null)
 * @method \app\HTMLFormField_Textarea textarea($label, $fieldname = null)
 * @method \app\HTMLFormField password($label, $fieldname = null)
 * @method \app\HTMLFormField radio($label, $fieldname = null)
 * @method \app\HTMLFormField_Checkbox checkbox($label, $fieldname = null)
 * @method \app\HTMLFormField file($label, $fieldname = null)
 * @method \app\HTMLFormField search($label, $fieldname = null)
 * @method \app\HTMLFormField number($label, $fieldname = null)
 * @method \app\HTMLFormField identifier($label, $fieldname = null)
 * @method \app\HTMLFormField currency($label, $fieldname = null)
 * @method \app\HTMLFormField phonenumber($label, $fieldname = null)
 * @method \app\HTMLFormField url($label, $fieldname = null)
 * @method \app\HTMLFormField email($label, $fieldname = null)
 * @method \app\HTMLFormField month($label, $fieldname = null)
 * @method \app\HTMLFormField week($label, $fieldname = null)
 * @method \app\HTMLFormField color($label, $fieldname = null)
 * @method \app\HTMLFormField range($label, $fieldname = null)
 * @method \app\HTMLFormField image($label, $fieldname = null)
 * @method \app\HTMLFormField date($label, $fieldname = null)
 * @method \app\HTMLFormField time($label, $fieldname = null)
 * @method \app\HTMLFormField datetime($label, $fieldname = null)
 * @method \app\HTMLFormField localdatetime($label, $fieldname = null)
 * @method \app\HTMLForm errors_are(array  & $errors = null)
 * @method \app\HTMLForm addfieldtemplate($template, $fieldtype = null)
 * @method \app\HTMLForm addhintrenderer($hintrenderer, $fieldtype = null)
 * @method \app\HTMLForm adderrorrenderer($errorrenderer, $fieldtype = null)
 */
class HTMLForm extends \mjolnir\html\HTMLForm
{
	/** @return \app\HTMLForm */
	static function instance() { return parent::instance(); }
	/** @return \app\HTMLForm */
	static function i($standard, $action = null) { return parent::i($standard, $action); }
}

/**
 * @method \app\HTMLFormField_Button form_is($form)
 * @method \app\HTMLFormField_Button form()
 * @method \app\HTMLFormField_Button tagname_is($tagname)
 * @method \app\HTMLFormField_Button tagbody_is($string)
 * @method \app\HTMLFormField_Button tagbody_render($renderable)
 * @method \app\HTMLFormField_Button appendtagbody($tagbody)
 * @method \app\HTMLFormField_Button set($name, $value)
 * @method \app\HTMLFormField_Button add($name, $value)
 * @method \app\HTMLFormField_Button metadata_is(array $metadata = null)
 * @method \app\HTMLFormField_Button addmetarenderer($key, $metarenderer)
 * @method \app\HTMLFormField_Button injectmetarenderers(array $metarenderers = null)
 * @method \app\HTMLFormField_Button fieldlabel_is($fieldlabel)
 * @method \app\HTMLFormField_Button hintrenderer_is($renderer)
 * @method \app\HTMLFormField_Button errorrenderer_is($renderer)
 * @method \app\HTMLFormField_Button fieldtemplate_is($fieldtemplate)
 * @method \app\HTMLFormField_Button hint($hint)
 * @method \app\HTMLFormField_Button adderror($message)
 * @method \app\HTMLFormField_Button adderrors(array $errors = null)
 * @method \app\HTMLFormField_Button apply($standard)
 * @method \app\HTMLFormField_Button noerrors()
 * @method \app\HTMLFormField_Button showerrors()
 * @method \app\HTMLFormField_Button disable_autocomplete()
 * @method \app\HTMLFormField_Button enable_autocomplete()
 */
class HTMLFormField_Button extends \mjolnir\html\HTMLFormField_Button
{
	/** @return \app\HTMLFormField_Button */
	static function instance() { return parent::instance(); }
	/** @return \app\HTMLTag */
	static function i($tagname, $tagbody = null) { return parent::i($tagname, $tagbody); }
}

/**
 * @method \app\HTMLFormField_Checkbox form_is($form)
 * @method \app\HTMLFormField_Checkbox form()
 * @method \app\HTMLFormField_Checkbox tagname_is($tagname)
 * @method \app\HTMLFormField_Checkbox tagbody_is($string)
 * @method \app\HTMLFormField_Checkbox tagbody_render($renderable)
 * @method \app\HTMLFormField_Checkbox appendtagbody($tagbody)
 * @method \app\HTMLFormField_Checkbox set($name, $value)
 * @method \app\HTMLFormField_Checkbox add($name, $value)
 * @method \app\HTMLFormField_Checkbox metadata_is(array $metadata = null)
 * @method \app\HTMLFormField_Checkbox addmetarenderer($key, $metarenderer)
 * @method \app\HTMLFormField_Checkbox injectmetarenderers(array $metarenderers = null)
 * @method \app\HTMLFormField_Checkbox value_is($fieldvalue)
 * @method \app\HTMLFormField_Checkbox fieldlabel_is($fieldlabel)
 * @method \app\HTMLFormField_Checkbox hintrenderer_is($renderer)
 * @method \app\HTMLFormField_Checkbox errorrenderer_is($renderer)
 * @method \app\HTMLFormField_Checkbox fieldtemplate_is($fieldtemplate)
 * @method \app\HTMLFormField_Checkbox hint($hint)
 * @method \app\HTMLFormField_Checkbox adderror($message)
 * @method \app\HTMLFormField_Checkbox adderrors(array $errors = null)
 * @method \app\HTMLFormField_Checkbox apply($standard)
 * @method \app\HTMLFormField_Checkbox noerrors()
 * @method \app\HTMLFormField_Checkbox showerrors()
 * @method \app\HTMLFormField_Checkbox disable_autocomplete()
 * @method \app\HTMLFormField_Checkbox enable_autocomplete()
 * @method \app\HTMLFormField_Checkbox checked()
 * @method \app\HTMLFormField_Checkbox unchecked()
 */
class HTMLFormField_Checkbox extends \mjolnir\html\HTMLFormField_Checkbox
{
	/** @return \app\HTMLFormField_Checkbox */
	static function instance() { return parent::instance(); }
	/** @return \app\HTMLTag */
	static function i($tagname, $tagbody = null) { return parent::i($tagname, $tagbody); }
}

/**
 * @method \app\HTMLFormField_Composite addfield($field)
 * @method \app\HTMLFormField_Composite form_is($form)
 * @method \app\HTMLFormField_Composite form()
 * @method \app\HTMLFormField_Composite tagname_is($tagname)
 * @method \app\HTMLFormField_Composite tagbody_is($string)
 * @method \app\HTMLFormField_Composite tagbody_render($renderable)
 * @method \app\HTMLFormField_Composite appendtagbody($tagbody)
 * @method \app\HTMLFormField_Composite set($name, $value)
 * @method \app\HTMLFormField_Composite add($name, $value)
 * @method \app\HTMLFormField_Composite metadata_is(array $metadata = null)
 * @method \app\HTMLFormField_Composite addmetarenderer($key, $metarenderer)
 * @method \app\HTMLFormField_Composite injectmetarenderers(array $metarenderers = null)
 * @method \app\HTMLFormField_Composite fieldlabel_is($fieldlabel)
 * @method \app\HTMLFormField_Composite hintrenderer_is($renderer)
 * @method \app\HTMLFormField_Composite errorrenderer_is($renderer)
 * @method \app\HTMLFormField_Composite fieldtemplate_is($fieldtemplate)
 * @method \app\HTMLFormField_Composite hint($hint)
 * @method \app\HTMLFormField_Composite adderror($message)
 * @method \app\HTMLFormField_Composite adderrors(array $errors = null)
 * @method \app\HTMLFormField_Composite apply($standard)
 * @method \app\HTMLFormField_Composite noerrors()
 * @method \app\HTMLFormField_Composite showerrors()
 * @method \app\HTMLFormField_Composite disable_autocomplete()
 * @method \app\HTMLFormField_Composite enable_autocomplete()
 * @method \app\HTMLFormField_Composite value_is($fieldvalue)
 * @method \app\HTMLFormField_Composite errors()
 * @method \app\HTMLFormField_Composite fieldmix($fieldmix)
 */
class HTMLFormField_Composite extends \mjolnir\html\HTMLFormField_Composite
{
	/** @return \app\HTMLFormField_Composite */
	static function instance() { return parent::instance(); }
	/** @return \app\HTMLTag */
	static function i($tagname, $tagbody = null) { return parent::i($tagname, $tagbody); }
}

/**
 * @method \app\HTMLFormField_Hidden fieldtemplate_is($template)
 * @method \app\HTMLFormField_Hidden form_is($form)
 * @method \app\HTMLFormField_Hidden form()
 * @method \app\HTMLFormField_Hidden tagname_is($tagname)
 * @method \app\HTMLFormField_Hidden tagbody_is($string)
 * @method \app\HTMLFormField_Hidden tagbody_render($renderable)
 * @method \app\HTMLFormField_Hidden appendtagbody($tagbody)
 * @method \app\HTMLFormField_Hidden set($name, $value)
 * @method \app\HTMLFormField_Hidden add($name, $value)
 * @method \app\HTMLFormField_Hidden metadata_is(array $metadata = null)
 * @method \app\HTMLFormField_Hidden addmetarenderer($key, $metarenderer)
 * @method \app\HTMLFormField_Hidden injectmetarenderers(array $metarenderers = null)
 * @method \app\HTMLFormField_Hidden value_is($fieldvalue)
 * @method \app\HTMLFormField_Hidden fieldlabel_is($fieldlabel)
 * @method \app\HTMLFormField_Hidden hintrenderer_is($renderer)
 * @method \app\HTMLFormField_Hidden errorrenderer_is($renderer)
 * @method \app\HTMLFormField_Hidden hint($hint)
 * @method \app\HTMLFormField_Hidden adderror($message)
 * @method \app\HTMLFormField_Hidden adderrors(array $errors = null)
 * @method \app\HTMLFormField_Hidden apply($standard)
 * @method \app\HTMLFormField_Hidden noerrors()
 * @method \app\HTMLFormField_Hidden showerrors()
 * @method \app\HTMLFormField_Hidden disable_autocomplete()
 * @method \app\HTMLFormField_Hidden enable_autocomplete()
 */
class HTMLFormField_Hidden extends \mjolnir\html\HTMLFormField_Hidden
{
	/** @return \app\HTMLFormField_Hidden */
	static function instance() { return parent::instance(); }
	/** @return \app\HTMLTag */
	static function i($tagname, $tagbody = null) { return parent::i($tagname, $tagbody); }
}

/**
 * @method \app\HTMLFormField_ImageUploader image_is($imageurl)
 * @method \app\HTMLFormField_ImageUploader previewsize($width, $height)
 * @method \app\HTMLTag makepreview()
 * @method \app\HTMLTag wrapper()
 * @method \app\HTMLFormField_ImageUploader form_is($form)
 * @method \app\HTMLFormField_ImageUploader form()
 * @method \app\HTMLFormField_ImageUploader tagname_is($tagname)
 * @method \app\HTMLFormField_ImageUploader tagbody_is($string)
 * @method \app\HTMLFormField_ImageUploader tagbody_render($renderable)
 * @method \app\HTMLFormField_ImageUploader appendtagbody($tagbody)
 * @method \app\HTMLFormField_ImageUploader set($name, $value)
 * @method \app\HTMLFormField_ImageUploader add($name, $value)
 * @method \app\HTMLFormField_ImageUploader metadata_is(array $metadata = null)
 * @method \app\HTMLFormField_ImageUploader addmetarenderer($key, $metarenderer)
 * @method \app\HTMLFormField_ImageUploader injectmetarenderers(array $metarenderers = null)
 * @method \app\HTMLFormField_ImageUploader value_is($fieldvalue)
 * @method \app\HTMLFormField_ImageUploader fieldlabel_is($fieldlabel)
 * @method \app\HTMLFormField_ImageUploader hintrenderer_is($renderer)
 * @method \app\HTMLFormField_ImageUploader errorrenderer_is($renderer)
 * @method \app\HTMLFormField_ImageUploader fieldtemplate_is($fieldtemplate)
 * @method \app\HTMLFormField_ImageUploader hint($hint)
 * @method \app\HTMLFormField_ImageUploader adderror($message)
 * @method \app\HTMLFormField_ImageUploader adderrors(array $errors = null)
 * @method \app\HTMLFormField_ImageUploader apply($standard)
 * @method \app\HTMLFormField_ImageUploader noerrors()
 * @method \app\HTMLFormField_ImageUploader showerrors()
 * @method \app\HTMLFormField_ImageUploader disable_autocomplete()
 * @method \app\HTMLFormField_ImageUploader enable_autocomplete()
 * @method \app\HTMLFormField_ImageUploader initialize()
 * @method \app\HTMLTag preview()
 * @method \app\HTMLFormField_ImageUploader langprefix_is($langprefix)
 * @method \app\HTMLFormField_ImageUploader channel_is($channel)
 * @method \app\Channel channel()
 */
class HTMLFormField_ImageUploader extends \mjolnir\html\HTMLFormField_ImageUploader
{
	/** @return \app\HTMLFormField_ImageUploader */
	static function instance() { return parent::instance(); }
	/** @return \app\HTMLTag */
	static function i($tagname, $tagbody = null) { return parent::i($tagname, $tagbody); }
}

/**
 * @method \app\HTMLFormField_Radio form_is($form)
 * @method \app\HTMLFormField_Radio form()
 * @method \app\HTMLFormField_Radio tagname_is($tagname)
 * @method \app\HTMLFormField_Radio tagbody_is($string)
 * @method \app\HTMLFormField_Radio tagbody_render($renderable)
 * @method \app\HTMLFormField_Radio appendtagbody($tagbody)
 * @method \app\HTMLFormField_Radio set($name, $value)
 * @method \app\HTMLFormField_Radio add($name, $value)
 * @method \app\HTMLFormField_Radio metadata_is(array $metadata = null)
 * @method \app\HTMLFormField_Radio addmetarenderer($key, $metarenderer)
 * @method \app\HTMLFormField_Radio injectmetarenderers(array $metarenderers = null)
 * @method \app\HTMLFormField_Radio value_is($fieldvalue)
 * @method \app\HTMLFormField_Radio fieldlabel_is($fieldlabel)
 * @method \app\HTMLFormField_Radio hintrenderer_is($renderer)
 * @method \app\HTMLFormField_Radio errorrenderer_is($renderer)
 * @method \app\HTMLFormField_Radio fieldtemplate_is($fieldtemplate)
 * @method \app\HTMLFormField_Radio hint($hint)
 * @method \app\HTMLFormField_Radio adderror($message)
 * @method \app\HTMLFormField_Radio adderrors(array $errors = null)
 * @method \app\HTMLFormField_Radio apply($standard)
 * @method \app\HTMLFormField_Radio noerrors()
 * @method \app\HTMLFormField_Radio showerrors()
 * @method \app\HTMLFormField_Radio disable_autocomplete()
 * @method \app\HTMLFormField_Radio enable_autocomplete()
 * @method \app\HTMLFormField_Radio checked()
 * @method \app\HTMLFormField_Radio unchecked()
 */
class HTMLFormField_Radio extends \mjolnir\html\HTMLFormField_Radio
{
	/** @return \app\HTMLFormField_Radio */
	static function instance() { return parent::instance(); }
	/** @return \app\HTMLTag */
	static function i($tagname, $tagbody = null) { return parent::i($tagname, $tagbody); }
}

/**
 * @method \app\HTMLFormField_Select options_array(array $array = null)
 * @method \app\HTMLFormField_Select optgroups_array(array $optgroups = null)
 * @method \app\HTMLFormField_Select form_is($form)
 * @method \app\HTMLFormField_Select form()
 * @method \app\HTMLFormField_Select tagname_is($tagname)
 * @method \app\HTMLFormField_Select tagbody_is($string)
 * @method \app\HTMLFormField_Select tagbody_render($renderable)
 * @method \app\HTMLFormField_Select appendtagbody($tagbody)
 * @method \app\HTMLFormField_Select set($name, $value)
 * @method \app\HTMLFormField_Select add($name, $value)
 * @method \app\HTMLFormField_Select metadata_is(array $metadata = null)
 * @method \app\HTMLFormField_Select addmetarenderer($key, $metarenderer)
 * @method \app\HTMLFormField_Select injectmetarenderers(array $metarenderers = null)
 * @method \app\HTMLFormField_Select fieldlabel_is($fieldlabel)
 * @method \app\HTMLFormField_Select hintrenderer_is($renderer)
 * @method \app\HTMLFormField_Select errorrenderer_is($renderer)
 * @method \app\HTMLFormField_Select fieldtemplate_is($fieldtemplate)
 * @method \app\HTMLFormField_Select hint($hint)
 * @method \app\HTMLFormField_Select adderror($message)
 * @method \app\HTMLFormField_Select adderrors(array $errors = null)
 * @method \app\HTMLFormField_Select apply($standard)
 * @method \app\HTMLFormField_Select noerrors()
 * @method \app\HTMLFormField_Select showerrors()
 * @method \app\HTMLFormField_Select disable_autocomplete()
 * @method \app\HTMLFormField_Select enable_autocomplete()
 * @method \app\HTMLFormField_Select options_table(array $table, $valuekey = null, $labelkey = null, $groupkey = null)
 * @method \app\HTMLFormField_Select value_is($value)
 * @method \app\HTMLFormField_Select value_array(array $values = null)
 */
class HTMLFormField_Select extends \mjolnir\html\HTMLFormField_Select
{
	/** @return \app\HTMLFormField_Select */
	static function instance() { return parent::instance(); }
	/** @return \app\HTMLTag */
	static function i($tagname, $tagbody = null) { return parent::i($tagname, $tagbody); }
}

/**
 * @method \app\HTMLFormField_Textarea form_is($form)
 * @method \app\HTMLFormField_Textarea form()
 * @method \app\HTMLFormField_Textarea tagname_is($tagname)
 * @method \app\HTMLFormField_Textarea tagbody_is($string)
 * @method \app\HTMLFormField_Textarea tagbody_render($renderable)
 * @method \app\HTMLFormField_Textarea appendtagbody($tagbody)
 * @method \app\HTMLFormField_Textarea set($name, $value)
 * @method \app\HTMLFormField_Textarea add($name, $value)
 * @method \app\HTMLFormField_Textarea metadata_is(array $metadata = null)
 * @method \app\HTMLFormField_Textarea addmetarenderer($key, $metarenderer)
 * @method \app\HTMLFormField_Textarea injectmetarenderers(array $metarenderers = null)
 * @method \app\HTMLFormField_Textarea fieldlabel_is($fieldlabel)
 * @method \app\HTMLFormField_Textarea hintrenderer_is($renderer)
 * @method \app\HTMLFormField_Textarea errorrenderer_is($renderer)
 * @method \app\HTMLFormField_Textarea fieldtemplate_is($fieldtemplate)
 * @method \app\HTMLFormField_Textarea hint($hint)
 * @method \app\HTMLFormField_Textarea adderror($message)
 * @method \app\HTMLFormField_Textarea adderrors(array $errors = null)
 * @method \app\HTMLFormField_Textarea apply($standard)
 * @method \app\HTMLFormField_Textarea noerrors()
 * @method \app\HTMLFormField_Textarea showerrors()
 * @method \app\HTMLFormField_Textarea disable_autocomplete()
 * @method \app\HTMLFormField_Textarea enable_autocomplete()
 */
class HTMLFormField_Textarea extends \mjolnir\html\HTMLFormField_Textarea
{
	/** @return \app\HTMLFormField_Textarea */
	static function instance() { return parent::instance(); }
	/** @return \app\HTMLTag */
	static function i($tagname, $tagbody = null) { return parent::i($tagname, $tagbody); }
}

/**
 * @method \app\HTMLFormField_VideoUploader videokey_is($videokey)
 * @method \app\HTMLTag makepreview()
 * @method \app\HTMLTag wrapper()
 * @method \app\HTMLFormField_VideoUploader form_is($form)
 * @method \app\HTMLFormField_VideoUploader form()
 * @method \app\HTMLFormField_VideoUploader tagname_is($tagname)
 * @method \app\HTMLFormField_VideoUploader tagbody_is($string)
 * @method \app\HTMLFormField_VideoUploader tagbody_render($renderable)
 * @method \app\HTMLFormField_VideoUploader appendtagbody($tagbody)
 * @method \app\HTMLFormField_VideoUploader set($name, $value)
 * @method \app\HTMLFormField_VideoUploader add($name, $value)
 * @method \app\HTMLFormField_VideoUploader metadata_is(array $metadata = null)
 * @method \app\HTMLFormField_VideoUploader addmetarenderer($key, $metarenderer)
 * @method \app\HTMLFormField_VideoUploader injectmetarenderers(array $metarenderers = null)
 * @method \app\HTMLFormField_VideoUploader value_is($fieldvalue)
 * @method \app\HTMLFormField_VideoUploader fieldlabel_is($fieldlabel)
 * @method \app\HTMLFormField_VideoUploader hintrenderer_is($renderer)
 * @method \app\HTMLFormField_VideoUploader errorrenderer_is($renderer)
 * @method \app\HTMLFormField_VideoUploader fieldtemplate_is($fieldtemplate)
 * @method \app\HTMLFormField_VideoUploader hint($hint)
 * @method \app\HTMLFormField_VideoUploader adderror($message)
 * @method \app\HTMLFormField_VideoUploader adderrors(array $errors = null)
 * @method \app\HTMLFormField_VideoUploader apply($standard)
 * @method \app\HTMLFormField_VideoUploader noerrors()
 * @method \app\HTMLFormField_VideoUploader showerrors()
 * @method \app\HTMLFormField_VideoUploader disable_autocomplete()
 * @method \app\HTMLFormField_VideoUploader enable_autocomplete()
 * @method \app\HTMLFormField_VideoUploader initialize()
 * @method \app\HTMLTag preview()
 * @method \app\HTMLFormField_VideoUploader langprefix_is($langprefix)
 * @method \app\HTMLFormField_VideoUploader channel_is($channel)
 * @method \app\Channel channel()
 */
class HTMLFormField_VideoUploader extends \mjolnir\html\HTMLFormField_VideoUploader
{
	/** @return \app\HTMLFormField_VideoUploader */
	static function instance() { return parent::instance(); }
	/** @return \app\HTMLTag */
	static function i($tagname, $tagbody = null) { return parent::i($tagname, $tagbody); }
}

/**
 * @method \app\HTMLFormField form_is($form)
 * @method \app\HTMLFormField form()
 * @method \app\HTMLFormField tagname_is($tagname)
 * @method \app\HTMLFormField tagbody_is($string)
 * @method \app\HTMLFormField tagbody_render($renderable)
 * @method \app\HTMLFormField appendtagbody($tagbody)
 * @method \app\HTMLFormField set($name, $value)
 * @method \app\HTMLFormField add($name, $value)
 * @method \app\HTMLFormField metadata_is(array $metadata = null)
 * @method \app\HTMLFormField addmetarenderer($key, $metarenderer)
 * @method \app\HTMLFormField injectmetarenderers(array $metarenderers = null)
 * @method \app\HTMLFormField value_is($fieldvalue)
 * @method \app\HTMLFormField fieldlabel_is($fieldlabel)
 * @method \app\HTMLFormField hintrenderer_is($renderer)
 * @method \app\HTMLFormField errorrenderer_is($renderer)
 * @method \app\HTMLFormField fieldtemplate_is($fieldtemplate)
 * @method \app\HTMLFormField hint($hint)
 * @method \app\HTMLFormField adderror($message)
 * @method \app\HTMLFormField adderrors(array $errors = null)
 * @method \app\HTMLFormField apply($standard)
 * @method \app\HTMLFormField noerrors()
 * @method \app\HTMLFormField showerrors()
 * @method \app\HTMLFormField disable_autocomplete()
 * @method \app\HTMLFormField enable_autocomplete()
 */
class HTMLFormField extends \mjolnir\html\HTMLFormField
{
	/** @return \app\HTMLFormField */
	static function instance() { return parent::instance(); }
	/** @return \app\HTMLTag */
	static function i($tagname, $tagbody = null) { return parent::i($tagname, $tagbody); }
}

/**
 * @method \app\HTMLTag tagname_is($tagname)
 * @method \app\HTMLTag tagbody_is($string)
 * @method \app\HTMLTag tagbody_render($renderable)
 * @method \app\HTMLTag appendtagbody($tagbody)
 * @method \app\HTMLTag set($name, $value)
 * @method \app\HTMLTag add($name, $value)
 * @method \app\HTMLTag metadata_is(array $metadata = null)
 * @method \app\HTMLTag addmetarenderer($key, $metarenderer)
 * @method \app\HTMLTag injectmetarenderers(array $metarenderers = null)
 */
class HTMLTag extends \mjolnir\html\HTMLTag
{
	/** @return \app\HTMLTag */
	static function instance() { return parent::instance(); }
	/** @return \app\HTMLTag */
	static function i($tagname, $tagbody = null) { return parent::i($tagname, $tagbody); }
}

/**
 * @method \app\Pager querykey_is($querykey)
 * @method \app\Pager pageorder_is($order)
 * @method \app\Pager pageorder_asc()
 * @method \app\Pager pageorder_desc()
 * @method \app\Pager page_is($page)
 * @method \app\Pager totalitems_are($totalitems)
 * @method \app\Pager pagediff_is($pagediff)
 * @method \app\Pager pagelimit_is($pagelimit)
 * @method \app\Pager baseurl_is($baseurl)
 * @method \app\Pager query_is(array $query)
 * @method \app\Pager appendquery($rawquery)
 * @method \app\Pager bookmark_is($entry, $anchor)
 * @method \app\Pager langprefix_is($langprefix)
 * @method \app\Pager apply($standard)
 * @method \app\Pager file_is($file, $ext = null)
 * @method \app\Pager set($name, $value)
 * @method \app\Pager add($name, $value)
 * @method \app\Pager metadata_is(array $metadata = null)
 * @method \app\Pager file_path($filepath)
 * @method \app\Pager addmetarenderer($key, $metarenderer)
 * @method \app\Pager injectmetarenderers(array $metarenderers = null)
 */
class Pager extends \mjolnir\html\Pager
{
	/** @return \app\Pager */
	static function instance($totalitems = 0, $baseurl = null, $pagediff = null, $pagelimit = null) { return parent::instance($totalitems, $baseurl, $pagediff, $pagelimit); }
}
