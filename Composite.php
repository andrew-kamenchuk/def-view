<?php
namespace def\View;

class Composite extends View
{
    /**
     * @var View[][]
     */
    private $views = [];

    public function __construct(callable $formatter)
    {
        parent::__construct(function (array $data) use ($formatter) {
            $content = array_fill_keys(array_keys($this->views), "");

            foreach ($this->views as $key => $views) {
                foreach ($views as $view) {
                    $content[$key] .= $view->fetch($data);
                }
            }

            return $formatter(array_merge($data, $content));
        });
    }

    public function attach(View $view, $key, $append = false)
    {
        if ($append && isset($this->views[$key])) {
            $this->views[$key][] = $view;
        } else {
            $this->views[$key]   = [$view];
        }
    }

    public function detach($key, View $view = null)
    {
        if (!isset($this->views[$key])) {
            return;
        }

        if (!isset($view)) {
            unset($this->views[$key]);
        } elseif (false !== $pos = array_search($view, $this->views[$key], true)) {
            unset($this->views[$key][$pos]);
        }
    }
}
