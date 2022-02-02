<?php
declare(strict_types=1);

class AuthController extends Controller
{
    private SessionManager $authManager;

    public function __construct()
    {
        $this->authManager = SessionManager::GetInstance();
    }


    public function login(): void
    {
        if ($this->authManager->isConnected()) {
            Router::RedirectTo('home');
            return;
        }
        if (isset($_POST["email"]) && isset($_POST["password"])) {
            $username = ParamUtils::findPOSTParam('email');
            $password = ParamUtils::findPOSTParam('password');

            if (empty($username) || empty($password)) {
                ViewManager::view("login-template",
                    ["ERROR_MESSAGE" => "Empty credentials",
                        "HIDDEN" => ""]);
                return;
            }
            $user = $this->getUser($username);
            if (!is_null($user)) {
                if ($user->checkCredentials($username, $password)) {
                    $this->authManager->createSessionFor($user);
                    Router::RedirectTo("Home");
                    return;
                }
            }
            ViewManager::view("login-template",
                ["ERROR_MESSAGE" => "Invalid Credentials"]);
            return;
        }

        ViewManager::view("login-template",
            ["ERROR_MESSAGE" => ""]);
    }

    public function logout(): void
    {
        $this->authManager->deleteSession();
        Router::RedirectTo('auth', 'login');
    }

    private function checkCredentials(User $user, string $username, string $password): bool
    {

        return true;
    }

    public function default()
    {
        $this->login();
    }

    public function getUser(string $email): ?User
    {
        $user = new User();
        if ($user->findByEmail($email)) {
            return $user;
        }
        return null;
    }

    static function isLoggedIn(): bool
    {
        return isset($_SESSION['utilisateur_id']);
    }

}