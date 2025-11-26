<?php
class Connection
{
    private string $host;
    private string $dbname;
    private string $username;
    private string $password;
    private PDO $db;
    public function __construct()
    {
        $this->host = 'localhost';
        $this->dbname = 'dream_seller';
        $this->username = 'root';
        $this->password = '';
        try {
            $this->db = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname . ';charset=utf8', $this->username, $this->password);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getDb(): PDO
    {
        return $this->db;
    }
}
