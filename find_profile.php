<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);
require_once("page_handlers/find_profile_h.php");

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
                    
                    if(array_key_exists("search_profile", $_POST) || isset($_GET['q']))
                    {
                        $profile_name = $_POST['profile_query'] ?? "";
                        $profile_q = $_GET['q'] ?? "";
                        search_profile_handler(($profile_name != "" ? $profile_name : $profile_q));
                    }

                    list_users();
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