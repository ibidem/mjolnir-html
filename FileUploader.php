<?php namespace mjolnir\html;

/**
 * @package    mjolnir
 * @category   Html
 * @author     Ibidem Team
 * @copyright  (c) 2013, Ibidem Team
 * @license    https://github.com/ibidem/ibidem/blob/master/LICENSE.md
 */
class FileUploader extends \app\Instantiatable
{
	/**
	 * @var mixed
	 */
	protected $fileuploader;

	/**
	 * @var string
	 */
	protected $basepath;

	/**
	 * @var string
	 */
	protected $uploadpath;

	/**
	 * @var boolean
	 */
	protected $overwrite = false;

	/**
	 * @return static
	 */
	static function instance(array $extentions = null)
	{
		$instance = parent::instance();

		$fileuploader_config = \app\CFS::config('mjolnir/uploads');

		if ($extentions === null)
		{
			$filteredformats = \app\Arr::filter
				(
					$fileuploader_config['image.formats'],
					function ($i, $value)
					{
						return $value !== null;
					}
				);

			$extentions = \array_keys($filteredformats);
		}

		$size_limit = $fileuploader_config['upload.limit'] * 1024 * 1024;
		$instance->fileuploader = new \app\FileUploader_QQUploader($extentions, $size_limit);

		return $instance;
	}

	/**
	 * @return string
	 */
	function upload()
	{
		return $this->fileuploader
			->handleUpload
			(
				$this->uploadpath,
				$this->overwrite,
				$this->basepath
			);
	}

	/**
	 * @return static $this
	 */
	function basepath_is($path)
	{
		$this->basepath = $path;
		return $this;
	}

	/**
	 * @return static $this
	 */
	function uploadpath_is($path, $overwrite = false)
	{
		$this->uploadpath = $path;
		$this->overwrite = $overwrite;

		return $this;
	}

	/**
	 * @return string
	 */
	function ext()
	{
		return $this->fileuploader->get_extension();
	}

	/**
	 * @return string
	 */
	function filename()
	{
		return $this->fileuploader->getName();
	}

} # class
