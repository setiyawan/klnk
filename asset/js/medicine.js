$(document).ready(function() {
  $().ready(function() {
    var last_medicine_stock = $("#last-medicine-stock")[0].value || 0;
    $("#update-stock").change(function(){
      var stock = parseInt(this.value) + parseInt(last_medicine_stock);
      if (this.value == '') {
        $('#medicine-stock').html(last_medicine_stock);
      } else {
        $('#medicine-stock').html(stock);
      }
    });
  });
});