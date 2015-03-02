<?php
namespace def\View\Adapter\Smarty;

use Smarty;
use def\View\View;
use def\View\Adapter\TemplateEngineAdapter;

class Template extends TemplateEngineAdapter
{
	protected $smarty;

	public function __construct($path = null)
	{
		parent::__construct($path);

		View::__construct(function(array $data) {
			return $this->engine()->createTemplate("{$this->filename}.{$this->extension}", null, null, $data)->fetch();
		});
	}

	public function addPath($path)
	{
		parent::addPath($path);
		$this->engine()->setTemplateDir($this->paths);
		return $this;
	}

	public function prependPath($path)
	{
		parent::prependPath($path);
		$this->engine()->setTemplateDir($this->paths);
		return $this;
	}

	public function engine()
	{
		return isset($this->smarty) ? $this->smarty : $this->smarty = new Smarty;
	}
}
