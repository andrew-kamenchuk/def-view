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

	/**
	 * @param string|boolean $cache
	 * @param boolean $autorealod
	 */
	public function setCache($cache, $autoreload = false)
	{
		$this->twig()->setCache($cache);

		if(false !== $cache) {
			if($autoreload)
				$this->twig()->enableAutoReload();
			else
				$this->twig()->disableAutoReload();
		}
	}

	/**
	 * @param boolean $debug
	 */
	public function setDebug($debug = true)
	{
		if($debug) {
			$this->twig()->enableDebug();
			$this->twig()->addExtension(new \Twig_Extension_Debug);
		} else {
			$this->twig()->disableDebug();
		}
	}

	/**
	 * @param string $charset
	 */
	public function setCharset($charset)
	{
		$this->twig()->setCharset($charset);
	}

	/**
	 * @param boolean $strict
	 */
	public function setStrictVariables($strict = true)
	{
		if($strict) {
			$this->twig()->enableStrictVariables();
		} else {
			$this->twig()->disableStrictVariables();
		}
	}

	/**
	 * @see \Twig_SimpleFilter::__construct
	 */
	public function addFilter($name, callable $filter, array $options = [])
	{
		$this->twig()->addFilter(new \Twig_SimpleFilter($name, $filter, $options));
	}

	/**
	 * @see \Twig_SimpleFunction::__construct
	 */
	public function addFunction($name, callable $function, array $options = [])
	{
		return $this->twig()->addFunction(new \Twig_SimpleFunction($name, $function, $options));
	}

	/**
	 * @param \Twig_ExtensionInterface $extension
	 */
	public function addExtension(\Twig_ExtensionInterface $extension)
	{
		$this->twig()->addExtension($extension);	
	}

	/**
	 * @return Twig_LoaderInreface
	 */
	abstract protected function getLoader();
}
