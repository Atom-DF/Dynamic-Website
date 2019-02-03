<nav class="header">
  <div class="header">
    <div class="header_item">
      <span style="font-size:1.8vw;cursor:pointer;" onclick="openNav()">&#9776;</span>
    </div>
    <div class="header_item title">
      <span id="header_title" onclick="open_notification()"><?php if(isset($_SESSION["username"])){echo "Welcome ".$_SESSION["username"];}else{echo "Billsplitter";} ?></span>
    </div>
    <div class="header_item login">
      <span onclick="open_bill()">New bill</span>
    </div>
    <div class="header_item register">
      <span onclick="open_transfer()">New Transfer</span>
    </div>
  </div>
</nav>
