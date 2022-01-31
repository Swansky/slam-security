<?php

class DecodedURL
{
    private string $controllerName;
    private string $actionName;
    private array $param;


    public function __construct()
    {
        $this->controllerName = "";
        $this->actionName = "";
        $this->param = array();
    }


    /**
     * @return string
     */
    public function getControllerName(): string
    {
        return $this->controllerName;
    }

    /**
     * @param string $controllerName
     */
    public function setControllerName(string $controllerName): void
    {
        $this->controllerName = $controllerName;
    }

    /**
     * @return string
     */
    public function getActionName(): string
    {
        return $this->actionName;
    }

    /**
     * @param string $actionName
     */
    public function setActionName(string $actionName): void
    {
        $this->actionName = $actionName;
    }

    /**
     * @return array
     */
    public function getParam(): array
    {
        return $this->param;
    }

    /**
     * @param array $param
     */
    public function setParam(array $param): void
    {
        $this->param = $param;
    }


}