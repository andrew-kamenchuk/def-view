<?php
namespace def\View\Adapter\Smarty;

use Smarty;
use def\View\View;
use def\View\Template as Base;

class Template extends TemplateEngineAdapter
{
	protected $smarty;

	public function __construct()
	{
		View::__construct(function(array $data) {
			return $this->smarty()->createTemplate("{$this->filename}.{$this->extension}", null, null, $data)->fetch();
		});
	}

	public function addPath($path)
	{
		parent::addPath($path);
		$this->smarty()->setTemplateDir($this->paths);
		return $this;
	}

	public function prependPath($path)
	{
		parent::prependPath($path);
		$this->smarty()->setTemplateDir($this->paths);
		return $this;
	}

	public function smarty()
	{
		return isset($this->smarty) ? $this->smarty : $this->smarty = new Smarty;
	}
}
