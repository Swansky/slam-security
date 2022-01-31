<?php

class AuthManager
{
    private static ?AuthManager $INSTANCE = null;


    public static function getInstance(): AuthManager
    {
        if (AuthManager::$INSTANCE == null) {
            AuthManager::$INSTANCE = new AuthManager();
        }
        return AuthManager::$INSTANCE;
    }

    public function isConnected(): bool
    {
        return true;
    }
}