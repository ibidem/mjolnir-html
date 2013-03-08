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
	 * @return array
	 */
	function json_upload_image()
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
	
	/**
	 * @return array
	 */
	function json_upload_video()
	{
		\set_time_limit(\app\CFS::config('mjolnir/uploads')['video.timeout']);
		
		$videoformats = \app\Arr::filter
			(
				\app\CFS::config('mjolnir/uploads')['video.formats'],
				function ($ext, $mime)
				{
					return $mime !== null;
				}
			);
			
		$uploader = \app\FileUploader::instance(\array_keys($videoformats));
		
		$ext = \strtolower($uploader->ext());
		$uploader->basepath_is(PUBDIR);
		$idprefix = \app\Auth::role() !== \app\Auth::Guest ? 'u'.\app\Auth::id() : 'g'.\crc32(\app\Server::client_ip());
		$basepath = 'uploads/'.$idprefix.'__'.\uniqid('mjupload_', true).'.';
		$uploadpath = $basepath.$ext;
		$uploader->uploadpath_is($uploadpath, true);
		
		//upload
		$result = $uploader->upload();
		$result["path"] = $uploadpath;

		foreach ($videoformats as $format => $mime)
		{
			if ($format !== $ext)
			{
				\app\VideoConverter::convert(PUBDIR.$uploadpath, PUBDIR.$basepath.$format);
			}
		}
		
		return $result;
	}
	
} # class
