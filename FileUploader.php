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
	 * @return \app\SphinxSearch
	 */
	static function instance(array $extentions = null)
	{
		$instance = parent::instance();

		$fileuploader_config = \app\CFS::config('mjolnir/uploads');
		$allowedExtensions = $extentions !== null ? $extentions : $fileuploader_config['allowed_extensions'] ;
		$sizeLimit = $fileuploader_config['max_size'] ;
		$instance->fileuploader = new \app\FileUploader_QQUploader($allowedExtensions, $sizeLimit);

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
	 * @return \app\FileUpload $this
	 */
	function basepath_is($path)
	{
		$this->basepath = $path;
		return $this;
	}

	/**
	 * @return \app\FileUpload $this
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
