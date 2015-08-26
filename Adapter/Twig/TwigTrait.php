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

		if($cache) {
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
	 * @return Twig_LoaderInreface
	 */
	abstract protected function getLoader();
}
