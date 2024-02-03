<?php
include_once("yomarket/item_lib.php");

$stats = Items::reqStats();

$db_c = $stats->results[0];
$search_c = $stats->results[1];
$change_c = $stats->results[2];
$admin = $stats->results[3];
?>
<div class="row">
  <div class="col-xl-3 col-sm-6">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Users</p>
              <h5 class="font-weight-bolder mb-0">
                <?php echo $admin; ?>
              </h5>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
              <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-capitalize font-weight-bold">Database Items</p>
              <h5 class="font-weight-bolder mb-0">
                  <?php echo $db_c; ?>
              </h5>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
              <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Searches</p>
              <h5 class="font-weight-bolder mb-0">
                  <?php echo $search_c; ?>
              </h5>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
              <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-capitalize font-weight-bold">Price Changes</p>
              <h5 class="font-weight-bolder mb-0">
                  <?php echo $change_c; ?>
              </h5>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
              <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<br />
<!-- <div style="width:100mw;height: 100px;padding: 10px;background-color: #ffffff;border-style: solid;border-size: 3px;">
  <font color="ff0000">
    <p style="size: 12px;"><b>Attention All Users Using YoMarket</b></p>
  </font>
  <font color="000000">
    <p>YoMarket is being worked on. Pages may break from time to time when restarting the backend. Just refresh!</p>
  </font>
</div> -->