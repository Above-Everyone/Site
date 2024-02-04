<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("yomarket/market_lib.php");
require_once("yomarket/objects/utils.php");
require_once("yomarket/objects/profile.php");

$profile_name = remove_strings($_SERVER['REQUEST_URI'], array("/", "@"));
$ip = $_SERVER["HTTP_CF_CONNECTING_IP"] ?? $_SERVER['REMOTE_ADDR'];

$profile_eng = new Profiles();
$display_profile = $profile_eng->searchProfile($profile_name, $ip);

if($display_profile->type == ResponseType::REQ_FAILED)
  die("No User Was Found....!");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" sizes="16x16" href="https://yoworld.com/images/icon.ico">
  <title>YoMarket | @<?php echo $display_profile->results->username; ?></title>
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
  <script defer data-site="https://yomarket.info" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<style>
/* Box styles */
.myBox {
border: none;
padding: 5px;
font: 24px/36px sans-serif;
width: 100mw;
height: 100mh;
overflow: scroll;
}

.invo-img {
  
  max-height:500px;
    max-width:500px;
    height:auto;
    width:auto;
}
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
    height: 600px;
    padding-right: 60px;
}
.grid-container {
    display: grid;
    background-color: transparent;
    /* grid-template-columns: fit-content(300px) fit-content(300px) 6 2fr; */
    /* grid-template-columns: 100mw, 100mw, auto; */
    /* grid-template-columns: repeat(auto-fill, 1fr); */
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    grid-gap: 5rem;
    /* grid-gap: 10px; */
    box-sizing: border-box;
    padding: 5px;
}
.grid-item {
    color: #fff;
    background-color: #fff;
    border-style: groove;
    border-color: #cb0c9f;
    text-align: center;
    box-sizing: border-box;
    width: 250px;
}
.item-name {
    box-sizing: border-box;
    margin: auto;
    background-color: #cb0c9f;
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

<body class="g-sidenav-show bg-gray-100">
  
  <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
    <!-- Navbar -->
    <?php include_once("nav_bar.php"); ?>
    <!-- End Navbar -->
    <div class="container-fluid">
      <?php include_once("statistics.php"); ?> 
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
      </div>
      <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <div class="row gx-4">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              
            <?php
                if(!empty($display_profile->results->yoworld_id)) {
                  echo '<img src="https://yomarket.info/cropped_avi.php?URL=https://yw-web.yoworld.com/user/images/yo_avatars/000/'. substr($display_profile->results->yoworld_id, 0, 3). "/". substr($display_profile->results->yoworld_id, 3, 3)."/". $display_profile->results->yoworld_id. ".png" .'" alt="profile_image" class="w-100 border-radius-lg shadow-sm">';
                }
                ?>
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
              <?php echo "@". $display_profile->results->username; ?>
              </h5>
              <p class="mb-0 font-weight-bold text-sm">
              <?php echo $display_profile->results->yoworld. " | ". $display_profile->results->yoworld_id; ?>
              </p>
            </div>
          </div>
          
          <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
            <div class="nav-wrapper position-relative end-0">
              <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">

                <?php

                if(count($display_profile->results->badges) > 0)
                {
                  if(in_array(Badges::VERIFIED, $display_profile->results->badges))
                  {
                    echo '<li class="nav-item">';
                    echo '<a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="true">';
                    echo '<img src="https://images-ext-1.discordapp.net/external/YhFGXZGaJHeKrXgPM1GUYC2lZMHOJNQnrAMwumJK0WM/https/puu.sh/K0a7Q/eab17f939a.png" alt="Verified Image" class="text-dark" width="70x" height="70px">';
                    echo '<div class="col-auto my-auto"><div class="h-100">';
                    echo '</div></div>';
                    echo '</a></li>';
                  } 
                  
                  if(in_array(Badges::TRUSTED, $display_profile->results->badges))
                  {
                    echo '<li class="nav-item">';
                    echo '<a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="true">';
                    echo '<img style="padding-top: 10px" src="https://yomarket.info/t.png" alt="Verified Image" class="text-dark" width="140x" height="65px">';
                    echo '<div class="col-auto my-auto"><div class="h-100">';
                    echo '</div></div>';
                    echo '</a>';
                    echo '</li>';
                  }
                }

                ?>


                <li class="nav-item">
                  <a class="nav-link mb-0 px-0 py-1 active " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="true">
                    <svg class="text-dark" width="16px" height="16px" viewBox="0 0 42 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g transform="translate(-2319.000000, -291.000000)" fill="#FFFFFF" fill-rule="nonzero">
                          <g transform="translate(1716.000000, 291.000000)">
                            <g transform="translate(603.000000, 0.000000)">
                              <path class="color-background" d="M22.7597136,19.3090182 L38.8987031,11.2395234 C39.3926816,10.9925342 39.592906,10.3918611 39.3459167,9.89788265 C39.249157,9.70436312 39.0922432,9.5474453 38.8987261,9.45068056 L20.2741875,0.1378125 L20.2741875,0.1378125 C19.905375,-0.04725 19.469625,-0.04725 19.0995,0.1378125 L3.1011696,8.13815822 C2.60720568,8.38517662 2.40701679,8.98586148 2.6540352,9.4798254 C2.75080129,9.67332903 2.90771305,9.83023153 3.10122239,9.9269862 L21.8652864,19.3090182 C22.1468139,19.4497819 22.4781861,19.4497819 22.7597136,19.3090182 Z">
                              </path>
                              <path class="color-background" d="M23.625,22.429159 L23.625,39.8805372 C23.625,40.4328219 24.0727153,40.8805372 24.625,40.8805372 C24.7802551,40.8805372 24.9333778,40.8443874 25.0722402,40.7749511 L41.2741875,32.673375 L41.2741875,32.673375 C41.719125,32.4515625 42,31.9974375 42,31.5 L42,14.241659 C42,13.6893742 41.5522847,13.241659 41,13.241659 C40.8447549,13.241659 40.6916418,13.2778041 40.5527864,13.3472318 L24.1777864,21.5347318 C23.8390024,21.7041238 23.625,22.0503869 23.625,22.429159 Z" opacity="0.7"></path>
                              <path class="color-background" d="M20.4472136,21.5347318 L1.4472136,12.0347318 C0.953235098,11.7877425 0.352562058,11.9879669 0.105572809,12.4819454 C0.0361450918,12.6208008 6.47121774e-16,12.7739139 0,12.929159 L0,30.1875 L0,30.1875 C0,30.6849375 0.280875,31.1390625 0.7258125,31.3621875 L19.5528096,40.7750766 C20.0467945,41.0220531 20.6474623,40.8218132 20.8944388,40.3278283 C20.963859,40.1889789 21,40.0358742 21,39.8806379 L21,22.429159 C21,22.0503869 20.7859976,21.7041238 20.4472136,21.5347318 Z" opacity="0.7"></path>
                            </g>
                          </g>
                        </g>
                      </g>
                    </svg>
                    <div class="col-auto my-auto">
                    <div class="h-100">
                      <h5 class="mb-1">
                      Vouches
                      </h5>
                      <p class="mb-0 font-weight-bold text-sm">
                      N/A
                      </p>
                    </div>
                  </div>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid py-4">
      <div class="row">

        <div class="col-12 col-xl-4">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-0">Contact Information</h6>
            </div>
            <div class="card-body p-3">
              <p class="text-sm">
                Bio
              </p>
              <hr class="horizontal gray-light my-4">
              <ul class="list-group">
                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Yoworld</strong> &nbsp; <?php echo ($display_profile->results->yoworld == "" ? "N/A": $display_profile->results->yoworld). ' | '. $display_profile->results->yoworld_id; ?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Discord</strong> &nbsp; <?php echo ($display_profile->results->discord == "" ? "N/A": $display_profile->results->discord). ' | '. ($display_profile->results->discord_id == "" ? "N/A ": $display_profile->results->discord_id); ?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Facebook:</strong> &nbsp; <?php echo ($display_profile->results->facebook == "" ? "N/A": $display_profile->results->facebook). ' | '. ($display_profile->results->facebook_id == "" ? "N/A": $display_profile->results->facebook_id); ?></li>
                <li class="list-group-item border-0 ps-0 pb-0">
                  <strong class="text-dark text-sm">Social:</strong> &nbsp;
                  <?php
                  if($display_profile->results->is_FbID()) {
                    echo '<a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0" href="https://www.facebook.com/profile.php?id='. $display_profile->results->facebook_id. '">';
                  } else { 
                    echo '<a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0" href="https://www.facebook.com/'. $display_profile->results->facebook_id. '">';
                  }
                  ?>
                    <i class="fab fa-facebook fa-lg"></i>
                  </a>
                  <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                    <i class="fab fa-twitter fa-lg"></i>
                  </a>
                  <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                    <i class="fab fa-instagram fa-lg"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-12 col-xl-4">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <div class="row">
                <div class="col-md-8 d-flex align-items-center">
                  <h6 class="mb-0">Avatar</h6>
                </div>
                <div class="col-md-4 text-end">
                  <a href="javascript:;">
                    <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                  </a>
                </div>
                <?php
                if(!empty($display_profile->results->yoworld_id)) {
                  echo '<center><img width="250" height="400" src="https://yw-web.yoworld.com/user/images/yo_avatars/000/'. substr($display_profile->results->yoworld_id, 0, 3). "/". substr($display_profile->results->yoworld_id, 3, 3)."/". $display_profile->results->yoworld_id. ".png" .'"/></center>'; }
                ?>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-12 col-xl-4">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-0">Acitivities</h6>
            </div>
            <div class="card-body p-3">
              <div style="width:100mw;height: 400px; line-height:.5em;padding:5px;overflow:auto;overflow-x:hidden;">
                <ul class="list-group">
                  <?php
                  // var_dump($check_auth->activities);
                    if(count($display_profile->results->activities) > 0) {
                      $n = array_reverse($display_profile->results->activities);
                      foreach($n as $act) {
                        echo '<li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">';
                        echo '<div class="avatar me-3">';

                        if(empty($act->item))
                          { echo '<img src="https://yomarket.info/cropped_avi.php?URL=https://yw-web.yoworld.com/user/images/yo_avatars/000/'. substr($display_profile->results->yoworld_id, 0, 3). "/". substr($display_profile->results->yoworld_id, 3, 3)."/". $display_profile->results->yoworld_id. ".png" .'" alt="kal" class="border-radius-lg shadow">'; }
                          else { echo '<img src="'. $act->item->url. '" alt="kal" class="border-radius-lg shadow">'; }

                        echo '</div>';
                        echo '<div class="d-flex align-items-start flex-column justify-content-center">';
                        echo '<h6 class="mb-0 text-sm">'. $display_profile->results->username. ' '. Activity_T::type2humanstr($act->act_t);

                        if($act->act_t == Activity_T::item_sold || $act->act_t == Activity_T::item_bought) {
                          echo ' for '. $act->price; }
                        else if($act->act_t == Activity_T::price_change) {
                          echo ' price the of '. $act->item->id. " to ". $act->price; }
                        else if($act->act_t == Activity_T::fs_posted) {
                          echo " ". $act->item->name. " for ". $act->price; }
                        else if($act->act_t == Activity_T::wtb_posted) {
                          echo " ". $act->item->name. "!"; }
                        else if($act->act_t == Activity_T::invo_posted) {
                          echo " ". $act->item->name. " to their inventory"; }
                        else if($act->act_t == Activity_T::item_viewed) {
                          echo " ". $act->item->name; }
                          
                        echo '</h6>';
                        echo '<p class="mb-0 text-xs">'. $act->timestamp. '</p>';
                      }
                    } else { echo '<p>'. $display_profile->results->username. ' has no activities</p>'; }
                  ?>
                </ul>
              </div>
            </div>

          </div>
        </div>

        <div class="col-12 mt-4">
          <div class="card mb-4">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-1">Inventory</h6>
              <p class="text-sm">List Of <?php echo $display_profile->results->username; ?>'s items</p>
            </div>
            <div class="card-body p-3">
              <div class="row">
                <div style="width:100mw;line-height:.5em;padding:10px;overflow:auto;overflow-x:hidden;">


                  
                  <?php
                    if(count($display_profile->results->invo) > 0 ) {
                        echo '<div class="result_box" style="margin-left: 0px">';
                        echo '<div class="grid-container">';
                        foreach($display_profile->results->invo as $item) {
                            echo '<div class="grid-item">';
                            echo '<p class="item-name bg-gradient-primary" style="font-size: 15px; color: #ff0000"><b>'. $item->name. '</b></p>';
                            echo '<img style="padding-top: 20px;" width="100" height="100" src="'. $item->url. '" />';
                            echo '<p style="font-size: 15px;color: #ff0000">#'. $item->id. '<br/>Price: '. ($item->price == "" ? "N/A" : $item->price). '<br />Update: '. ($item->update == "" ? "N/A" : $item->update). '</p>';
                            echo '<div class="form-group mb-4"><div class="col-sm-12"><a class="fit btn btn-success" href="https://yomarket.info/more_info.php?iid='. $item->id. '">More Info</a></div></div>';
                            echo '</div>';
                        }
                        echo '</div>';
                        echo '</div>';
                    } else { echo '<p>'. $display_profile->results->username. ' has no items!</p>'; }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 mt-4">
          <div class="card mb-4">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-1">List Of Items For Sale</h6>
              <p class="text-sm">List Of <?php echo $display_profile->results->username; ?>'s items</p>
            </div>
            <div class="card-body p-3">
              <div class="row">
                <div style="width:100mw;line-height:.5em;padding:5px;overflow:auto;overflow-x:hidden;">
                  
                  <?php
                    if(count($display_profile->results->fs_list) > 0 ) {
                        echo '<div class="result_box" style="margin-left: 0px">';
                        echo '<div class="grid-container">';
                        foreach($display_profile->results->fs_list as $item) {
                            echo '<div class="grid-item">';
                            echo '<p class="item-name bg-gradient-primary" style="font-size: 15px; color: #ff0000"><b>'. $item->item->name. '</b></p>';
                            echo '<img style="padding-top: 20px;" width="100" height="100" src="'. $item->item->url. '" />';
                            echo '<p style="font-size: 15px;color: #ff0000">#'. $item->item->id. '<br />Selling for: '. ($item->fs_price == "" ? "N/A" : $item->fs_price). '<br />Posted: '. ($item->posted_timestamp == "" ? "N/A" : $item->posted_timestamp). '</p>';
                            echo '<div class="form-group mb-4"><div class="col-sm-12"><a class="fit btn btn-success" href="https://yomarket.info/more_info.php?iid='. $item->item->id. '">More Info</a></div></div>';
                            echo '</div>';
                        }
                        echo '</div>';
                        echo '</div>';
                    } else { echo '<p>'. $display_profile->results->username. ' has no items!</p>'; }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 mt-4">
          <div class="card mb-4">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-1">List Of Items Wanted</h6>
              <p class="text-sm">List Of <?php echo $display_profile->results->username; ?>'s items</p>
            </div>
            <div class="card-body p-3">
              <div class="row">
                <div style="width:100mw;line-height:.5em;padding:5px;overflow:auto;overflow-x:hidden;">
                  
                  <?php
                    if(count($display_profile->results->wtb_list) > 0 ) {
                        echo '<div class="result_box" style="margin-left: 0px">';
                        echo '<div class="grid-container">';
                        foreach($display_profile->results->wtb_list as $item) {
                            echo '<div class="grid-item">';
                            echo '<p class="item-name bg-gradient-primary" style="font-size: 15px; color: #ff0000"><b>'. $item->item->name. '</b></p>';
                            echo '<img style="padding-top: 20px;" width="100" height="100" src="'. $item->item->url. '" />';
                            echo '<p style="font-size: 15px;color: #ff0000">#'. $item->item->id. '</p>';
                            echo '<p style="font-size: 15px;color: #ff0000">Offering: '. ($item->wtb_price == "" ? "N/A" : $item->wtb_price). '<br />Posted: '. ($item->posted_timestamp == "" ? "N/A" : $item->posted_timestamp). '</p>';
                            echo '<div class="form-group mb-4"><div class="col-sm-12"><a class="fit btn btn-success" href="https://yomarket.info/more_info.php?iid='. $item->item->id. '">More Info</a></div></div>';
                            echo '</div>';
                        }
                        echo '</div>';
                        echo '</div>';
                    } else { echo '<p>'. $display_profile->results->username. ' has no items!</p>'; }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php include_once("footer.php"); ?>

    </div>
  </div>
  
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
</body>

</html>