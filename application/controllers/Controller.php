<?php

namespace application\controllers;

abstract class Controller
{
    public function __construct($action)
    {
        $view = $this->$action();
        require_once $this->getView($view);
    }

    protected function addAttribute($key, $val)
    {
        $this->$key = $val;
    }

    protected function getView($view)
    {
        if (strpos($view, "redirect:") === 0) {
            header("Location: " . substr($view, 9));
            return;
        }
        return _VIEW . "/" . $view; // "" 없고, $도 없고 문자가 다 대문자면 상수다.
    }
}
