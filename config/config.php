<?php
$host = 'localhost';
$db = 'greencalc';
$user = 'root';
$pass = '';

try {
    $mysql_db = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $mysql_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
