<?php
session_start();
include "../database/database2.php";
$db = new Database();
$stmt = $db->prepare("DELETE FROM transfer WHERE id=:id");
$stmt->bindValue(':id', $_POST["id"], SQLITE3_INTEGER);
$stmt->execute();
 ?>
