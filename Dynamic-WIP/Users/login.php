<?php
session_start();
include '../database/database2.php';
$db = new Database();
$stmt = $db->prepare("SELECT * FROM users WHERE username=:username");
$stmt->bindValue(':username', $_POST['username'], SQLITE3_TEXT);
$user = $stmt->execute()->fetchArray();
if (isset($user["username"]))
{
  if($user["password"] == sha1($user["salt"].$_POST['password']))
  {
    $_SESSION["id"]=$user["id"];
    $_SESSION["username"]=$user["username"];
    echo $user["username"];
  } else {
    echo -2;
  }
} else
{
  echo -1;
}
 ?>
