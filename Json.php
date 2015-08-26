<?php
namespace def\View;

class Json extends View
{
	/**
	 * @var $options
	 */
	protected $options = 0;

	public function __construct()
	{
		parent::__construct(function(array $data) {
			return \json_encode($data, $this->options);
		});
	}

	/**
	 * @param int $option
	 */
	public function setOption($option)
	{
		$this->options |= $option;
	}

	/**
	 * @param int $option
	 */
	public function removeOption($option)
	{
		$this->options &= ~$option;	
	}

	public function setPrettyPrint()
	{
		return $this->setOption(\JSON_PRETTY_PRINT);
	}

	public function setUnescapedSlashes()
	{
		return $this->setOption(\JSON_UNESCAPED_SLASHES);
	}

	public function setUnescapedUnicode()
	{
		return $this->setOption(\JSON_UNESCAPED_UNICODE);
	}
}
