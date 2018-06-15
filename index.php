<?php include_once 'settings.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Governance Proposal Generator - ChainCoin</title>

    <?php include_once 'layouts/scripts.php'; ?>
    <?php include_once 'layouts/icons.php'; ?>
    <?php include_once 'layouts/functions.php'; ?>
  </head>
  <body>
    <?php include_once 'layouts/menu.php'; ?>
    <p style="clear: both"></p>
    <div class="container">
      <div class="panel1">
        <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">

          <div class="panel panel-default" id="prepare">
            <div class="panel-heading">
              <h1 class="panel-title">Create a Proposal</h1>
            </div>
            <div class="panel-body">
              <p>Enter details for your Proposal and click 'Create Proposal'. This will generate a command you can run in your local wallet to prepare the Proposal at a cost of <?php echo $collateral; ?> CHC.</p>

              <hr>
              <form action="#" method="post" onsubmit="return check();">

                <div class="col-md-12">
                  <div class="form-group">
                    <label for="proposal-name">Proposal Name</label>
                    <input type="text" class="form-control" id="proposal-name" placeholder="Proposal Name" required maxlength="40" onblur="checkName();">

                    <div class="alert alert-danger" role="alert" style="display: none;" id="invalidName"></div>

                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label for="proposal-url">Proposal Description URL:</label>
                    <input type="url" class="form-control" id="proposal-url" placeholder="https://proposal.chaincoin.org/test" required >
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="payment-date">Payment Date</label>
                    <select class="form-control" name="payment-date" id="payment-date" onchange="totalAmount();">
                    </select>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="payment-number">Payments</label>
                    <select class="form-control" name="payment-number" id="payment-number" required onchange="totalAmount()">
                    </select>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="payment-amount">Payment Amount:</label>
                    <input type="number" class="form-control" id="payment-amount" onchange="totalAmount();" required >
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label for="payment-address">Payment Address:</label>
                    <input type="text" class="form-control" id="payment-address" onblur="checkAddress();" required >

                    <div class="alert alert-danger" role="alert" style="display: none;" id="invalidAddress">
                      <p><strong>Invalid payment address!</strong> Check the given CHC address</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                <div class="r01">
                  <p><b>Total Amount:</b> <span id="totalAmount">0 CHC</span></p>
                </div>

                <div >
                  <input type="submit" class="btn btn-primary btn-lg btn-block" name="submit" value="Create Proposal">
                </div>
                </div>
              </form>
            </div>
          </div>

          <div class="panel panel-default" id="walletCommand" style="display: none;">
            <div class="panel-heading">
              <h1 class="panel-title">Wallet Commands</h1>
            </div>
            <div class="panel-body">
              <p>Paste the following into your wallet console to generate the Proposal at a cost of <?php echo $collateral; ?> CHC.</p>

              <hr>
                <textarea id="textPrepare" readonly class="form-control"></textarea>

                <hr>

                <form action="#" method="post" onsubmit="return false;">
                  <div class="form-group">
                    <label for="txid">Transaction ID:</label>
                    <p>Paste the resulting transaction id to move to the next step.</p>
                    <input type="text" class="form-control" id="txid" placeholder="<fee-txid>" onchange="getConfirmations(this.value);">
                  </div>

                </form>

            </div>
          </div>
        </div>

        <div class="col-md-3 col-md-offset-1 col-lg-3 col-lg-offset-1 col-sm-12 col-xs-12">
          <div >
          <h2 class="header_title">ChainCoin</h2>
          <h2 class="header_title">Budget Proposal</h2>
          </div>
          <p>Generate budget proposal commands you can copy/paste into your wallet to prepare a budget proposal and submit it to the network.</p>

          <p>
            <svg class="octicon-mark-github" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0 0 16 8c0-4.42-3.58-8-8-8z"></path></svg>
           <a href="https://github.com/chaincoin/proposal">Source code</a>
         </p>
        </div>

      </div>
    </div>

  </body>
</html>
