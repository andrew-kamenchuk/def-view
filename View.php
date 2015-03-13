<?php
namespace def\View;

class View
{
	protected $formatter, $data = [];

	protected $filters = [];

	public function __construct(callable $formatter)
	{
		$this->formatter = $formatter;
	}

	public function disable()
	{
		$this->formatter = null;
	}

	public function fetch(array $data = [])
	{
		if(\is_callable($formatter = $this->formatter))
			return $formatter(\array_merge($data, $this->data));
	}

	public function __toString()
	{
		return $this->fetch();
	}

	public function __clone()
	{
		$this->data = [];
	}

	public function filter($key, callable $filter = null)
	{
		if(1 == \func_num_args())
			return $this->filters[$key];

		if(isset($filter)) 
			$this->filters[$key] = $filter;

		return $this;
	}

	public function assign($key, $value, callable $filter = null/**, $filter, ...*/)
	{
		foreach (\array_slice(\func_get_args(), 2) as $filter) {
			if(\is_callable($filter)) $value = $filter($value);
		}

		$this->data[$key] = $value;
		return $this;
	}

	public function __set($key, $value)
	{
		$this->assign($key, $value);
	}

	public function assignArray(array $data, callable $filter = null/**, $filter, ...*/)
	{
		foreach (\array_slice(\func_get_args(), 1) as $filter) {
			$data = \array_map($filter, $data);
		}

		$this->data = \array_merge($this->data, $data);
		return $this;
	}

	public function assigned($key)
	{
		return \array_key_exists($key, $this->data);
	}

	public function __get($key)
	{
		return $this->data[$key];
	}
}
