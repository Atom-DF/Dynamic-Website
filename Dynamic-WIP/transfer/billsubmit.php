<?php
session_start();
include "../database/database2.php";
$db = new Database();
$billid = $_POST["billid"];
$post_data = array(
  'transferid' => array(),
  'weight' => array(),
  'amount' => array(),
  'size' => 0,
  'total' => 0,
  'weights' => 0
);
$stmt = $db->prepare("SELECT * FROM transfer WHERE bill_id=:id");
$stmt->bindValue(':id', $billid, SQLITE3_INTEGER);
$result = $stmt->execute();
while ($row = $result->fetchArray())
{
  $post_data["transferid"][]=$row["id"];
  $post_data["weight"][]=$row["weight"];
  $post_data["total"]=$post_data["total"] + $row["weight"];
  $post_data["amount"][]=$row["amount"];
  $post_data["size"]=$post_data["size"] + 1;
  if ($row["weight"] != 0)
  {
    $post_data["weights"]=$post_data["weights"]+1;
  }
}

for($i = 0; $i < $post_data["size"]; $i++)
{

  if($post_data["weight"][$i] == 0)
  {
    $post_data["amount"][$i] = $post_data["amount"][$post_data["size"]-1]/$post_data["size"];
    echo "im in here";
  } else {
    $post_data["amount"][$i] = (($post_data["weights"]*($post_data["amount"][$post_data["size"]-1])/$post_data["size"])*$post_data["weight"][$i])/$post_data["total"];
  }
  echo $post_data["amount"][$i]."hi";
  $stmt = $db->prepare("UPDATE transfer set amount=:amount WHERE id=:id");
  $stmt->bindValue(':id', $post_data["transferid"][$i], SQLITE3_INTEGER);
  $stmt->bindValue(':amount', $post_data["amount"][$i], SQLITE3_INTEGER);

  $user = $stmt->execute();
}
$stmt = $db->prepare("UPDATE bill set accepted=1 WHERE id=:id");
$stmt->bindValue(':id', $billid, SQLITE3_INTEGER);
$user = $stmt->execute();
 ?>
