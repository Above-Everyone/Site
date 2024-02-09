<?php
/* Reporting all errors */

require_once("page_handlers/more_info_h.php");

/* User Profile & Information Tracking */
$ip = $_SERVER["HTTP_CF_CONNECTING_IP"] ?? "";
$agt = $_SERVER["HTTP_USER_AGENT"] ?? "";
$agent = str_replace(" ", "_", $agt);
$agent = str_replace(";", "-", $agent);

$id = $_GET['iid'] ?? "";
$info = $_COOKIE['ym_user_info'] ?? "";

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
.fit {
    color: #000;
    box-sizing: border-box;
}
.fit-price {
    color: #000;
    box-sizing: border-box;
    display: inline-block;
}
table, th, td {
  border:1px solid black;
}

.wrap-box {
    border-color: #fff;
    border-style: solid;
    padding: 50px;
    margin: 50px;
    align-items: center;
}
.result-box {
  border: 5px solid;
  border-color: #fff;
  margin: auto;
  width: 100mw;
  height: 100mh;
  padding: 10px;
}
.img-box {
    align: center;
    border-color: #fff;
    border-style: solid;
    margin: auto;
    width: 100mw;
    height: 100mh;
    padding: 10px;
}
.result-gap {
    width: 50px;
    height: 80px;
}
.info-box {
    border-color: #fff;
    border-style: solid;
    margin: auto;
    width: 100mw;
    height: 100mh;
    padding: 10px;
    box-sizing: border-box;
}
h1 {
    font-size: 20px;
    color: #cb0c9f;
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
            <h6 class="mb-1">YoMarket</h6>
            <p class="text-sm">The #1 Price Guide For Yoworld!</p>
          </div>
          <div class="card-body p-3">
                <?php
                    
                    /*
                        Always search for item to display
                    */
                    if(array_key_exists('iid', $_GET)) {
                        run_search_handler($id, $ip, $agent);
                    }


                    /*
                        Price Change Handler
                    */
                    if(array_key_exists("price_btn", $_POST))
                    {
                        $n_price = $_POST['new_price'] ?? "0";
                        price_change_handler($id, $n_price, $info, $ip, $agent);
                    }

                    /*
                        Add to Template Handler
                    */
                    if(array_key_exists('add2template', $_POST) && array_key_exists('new_price', $_POST)) 
                    {
                        $n_price = $_POST['new_price'] ?? "0";
                        add2template_handler($id, $n_price, $info, $ip);
                    }

                    /*
                        Profile item List Handler
                    */
                    if(array_key_exists("add_to_fs", $_POST))
                    {
                        $n_price = $_POST['new_price'] ?? "0";
                        add2fs_handler($id, $n_price, $info, $ip);
                    }

                    if(array_key_exists("rm_from_fs", $_POST))
                    {
                        rmfromfs_handler($id, $info, $ip);
                    }
                    
                    if(array_key_exists("add_to_wtb", $_POST))
                    {
                        $n_price = $_POST['new_price'] ?? "0";
                        add2wtb_handler($id, $n_price, $info, $ip);
                    } 

                    if(array_key_exists("rm_from_wtb", $_POST))
                    {
                        rmfromwtb_handler($id, $info, $ip);
                    }
                    
                    if(array_key_exists("add_to_invo", $_POST))
                    {
                        add2invo_handler($id, $info, $ip);
                    }
                    
                    
                    if(array_key_exists("rm_from_invo", $_POST))
                    {
                        rmfrominvo_handler($id, $info, $ip);
                    }

                    /*
                        Listing yoworld.info prices!
                    */
                    if(array_key_exists("iid", $_GET))
                    {
                        list_yw_info_price();
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