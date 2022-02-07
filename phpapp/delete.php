<?php
session_start();
require('database.php');
require('./Controllers/controller.php');
$controller = new ContactController();
$controller = $controller->Disapper();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>
<body></body>
</html>