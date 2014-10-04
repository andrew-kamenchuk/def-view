<?php
namespace def\View;

class Json extends View
{
	protected $options = 0;

	public function __construct()
	{
		parent::__construct(function(array $data) {
			return \json_encode($data, $this->options);
		});
	}

	public function setOption($option)
	{
		$this->options |= $option;
	}

	public function hasOption($option)
	{
		return (bool) $this->options & $option;
	}

	public function removeOption($option)
	{
		$this->options &= ~$option;
	}
}
