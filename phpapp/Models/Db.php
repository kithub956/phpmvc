<?php
class Db
{
    protected $dbh;
    public function __construct()
    {
        try {
            $dbh = new PDO(DSN, USER, PASSWORD, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);
            $this->dbh = $dbh;
        } catch (PDOException $e) {
            echo 'DB接続エラー：' . $e->getMessage();
            exit();
        };
    }
}
