<script>
    function checkAddress() {
      $.get(
        "function/checkAddress.php",
        {
          address: $("#payment-address").val()
        },
        function(data) {
          if ((data == "false")) {
            $("#payment-address").css('border', '2px solid red');
            $("#invalidAddress").css('display', 'block');
          } else {
            $("#payment-address").css('border', '1px solid #ccc');
            $("#invalidAddress").css('display', 'none');
          }
          //console.log(data);
        }
    );
    return false;
    }

    function totalAmount() {
      $("#totalAmount").html( ($("#payment-number").val() * $("#payment-amount").val()) + " CHC" );
    }

    function superBlocks() {
      $.get(
        "function/paymentDate.php",
        function(data) {
          $.each(JSON.parse(data), function(index, value) {
            $("#payment-date").append("<option value=\"\">" + value + "</option>");
            $("#payment-number").append("<option value=\"\">" + (index+1) + " Payments</option>");
          });
        }
    );
    return false;
    }

    $(document).ready(function() {
      superBlocks();
    });

    </script>
