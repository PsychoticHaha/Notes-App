<?php
session_start();
$dbUsername = 'root';
$dbPassword = '';
$dsn = 'mysql:host=localhost;dbname=tabory';
$pdo = new PDO($dsn, $dbUsername, $dbPassword);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$dbms = $pdo->getAttribute(PDO::ATTR_DRIVER_NAME);
  $user_id = $_SESSION['user_id'];
?>