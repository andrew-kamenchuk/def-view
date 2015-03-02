<?php
namespace def\View\Adapter\Twig;

use def\View\View;
use Twig_Loader_String as Loader;

class String extends View
{
	use TwigTrait;

	protected $template;

	public function __construct($template = null)
	{
		$this->template($template);

		parent::__construct(function(array $data) {
			return $this->engine()->render($this->template, $data);
		});
	}

	public function template($string)
	{
		$this->template = (string) $string;
		return $this;
	}

	public function append($string)
	{
		return $this->template("{$this->template}{$string}");
	}

	public function prepend($string)
	{
		return $this->template("{$string}{$this->template}");
	}

	protected function getLoader()
	{
		return new Loader;
	}
}
