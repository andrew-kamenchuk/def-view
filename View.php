<?php
namespace def\View;

class View
{
	use Data;

	/**
	 * @var callable|null
	 */
	protected $formatter;

	/**
	 * @param callable $formatter
	 */
	public function __construct(callable $formatter)
	{
		$this->formatter = $formatter;
	}

	public function disable()
	{
		$this->formatter = null;
	}

	/**
		* @param array $data
		* @return string
	 */
	public function fetch(array $data = [])
	{
		if(\is_callable($formatter = $this->formatter)) {
			return $formatter(\array_merge($data, $this->data));
		}
	}

	/**
	 * @return string
	 */
	public function __toString()
	{
		return $this->fetch();
	}

}
