<?php

include_once("yomarket/market_lib.php");

$info = $_COOKIE['ym_user_info'] ?? "";
$MORE_INFO_PAGE_PROFILE = "";

if(!empty($info)) { 
    $MORE_INFO_PAGE_PROFILE = new Profile($info);
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
                    ini_set('display_errors', 1);
                    ini_set('display_startup_errors', 1);
                    error_reporting(E_ALL);

                    $ip = $_SERVER["HTTP_CF_CONNECTING_IP"] ?? $_SERVER['REMOTE_ADDR'];
                    $agent = str_replace(" ", "_", $_SERVER["HTTP_USER_AGENT"]);
                    $agent = str_replace(";", "-", $agent);
                    $itemID = $_GET['iid'] ?? "";
                    $r = new Response(ResponseType::NONE, 0);
                    
                    if(array_key_exists("iid", $_GET))
                    {
                        if(!isset($_GET['iid']) || empty($itemID))
                            die("[ X ] Fill out GET parameters to continue...!");
                            
                        $items = new Items();
                        $r = $items->searchItem($itemID, $ip."&agent=". $agent);

                        if($r->type == ResponseType::REQ_FAILED || $r->type == ResponseType::NONE)
                        {
                            echo "<center><p>Error, Unable to connect to YoMarket's API. Please try again (Try using all lowercase)</p><br /><p>This is a common bug we are working on fixing....!</p><center>";
                        } else if($r->type == ResponseType::EXACT)
                        {
                            echo '<div class="result-box">';
                                echo '<div class="img-box">';
                                echo '<center><img width="200" height="200" src="'. $r->results->url. '"/></center>';
                                echo '</div>';

                                echo '<div class="result-gap"></div>';
                                echo '<div class="info-box">';
                                    echo '<center><h2>'. $r->results->name.'</h2>';
                                    echo '<p class="fit">Item ID: '. $r->results->id. '</p>';
                                    echo '<p class="fit">Price: '. $r->results->price. '</p>';
                                    echo '<p class="fit">In-Store: '. ($r->results->in_store == "" ? "N/A" : $r->results->in_store) .'</p>';
                                    echo '<p class="fit">Store Price: '. ($r->results->store_price == "" ? "N/A" : $r->results->store_price). '</p>';
                                    echo '<p class="fit">Gender: '. ($r->results->gender == "" ? "N/A" : $r->results->gender). '</p>';
                                    echo '<p class="fit">XP: '. ($r->results->xp == "" ? "N/A" : $r->results->xp). '</p>';
                                    echo '<p class="fit">Category: '. ($r->results->category == "" ? "N/A" : $r->results->category). '</p>';
                            
                                    echo '<form method="post"><div class="mb-3"><input type="text" class="form-control" style="width: 400px;padding: 10px;" placeholder="Price (ex: 2m)" aria-label="Name" aria-describedby="email-addon" id="new_price" name="new_price"></div>';

                                    echo '<div class="form-group mb-4" style="margin-right:16px;display: inline-block;"><div class="col-sm-12">';
                                    echo '<input style="width: 200px;" type="submit" class="fit btn btn-success" id="price_btn" name="price_btn" value="Suggest"/>';
                                    echo '<input style="margin-left:16px;width: 200px;" type="submit" class="fit btn btn-success" id="#" name="#" value="Request Price Check"/></div></div>';

                                    echo '<br/><div class="form-group mb-4" style="margin-right:16px;display: inline-block;"><div class="col-sm-12">';
                                    echo '<input style="margin-left:16px;width: 200px;" type="submit" class="fit btn btn-success" id="add_to_invo" name="add_to_invo" value="Add To Invo"/>';
                                    echo '<input style="margin-left:16px;width: 200px;" type="submit" class="fit btn btn-success" id="add_to_fs" name="add_to_fs" value="Add To FS"/>';
                                    echo '<input style="margin-left:16px;width: 200px;" type="submit" class="fit btn btn-success" id="add_to_wtb" name="add_to_wtb" value="Add To WTB"/></div></div>';

                                    echo '<br/><div class="form-group mb-4" style="margin-right:16px;display: inline-block;"><div class="col-sm-12">';
                                    echo '<input style="margin-left:16px;width: 200px;" type="submit" class="fit btn btn-success" id="rm_from_invo" name="rm_from_invo" value="Remove From Invo"/>';
                                    echo '<input style="margin-left:16px;width: 200px;" type="submit" class="fit btn btn-success" id="rm_from_fs" name="rm_from_fs" value="Remove From FS"/>';
                                    echo '<input style="margin-left:16px;width: 200px;" type="submit" class="fit btn btn-success" id="rm_from_wtb" name="rm_from_wtb" value="Remove From WTB"/></div></div>';
                                echo '</center></div>';
                            echo '</div></form>';
                        } else {
                            echo "[ X ] Error, No item was found...!";
                        }
                    } else {
                        die("[ X ] No Item ID Provided To Search For Item Information....!");
                    }

                    /*
                        Price Change Handler & Profile Event Handler
                    */
                    if(array_key_exists("price_btn", $_POST))
                    {
                        $ip = $_SERVER["HTTP_CF_CONNECTING_IP"] ?? $_SERVER['REMOTE_ADDR'];
                        $n_price = $_POST['new_price'] == "" ? "0": $_POST['new_price'];

                        if(!isset($_GET['iid']) || empty($itemID))
                            die("[ X ] Fill out GET parameters to continue...!");
                        
                        $items = new Items();
                        $r = $items->searchItem($itemID, $ip."&agent=". $agent);

                        if(empty($info)) {
                            echo "<center><p>Error, You must be signed in to suggest a price!</p></center>";
                            return;
                        }

                        if(!in_array(Badges::ADMIN, $MORE_INFO_PAGE_PROFILE->badges) && !in_array(Badges::OWNER, $MORE_INFO_PAGE_PROFILE->badges)) {
                            echo "<center><p>Error, You Aren't an admin to change prices! </p><center>";
                            return;
                        }
                        
                        if($r->type != ResponseType::EXACT) {
                            echo "<center><p>Error, Unable to find item!<br />Something went wrong. Contact an admin!</p><center>";
                            return;
                        }

                        $change_r = $items->changePrice($r->results, $n_price, $MORE_INFO_PAGE_PROFILE->username, $ip);
                        
                        if($change_r->type == ResponseType::ITEM_UPDATED)
                        {
                            // $format = YoGuide::format_change_log($ip, $itemID, $r->result->price, $n_price);
                            // YoGuide::send_post_req((new YoGuide())->CHANGE_LOG_URL, $format);
                            echo "<center><p>Item ". $r->results->name. " successfully updated....!</p><center>";
                        }
                    } else if(array_key_exists("add_to_fs", $_POST))
                    {
                        $ip = $_SERVER["HTTP_CF_CONNECTING_IP"] ?? $_SERVER['REMOTE_ADDR'];
                        $n_price = $_POST['new_price'] == "" ? "0": $_POST['new_price'];

                        if(!isset($_GET['iid']) || empty($itemID) || empty($n_price))
                            die("<center><p>[ X ] Fill out GET parameters to continue...!</p></center>");

                        if(empty($info)) {
                            echo "<center><p>Error, You must be signed in to use this!</p></center>";
                            return;
                        }
                        $action_check = (new Profiles($MORE_INFO_PAGE_PROFILE->username))->addItem($MORE_INFO_PAGE_PROFILE->username, $MORE_INFO_PAGE_PROFILE->password, $ip, $itemID, $n_price, Settings_T::add_to_fs);
                        
                        if($action_check->type != ResponseType::REQ_SUCCESS) {
                            echo "<center><p>Action Failed<br />Contact an admin for more info!</p></center>";
                            return; }

                        echo "<center><p>Action Successfully completed!</p></center>";
                        return;
                    } else if(array_key_exists("add_to_wtb", $_POST))
                    {
                        $ip = $_SERVER["HTTP_CF_CONNECTING_IP"] ?? $_SERVER['REMOTE_ADDR'];
                        $n_price = $_POST['new_price'] == "" ? "0": $_POST['new_price'];

                        if(!isset($_GET['iid']) || empty($itemID) || empty($n_price))
                            die("<center><p>[ X ] Fill out GET parameters to continue...!</p></center>");

                        if(empty($info)) {
                            echo "<center><p>Error, You must be signed in to use this!</p></center>";
                            return;
                        }
                        $action_check = (new Profiles($MORE_INFO_PAGE_PROFILE->username))->addItem($MORE_INFO_PAGE_PROFILE->username, $MORE_INFO_PAGE_PROFILE->password, $ip, $itemID, $n_price, Settings_T::add_to_wtb);
                        
                        if($action_check->type != ResponseType::REQ_SUCCESS) {
                            echo "<center><p>Action Failed<br />Contact an admin for more info!</p></center>";
                            return; }

                        echo "<center><p>Action Successfully completed!</p></center>";
                        return;
                    } else if(array_key_exists("rm_from_fs", $_POST))
                    {
                        $ip = $_SERVER["HTTP_CF_CONNECTING_IP"] ?? $_SERVER['REMOTE_ADDR'];
                        $n_price = $_POST['new_price'] == "" ? "0": $_POST['new_price'];

                        if(!isset($_GET['iid']) || empty($itemID))
                            die("<center><p>[ X ] Fill out GET parameters to continue...!</p></center>");
                        
                        if(empty($info)) {
                            echo "<center><p>Error, You must be signed in to use this!</p></center>";
                            return;
                        }
                        $action_check = (new Profiles($MORE_INFO_PAGE_PROFILE->username))->rmItem($MORE_INFO_PAGE_PROFILE->username, $MORE_INFO_PAGE_PROFILE->password, $ip, $itemID, Settings_T::rm_from_fs);
                        
                        if($action_check->type != ResponseType::REQ_SUCCESS) {
                            echo "<center><p>Action Failed<br />Contact an admin for more info!</p></center>";
                            return; }

                        echo "<center><p>Action Successfully completed!</p></center>";
                        return;
                    } else if(array_key_exists("rm_from_wtb", $_POST))
                    {
                        $ip = $_SERVER["HTTP_CF_CONNECTING_IP"] ?? $_SERVER['REMOTE_ADDR'];
                        $n_price = $_POST['new_price'] == "" ? "0": $_POST['new_price'];

                        if(!isset($_GET['iid']) || empty($itemID))
                            die("<center><p>[ X ] Fill out GET parameters to continue...!</p></center>");

                        if(empty($info)) {
                            echo "<center><p>Error, You must be signed in to use this!</p></center>";
                            return;
                        }
                        $action_check = (new Profiles($MORE_INFO_PAGE_PROFILE->username))->rmItem($MORE_INFO_PAGE_PROFILE->username, $MORE_INFO_PAGE_PROFILE->password, $ip, $itemID, Settings_T::rm_from_wtb);
                        
                        if($action_check->type != ResponseType::REQ_SUCCESS) {
                            echo "<center><p>Action Failed<br />Contact an admin for more info!</p></center>";
                            return; }

                        echo "<center><p>Action Successfully completed!</p></center>";
                        return;
                    } else if(array_key_exists("add_to_invo", $_POST))
                    {
                        $ip = $_SERVER["HTTP_CF_CONNECTING_IP"] ?? $_SERVER['REMOTE_ADDR'];
                        $n_price = $_POST['new_price'] == "" ? "0": $_POST['new_price'];

                        if(!isset($_GET['iid']) || empty($itemID))
                            die("<center><p>[ X ] Fill out GET parameters to continue...!</p></center>");

                        if(empty($info)) {
                            echo "<center><p>Error, You must be signed in to use this!</p></center>";
                            return;
                        }
                        $action_check = (new Profiles($MORE_INFO_PAGE_PROFILE->username))->addItem($MORE_INFO_PAGE_PROFILE->username, $MORE_INFO_PAGE_PROFILE->password, $ip, $itemID, "", Settings_T::add_to_invo);
                        
                        if($action_check->type != ResponseType::REQ_SUCCESS) {
                            echo "<center><p>Action Failed<br />Contact an admin for more info!</p></center>";
                            return; }

                        echo "<center><p>Action Successfully completed!</p></center>";
                        return;
                    } else if(array_key_exists("rm_from_invo", $_POST))
                    {
                        $ip = $_SERVER["HTTP_CF_CONNECTING_IP"] ?? $_SERVER['REMOTE_ADDR'];
                        $n_price = $_POST['new_price'] == "" ? "0": $_POST['new_price'];

                        if(!isset($_GET['iid']) || empty($itemID))
                            die("<center><p>[ X ] Fill out GET parameters to continue...!</p></center>");

                        if(empty($info)) {
                            echo "<center><p>Error, You must be signed in to use this!</p></center>";
                            return;
                        }
                        $action_check = (new Profiles($MORE_INFO_PAGE_PROFILE->username))->rmItem($MORE_INFO_PAGE_PROFILE->username, $MORE_INFO_PAGE_PROFILE->password, $ip, $itemID, Settings_T::rm_from_invo);
                        
                        if($action_check->type != ResponseType::REQ_SUCCESS) {
                            echo "<center><p>Action Failed<br />Contact an admin for more info!</p></center>";
                            return; }

                        echo "<center><p>Action Successfully completed!</p></center>";
                        return;
                    }

                    /*
                        Listing yoworld.info prices!
                    */
                    if(array_key_exists("iid", $_GET))
                    {
                        if($r->type == ResponseType::EXACT)
                        {
                            echo '<br /><br />';
                            echo '<div style="height: 50px;"></div>';
                            echo '<div class="log-box">';
                            echo '<center><h1>Yoworld.Info\'s Price Change History</h1>';
                            foreach($r->results->ywinfo_prices as $price) 
                            {
                                echo '<div stlye="display: inline-block">';
                                echo '<p class="fit-price">Price: '. $price->price. ' | </p>';
                                echo '<p class="fit-price">Update: '. $price->timestamp. '</p>';
                                echo '</div>';
                            }
                            echo '</center></div>';
                            echo '</div>';
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