<div id="bill" class="modal">
  <div class="modal_content">
    <span class="bill_title">Bill</span>
    <span class="modal_close" onclick="close_bill()">&times;</span>   <br />
    <form action="" onsubmit="return billform()" method="post">
      <label for="bill_ammount">Amount</label>
      <input type="number" min="0" step="0.01" name="bill_amount" id="bill_amount"/><br />
      <label for="bill_description">Description</label>
      <input name="bill_description" id="bill_description" /><br />
      <label for="bill_payed">Person who payed the bill</label>
      <input name="bill_payed" id="bill_payed" /><br />
      <label for="bill_participate">Add user</label>
      <input name="bill_participate" id="bill_participate"/><br />
      <label for="bill_weight">Weight</label>
      <input type="number" min="0" step="1" max="100" name="bill_weight" id="bill_weight" placeholder="100%"/><br />
      <input type="hidden" id="bill_id"/>
      <input type="submit" value="Add user" id="bill_adduser" /><br />
    </form>
    <div class="billusers"></div>
    <button onclick="submitbill()">Create Bill</button>
    <div id="bill_errors"></div>
  </div>
</div>
