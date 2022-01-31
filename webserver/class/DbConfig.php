<?php

class DbConfig
{

    private const  FILE_PATH = 'dbconfig.json';
    private array $dataJson;
    private string $host;
    private string $dbName;
    private string $charset;
    private string $user;
    private string $password;

    public function __construct()
    {
        $this->dataJson = $this->readJSONConfig(DbConfig::FILE_PATH);
        $this->host = $this->dataJson['host'];
        $this->dbName = $this->dataJson['databasename'];
        $this->charset = $this->dataJson['charset'];
        $this->user = $this->dataJson['user'];
        $this->password = $this->dataJson['password'];
    }

    private function readJSONConfig(string $filePath): array
    {
        $sConfig = file_get_contents($filePath);
        $aConfigDB = json_decode($sConfig, true);
        return ($aConfigDB);
    }

    public function getHost()
    {
        return ($this->host);
    }

    public function getDBName()
    {
        return ($this->dbName);
    }

    public function getCharset()
    {
        return ($this->charset);
    }

    public function getUser()
    {
        return ($this->user);
    }

    public function getPassword()
    {
        return ($this->password);
    }


}


