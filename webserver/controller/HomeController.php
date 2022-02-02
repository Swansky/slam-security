<?php

class HomeController extends Controller
{


    public function loadView()
    {
        ViewManager::view("home-template", []);
    }


    public function default()
    {
        $this->loadView();
    }


}