<?php
namespace def\View;

class Composite extends View
{
	/**
	 * @var View[]
	 */
	protected $views = [];

	public function __construct(callable $formatter)
	{
		parent::__construct(function(array $data) use($formatter) {
			$partial = [];
			foreach($this->views as $key => $view) {
				$partial[$key] = $view->fetch($data);
			}
			return $formatter(\array_merge($data, $partial));
		});
	}

	/**
	 * @param View $view
	 * @param string|null $key
	 * @param boolean $append
	 * @return View
	 */
	public function attach(View $view, $key = null, $append = false)
	{
		if(!isset($key)) {
			$this->views[] = $view;
		} elseif($append && isset($this->views[$key])) {
			$prev = $this->views[$key];

			$this->views[$key] = new View(function(array $data) use($view, $prev) {
				return $prev->fetch($data) . $view->fetch($data);
			});

		} else {
			$this->views[$key] = $view;
		}

		return $view;
	}

	public function detach($key)
	{
		unset($this->views[$key]);
	}

}
