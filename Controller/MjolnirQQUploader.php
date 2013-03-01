<?php namespace mjolnir\html;

/**
 * @package    mjolnir
 * @category   Html
 * @author     Ibidem Team
 * @copyright  (c) 2013, Ibidem Team
 * @license    https://github.com/ibidem/ibidem/blob/master/LICENSE.md
 */
class Controller_MjolnirQQUploader extends \app\Instantiatable implements \mjolnir\types\Controller
{
	use \app\Trait_Controller;

	/**
	 * @return 
	 */
	function json_upload()
	{
		$uploader = \app\FileUploader::instance();
		
		$ext = $uploader->ext();
		$uploader->basepath_is(PUBDIR);
		$idprefix = \app\Auth::role() !== \app\Auth::Guest ? 'u'.\app\Auth::id() : 'g'.\crc32(\app\Server::client_ip());
		$uploadpath = 'uploads/'.$idprefix.'__'.\uniqid('mjupload_', true).'.'.$ext;
		$uploader->uploadpath_is($uploadpath, true);
		
		//upload
		$result = $uploader->upload();
		$result["path"] = $uploadpath;

		return $result;
	}
	
} # class
