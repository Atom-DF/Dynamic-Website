<div id="login" class="modal">
  <div class="modal_content">
    <span class="login_title">Login</span>
    <span class="modal_close" onclick="close_login()">&times;</span>   <br />
    <form action="" onsubmit="return loginform()" method="post">
      <label for="login_username">Username</label>
      <input name="login_username" id="login_username" /><br />
      <label for="login_password">Password</label>
      <input type="password" name="login_password" id="login_password" /><br />
      <label for="login_submit">Submit</label>
      <input type="submit" value="Submit" id="login_submit" /><br />
    </form>
    <div id="login_errors"></div>
  </div>
</div>
