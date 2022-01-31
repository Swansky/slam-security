<?php
declare(strict_types=1);
session_start();
class User{

    private string $password;
    private string $username;
    private int $id;
    public function __construct(){
        $this->username = 'admin';
        $this->password = 'admin';
        $this->id = 1;
    }
    public function getUsername(): string{
        return $this->username;
    }
    public function getPassword(): string{
        return $this->password;
    }
    public function getId(): int{
        return $this->id;
    }
}
class AuthController extends Controller
{
    private User $user;


    public function __construct()
    {
        $this->user = new User();

    }
    /**
     * @throws Exception
     */
    public function login(): void
    {

        if (isset($_SESSION['utilisateur_id'])) {
            Router::RedirectTo('home');
        }
        $username = ParamUtils::findPOSTParam('username');
        $password = ParamUtils::findPOSTParam('password');

        if (empty($username) || empty($password)) {
            ViewManager::view("login-template",
                ["ERROR_MESSAGE" => "Empty credentials",
                    "HIDDEN" => ""]);
        }

        if ($this->checkCredentials($username, $password)) {
            $user = $this->getUser($username, $password);
            $_SESSION['utilisateur_id'] = $user->getId();
            $_COOKIE["token"] = md5($user->getUsername() . ":" . $user->getPassword());
            header("Location:home");
        }
        ViewManager::view("login-template",
            ["ERROR_MESSAGE" => ""]);
    }

    public function logout(): void
    {
        session_destroy();
        unset($_COOKIE["token"]);
        header("Location:login");
        Router::RedirectTo('login');
        unset($this);
    }

    private function checkCredentials(string $username, string $password): bool
    {
        return true;
    }

    public function default()
    {
        $this->login();
    }
    public function createCookie(){
        setcookie('auth',"",3600, "","",false,true);
    }

    public function getUser(string $username, string $password) : User
    {
        $user = new User();
        $user->getUsername($username);
        $user->getPassword($password);
        return $user;
    }
    static function isLoggedIn(): bool
    {
        return isset($_SESSION['utilisateur_id']);
    }
}