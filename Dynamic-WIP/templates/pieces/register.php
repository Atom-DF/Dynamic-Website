<div id="register" class="modal">
  <div class="modal_content">
    <span class="register_title">Register</span>
    <span class="modal_close" onclick="close_register()">&times;</span><br />
    <form action="" method="post" onsubmit="return registerform();">
      <label for="register_username">Username</label>
      <input type="text" name="register_username" id="register_username" /><br />
      <label for="register_email">Email</label>
      <input type="text" name="register_email" id="register_email" /><br />
      <label for="register_password">Password</label>
      <input type="password" name="register_password" id="register_password" /><br />
      <label for="register_password2">Re-enter password</label>
      <input type="password" name="register_password2" id="register_password2" /><br />
      <label for="register_submit">Submit</label>
      <input type="submit" value="Submit" id="register_submit" /><br />
    </form>
    <div id="register_errors"></div>
  </div>
</div>
