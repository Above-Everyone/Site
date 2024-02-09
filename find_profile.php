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
            width: 50px;
            height: 50px;
            border-color: transparent;
            border-style: solid;
        }
        .verified_badge:hover {
            border-style: solid;
            border-color: #ff0000;
        }
        .admin_badge {
            width: 60px;
            height: 50px;
            border-color: transparent;
            border-style: solid;
        }
        .admin_badge:hover {
            border-style: solid;
            border-color: #ff0000;
        }
        .trusted_badge {
            width: 120px;
            height: 50px;
            border-color: transparent;
            border-style: solid;
        }
        .trusted_badge:hover {
            border-style: solid;
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
            <h6 class="mb-1">Profile Search</h6>
            <p class="text-sm">View the list of users or enter a profile name</p>
          </div>
          <div class="card-body p-3">
            <form method="post">
                <div class="mb-3"><input type="text" class="form-control" placeholder="Name" aria-label="Name" aria-describedby="email-addon" id="profile_query" name="profile_query"></div><br />
                <div class="form-group mb-4"><div class="col-sm-12"><input type="submit" class="btn btn-success" style="width: 100mw" id="search_profile" name="search_profile" value="Search Profile"/></div></div>
            </form>
                <?php
                    ini_set('display_errors', 1);
                    ini_set('display_startup_errors', 1);
                    error_reporting(E_ALL);
                    include_once("yomarket/market_lib.php");
                    include_once("yomarket/objects/response.php");
                    include_once("yomarket/objects/profile.php");
                    $ip = $_SERVER["HTTP_CF_CONNECTING_IP"] ?? $_SERVER['REMOTE_ADDR'];
                    $agt = $_SERVER["HTTP_USER_AGENT"] ?? "";
                    $agent = str_replace(" ", "_", $agt);
                    $agent = str_replace(";", "-", $agent);
                    
                    if(array_key_exists("search_profile", $_POST) || isset($_GET['q']))
                    {
                        $profile_name = $_POST['profile_query'] ?? "";
                        if(isset($_GET['q']))
                            $profile_name = $_GET['q'];

                        if(empty($profile_name))
                            die("[ X ] Fill out GET parameters to continue...!");

                        $items = new Items();
                        // SEARCH FUNCTIONILITY
                    }

                    $r = Profiles::list_users();

                    if($r->type == ResponseType::REQ_FAILED)
                    {
                        echo "<p>Error, Unable to connect to YoMarket's API. Please try again (Try using all lowercase)</p><br /><p>This is a common bug we are working on fixing....!</p>";
                    } else if($r->type == ResponseType::NONE) {
                        echo "<center><p>No user was found with <b>$";
                    } else if($r->type == ResponseType::REQ_SUCCESS)  {
                        echo '<center><p>Owners</p></center>';
                        foreach($r->results[0] as $owner) {
                            if(in_array($owner, array("[@OWNER]", "[@ADMINS]", "[@USERS]"))) continue;
                            $profile_eng = new Profiles();
                            $prof = $profile_eng->searchProfile(trim($owner), "5.5.5.5");
                            
                            if($prof->type == ResponseType::REQ_SUCCESS) {
                                $p = $prof->results;
                                echo '<div class="profile-box">';
                                echo '<div class="profile-pic">';
                                echo '<a href="http://yomarket.info/@'. $owner. '"><img src="https://yomarket.info/cropped_avi.php?URL=https://yw-web.yoworld.com/user/images/yo_avatars/000/187/753/187753659.png" alt="Profile Picture"></a>';
                                echo '</div>';
                                echo '<div class="profile-info">';
                                echo '<h2>@'. $owner. '</h2>';
                                echo '<div class="badges">';
                                // var_dump($p->badges);
                                if(in_array(Badges::VERIFIED, $p->badges)) {
                                    echo '<img class="verified_badge" src="https://puu.sh/K0a7Q/eab17f939a.png" alt="Badge 1"/>'; }

                                if(in_array(Badges::ADMIN, $p->badges)) { // https://puu.sh/K0trx/5fe04add98.png
                                    echo '<img class="admin_badge" src="https://puu.sh/K0ttu/941ecd1542.png" alt="Badge 2"/>'; }

                                if(in_array(Badges::TRUSTED, $p->badges)) { // https://puu.sh/K0trx/5fe04add98.png
                                    echo '<img class="trusted_badge" src="https://yomarket.info/t.png" alt="Badge 2"/>'; }
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                            }
                        }

                        echo '<br /><br /><center><p>Admins</p></center><br />';
                        foreach($r->results[1] as $admin) {
                            if(in_array($admin, array("[@OWNER]", "[@ADMINS]", "[@USERS]", ""))) continue;
                            $profile_eng = new Profiles();
                            $prof = $profile_eng->searchProfile(trim($admin), "5.5.5.5");
                            
                            if($prof->type == ResponseType::REQ_SUCCESS) {
                                $p = $prof->results;
                                echo '<div class="profile-box">';
                                echo '<div class="profile-pic">';
                                echo '<a href="http://yomarket.info/@'. $admin. '"><img src="https://yomarket.info/cropped_avi.php?URL=https://yw-web.yoworld.com/user/images/yo_avatars/000/'. substr($p->yoworld_id, 0, 3). "/". substr($p->yoworld_id, 3, 3)."/". $p->yoworld_id. '.png" alt="profile_image" class="w-100 border-radius-lg shadow-sm"></a>';
                                echo '</div>';
                                echo '<div class="profile-info">';
                                echo '<h2>'. $admin. '</h2>';
                                echo '<div class="badges">';
                                // var_dump($p->badges);
                                if(in_array(Badges::VERIFIED, $p->badges)) {
                                    echo '<img class="verified_badge" src="https://puu.sh/K0a7Q/eab17f939a.png" alt="Badge 1"/>'; }

                                if(in_array(Badges::ADMIN, $p->badges)) { // https://puu.sh/K0trx/5fe04add98.png
                                    echo '<img class="admin_badge" src="https://puu.sh/K0ttu/941ecd1542.png" alt="Badge 2"/>'; }

                                if(in_array(Badges::TRUSTED, $p->badges)) { // https://puu.sh/K0trx/5fe04add98.png
                                    echo '<img class="trusted_badge" src="https://yomarket.info/t.png" alt="Badge 2"/>'; }
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                                echo '<div style="height: 10px;"background-color: transparent;"></div>';
                            }
                        }

                        echo '<br /><br /><center><p>Users</p></center><br />';
                        foreach($r->results[2] as $user) {
                            if(in_array($user, array("[@OWNER]", "[@ADMINS]", "[@USERS]", ""))) continue;
                            $profile_eng = new Profiles();
                            $prof = $profile_eng->searchProfile(trim($user), "5.5.5.5");
                            
                            if($prof->type == ResponseType::REQ_SUCCESS) {
                                $p = $prof->results;
                                echo '<div class="profile-box">';
                                echo '<div class="profile-pic">';
                                echo '<a href="http://yomarket.info/@'. $user. '"><img src="https://yomarket.info/cropped_avi.php?URL=https://yw-web.yoworld.com/user/images/yo_avatars/000/'. substr($p->yoworld_id, 0, 3). "/". substr($p->yoworld_id, 3, 3)."/". $p->yoworld_id. '.png" alt="profile_image" class="w-100 border-radius-lg shadow-sm"></a>';
                                echo '</div>';
                                echo '<div class="profile-info">';
                                echo '<h2>'. $user. '</h2>';
                                echo '<div class="badges">';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                                echo '<div style="height: 10px;"background-color: transparent;"></div>';
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