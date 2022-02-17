<?php
session_start();
require('database.php');
require('../Controllers/controller.php');
$controller = new ContactController();
$controller = $controller->Run();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="update.css">
</head>
<body></body>
</html>