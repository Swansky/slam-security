<?php

class Database
{
    private static ?Database $INSTANCE = null;
    private static ?PDO $PDO;


    public function __construct()
    {
        $dbConfig = new DbConfig();
        try {
            self::$PDO = new PDO('mysql:host=' . $dbConfig->getHost() .
                ';dbname=' . $dbConfig->getDBName() .
                ';charset=' . $dbConfig->getCharset(),
                $dbConfig->getUser(),
                $dbConfig->getPassword());
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public static function Connect(): PDO
    {
        if (is_null(self::$INSTANCE)) {
            self::$INSTANCE = new Database();
        }

        return self::$PDO;
    }

}