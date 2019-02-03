<?php
session_start();
include "../database/database2.php";
$db = new Database();
$stmt = $db->prepare("SELECT * FROM users WHERE username=:username");
$stmt->bindValue(':username', $_POST['user'], SQLITE3_TEXT);
$user = $stmt->execute()->fetchArray();
if (!isset($user["id"]))
{
  echo -1;
} else if($user["id"] == $_SESSION["id"])
{
  echo -2;
} else
{
  if ($_POST["accepted"] == "true")
  {
    $accepted = 0;
    $user1 = $_SESSION["id"];
    $user2 = $user["id"];
    echo 0;
  } else {
    $accepted = 1;
    $user2 = $_SESSION["id"];
    $user1 = $user["id"];
    echo 1;
  }
  $stmt = $db->prepare("INSERT INTO transfer VALUES(null, :amount, :description, 0, 0, :user1, :user2, null, 0, :accepted)");
  $stmt->bindValue(':amount', $_POST['amount']*100, SQLITE3_INTEGER);
  $stmt->bindValue(':description', $_POST['description'], SQLITE3_TEXT);
  $stmt->bindValue(':user1', $user1, SQLITE3_INTEGER);
  $stmt->bindValue(':user2', $user2, SQLITE3_INTEGER);
  $stmt->bindValue(':accepted', $accepted, SQLITE3_INTEGER);
  $stmt->execute();
}
?>
