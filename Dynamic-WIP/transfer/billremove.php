<?php
session_start();
include "../database/database2.php";
$db = new Database();

$stmt = $db->prepare("SELECT * FROM transfer WHERE bill_id=:id");
$stmt->bindValue(':id', $_POST["id"], SQLITE3_INTEGER);
$bill = $stmt->execute();

while ($row = $bill->fetchArray()) {
  $stmt = $db->prepare("DELETE FROM transfer WHERE bill_id=:id");
  $stmt->bindValue(':id', $row["bill_id"], SQLITE3_INTEGER);
  $stmt->execute();
}

$stmt = $db->prepare("DELETE FROM bill WHERE id=:id");
$stmt->bindValue(':id', $_POST["id"], SQLITE3_INTEGER);
$stmt->execute();
 ?>
