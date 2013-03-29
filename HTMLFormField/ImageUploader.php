<?php namespace mjolnir\html;

/**
 * @package    mjolnir
 * @category   Html
 * @author     Ibidem Team
 * @copyright  (c) 2013, Ibidem Team
 * @license    https://github.com/ibidem/ibidem/blob/master/LICENSE.md
 */
class HTMLFormField_ImageUploader extends \app\HTMLFormField implements \mjolnir\types\HTMLFormField_AjaxUploader
{
	use \app\Trait_HTMLFormField_AjaxUploader;

	/**
	 * @var string
	 */
	protected $imageurl = null;
	
	/**
	 * @var array
	 */
	protected $previewsize = [ 100, 100 ];
	
	/**
	 * Set the preview image.
	 *
	 * @return static $this
	 */
	function image_is($imageurl)
	{
		if ( ! empty($imageurl))
		{
			$this->imageurl = $imageurl;
			
			$this->preview->set
				(
					'src', 
					\app\URL::href
						(
							'mjolnir:thumbnail.route', 
							[ 
								'image'  => \app\CFS::config('mjolnir/base')['path'].$imageurl, 
								'width'  => $this->previewsize[0],
								'height' => $this->previewsize[1],
							]
						)
				);
		}

		return $this;
	}

	/**
	 * @return static $this
	 */
	function previewsize($width, $height)
	{		
		$this->previewsize = [ $width, $height ];
		
		if ($this->imageurl !== null)
		{
			$this->preview->set
				(
					'src', 
					\app\URL::href
						(
							'mjolnir:thumbnail.route', 
							[ 
								'image'  => \app\CFS::config('mjolnir/base')['path'].$this->imageurl, 
								'width'  => $width,
								'height' => $height,
							]
						)
				);
		}
		
		$this->preview
			->set('width', $width)
			->set('height', $width);

		$this->wrapper()
			->set('data-preview-width', $width)
			->set('data-preview-height', $height);

		return $this;
	}
	
	/**
	 * @return \mjolnir\types\HTMLTag
	 */
	function makepreview()
	{		
		return \app\HTMLTag::i('img')
			->set('id', $this->input->get('id').'_preview')
			->set('alt', '') # an empty value is the correct value
			->set('src', $this->imageurl);
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
			
			$langprefix = $this->langprefix('mjolnir:html/image-uploader/');

			$wrapper = \app\HTMLTag::i('div')
				->set('data-qq-uploader-context', '')
				->set('class', ['uploader-context image-uploader'])
				->set('data-upload-uploader-type', 'image')
				->set('data-uploader-action', \app\URL::href('mjolnir:html/qq-uploader.route', ['action' => 'upload_image']))
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
