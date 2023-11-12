<?php
namespace controllers\traits;

trait RedirectTrait
{
    private function redirect($path)
    {
        header('Location: ' . $path);
    }
}