function gettransfer() {
  var posting = $.post("transfer/gettransfer.php", dataType="json");
  posting.done(function(data) {
    let obj = JSON.parse(data);
    $(".transfer_items").html("");
    for(i=0; i < obj["size"]; i++)
    {
      $(".transfer_items").append("<li class='transfer_item'>"+"<span>"+obj["description"][i]+" </span><span>"+obj["payed"][i]/100+"(&pound)/"+obj["amount"][i]/100+"(&pound) </span><span>"+obj["user1"][i]+" owes "+obj["user2"][i]+"</span>"+"<button onclick='paytransfer(this)' value="+obj['id'][i]+">Pay</button>"+"</li>");
    }
  });
}

function gettransfercompleted() {
  var posting = $.post("transfer/gettransfercompleted.php", dataType="json");
  posting.done(function(data) {
    let obj = JSON.parse(data);
    $(".transfercompleted_items").html("");
    for(i=0; i < obj["size"]; i++)
    {
      $(".transfercompleted_items").append("<li class='transfercompleted_item'>"+"<span>"+obj["description"][i]+" </span><span>"+obj["payed"][i]/100+"(&pound)/"+obj["amount"][i]/100+"(&pound) </span><span>"+obj["user1"][i]+" owes "+obj["user2"][i]+"</span>"+"<button onclick='deletetransfer(this)' value="+obj['id'][i]+">Delete</button>"+"</li>");
    }
  });
}

function getbill() {
  var posting = $.post("transfer/getbill.php", dataType="json");
  posting.done(function(data) {
    console.log(data);
    let obj = JSON.parse(data);
    $(".bill_items").html("");
    k=0;
    for(i=0; i < obj["size"]; i++)
    {
      $(".bill_items").append("<li class='bill_item'><span>"+obj["billname"][i]+"</span><span>"+obj["billpayed"][i]/100+"(&pound)/"+obj["billamount"][i]/100+"(&pound)</span><li>");
      for(j=0; j < obj["billsize"][i+1]; j++)
      {
        $(".bill_items").append("<li class='bill_itemtransfer'><span>"+obj["transfer"]["payed"][k]/100+"(&pound)/"+obj["transfer"]["amount"][k]/100+"(&pound) </span><span>"+obj["transfer"]["user1"][k]+" owes "+obj["transfer"]["user2"][k]+"</span><button onclick='paytransfer(this)' value="+obj["transfer"]['id'][k]+">Pay</button></li>");
        k++;
      }
    }
  });
}

function getbillcomplete() {
  var posting = $.post("transfer/getbillcomplete.php", dataType="json");
  posting.done(function(data) {
    console.log(data);
    let obj = JSON.parse(data);
    $(".billcomplete_items").html("");
    k=0;
    for(i=0; i < obj["size"]; i++)
    {
      $(".billcomplete_items").append("<li class='bill_item'><span>"+obj["billname"][i]+"</span><span>"+obj["billpayed"][i]/100+"(&pound)/"+obj["billamount"][i]/100+"(&pound)</span><button onclick='removebill(this)' value="+obj["billid"][i]+">delete</button><li>");
      for(j=0; j < obj["billsize"][i+1]; j++)
      {
        $(".billcomplete_items").append("<li class='bill_itemtransfer'><span>"+obj["transfer"]["payed"][k]/100+"(&pound)/"+obj["transfer"]["amount"][k]/100+"(&pound) </span><span>"+obj["transfer"]["user1"][k]+" owes "+obj["transfer"]["user2"][k]+"</span></li>");
        k++;
      }
    }
  });
}

function removebill(e) {
  var posting = $.post("transfer/billremove.php", {id:$(e).val()});
  posting.done(function(data) {
    $(e).parent().fadeOut();
  });
}
