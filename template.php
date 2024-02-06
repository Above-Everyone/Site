<!--
=========================================================
* Soft UI Dashboard - v1.0.7
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2023 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<?php

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

require_once("yomarket/template.php");
include_once("yomarket/item_lib.php");
require_once("yomarket/market_lib.php");

$info = $_COOKIE['ym_user_info'] ?? "";
$MORE_INFO_PAGE_PROFILE = "";
if(!empty($info)) { 
    $MORE_INFO_PAGE_PROFILE = new Profile($info);
}

$ip = $_SERVER["HTTP_CF_CONNECTING_IP"] ?? $_SERVER['REMOTE_ADDR'];
$agt = $_SERVER["HTTP_USER_AGENT"] ?? "";
$agent = str_replace(" ", "_", $agt);
$agent = str_replace(";", "-", $agent);

$cookie_items = $_COOKIE['ym_template_info'] ?? "";
var_dump($cookie_items);
$items = explode(",", $cookie_items);
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
    .txtt-input {
    font-size: 20px;
    margin: auto;
    border-style: solid;
    border-color: #0c0d10;
    color: #000;
    background-color: #fff;
}
.btnn-input {
    font-size: 20px;
    margin: auto;
    border-style: solid;
    border-color: #0c0d10;
    color: #fff;
    background-color: #fff;
    font-size: 20px;
}

.item_box {
    background-color: #cb0c9f;
    height: 100mh;
    width: 500px;
    border: solid;
}

/*
            Search Results Box & Grid Container
*/
.result_box {
    color: #fff;
    margin: auto;
    border-style: solid;
    border-color: #fff;
    background-color: #fff;
}
.grid-container {
    display: grid;
    background-color: transparent;
    /* grid-template-columns: fit-content(300px) fit-content(300px) 6 2fr; */
    /* grid-template-columns: auto auto auto auto; */
    grid-template-columns: repeat(5, 1fr);
    grid-gap: 5px;
    box-sizing: border-box;
    padding: 10px;
}
.grid-item {
    color: #fff;
    background-color: #fff;
    border-style: groove;
    border-color: #cb0c9f;
    text-align: center;
}
.item-name {
    margin: auto;
    background-color: #000;
    box-sizing: border-box;
    width: 100mw;
    height: 50px;
}
/*
            Buttons And Textboxes
*/
.txt-input {
font-size: 20px;
    border-style: solid;
    border-color: #fff;
    color: #fff;
    background-color: rgba(42, 42, 42);
}
.btn-input {
    font-size: 20px;
    border-style: solid;
    border-color: #fff;
    color: #fff;
    background-color: #0c0d10;
    font-size: 20px;
}
.fit {
    
    box-sizing: border-box;
}
table, th, td {
  border:1px solid black;
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
            <h6 class="mb-1">Tempalate Generator</h6>
            <p class="text-sm">Download a list of items in an image with custom text, font and font size!<br />Please keep in mind that this page is still in development! While you can't download the template yet, you can screen shot the items in page that fits!</p>
          </div>
          <div class="card-body p-3">
            <div class="row">
                <?php
                  if(!empty($info)) {
                    echo '<center><img style="width: 500px;height: 300px;" src="https://backup.yomarket.info/get_template?name='. $MORE_INFO_PAGE_PROFILE->username. '"></center>';
                  } 
                  
                  if(!empty($cookie_items))
                  {
                    echo '<center><form method="post"><div class="form-group mb-4"><div class="col-sm-12"><input type="submit" class="btn btn-success" style="width: 100mw" id="generate_template" name="generate_template" value="Generate Current Template"/></div></div></form></center>';
                  }

                  if(array_key_exists('generate_template', $_POST))
                  {
                    $check = TemplateGenerator::GenerateTemplate($cookie_items, $MORE_INFO_PAGE_PROFILE->username);
                    var_dump($check);
                    if($check->type == ResponseType::REQ_SUCCESS) {
                      echo '<center><p>Template Generated</p></center>';
                    }
                    echo '<center><p>Action Failed. Contact an admin for more information!</p></center>';
                  }
                ?>
                <div style="width:100mw;line-height:.5em;padding:10px;overflow:auto;overflow-x:hidden;">
                <?php
                    if(!empty($cookie_items))
                    {
                        echo '<div class="result_box" style="margin-left: 0px">';
                        echo '<div class="grid-container">';
                        foreach($items as $item)
                        {
                            $info = explode(":", $item);
                            if($info <= 1) continue;

                            $items = new Items();
                            $r = $items->searchItem($info[0], "");

                            if($r->type == ResponseType::EXACT) {
                                $item = $r->results;
                                echo '<div class="grid-item">';
                                echo '<p class="item-name bg-gradient-primary" style="font-size: 15px; color: #000000"><b>'. $item->name. '</b></p>';
                                echo '<img style="padding-top: 20px;" width="100" height="100" src="'. $item->url. '" />';
                                echo '<p style="font-size: 15px;color: #ff0000">#'. $item->id. '<br/>Price: '. ($item->price == "" ? "N/A" : $item->price). '<br />Update: '. ($item->update == "" ? "N/A" : $item->update). '</p>';
                                echo '<div class="form-group mb-4"><div class="col-sm-12"><a class="fit btn btn-success" href="https://yomarket.info/more_info.php?iid='. $item->id. '">More Info</a></div></div>';
                                echo '</div>';
                            }

                            echo '<p>Item: '. $info[0]. ' | Price: '. $info[1]. '</p>';
                        }
                        echo '</div>';
                        echo '</div>';
                    } else {
                        echo '<p> You have no items for the template added! </p>';
                    }
                ?>
                </div>
              </div>
            </div>
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