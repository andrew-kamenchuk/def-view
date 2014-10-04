<?php
namespace def\View;

class Delegate extends View
{
	protected $view;

	public function __construct(callable $formatter)
	{
		parent::__construct(function(array $data) use($formatter) {
			return isset($this->view) ? $this->view->fetch($data) : $formatter($data);
		});
	}

	public function view(View $view = null)
	{
		return 0 == \func_num_args() ? $this->view : $this->view = $view;
	}
}


