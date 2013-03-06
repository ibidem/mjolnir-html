<?php namespace mjolnir\html;

/**
 * @package    mjolnir
 * @category   Html
 * @author     Ibidem Team
 * @copyright  (c) 2013, Ibidem Team
 * @license    https://github.com/ibidem/ibidem/blob/master/LICENSE.md
 */
class HTMLFormField_VideoUploader extends \app\HTMLFormField implements \mjolnir\types\HTMLFormField_AjaxUploader
{
	use \app\Trait_HTMLFormField_AjaxUploader;

	/**
	 * @var string
	 */
	protected $videokey;
	
	/**
	 * @return static $this
	 */
	function videokey_is($videokey)
	{
		$this->videokey = $videokey;
		return $this;
	}
	
	/**
	 * @return \mjolnir\types\HTMLTag
	 */
	function makepreview()
	{
		$preview = \app\HTMLTag::i('div', '')
			->set('id', $this->input->get('id').'_preview')
			->add('class', 'off');
		
		if ($this->videokey !== null)
		{
			$webm = \app\HTMLTag::i('source')
				->set('type', 'video/webm')
				->set('src', "{$this->videokey}.webm");

			$mp4 = \app\HTMLTag::i('source')
				->set('type', 'video/mp4')
				->set('src', "{$this->videokey}.mp4");

			$ogv = \app\HTMLTag::i('source')
				->set('type', 'video/ogv')
				->set('src', "{$this->videokey}.ogv");

			$video = \app\HTMLTag::i('video')
				->set('controls', false)
				->appendtagbody($webm)
				->appendtagbody($mp4)
				->appendtagbody($ogv);
			
			$preview->appendtagbody($video);
		}
		
		return $preview;
	}
	
	/**
	 * @return \mjolnir\types\HTMLTag
	 */
	function wrapper()
	{
		static $wrapper = null;

		if ($wrapper === null)
		{
			$this->ajax_dependencies();

			$langprefix = $this->langprefix('mjolnir:html/video-uploader/');

			$wrapper = \app\HTMLTag::i('div')
				->set('data-qq-uploader-context', '')
				->set('class', ['uploader-context image-uploader'])
				->set('data-upload-uploader-type', 'video')
				->set('data-uploader-action', \app\URL::href('mjolnir:html/qq-uploader.route', ['action' => 'upload_video']))
				->set('data-upload-button-upload', \app\Lang::key("{$langprefix}upload"))
				->set('data-upload-button-cancel', \app\Lang::key("{$langprefix}cancel"))
				->set('data-upload-fail-message', \app\Lang::key("{$langprefix}failed-to-upload"))
				->set('data-preview-id', $this->input->get('id').'_preview')
				->set('data-field-id', $this->input->get('id'));

			$this->input->set('name', $this->get('name', 'image'));

			$wrapper->appendtagbody($this->input);

			$wrapper->appendtagbody(\app\HTMLTag::i('div')->add('class', 'uploader-body')->tagbody_is(''));
		}

		return $wrapper;
	}

} # class
