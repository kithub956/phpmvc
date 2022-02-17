<?php
require_once('../Models/Contact.php');
// phpcs:ignore -- 継承元のメソッド名であるため無視
class ContactController
{
    private $request;
    private $Contact;

    public function __construct()
    {
        $this->request['get'] = $_GET;
        $this->request['post'] = $_POST;
        $this->Contact = new Contact();
    }

    public function showTable()
    {
        $Contact = $this->Contact->getTable();
        return $Contact;
    }

    public function index()
    {
        return $this->Contact->findAll();
    }
    public function checkOut($date)
    {
        return $this->Contact->checkIn($date);
    }
    // phpcs:ignore -- 継承元のメソッド名であるため無視
    public function Varup()
    {
        return $this->Contact->change();
    }
    // phpcs:ignore -- 継承元のメソッド名であるため無視
    public function Run()
    {
        return $this->Contact->Decision();
    }
    // phpcs:ignore -- 継承元のメソッド名であるため無視
    public function Disapper()
    {
        return $this->Contact->Delete();
    }

    public function validate($post)
    {
        $name = !empty($post["name"]);
        $kana = !empty($post["kana"]);
        $tel = !empty($post["tel"]);
        $email = !empty($post["email"]);
        $body = !empty($post["body"]);
        $name = htmlspecialchars($name, ENT_QUOTES);
        $kana = htmlspecialchars($kana, ENT_QUOTES);
        $tel =  htmlspecialchars($tel, ENT_QUOTES);
        $email =  htmlspecialchars($email, ENT_QUOTES);
        $body =  htmlspecialchars($body, ENT_QUOTES);
        $reg_str = "/^([a-zA-Z0-9])+([a-zA-Z0-9._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9._-]+)+$/";
        $error = [];
        
        if ($name === '') {
            $error['name'] = 'blank';
        } elseif (mb_strlen($post['name']) > 10) {
            $error['name'] = 'length';
        } else {
            $error['name'] = '';
        }
        
        if ($kana === '') {
            $error['kana'] = 'blank';
        } elseif (mb_strlen($post['kana']) > 10) {
            $error['kana'] = 'length';
        } else {
            $error['kana'] = '';
        }

        if ($tel === '') {
            $error['tel'] = 'ok';
        } elseif (!preg_match("/^(0{1}\d{9,10})$/", $post['tel'])) {
            $error['tel'] = 'num';
        } else {
            $error['tel'] = '';
        }
        
        if ($email === '') {
            $error['email'] = 'blank';
        } elseif (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            $error['email'] = 'email';
        } else {
            $error['email'] = '';
        }
        
        if ($body === '') {
            $error['body'] = 'blank';
        } else {
            $error['body'] = '';
        }
         return $error;
    }
    public function upvali($result)
    {
        $error = [];
        if (@$_POST['name'] === '') {
            $error['name'] = 'blank';
        } elseif (mb_strlen(@$_POST['name']) > 10) {
            $error['name'] = 'length';
        } else {
            $error['name'] = 'ok';
        }

        if (@$_POST['kana'] === '') {
            $error['kana'] = 'blank';
        } elseif (mb_strlen(@$_POST['kana']) > 10) {
            $error['kana'] = 'length';
        } else {
            $error['kana'] = 'ok';
        }

        if (@$_POST['tel'] === '') {
            $error['tel'] = 'ok';
        } elseif (!preg_match("/^(0{1}\d{9,10})$/", @$_POST["tel"])) {
            $error['tel'] = 'num';
        } else {
            $error['tel'] = 'ok';
        }

        if (@$_POST['email'] === '') {
            $error['email'] = 'blank';
        } elseif (!filter_var(@$_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error['email'] = 'email';
        } else {
            $error['email'] = 'ok';
        }
        if (@$_POST['body'] === '') {
            $error['body'] = 'blank';
        } else {
            $error['body'] = 'ok';
        }
        return $error;
    }
}
