<?php
namespace def\View\Adapter\Twig;

use Twig_Environment as Twig;

trait TwigTrait
{
	/**
	 * @var Twig_Environment
	 */
	protected $twig;

	/**
	 * @return Twig_Environment
	 */
	public function twig()
	{
		return isset($this->twig) ? $this->twig : $this->twig = new Twig($this->getLoader());
	}

	abstract protected function getLoader();
}
