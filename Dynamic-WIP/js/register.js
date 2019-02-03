function open_register() {
  $("#register").css('display', 'block');
}

function close_register() {
  $("#register").css('display', 'none');
}

function registerform() {
  $("#register_errors").html("");
  var count = 0;
  if ($("#register_username").val() == "") {
      $("#register_errors").append("<li>Username must be filled out</li>");
      count = count + 1;
  }
  if ($("#register_password").val() == "") {
      $("#register_errors").append("<li>Password must be filled out</li>");
      count = count + 1;
  }
  if ($("#register_password2").val() == "") {
      $("#register_errors").append("<li>Re-enter Password must be filled out</li>");
      count = count + 1;
  }
  if (($("#register_password").val() != $("#register_password2").val()) | $("#register_password").val() == "")
  {
    $("#register_errors").append("<li>Passwords do not match</li>");
    count = count + 1;
  }
  if ($("#register_email").val() == "") {
      $("#register_errors").append("<li>Email address must be filled out</li>");
      count = count + 1;
  }
  if (count == 0)
  {
    var posting = $.post("Users/register.php",{username: $("#register_username").val(), email: $("#register_email").val(), password: $("#register_password").val(), password2: $("#register_password2").val()});
    posting.done(function(data) {
      if (data == -1)
      {
        $("#register_errors").html("");
        $("#register_errors").append("<li>Username taken</li>");
      } else {
        location.reload();
      }
    });
  }
  return false;
}
