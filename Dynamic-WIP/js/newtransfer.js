function open_transfer() {
  $("#transfer").css('display', 'block');
}

function close_transfer() {
  $("#transfer").css('display', 'none');
}

function open_bill() {
  $("#bill").css('display', 'block');
}

function close_bill() {
  $("#bill").css('display', 'none');
}

function billform() {
  $("#bill_errors").html("");
  var count = 0;
  if ($("#bill_ammount").val() == 0) {
      $("#bill_errors").append("<li>Amount cannot be 0</li>");
      count = count + 1;
  }

  if ($("#bill_description").val() == "") {
      $("#bill_errors").append("<li>Need a description</li>");
      count = count + 1;
  }

  if ($("#bill_to").val() == "") {
      $("#bill_errors").append("<li>Must have an other person</li>");
      count = count + 1;
  }

  if (count == 0)
  {
    var posting = $.post("transfer/billadduser.php",{amount: $("#bill_amount").val(), description: $("#bill_description").val(), userpayed: $("#bill_payed").val(), participate: $("#bill_participate").val(), weight: $("#bill_weight").val(), billid: $("#bill_id").val()});
    posting.done(function(data) {
      let obj = JSON.parse(data);
      if (obj["error"] == -1)
      {
        $("#bill_errors").html("");
        $("#bill_errors").append("<li>No such user</li>");
      } else if (obj["error"] == -2)
      {
        $("#bill_errors").html("");
        $("#bill_errors").append("<li>You cannot transfer yourself</li>");
      } else if(obj["error"] == -3)
      {
        $("#bill_errors").html("");
        $("#bill_errors").append("<li>You cannot transfer yourself</li>");
      } else if (obj["error"] == -4)
      {
        $("#bill_errors").html("");
        $("#bill_errors").append("<li>Already in the group</li>");
      } else if(obj["error"] == 1)
      {
          $(".billusers").append("<div>"+$("#bill_participate").val()+"<button onclick='billremoveuser(this)' value='"+obj["transferid"]+"'>delete</button>"+"</div>");
          $("#bill_id").val(obj["billid"]);
      }
    });
  }
  return false;
}

function billremoveuser(e) {
  var posting = $.post("transfer/billremoveuser.php", {id:$(e).val()});
  posting.done(function(data) {
    $(e).parent().fadeOut();
  });
}

function paytransfer(e) {
  var posting = $.post("transfer/paytransfer.php", {id:$(e).val()});
  posting.done(function(data) {
    $(e).parent().fadeOut();
  });
}

function submitbill() {
  var posting = $.post("transfer/billsubmit.php", {billid:$("#bill_id").val()});
  posting.done(function(data) {
    close_bill();
    $("#bill_id").val("");
    $("#bill_participate").val("");
    $("#bill_amount").val("");
    $("#bill_description").val("");
    $("#bill_payed").val("");
    $("#bill_weight").val("");
    $(".billusers").html("");
    $("#bill_errors").html("");
  });
}

function transferform() {
  $("#transfer_errors").html("");
  var count = 0;
  if ($("#transfer_amount").val() == 0 | $("#transfer_amount").val() == undefined) {
      $("#transfer_errors").append("<li>Amount cannot be 0</li>");
      count = count + 1;
  }

  if ($("#transfer_description").val() == "") {
      $("#transfer_errors").append("<li>Need a description</li>");
      count = count + 1;
  }

  if ($("#transfer_to").val() == "") {
      $("#transfer_errors").append("<li>Must have an other person</li>");
      count = count + 1;
  }

  if (count == 0)
  {
    var posting = $.post("transfer/transfer.php",{amount: $("#transfer_amount").val(), description: $("#transfer_description").val(), user: $("#transfer_to").val(), accepted: $("#transfer_accepted").is(":checked")});
    posting.done(function(data) {
      if (data == -1)
      {
        $("#transfer_errors").html("");
        $("#transfer_errors").append("<li>No such user</li>");
      } else if (data == -2)
      {
        $("#transfer_errors").html("");
        $("#transfer_errors").append("<li>You cannot transfer yourself</li>");
      } else
      {
          close_transfer();
          $("#transfer_amount").val("");
          $("#transfer_description").val("");
          $("#transfer_to").val("");
          $("#transfer_accepted").prop('checked', false);
      }
    });
  }
  return false;
}
