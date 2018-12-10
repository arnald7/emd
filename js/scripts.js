$(document).ready(function() {
  function totalamount() {
    var q = 0;
    var rows = document
      .getElementById("tablecart")
      .getElementsByTagName("tbody")[0]
      .getElementsByTagName("tr").length;

    for (var i = 0; i < rows; i++) {
      var z = $(".amount:eq(" + i + ")").html();

      if (!isNaN(z)) {
        q += Number(z);
      }
    }
    $(".total").html(q);
  }

  //  $(".body").delegate(".qty", "change", function() {

  $(function() {
    var tr = $(this)
      .parent()
      .parent();
    var qty = tr.find(".qty").val();
    var price = tr.find(".valor").text();
    var total = price * qty;

    tr.find(".amount").html(total);

    /*
    $.ajax({
      type: "POST",
      url: "update.php",
      data: { qtdh: qty },
      success: function(response) {
        console.log("quantidade alterada: " + qty);
      }
    });*/

    totalamount();
  });
});
