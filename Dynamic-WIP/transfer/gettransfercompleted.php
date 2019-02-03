<?php
session_start();
include "../database/database2.php";
$db = new Database();
$stmt = $db->prepare("SELECT * FROM transfer WHERE (user_owed=:user OR user_owes=:user) and accepted=1");
$stmt->bindValue(':user', $_SESSION["id"], SQLITE3_INTEGER);
$user = $stmt->execute();

$post_data = array(
  'id' => array(),
  'amount' => array(),
  'description' => array(),
  'user1' => array(),
  'user2' => array(),
  'payed' => array(),
  'size' => 0
);
while($row = $user->fetchArray())
{
  if ($row["ammount"] != $row["payed"])
  {
    if ($row["user_owed"] == $_SESSION["id"])
    {
      $stmt = $db->prepare("SELECT username FROM users WHERE id=:id");
      $stmt->bindValue(':id', $row["user_owes"], SQLITE3_INTEGER);
      $user2 = $stmt->execute()->fetchArray();
      $post_data["id"][]=$row["id"];
      $post_data["amount"][]=$row["amount"];
      $post_data["description"][]=$row["description"];
      $post_data["user1"][]=$user2["username"];
      $post_data["user2"][]="You";
      $post_data["payed"][]=$row["payed"];
      $post_data["size"]=$post_data["size"] +1;
    } else
    {
      $stmt = $db->prepare("SELECT username FROM users WHERE id=:id");
      $stmt->bindValue(':id', $row["user_owed"], SQLITE3_INTEGER);
      $user2 = $stmt->execute()->fetchArray();
      $post_data["id"][]=$row["id"];
      $post_data["amount"][]=$row["amount"];
      $post_data["description"][]=$row["description"];
      $post_data["user1"][]="You";
      $post_data["user2"][]=$user2["username"];
      $post_data["payed"][]=$row["payed"];
      $post_data["size"]=$post_data["size"] +1;
    }
  }
}
echo json_encode($post_data);
 ?>
