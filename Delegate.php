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
		if(0 == \func_num_args()) {
			return $this->view;
		}

		return $this->view = $view;
	}

	public function fetch(array $data = [])
	{
		if(isset($this->view))
			return $this->view->fetch(\array_merge($data, $this->data));

		return parent::fetch($data);
	}
}
