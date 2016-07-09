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

    public function fetch(array $data = [])
    {
        if (isset($this->view)) {
            return $this->view->fetch(\array_merge($this->data, $data));
        }

        return parent::fetch($data);
    }
}
