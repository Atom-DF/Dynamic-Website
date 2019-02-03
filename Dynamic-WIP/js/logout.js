function logout() {
  var posting = $.post("Users/logout.php");
  posting.done(function(data) {
    if (data == 1)
    {
      location.reload();
    } else if (data == 0)
    {
      alert("Could not log out, no user logged in.");
    } else
    {
      alert("Error no response/Response not recognised.")
    }
  });
}
