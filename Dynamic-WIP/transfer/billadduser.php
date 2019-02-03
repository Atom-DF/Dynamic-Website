<?php
session_start();
include "../database/database2.php";
$db = new Database();
$billid = $_POST["billid"];
if (!isset($_POST["billid"]) || $billid == "")
{
  $stmt = $db->prepare("INSERT into bill values(null, :description, :amount, 0, 0, 0)");
  $stmt->bindValue(':description', $_POST["description"], SQLITE3_TEXT);
  $stmt->bindValue(':amount', $_POST["amount"]*100, SQLITE3_INTEGER);
  $stmt->execute();
  $query = $db->querySingle("select last_insert_rowid()");
  $billid = $query["last_insert_rowid()"];
}
$stmt = $db->prepare("SELECT * FROM users WHERE username=:username");
$stmt->bindValue(':username', $_POST['userpayed'], SQLITE3_TEXT);
$user = $stmt->execute()->fetchArray();
$error = 0;
$transferid = 0;
if(!isset($user["id"])) {
  $error = -1;
} else {
  $stmt = $db->prepare("SELECT * FROM users WHERE username=:username");
  $stmt->bindValue(':username', $_POST['participate'], SQLITE3_TEXT);
  $user2 = $stmt->execute()->fetchArray();
  if(!isset($user2["id"])) {
    $error = -2;
  } else if($user2["id"] == $user["id"])
  {
    $error = -3;
  } else
  {
    $stmt = $db->prepare("SELECT * FROM transfer WHERE user_owes=:user and bill_id=:billid");
    $stmt->bindValue(':user', $user2["id"], SQLITE3_INTEGER);
    $stmt->bindValue(':billid', $billid["id"], SQLITE3_INTEGER);
    $transfer = $stmt->execute()->fetchArray();
    if (isset($transfer["id"]))
    {
      $error == -4;
    } else
    {
      $weight = $_POST["weight"];
      if (!isset($_POST["weight"]) || $_POST["weight"] == "")
      {
        $weight = 0;
      }
      $stmt = $db->prepare("INSERT INTO transfer VALUES(null, :amount, :description, 0, 0, :user1, :user2, :billid, :weight, 0)");
      $stmt->bindValue(':amount', $_POST['amount']*100, SQLITE3_INTEGER);
      $stmt->bindValue(':description', $_POST['description'], SQLITE3_TEXT);
      $stmt->bindValue(':billid', $billid, SQLITE3_INTEGER);
      $stmt->bindValue(':user1', $user["id"], SQLITE3_INTEGER);
      $stmt->bindValue(':user2', $user2["id"], SQLITE3_INTEGER);
      $stmt->bindValue(':weight', $weight, SQLITE3_INTEGER);
      $stmt->execute();
      $query = $db->querySingle("select last_insert_rowid()");
      $transferid = $query["last_insert_rowid()"];
      $error = 1;
    }
  }
}
$post = array(
  'billid' => $billid,
  'error' => $error,
  'transferid' => $transferid
  );
echo json_encode($post);
 ?>
