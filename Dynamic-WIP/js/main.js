$(document).ready(function() {
  var posting = $.post("Users/loggedin.php");
  posting.done(function(data) {
    if (data == "-1")
    {
      open_login();
    } else {
      setTimeout(function(){getnotification();
      gettransfer();
      gettransfercompleted();
      getbill();
      getbillcomplete()}, 500);

      setInterval(getnotification, 2500);
      setInterval(gettransfer, 2500);
      setInterval(gettransfercompleted, 2500);
      setInterval(getbill, 2500);
      setInterval(getbillcomplete, 2500);
    }
  });
});
