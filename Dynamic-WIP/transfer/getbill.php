<?php
session_start();
include "../database/database2.php";
$db = new Database();
$stmt = $db->prepare("SELECT * FROM transfer WHERE (user_owed=:user OR user_owes=:user) and bill_id is not null");
$stmt->bindValue(':user', $_SESSION["id"], SQLITE3_INTEGER);
$bill = $stmt->execute();

$post_data = array(
  'billid' => array(),
  'billname' => array(),
  'billamount' => array(),
  'billpayed' => array(),
  'billsize' => array(),
  'size' => 0,
  'transfer' => array(
    'id' => array(),
    'amount' => array(),
    'description' => array(),
    'user1' => array(),
    'user2' => array(),
    'payed' => array())
);
$x = 0;
while($row2 = $bill->fetchArray())
{
  $new = true;
  for($i = 0; $i < $post_data["size"]; $i ++)
  {
    if ($post_data["billid"][$i] == $row2["bill_id"])
    {
      $new = false;
    }
  }
  if ($new == true)
  {
    $stmt = $db->prepare("SELECT * FROM bill WHERE id=:id");
    $stmt->bindValue(':id', $row2["bill_id"], SQLITE3_INTEGER);
    $bill2 = $stmt->execute()->fetchArray();
    if ($bill2["complete"] != 1)
    {
      $post_data["billid"][]=$bill2["id"];
      $post_data["billname"][]=$bill2["name"];
      $post_data["billamount"][]=$bill2["original_amount"];
      $post_data["billpayed"][]=$bill2["payed"];
      $post_data["size"]=$post_data["size"] + 1;
      $stmt = $db->prepare("SELECT * FROM transfer WHERE bill_id=:id");
      $stmt->bindValue(':id', $row2["bill_id"], SQLITE3_INTEGER);
      $result = $stmt->execute();
      $x = $x + 1;
      while($row = $result->fetchArray())
      {
        $stmt = $db->prepare("SELECT username FROM users WHERE id=:id");
        $stmt->bindValue(':id', $row["user_owes"], SQLITE3_INTEGER);
        $user2 = $stmt->execute()->fetchArray();
        $stmt = $db->prepare("SELECT username FROM users WHERE id=:id");
        $stmt->bindValue(':id', $row["user_owed"], SQLITE3_INTEGER);
        $user3 = $stmt->execute()->fetchArray();
        $post_data["transfer"]["id"][]=$row["id"];
        $post_data["transfer"]["amount"][]=$row["amount"];
        $post_data["transfer"]["description"][]=$row["description"];
        $post_data["transfer"]["user1"][]=$user2["username"];
        $post_data["transfer"]["user2"][]=$user3["username"];
        $post_data["transfer"]["payed"][]=$row["payed"];
        $post_data["billsize"][$x]=$post_data["billsize"][$x] + 1;
      }
    }

  }
}
echo json_encode($post_data);
 ?>
