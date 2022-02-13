<?php
declare(strict_types=1);


class Router
{
    private SessionManager $authManager;

    public function __construct()
    {
        $this->authManager = SessionManager::GetInstance();
        $this->routing();
    }

    private function routing(): void
    {
        if ($this->authManager->isConnected()) {
            $decodedURL = $this->decodeURL();
            $this->callController($decodedURL);
        } else {
            Router::RedirectTo('auth', 'login');
        }
    }

    private function decodeURL(): ?DecodedURL
    {
        $decodedURL = new DecodedURL();
        $currentUrl = $_SERVER['REQUEST_URI'];
        if ($currentUrl === '/') {
            $decodedURL->setControllerName("Home");
        } else {
            if (str_ends_with($currentUrl, "/")) {
                $currentUrl = substr($currentUrl, 0, -1);
            }

            $url_split = explode("/", substr($currentUrl, 1));
            $decodedURL->setControllerName($url_split[0]);
            if (sizeof($url_split) > 1) {
                $decodedURL->setActionName($url_split[1]);
                if (sizeof($url_split) > 2) {
                    $param = array();
                    for ($i = 2; $i <= sizeof($url_split)-1; $i++) {
                        $param[] = $url_split[$i];
                    }
                    $decodedURL->setParam($param);
                }
            }
        }

        return $decodedURL;
    }

    private static function callController(DecodedURL $decodedURL): void
    {
        if ($decodedURL->getControllerName() === '' || !Router::IsControllerExist($decodedURL->getControllerName())) {
            $controller = new NotFoundController();
            $controller->default();

        } else {
            $controllerClassName = Router::GetControllerClassName($decodedURL->getControllerName());
            $controller = new $controllerClassName();
            if (Router::IsValidAction($controller, $decodedURL->getActionName())) {
                $actionName = $decodedURL->getActionName();
                $controller->$actionName();
                $controller->setArgs($decodedURL->getParam());
            } else {
                $controller->default();
            }
        }
    }

    public static function IsControllerExist(string $controllerName): bool
    {
        return file_exists(Settings::BASE_PATH . '/controller/' . $controllerName . 'Controller.php');
    }

    private static function GetControllerClassName(string $pathName): string
    {
        return $pathName . "Controller";
    }

    private static function IsValidAction(Controller $controller, string $actionName): bool
    {
        return method_exists($controller, $actionName);
    }


    public static function RedirectTo(string $controllerNameToRedirect, string $actionToRedirect = 'default', array $params = array()): void
    {
        $decodedURL = new DecodedURL();
        $decodedURL->setControllerName($controllerNameToRedirect);
        $decodedURL->setActionName($actionToRedirect);
        $decodedURL->setParam($params);
        Router::callController($decodedURL);
    }
}