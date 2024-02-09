<?php


include_once("yomarket/objects/response.php");
include_once("yomarket/objects/profile.php");
include_once("yomarket/market_lib.php");

$info = $_COOKIE['ym_user_info'] ?? "";
$ADMIN_ACC_INFO;

if(empty($info))
{
    header('Location: index.php');
    exit();
} else {
    $ADMIN_ACC_INFO = new Profiles($info);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" sizes="16x16" href="https://yoworld.com/images/icon.ico">
  <title>YoMarket | Item Search (Desktop)</title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<style>
        .market-box {
          width: 100%;
          height: 100%;
          padding: 10px;
        }
        .profile-box {
            display: flex;
            border: 1px solid #000;
            padding: 10px;
            width: 450px;
            margin: 0 auto;
        }
        .profile-pic {
            flex: 1;
        }
        .profile-pic img {
            width: 100%;
            height: 100%;
        }
        .profile-info {
            flex: 2;
            margin-left: 10px;
        }
        .badges {
            display: flex;
            flex-wrap: wrap;
        }
        .verified_badge {
            width: 100mw;
            height: 100mh;
            border-color: transparent;
            border-style: solid;
        }
        .verified_badge:hover {
            border-style: solid;
            height: 100mh;
            border-color: #ff0000;
        }
</style>

<body class="g-sidenav-show  bg-gray-100">
  
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

    <?php include_once("nav_bar.php"); ?>

    <div class="container-fluid py-4">
      <?php include_once("statistics.php"); ?>
      
      <div class="col-12 mt-4">
        <div class="card mb-4">
          <div class="card-header pb-0 p-3">
            <h6 class="mb-1">Market-Place</h6>
            <p class="text-sm">Here are all items for sale. You can search for specific items for sale below!<br /><br />- Please keep in mind that this page is still under development to improve item searching<br />- The Item FS Search has been temporarily removed until further notice!</p>
            <!-- <form method="post">
                <div class="mb-3"><input type="text" class="form-control" placeholder="Name" aria-label="Name" aria-describedby="email-addon" id="fs_item_q" name="fs_list_q"></div><br />
                <div class="form-group mb-4"><div class="col-sm-12"><input type="submit" class="btn btn-success" style="width: 100mw" id="fs_item_search" name="fs_item_search" value="Search Profile"/></div></div>
            </form> -->
          </div>
          <div class="card-body p-3">
                <?php
                    $ip = $_SERVER["HTTP_CF_CONNECTING_IP"] ?? $_SERVER['REMOTE_ADDR'];
                    $agt = $_SERVER["HTTP_USER_AGENT"] ?? "";
                    $agent = str_replace(" ", "_", $agt);
                    $agent = str_replace(";", "-", $agent);

                    $r = (new Profiles())->all_items_fs();

                    if($r->type == ResponseType::REQ_SUCCESS) 
                    {
                      if(count($r->results) == 0) {
                        echo '<center><p>No items were found for sale!</p></center>';
                      } else {
                        echo '<center><p>You can click an item image to view more item information and Item name to view seller\'s Profile</p></center>';
                        foreach($r->results as $fs_item) 
                        {
                          echo '<div class="profile-box">';
                          echo '<div class="profile-pic">';
                          echo '<a href="http://yomarket.info/more_info.php?iid='. $fs_item->item->id. '"><img src="'. $fs_item->item->url. '" alt="Item Image"></a>';
                          echo '</div>';
                          echo '<div class="profile-info">';
                          echo '<a href="https://yomarket.info/@'. $fs_item->seller. '"><p style="font-size: 18px"><b>'. $fs_item->item->name. '</b></p></a>';
                          echo '<div class="badges">';
                          echo '<div class="verified_badge">FS Price: '. $fs_item->fs_price. '<br />Posted: '. $fs_item->posted_timestamp. '<br />Seller: '. $fs_item->seller. '</div>';
                          echo '</div>';
                          echo '</div>';
                          echo '</div>';
                          echo '<div style="height: 10px;background-color: transparent;"></div>';
                        }
                      }
                    }
                ?>
          </div>
        </div>
      </div>

      
      <?php include_once("footer.php"); ?>

    </div>
  </main>
  
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
</body>

</html>