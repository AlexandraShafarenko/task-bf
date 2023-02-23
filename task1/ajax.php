<?php
$hostname = "localhost";
$database = "task_bf";
$username = "root";
$password = "root";
$db = new Mysqli($hostname, $username, $password, $database);

if($db->connect_errno){
    die('Connect Error: ' . $db->connect_errno);
}
//создание таблицы task1
/*$sql = "CREATE TABLE IF NOT EXISTS `task1` (
    `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `marka` varchar(255) NOT NULL, 
    `model` varchar(255) NOT NULL, 
    `type` varchar(255) NOT NULL, 
    `name` varchar(255) NOT NULL, 
    `phone` varchar(255) NOT NULL 
)";
$db->query($sql);*/

//Добавление записей из форм
$marka = $db->real_escape_string($_POST['marka']);
$model = $db->real_escape_string($_POST['model']);
$type = $db->real_escape_string($_POST['type']);
$name = $db->real_escape_string($_POST['name']);
$phone = $db->real_escape_string($_POST['phone']);

$sql = "INSERT INTO `task1` (`marka`, `model`, `type`, `name`, `phone`) 
VALUES ('$marka', '$model', '$type', '$name', '$phone')";

$db->query($sql);

echo 'Ваша заявка принята';

$db = null;