<?php

abstract class Controller
{
    protected array $args = array();

    public abstract function default();

    public function setArgs(array $args = array())
    {
        $this->args = $args;
    }
}