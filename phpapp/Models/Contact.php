<?php
require_once('./Models/Db.php');
// phpcs:ignore -- 継承元のメソッド名であるため無視
class Contact extends Db
{
    public function __construct($dbh = null)
    {
        parent::__construct($dbh);
    }

    public function getTable()
    {
        $sql =  'SELECT * FROM contacts';
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    //contact.php
    public function findAll()
    {
        try {
            $sql = "SELECT * FROM contacts";
            $stmt = $this->dbh->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            echo 'エラーが発生しました。:' . $e->getMessage();
        }
    }
    //confirm.php
    public function checkIn($date)
    {
        try {
            $name = $date['name'];
            $kana = $date['kana'];
            $tel = $date['tel'];
            $email = $date['email'];
            $body = $date['body'];
            $stmt = $this->dbh->prepare("INSERT INTO contacts (name, kana, tel, email, body) VALUES (:name, :kana, :tel, :email, :body)");
            $params = array(':name' => $name, ':kana' => $kana, ':tel' => $tel, ':email' => $email, ':body' => $body);
            $stmt->execute($params);
        } catch (PDOException $e) {
            exit('データベースに接続できませんでした。' . $e->getMessage());
        }
    }
    //update.php
    public function change()
    {
        try {
            $stmt = $this->dbh->prepare('SELECT * FROM contacts WHERE id = :id');
            $stmt->execute(array(':id' => $_POST['id']));
            $result = 0;
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            echo 'エラーが発生しました。:' . $e->getMessage();
        }
    }
    //edit.php
    // phpcs:ignore -- 継承元のメソッド名であるため無視
    public function Decision()
    {
        try {
            $stmt = $this->dbh->prepare('UPDATE contacts SET name = :name, kana = :kana, tel = :tel, email = :email, body = :body WHERE id = :id');
            $stmt->execute(array(':name' => $_SESSION['name'], ':kana' => $_SESSION['kana'], ':tel' => $_SESSION['tel'], ':email' => $_SESSION['email'], ':body' => $_SESSION['body'], ':id' => $_SESSION['id']));
            session_destroy();
            header("Location:contact.php");
        } catch (Exception $e) {
            echo 'エラーが発生しました。:' . $e->getMessage();
        }
    }
    //delete.php
    // phpcs:ignore -- 継承元のメソッド名であるため無視
    public function Delete()
    {
        try {
            $stmt = $this->dbh->prepare('DELETE FROM contacts WHERE id = :id');
            $stmt->execute(array(':id' => $_POST["id"]));
            header("Location:contact.php");
            exit;
        } catch (Exception $e) {
            echo 'エラーが発生しました。:' . $e->getMessage();
        }
    }
}
