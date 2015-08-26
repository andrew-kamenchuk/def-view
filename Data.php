<?php
namespace def\View;

trait Data
{
	/**
	 * @var array
	 */
	protected $data = [];

	/**
	 * @var array
	 */
	protected $filters = [];

	/**
	 * @param string $key
	 * @param scalar $value
	 * @param callable[] $filters
	 */
	public function assign($key, $value, callable ...$filters)
	{
		foreach($filters as $filter) {
			$value = $filter($value);
		}

		$this->data[$key] = $value;
	}

	/**
	 * @param array $data
	 * @param callable[] $fiters
	 */
	public function assignArray(array $data, callable ...$filters)
	{
		foreach($filters as $filter) {
			$data = \array_map($filter, $data);
		}

		$this->data = \array_merge($this->data, $data);
	}

	/**
	 * @param string $key
	 * @return boolean
	 */
	public function assigned($key)
	{
		return isset($this->data[$key]) || array_key_exists($key, $this->data);
	}

	/**
	 * @param string $key
	 */
	public function remove($key)
	{
		unset($this->data[$key]);
	}

	/**
	 * @param string $key
	 */
	public function __get($key)
	{
		return $this->data[$key];
	}

	/**
	 * @param string $key
	 * @param scalar $value
	 */
	public function __set($key, $value)
	{
		$this->assign($key, $value);
	}

	/**
	 * @param string $key
	 */
	public function __isset($key)
	{
		return $this->assigned($key);	
	}

	/**
	 * @param string $key
	 */
	public function __unset($key)
	{
		$this->remove($key);
	}

	/**
	 * @param string $key
	 * @param callable|null $filter
	 */
	public function filter($key, callable $filter = null)
	{
		if(!isset($filter)) {
			return $this->filters[$key];
		}

		$this->filters[$key] = $filter;
	}

}
