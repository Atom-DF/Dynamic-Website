<?php
session_start();
include '../database/database2.php';
$db = new Database();
$stmt = $db->prepare("SELECT * FROM users WHERE username=:username");
$stmt->bindValue(':username', $_POST['username'], SQLITE3_TEXT);
$user = $stmt->execute()->fetchArray();
if (!isset($user["username"]))
{
  $time = sha1(time());
  $password = sha1($time.$_POST["password"]);
  $stmt = $db->prepare("INSERT INTO users VALUES
  (NULL, :username, :password , :salt, :email, 0)");
  $stmt->bindValue(':username', $_POST["username"], SQLITE3_TEXT);
  $stmt->bindValue(':password', $password, SQLITE3_TEXT);
  $stmt->bindValue(':salt', $time, SQLITE3_TEXT);
  $stmt->bindValue(':email', $_POST["email"], SQLITE3_TEXT);
  $stmt->execute();
  $stmt = $db->prepare("SELECT * FROM users WHERE username=:username");
  $stmt->bindValue(':username', $_POST['username'], SQLITE3_TEXT);
  $user = $stmt->execute()->fetchArray();
  $_SESSION["id"]=$user["id"];
  $_SESSION["username"]=$user["username"];
  echo $user["username"];
} else {
  echo "-1";
}
 ?>
