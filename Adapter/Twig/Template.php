<?php
namespace def\View\Adapter\Twig;

use def\View\View;
use def\View\Adapter\TemplateEngineAdapter;
use Twig_Loader_Filesystem as Loader;
use Twig_Error_Loader;

class Template extends TemplateEngineAdapter
{
	use TwigTrait;

	public function __construct()
	{
		View::__construct(function(array $data) {
			return $this->engine()->render("{$this->filename}.{$this->extension}", $data);
		});
	}

	public function addPath($path, $namespace = Loader::MAIN_NAMESPACE)
	{
		$this->engine()->getLoader()->addPath($path, $namespace);
		return parent::addPath($path);
	}

	public function prependPath($path, $namespace = Loader::MAIN_NAMESPACE)
	{
		$this->engine()->getLoader()->prependPath($path, $namespace);
		return parent::prependPath($path);
	}

	protected function getLoader()
	{
		return new Loader;
	}
}
