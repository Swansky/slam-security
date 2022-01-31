<?php


class NotFoundController implements Controller
{

    public function loadView()
    {
        ViewManager::view("notFound-template", []);
    }


    public function default(): void
    {
        $this->loadView();
    }

    public function setArgs(array $args = array())
    {
        //useless
    }
}