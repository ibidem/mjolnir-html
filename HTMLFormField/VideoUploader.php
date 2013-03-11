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
	 * @var array
	 */
	protected $previewsize = [ null, null ];
	
	/**
	 * @var boolean
	 */
	protected $show_controls = true;
	
	/**
	 * @return static $this
	 */
	function videokey_is($videokey)
	{
		$this->videokey = $videokey;
		return $this;
	}
	
	/**
	 * @return static $this
	 */
	function previewsize($width, $height)
	{		
		$this->previewsize = [ $width, $height ];
		return $this;
	}
	
	/**
	 * @return static $this
	 */
	function showcontrols()
	{
		$this->show_controls = true;
		return $this;
	}
	
	/**
	 * @return static $this
	 */
	function hidecontrols()
	{
		$this->show_controls = false;
		return $this;
	}
	
	/**
	 * @return \mjolnir\types\HTMLTag
	 */
	function makepreview()
	{
		$this->autocompletefield();
		
		$preview = \app\HTMLTag::i('div', '')
			->set('id', $this->input->get('id').'_preview');
			
		if ($this->videokey !== null)
		{
			$videowrapper = \app\HTMLTag::i('div')
				->set('class', 'video');
			
			$video = \app\HTMLTag::i('video')
				->set('width', $this->previewsize[0])
				->set('height', $this->previewsize[1]);
			
			if ($this->show_controls)
			{
				$video->set('controls', false);
			}
			
			$videowrapper->appendtagbody($video);
			
			$base = \app\CFS::config('mjolnir/base');
			$baseurl = $base['protocol'].$base['domain'].$base['path'];
			
			$formats = \app\CFS::config('mjolnir/uploads')['video.formats'];
			foreach ($formats as $format)
			{
				$source = \app\HTMLTag::i('source')
					->set('type', "video/$format")
					->set('src', "$baseurl{$this->videokey}.$format");
					
				$video->appendtagbody($source);
			}
			
			$preview->appendtagbody($videowrapper);
		}
		else # no preview required
		{
			$preview->add('class', 'off');
		}
		
		return $preview;
	}
	
	/**
	 * @return static $this
	 */
	function value_is($video)
	{
		$this->input->set('value', $video);
		
		if ( ! empty($video))
		{
			$videokey = \preg_replace('#\.[a-z0-9]+$#', '', $video);
			$this->videokey_is($videokey);
		}
		
		return $this;
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
				->set('data-preview-width', $this->previewsize[0])	
				->set('data-preview-height', $this->previewsize[1])	
				->set('data-preview-controls', $this->show_controls ? 'true' : 'false')	
				->set('data-field-id', $this->input->get('id'));

			$this->input->set('name', $this->get('name', 'image'));

			$wrapper->appendtagbody($this->input);

			$wrapper->appendtagbody(\app\HTMLTag::i('div')->add('class', 'uploader-body')->tagbody_is(''));
		}

		return $wrapper;
	}

} # class
