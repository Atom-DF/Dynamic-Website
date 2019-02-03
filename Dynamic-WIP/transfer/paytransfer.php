<?php
session_start();
include "../database/database2.php";
$db = new Database();
$id = $_POST["id"];
$stmt = $db->prepare("SELECT * FROM transfer WHERE id=:id");
$stmt->bindValue(':id', $id, SQLITE3_INTEGER);
$transfer = $stmt->execute()->fetchArray();
$stmt = $db->prepare("UPDATE transfer set payed=:payed WHERE id=:id");
$stmt->bindValue(':id', $id, SQLITE3_INTEGER);
$stmt->bindValue(':payed', $transfer["amount"], SQLITE3_INTEGER);
$user = $stmt->execute();
if (isset($transfer["bill_id"]))
{
  echo $transfer["bill_id"];
  $stmt = $db->prepare("SELECT * FROM bill WHERE id=:id");
  $stmt->bindValue(':id', $transfer["bill_id"], SQLITE3_INTEGER);
  $bill = $stmt->execute()->fetchArray();
  $amount =  $transfer["amount"]+$bill["payed"];
  echo "loool".$amount."oiwhf";
  $stmt = $db->prepare("UPDATE bill set payed=:payed WHERE id=:id");
  $stmt->bindValue(':id', $transfer["bill_id"], SQLITE3_INTEGER);
  $stmt->bindValue(':payed', $transfer["amount"]+$bill["payed"], SQLITE3_INTEGER);
  $user = $stmt->execute();
  $stmt = $db->prepare("SELECT * FROM bill WHERE id=:id");
  $stmt->bindValue(':id', $transfer["bill_id"], SQLITE3_INTEGER);
  $bill = $stmt->execute()->fetchArray();
  if($bill["payed"] >= $bill["original_amount"])
  {
    $stmt = $db->prepare("UPDATE bill set complete=1 WHERE id=:id");
    $stmt->bindValue(':id', $transfer["bill_id"], SQLITE3_INTEGER);
    $user = $stmt->execute();
  }
}
 ?>
