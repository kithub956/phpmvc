<?php
require_once('./Models/Contact.php');
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
}
