<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Index</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <!-- <link rel="stylesheet" type="text/css" href="main.css"> -->
  </head>
  <body>
    <?php include "pieces/header.php" ?>
    <div class="content_wrapper">
      <form action="../Users/register.php" method="post">
        <label for="username">Username</label>
        <input name="username" id="username" /><br />
        <label for="email">Email</label>
        <input name="email" id="email" /><br />
        <label for="password">Password</label>
        <input type="password" name="user_password" id="password" /><br />
        <label for="password2">Re-enter password</label>
        <input type="password" name="user_password2" id="password2" /><br />
        <label for="submit">Submit</label>
        <input type="submit" value="Submit" id="submit" /><br />
      </form>
    </div>
  </body>
</html>
