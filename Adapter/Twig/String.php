<?php
namespace def\View\Adapter\Twig;

use def\View\View;
use Twig_Loader_Array as Loader;

class String extends View
{
	use TwigTrait;

	protected $template;

	public function __construct()
	{
		parent::__construct(function(array $data) {
			return $this->twig()->createTemplate($this->template)->render($data);
		});
	}

	/**
	 * @param string $string
	 */
	public function template($string)
	{
		$this->template = $string;
		return $this;
	}

	/**
	 * @param string $string
	 */
	public function append($string)
	{
		return $this->template("{$this->template}{$string}");
	}

	/**
	 * @param string $string
	 */
	public function prepend($string)
	{
		return $this->template("{$string}{$this->template}");
	}

	protected function getLoader()
	{
		return new Loader([]);
	}
}
