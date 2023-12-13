<?php

namespace Draszanicus\logic;

class View
{
    private \Smarty $smarty;
    private array $context;
    public function __construct()
    {
        $this->smarty = new \Smarty();
        $this->smarty->setTemplateDir(ROOT_PATH . "/templates/view");
        $this->smarty->setCompileDir(ROOT_PATH . "/templates_c");
    }

    public function assign(string $name, $value): void{
        $this->context[$name] = $value;
    }

    public function setTemplate(string $path): void{
        $this->smarty->assign($this->context);
        $this->smarty->display($path);
    }
}