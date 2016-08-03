<?php
namespace def\View;

class Strategy extends View
{
    /**
     * @var View[]
     */
    private $views = [];

    /**
     * @param string $key
     * @param View $view
     */
    public function add($key, View $view)
    {
        $this->views[$key] = $view;
    }

    /**
     * @param string|View $view
     * @return boolean
     */
    public function has($view)
    {
        if ($view instanceof View && false === $view = array_search($view, $this->views, true)) {
            return false;
        }

        return isset($this->views[$view]);
    }

    public function __construct(callable $formatter)
    {
        parent::__construct(function (array $data, $key) use ($formatter) {
            if (isset($key) && isset($this->views[$key])) {
                return $this->views[$key]->fetch($data);
            }

            return $formatter($data);
        });
    }

    /**
     * @param array $data
     * @param string $key
     * @return string
     */
    public function fetch(array $data = [], $key = null)
    {
        if (null !== $formatter = $this->formatter) {
            return $formatter(array_merge($this->data(), $data), $key);
        }
    }
}
