<?php
session_start();
if(isset($_SESSION["id"]))
{
  session_destroy();
  echo "1";
} else {
  echo "0";
}
 ?>
