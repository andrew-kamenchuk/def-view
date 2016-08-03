<?php
namespace def\View;

class View
{
    /**
     * @var callable|null
     */
    private $formatter;

    /**
     * @var mixed[]
     */
    private $data = [];

    /**
     * @var callable[]
     */
    private $filters = [];

    /**
     * @param mixed callable $formatter
     */
    public function __construct(callable $formatter)
    {
        $this->formatter = $formatter;
    }

    public function disable()
    {
        $this->formatter = null;
    }

    public function __toString()
    {
        return $this->fetch();
    }

    public function fetch(array $data = [])
    {
        if (null !== $formatter = $this->formatter) {
            return $formatter(array_merge($this->data, $data));
        }
    }

    public function data()
    {
        return $this->data;
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public function assign($key, $value, callable ...$filters)
    {
        foreach ($filters as $filter) {
            $value = $filter($value);
        }

        $this->data[$key] = $value;
    }

    public function assignArray(array $data, callable ...$filters)
    {
        foreach ($filters as $filter) {
            $data = array_map($filter, $data);
        }

        $this->data = array_merge($this->data, $data);
    }

    public function filter($key, callable $filter = null)
    {
        if (isset($filter)) {
            $this->filters[$key] = $filter;
        }

        return $this->filters[$key];
    }

    public function assigned($key)
    {
        return isset($this->data[$key]) || array_key_exists($this->data[$key]);
    }
}
