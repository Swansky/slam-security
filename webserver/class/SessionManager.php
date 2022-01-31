<?php
session_start();

class SessionManager
{
    private static ?SessionManager $INSTANCE = null;


    public function isConnected(): bool
    {
        return (isset($_SESSION["logged"]) && $_SESSION["logged"] === true);
    }

    public function createSessionFor(User $user): void
    {
        $_SESSION["logged"] = true;
        $_SESSION["user"] = $user;
    }

    public function deleteSession(): void
    {
        session_destroy();
    }



    public static function GetInstance(): SessionManager
    {
        if (SessionManager::$INSTANCE == null) {
            SessionManager::$INSTANCE = new SessionManager();
        }
        return SessionManager::$INSTANCE;
    }
}