<?php namespace mjolnir\html;

require_once \app\CFS::dir('vendor/qq-uploader').'php.php';

/**
 * @package    mjolnir
 * @category   Html
 * @author     Ibidem Team
 * @copyright  (c) 2013, Ibidem Team
 * @license    https://github.com/ibidem/ibidem/blob/master/LICENSE.md
 */
class FileUploader_QQUploader extends \qqFileUploader
{
	/**
	 * @return string
	 */
	public function get_extension()
	{
		$pathinfo = \pathinfo($this->getName());

		if (isset($pathinfo['extension']))
		{
			return $pathinfo['extension'];
		}
		else # no extention
		{
			return null;
		}
	}

	/**
	 * @return array
	 */
	function handleUpload($upload_path, $replace_existing_file = false, $base_path = null)
	{
		if ($base_path === null)
		{
			if (\app\Env::key('www.path'))
			{
				$base_path = \app\Env::key('www.path');
			}
			else # no public directory defined
			{
				throw new \app\Exception('www path is not defined in current context.');
			}
		}

		$pathinfo_dest = \pathinfo($base_path.$upload_path);

		if ( ! \is_writable($pathinfo_dest['dirname']))
		{
			\mjolnir\log('Uploads', "Unwritable directory: {$pathinfo_dest['dirname']}");
			return [ 'error' => \app\Lang::term('Server error. Upload directory isn\'t writable.') ];
		}

		if ( ! $this->file)
		{
			\mjolnir\log('Uploads', "No files were uploaded");
			return [ 'error' => \app\Lang::term('No files were uploaded.') ];
		}

		$size = $this->file->getSize();

		if ($size == 0)
		{
			\mjolnir\log('Uploads', "Empty file");
			return [ 'error' => \app\Lang::term('File is empty') ];
		}

		if ($size > $this->sizeLimit)
		{
			\mjolnir\log('Uploads', "File is too large. ($size > $this->sizeLimit)");
			return [ 'error' => \app\Lang::term("File is too large.") ];
		}

		$pathinfo = \pathinfo($this->file->getName());

		if (isset($pathinfo['extension']))
		{
			$ext = $pathinfo['extension'];
		}
		else # extention
		{
			$ext = null;
		}

		if ( ! empty($this->allowedExtensions) && ! \in_array(\strtolower($ext), $this->allowedExtensions))
		{
			$allowed_extentions = \implode(', ', $this->allowedExtensions);
			\mjolnir\log('Uploads', \app\Lang::key('mjolnir:html/uploader/filetype-not-allowed', ['extention' => \strtolower($ext), 'allowed_extensions' => $allowed_extentions]));
			return [ 'error' => \app\Lang::key('mjolnir:html/uploader/filetype-not-allowed', ['extention' => \strtolower($ext), 'allowed_extensions' => $allowed_extentions]) ];
		}

		if ( ! $replace_existing_file)
		{
			throw new \app\Exception('File already exists.');
		}

		$filename_dest = $pathinfo_dest['filename'];

		if (isset($pathinfo_dest['extention']))
		{
			$ext_dest = $pathinfo_dest['extension'];
		}
		else # extention not defined
		{
			$ext_dest = null;
		}

		$this->uploadName = $filename_dest.'.'.$ext_dest;

		if ($this->file->save($base_path.$upload_path))
		{
			return [ 'success' => true ];
		}
		else # got error
		{
			\mjolnir\log('Uploads', 'Could not save uploaded file: '.$base_path.$upload_path);
			return [ 'error'=> \app\Lang::term('Could not save uploaded file.') ];
		}

	}

} # class
