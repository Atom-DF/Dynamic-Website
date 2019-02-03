function open_login() {
  $("#login").css('display', 'block');
}

function close_login() {
  $("#login").css('display', 'none');
}

function loginform() {
  $("#login_errors").html("");
  var count = 0;
  if ($("#login_username").val() == "") {
      $("#login_errors").append("<li>Username must be filled out</li>");
      count = count + 1;
  }

  if ($("#login_password").val() == "") {
      $("#login_errors").append("<li>Password must be filled out</li>");
      count = count + 1;
  }

  if (count == 0)
  {
    var posting = $.post("Users/login.php",{username: $("#login_username").val(), password: $("#login_password").val()});
    posting.done(function(data) {
      if (data == -1)
      {
        $("#login_errors").html("");
        $("#login_errors").append("<li>Invalid password</li>");
      } else if (data == -2){
        $("#login_errors").html("");
        $("#login_errors").append("<li>Password does not match username</li>");
      } else {
        location.reload();
      }
    });
  }
  return false;
}
