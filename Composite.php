<?php
namespace def\View;

class Composite extends View
{
	/**
	 * @var View[]
	 */
	protected $views = [];

	public function fetch(array $data = [])
	{
		$data = \array_merge($data, $this->data);

		foreach($this->views as $key => $view) {
			$data[$key] = $view->fetch($data);
		}

		return parent::fetch($data);
	}

	/**
	 * @param View $view
	 * @param string|null $key
	 * @param boolean $append
	 * @return View
	 */
	public function attach(View $view, $key, $append = false)
	{
		if($append && isset($this->views[$key])) {
			$prev = $this->views[$key];
			$view = new View(function(array $data) use($view, $prev) {
				return $prev->fetch($data) . $view->fetch($data);
			});
		}

		return $this->views[$key] = $view;
	}

	public function detach($key)
	{
		unset($this->views[$key]);
	}

}
