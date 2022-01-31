<?php

class HomeController implements Controller
{
    private array $args = array();

    public function loadView()
    {
        ViewManager::view("home-template", []);
    }


    public function default()
    {
        var_dump("homeController");
        $this->loadView();
    }

    public function setArgs(array $args = array())
    {
        $this->args = $args;
    }
}