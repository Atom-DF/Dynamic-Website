<div id="transfer" class="modal">
  <div class="modal_content">
    <span class="transfer_title">Bill</span>
    <span class="modal_close" onclick="close_transfer()">&times;</span>   <br />
    <form action="" onsubmit="return transferform()" method="post">
      <label for="transfer_ammount">Amount</label>
      <input type="number" min="0" step="0.01" name="transfer_amount" id="transfer_amount"/><br />
      <label for="transfer_description">Description</label>
      <input name="transfer_description" id="transfer_description" /><br />
      <label for="transfer_to">Who ?</label>
      <input name="transfer_to" id="transfer_to" /><br />
      <label for="transfer_accepted">He owes you ?</label>
      <input type="checkbox" name="transfer_accepted" id="transfer_accepted" /><br />
      <label for="transfer_submit">Submit</label>
      <input type="submit" value="Submit" id="transfer_submit" /><br />
    </form>
    <div id="transfer_errors"></div>
  </div>
</div>
