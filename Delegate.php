<?php
namespace def\View;

class Delegate extends View
{
	/**
	 * @var View
	 */
	protected $view;

	public function __construct(callable $formatter)
	{
		parent::__construct(function(array $data) use($formatter) {
			return isset($this->view) ? $this->view->fetch($data) : $formatter($data);
		});
	}

	/**
	 * @param View|null $view
	 * @return View|null
	 */
	public function view(View $view = null)
	{
		return isset($view) ? $this->view = $view : $this->view;
	}
}
