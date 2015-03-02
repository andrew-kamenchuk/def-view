<?php
namespace def\View\Adapter;

use def\View\Template;

abstract class TemplateEngineAdapter extends Template
{
	abstract public function engine();
}
