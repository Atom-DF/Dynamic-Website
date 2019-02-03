<div id="mySidenav" class="sidenav">
  <span  class="closebtn" onclick="closeNav()">&times;</span>
  <?php
  if(!isset($_SESSION["id"]))
  {
    echo "<span onclick='open_register()'>Register</span>";
  }
  ?>
  <?php
  if(!isset($_SESSION["id"]))
  {
    echo "<span onclick='open_login()'>Login</span>";
  } else
  {
    echo "<span onclick='logout()'>Logout</span>";
  }
  ?>
</div>
