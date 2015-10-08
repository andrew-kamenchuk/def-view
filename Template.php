<?php
namespace def\View;

class Template extends View
{
	/**
	 * @var string[] $paths
	 * @var string filename
	 * @var string $extension
	 */
	protected $paths = [], $filename, $extension;

	/**
	 * @var boolean
	 */
	protected $useIncludePath = false;

	public function __construct()
	{
		parent::__construct(function(array $data) {
			if(false !== $template = $this->findTemplate($this->filename)) {
				return static::fetchTemplate($template, $data);
			}
		});
	}

	protected static function fetchTemplate()
	{
		\extract(\func_get_arg(1));
		if(!\ob_start()) {
			return;
		}
		include \func_get_arg(0);
		return \ob_get_clean();
	}

	/**
	 * @var string $path
	 * @return self
	 */
	public function addPath($path)
	{
		$this->paths[] = \rtrim($path, '\\/');
		return $this;
	}

	/**
	 * @var string $path
	 * @return self
	 */
	public function prependPath($path)
	{
		\array_unshift($this->paths, \rtrim($path, '\\/'));
		return $this;
	}

	/**
	 * @var string $filename
	 * @return self
	 */
	public function filename($filename)
	{
		$this->filename = $filename;
		return $this;
	}

	/**
	 * @var string $extension
	 * @return self
	 */
	public function extension($extension)
	{
		$this->extension = $extension;
		return $this;
	}

	/**
	 * @var string $file
	 * @return self
	 */
	public function file($file)
	{
		$info = \pathinfo($file);
		return $this->prependPath($info['dirname'])
			->filename($info['filename'])->extension($info['extension']);
	}

	/**
	 * @var string $filename
	 * @return string|boolean 
	 */
	protected function findTemplate($filename)
	{
		$template = "$filename.{$this->extension}";
		foreach($this->paths as $path)
			if(\is_file($file = "$path/$template")) return $file;

		if($this->useIncludePath) {
			return \stream_resolve_include_path($template);
		}

		return false;
	}

	/**
	 * @var boolean $use
	 */
	public function setUseIncludePath($useIncludePath = true)
	{
		$this->useIncludePath = $useIncludePath;
	}

}
