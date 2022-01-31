<?php

class CommentController implements Controller
{

   // private array $args = [];
    public function loadView()
    {
        //  $bdd = new Database();
        //  $bdd->connect();
        $comments = [["title" => "je suis un titre", "content" => "contenu", "date" => "12/03/2000 12:10:02"]];
        ViewManager::view("comment-template", ["comments" => $comments]);
    }


    public function default()
    {
        $this->loadView();
    }

    public function setArgs(array $args = array())
    {
        //useless for the moment
        //$this->args = $args;
    }
}
