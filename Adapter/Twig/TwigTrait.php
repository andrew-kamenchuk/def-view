<?php
namespace def\View\Adapter\Twig;

use Twig_Environment as Twig;

trait TwigTrait
{
	protected $twig;

	public function engine()
	{
		return isset($this->twig) ? $this->twig : $this->twig = new Twig($this->getLoader());
	}

	abstract protected function getLoader();
}
