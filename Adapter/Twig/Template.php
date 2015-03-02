<?php
namespace def\View\Adapter\Twig;

use def\View\View;
use def\View\Adapter\TemplateEngineAdapter;
use Twig_Loader_Filesystem as Loader;

class Template extends TemplateEngineAdapter
{
	use TwigTrait;

	public function __construct($path = null)
	{
		parent::__construct($path);

		View::__construct(function(array $data) {
			return $this->engine()->render("{$this->filename}.{$this->extension}", $data);
		});
	}

	public function addPath($path)
	{
		$this->engine()->getLoader()->addPath($path);
		return parent::addPath($path);
	}

	public function prependPath($path)
	{
		$this->engine()->getLoader()->prependPath($path);
		return parent::prependPath($path);
	}

	protected function getLoader()
	{
		return new Loader;
	}
}
