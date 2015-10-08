<?php
namespace def\View;

class Delegate extends View
{
	/**
	 * @var View
	 */
	protected $view;

	/**
	 * @param View|null $view
	 * @return View|null
	 */
	public function view(View $view = null)
	{
		return isset($view) ? $this->view = $view : $this->view;
	}

	public function fetch(array $data = [])
	{
		if(isset($this->view))
			return $this->view->fetch(\array_merge($data, $this->data));

		return parent::fetch($data);
	}
}
