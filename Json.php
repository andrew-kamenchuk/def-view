<?php
namespace def\View;

class Json extends View
{
    /**
     * @param int json options
     */
    private $options = 0;

    /**
     * @param int json encode depth
     */
    private $depth = 512;

    public function __construct()
    {
        parent::__construct(function (array $data) {
            return \json_encode($data, $this->options, $this->depth);
        });
    }

    /**
     * set json encode option
     *
     * @return void
     */
    public function setOption($option)
    {
        $this->options |= $option;
    }

    public function removeOption($option)
    {
        $this->options &= ~$option;
    }

    public function setPrettyPrint()
    {
        return $this->setOption(\JSON_PRETTY_PRINT);
    }
}
