<?php
declare(strict_types=1);

class Model
{
    protected ?PDO $pdo = null;

    protected array $data = [];

    public function __construct()
    {
        $this->pdo = Database::Connect();
    }

    public function toArray()
    {
        return ($this->data);
    }

    public function toString()
    {
        return (json_encode($this->data));
    }

}