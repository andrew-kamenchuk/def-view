<?php
namespace def\View;

class Composite extends View
{
	protected $views = [];

	public function __construct(callable $formatter)
	{
		parent::__construct(function(array $data) use($formatter) {
			$content = [];
			foreach($this->views as $key => $view) {
				$content[$key] = $view->fetch($data);
			}
			return $formatter(\array_merge($data, $content));
		});
	}

	public function __clone()
	{
		parent::__clone();

		foreach($this->views as $key => $view) {
			$this->views[$key] = clone $view;
		}
	}

	public function attach(View $view, $key = null, $append = false)
	{
		if(!isset($key)) {
			$this->views[] = $view;
		} elseif($append && isset($this->views[$key])) {
			$old = $this->views[$key];
			$this->views[$key] = new View(function(array $data) use($old, $view) {
				return $old->fetch($data) . $view->fetch($data);
			});
		} else {
			$this->views[$key] = $view;
		}

		return $this;
	}

	public function detach($key)
	{
		unset($this->views[$key]);
		return $this;
	}

	public function has($key)
	{
		return isset($this->views[$key]);
	}
}
