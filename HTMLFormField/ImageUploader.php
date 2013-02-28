<?php namespace mjolnir\html;

/**
 * @package    mjolnir
 * @category   Html
 * @author     Ibidem Team
 * @copyright  (c) 2013, Ibidem Team
 * @license    https://github.com/ibidem/ibidem/blob/master/LICENSE.md
 */
class HTMLFormField_ImageUploader extends \app\HTMLFormField implements \mjolnir\types\HTMLFormField_ImageUploader
{
	use \app\Trait_HTMLFormField_ImageUploader;

	// ------------------------------------------------------------------------
	// interface: Renderable
	
	/**
	 * @return string
	 */
	function render()
	{
		$channel = $this->channel();
		
		if ($this->channel() === null)
		{
			throw new \app\Exception('A channel is required for rendering '.__CLASS__);
		}
		
		/* @var $htmllayer \app\Layer_HTML */
		$htmllayer = $channel->get('layer:html');
		
		if ($htmllayer === null)
		{
			throw new \app\Exception('Rendering outside of a HTML context not supported. Please check the layer stack.');
		}
		
		$htmllayer->add
			(
				'script',
				[
					'type' => 'application/javascript',
					'src' => \app\URL::href
						(
							'mjolnir:theme/themedriver/javascript.route',
							[
								'theme'   => 'mjolnir/html',
								'version' => \app\Theme::instance()->version(),
								'target'  => 'qq-uploader',
							]
						)
				]
			);
		
		$htmllayer->add
			(
				'stylesheet',
				[
					'type' => 'text/css',
					'href' => \app\URL::href
						(
							'mjolnir:theme/themedriver/style.route',
							[
								'theme'   => 'mjolnir/html',
								'style'   => 'utilities',
								'version' => \app\Theme::instance()->version(),
								'target'  => 'qq-uploader',
							]
						)
				]
			);
		
		$wrapper = \app\HTMLTag::i('div')
			->set('class', ['uploader-context image-uploader'])
			->set('data-uploader-name', $this->get('name'))
			->set('data-uploader-action', \app\URL::href('qq-uploads.json', ['action' => 'upload']))
			->set('data-upload-form', $this->form()->get('id'))
			->set('data-upload-image-uploader', 'true')
				
			->set('data-upload-button-upload', \app\Lang::key("{$langprefix}upload"))
			->set('data-upload-button-cancel', \app\Lang::key("{$langprefix}cancel"))
			->set('data-upload-fail-message', \app\Lang::key("{$langprefix}failed-to-upload"))
				
			->set('data-upload-button-upload', \app\Lang::tr('Upload'))
			->set('data-upload-button-cancel', \app\Lang::tr('Cancel'))
			->set('data-upload-fail-message', \app\Lang::tr('Failed to upload file.'));
		
		return '#';
	}
	
} # class
