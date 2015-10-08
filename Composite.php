<?php
namespace def\View;

class Composite extends View
{
	/**
	 * @var View[][]
	 */
	protected $views = [];

	public function fetch(array $data = [])
	{
		$data = \array_merge($data, $this->data);

		foreach($this->views as $key => $views) {

			$content = '';

			foreach($views as $view) {
				$content .= $view->fetch($data);
			}

			$data[$key] = $content;
		}

		return parent::fetch($data);
	}

	/**
	 * @param View $view
	 * @param string|null $key
	 * @param boolean $append
	 */
	public function attach(View $view, $key, $append = false)
	{
		if($append) {
			$this->views[$key][] = $view;
		} else {
			$this->views[$key]   = [$view];
		}
	}

	/**
	 * @param string $key
	 * @param View|null $view
	 */
	public function detach($key, View $view = null)
	{
		if(!isset($this->views[$key])) {
			return;
		}

		if(!isset($view)) {
			unset($this->views[$key]);
		} elseif(false !== $pos = \array_search($view, $this->views[$key], true)) {
			unset($this->views[$key][$pos]);
		}
	}

}
