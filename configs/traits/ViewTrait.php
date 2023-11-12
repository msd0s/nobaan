<?php
namespace configs\traits;

trait ViewTrait
{
    private function view($themeFileName,$parameters)
    {
        return include_once $this->config['root_dir'].'views/'.$themeFileName;
    }
}