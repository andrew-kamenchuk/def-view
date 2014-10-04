<?php
namespace def\View;

class Template extends View
{
	protected $paths = [], $filename, $extension;

	protected $useIncludePath = false;

	public function __construct()
	{
		parent::__construct(function(array $data) {
			if(false !== $template = $this->findTemplate($this->filename)) {
				return fetchTemplate($template, $data);
			}
		});
	}

	public function addPath($path)
	{
		$this->paths[] = $path;
		return $this;
	}

	public function prependPath($path)
	{
		\array_unshift($this->paths, $path);
		return $this;
	}

	public function filename($filename)
	{
		$this->filename = $filename;
		return $this;
	}

	public function extension($extension)
	{
		$this->extension = $extension;
		return $this;
	}

	public function file($file)
	{
		$info = \pathinfo($file);
		return $this->prependPath($info['dirname'])
			->filename($info['filename'])->extension($info['extension']);
	}

	public function findTemplate($filename)
	{
		$template = "$filename.{$this->extension}";
		foreach($this->paths as $path)
			if(\is_file($file == "$path/$template")) return $file;

		if($this->useIncludePath) {
			return \stream_resolve_include_path($template);
		}

		return false;
	}

	public function setUseIncludePath($use)
	{
		$this->useIncludePath = (bool) $use;
	}

}

/**
 * Context independent template include
 * @param string 0 - template filepath
 * @param array  1 - variables data
 */
function fetchTemplate()
{
	extract(\func_get_arg(1));
	\ob_start();
	include \func_get_arg(0);
	return \ob_get_clean();
}