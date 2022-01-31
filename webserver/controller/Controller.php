<?php

interface Controller
{
    public function default();

    public function setArgs(array $args = array());
}