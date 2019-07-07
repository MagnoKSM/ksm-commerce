<?php

namespace MagnoKsm;

use Rain\Tpl;

class Page
{

    private $renderTpl;

    private $options = [];

    private $default = [
        'data' => []
    ];

    public function __construct($opts = [])
    {
        $this->options = array_merge($this->default, $opts);
        // config
        $config = array(
            "tpl_dir"       => $_SERVER['DOCUMENT_ROOT']."/views/",
            "cache_dir"     => $_SERVER['DOCUMENT_ROOT']."/views-cache/",
            "debug"         => true // set to false to improve the speed
        );

        Tpl::configure( $config );

        $this->renderTpl = new Tpl();

        $this->setDataToRender($this->options['data']);

        $this->renderTpl->draw('header');
    }

    private function setDataToRender($dataToRender)
    {
        foreach($dataToRender as $key => $value) {
            $this->renderTpl->assign($key, $value);
        }
    }

    public function setTpl($name, $dataToRender = [], $returnHtml = false)
    {
        $this->setDataToRender($dataToRender);

        return $this->renderTpl->draw($name, $returnHtml);
    }

    public function __destruct()
    {
        $this->renderTpl->draw('footer');
    }
}