<?php
namespace def\View;

class Strategy extends View
{
	protected $views = [];

	public function add($key, View $view)
	{
		$this->views[$key] = $view;
		return $this;
	}

	public function  has($key)
	{
		return isset($this->views[$key]);
	}

	public function fetch(array $data = [], $key = null)
	{
		if(isset($key))
			return $this->views[$key]->fetch(\array_merge($data, $this->data));

		return parent::fetch($data);
	}

	public function __clone()
	{
		parent::__clone();

		foreach($this->views as $key => $view) {
			$this->views[$key] = clone $view;
		}
	}
}
