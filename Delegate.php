<?php
namespace def\View;

class Delegate extends View
{
    /**
     * @var View|null
     */
    private $view;

    public function setView(View $view)
    {
        $this->view = $view;
    }

    public function __construct(callable $formatter)
    {
        parent::__construct(function (array $data) use ($formatter) {
            if (isset($this->view)) {
                return $this->view->fetch($data);
            }

            return $formatter($data);
        });
    }
}
