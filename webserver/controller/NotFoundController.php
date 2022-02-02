<?php


class NotFoundController extends Controller
{

    public function loadView()
    {
        ViewManager::view("notFound-template", []);
    }


    public function default(): void
    {
        $this->loadView();
    }

}