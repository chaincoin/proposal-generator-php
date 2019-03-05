<script>

    jQuery.ajaxSetup({async:false});
    var superBlocksList = [];
    var validAddress;
    var funding = false;

    function calcPayments() {

      $("#payment-number").empty();
      var i = parseInt($("#payment-date").val()) + 1;
      var count = 1;
      for (; i < ((superBlocksList.length)); i++) {
        $("#payment-number").append("<option value="+count+">" + (count) + " Payments</option>");
        count++;
      }

     totalAmount();
    }

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
            validAddress = false;
            return false;
          } else {
            $("#payment-address").css('border', '1px solid #ccc');
            $("#invalidAddress").css('display', 'none');
            validAddress = true;
            return true;
          }
        }
    );
    }

    function totalAmount() {
      if ($("#payment-number").val() && $("#payment-amount").val() && $("#payment-date"))
        $("#totalAmount").html( ($("#payment-number").val() * $("#payment-amount").val()) + " CHC with a final payment at " + superBlocksList[(parseInt($("#payment-number").val()) + parseInt($("#payment-date").val())) - 1] );
    }

    function superBlocks() {
      $.get(
        "function/paymentDate.php",
        function(data) {
          $.each(JSON.parse(data), function(index, value) {
            superBlocksList.push(value);
            if ((index + 1) < JSON.parse(data).length) {
              $("#payment-date").append("<option value="+(index)+">" + value + "</option>");
              $("#payment-number").append("<option value="+(index+1)+">" + (index+1) + " Payments</option>");
            }
          });
          if (superBlocksList[superBlocksList.length-1]) {
            funding = true;
          }
        }
    );
    }

    $(document).ready(function() {
      superBlocks();
    });

    function checkName() {
      if ($("#proposal-name").val().length > 40) {
        $("#invalidName").html("<p><b>Invalid name!</b> The length maximum is 40 characters</p>");
        $("#invalidName").css('display', 'block');
        return false;
      } else {
        //TODO: check for duplicated proposal-name (?)
      }
      $("#invalidName").css('display', 'none');
      return true;
    }

    function checkAmount() {
      return Number.isInteger(parseInt($("#payment-amount").val()));
    }

    function a2hex(str) {
      var arr = [];
      for (var i = 0, l = str.length; i < l; i ++) {
        var hex = Number(str.charCodeAt(i)).toString(16);
        arr.push(hex);
      }
      return arr.join('');
    }

    function textAreaAdjust(o) {
      o.style.height = (5+o.scrollHeight)+"px";
    }

    function check() {
      if (checkName() && validAddress && checkAmount()) {
        $("#prepare").css('display', 'none');
        $("#walletCommand").css('display', 'block');

        var d = new Date();
        var seconds = Math.round(d.getTime() / 1000);

        var end = new Date(superBlocksList[(parseInt($("#payment-number").val()) + parseInt($("#payment-date").val()))]);

        var endEpoch = Math.round(end.getTime() / 1000);

        var start = new Date(superBlocksList[parseInt($("#payment-date").val())]);

        var startEpoch = Math.round(start.getTime() / 1000);

        var textToHex = "[[\"proposal\",{\"end_epoch\":"+endEpoch+",\"name\":\""+$("#proposal-name").val().replace(/\s+/g, '-')+"\",\"payment_address\":\""+$("#payment-address").val()+"\",\"payment_amount\":"+$("#payment-amount").val()+",\"start_epoch\":"+startEpoch+",\"type\":1,\"url\":\""+$("#proposal-url").val()+"\"}]]";

        if (funding)
          $("#textPrepare").html("prepareproposal 0 1 " + seconds + " " + a2hex(textToHex));
        else
          $("#textPrepare").html("gobject prepare 0 1 " + seconds + " " + a2hex(textToHex));

        textAreaAdjust(document.getElementById('textPrepare'));

        return false;

      } else {
        return false;
      }
    }

    var confirmed = false;
    var txid;

    function getConfirmations(txid) {
      $("#voteManyS").css('display', 'none');
      $("#voteManyF").css('display', 'none');
      $("#waiting").css("display", "inline-block");
        txid = txid;
        window.setInterval(function(){
          if (!(confirmed)) {

          $.get(
            "function/getConfirmations.php",
            {
              txid: txid
            },
            function(data) {
              if (parseInt(data) > 0) {
                confirmed = true;
                finish($("#textPrepare").html(), txid);
                return;
              }
            }
          );

        }
      }, 30000);
        return;
    }

    function finish(prepare, txid) {

      prepare = prepare.replace("prepare", "submit");

      prepare = prepare + " " + txid;

      submitProposal(prepare);
    }

    function submitProposal(command) {

      $("#waiting").css('display', 'none');

      $.post(
        "function/submit.php",
        {
          proposal: command
        },
        function(data) {
          if (data[0] == "!") {
            $("#voteManyS").html("<b>Success</b>Your governance hash is: " + data.replace("!", ""));
            $("#voteManyS").css('display', 'block');
            $("#voteManyF").css('display', 'none');
          } else {
            $("#voteManyF").html('<b>Error.</b> Copy the content below and open a issue at <a href="https://github.com/chaincoin/proposal">GitHub</a><br /><br />'+ data.replace("?", ""));
            $("#voteManyF").css('display', 'block');
            $("#voteManyS").css('display', 'none');
          }
        }
      );
    }

    </script>
