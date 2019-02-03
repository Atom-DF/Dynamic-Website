<?php
session_start();
include "../database/database2.php";
$db = new Database();
$stmt = $db->prepare("UPDATE transfer set accepted = 1 WHERE id=:id");
$stmt->bindValue(':id', $_POST["id"], SQLITE3_INTEGER);
$user = $stmt->execute();
echo var_dump($_POST);
 ?>
