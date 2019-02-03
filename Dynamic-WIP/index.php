<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Index</title>
    <link rel="icon" href="favicon.ico" type="image/ico" >
    <link rel="stylesheet" type="text/css" href="templates/css/reset.css">
    <link rel="stylesheet" type="text/css" href="templates/css/sidebar.css">
    <link rel="stylesheet" type="text/css" href="templates/css/header.css">
    <link rel="stylesheet" type="text/css" href="templates/css/transfer.css">
    <link rel="stylesheet" type="text/css" href="templates/css/bills.css">
    <link rel="stylesheet" type="text/css" href="templates/css/main.css">
    <link rel="stylesheet" type="text/css" href="templates/css/modal.css">
    <link rel="stylesheet" type="text/css" href="templates/css/register.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/index.js"></script>
    <script src="js/register.js"></script>
    <script src="js/login.js"></script>
    <script src="js/logout.js"></script>
    <script src="js/newtransfer.js"></script>
    <script src="js/gettransfer.js"></script>
    <script src="js/main.js"></script>
    <script src="js/notification.js"></script>
  </head>
  <body>
    <?php include "templates/pieces/sidebar.php"; ?>
    <div id="main">
      <?php include "templates/pieces/header.php"; ?>
      <div class="content_wrapper">
        <?php include "templates/pieces/register.php"; ?>
        <?php include "templates/pieces/login.php"; ?>
        <?php include "templates/pieces/transfer.php"; ?>
        <?php include "templates/pieces/notification.php"; ?>
        <?php include "templates/pieces/newbill.php"; ?>
        <?php include "bills/transfer.php"; ?>
        <?php include "bills/bills.php"; ?>
        <?php include "bills/transfercompleted.php"; ?>
      </div>
    </div>
  </body>
</html>
