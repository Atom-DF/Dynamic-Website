<?php
session_start();
include "../database/database2.php";
$db = new Database();
$stmt = $db->prepare("SELECT * FROM transfer WHERE (user_owes =:user) and accepted=0");
$stmt->bindValue(':user', $_SESSION["id"], SQLITE3_INTEGER);
$user = $stmt->execute();

$post_data = array(
  'id' => array(),
  'amount' => array(),
  'description' => array(),
  'user' => array(),
  'size' => 0
);
while($row = $user->fetchArray())
{
  $stmt = $db->prepare("SELECT username FROM users WHERE id=:id");
  $stmt->bindValue(':id', $row["user_owed"], SQLITE3_INTEGER);
  $user2 = $stmt->execute()->fetchArray();
  $post_data["id"][]=$row["id"];
  $post_data["amount"][]=$row["amount"];
  $post_data["description"][]=$row["description"];
  $post_data["user"][]=$user2["username"];
  $post_data["size"]=$post_data["size"] +1;
}
echo json_encode($post_data);
 ?>
