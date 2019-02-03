function open_notification() {
  $("#notification").css('display', 'block');
  getnotification();
}

function close_notification() {
  $("#notification").css('display', 'none');
}

function accepttransfer(e) {
  var posting = $.post("transfer/accepttransfer.php", {id:$(e).val()}, dataType="json");
  $(e).parent().fadeOut();
  posting.done(function(data) {
  });
}

function deletetransfer(e) {
  var posting = $.post("transfer/deletetransfer.php", {id:$(e).val()}, dataType="json");
  $(e).parent().fadeOut();
  posting.done(function(data) {
  });
}

function getnotification() {
  var posting = $.post("transfer/notification.php", dataType="json");
  posting.done(function(data) {
    let obj = JSON.parse(data);
    $("#notification_items").html("");
    for(i=0; i < obj["size"]; i++)
    {
      $("#notification_items").append("<li class='transfer_item'>"+"<span>"+obj["description"][i]+" </span><span>"+obj["amount"][i]/100+"(&pound) </span><span>You owe "+obj["user"][i]+"</span><button onclick='accepttransfer(this)' value="+obj["id"][i]+">Accept</button><button onclick='deletetransfer(this)' value="+obj["id"][i]+">Delete</button></li>");
    }
  });
}
