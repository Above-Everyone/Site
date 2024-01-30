<?php
include_once("market_profiles.php");
include_once("yomarket.php");
$profile_name = YoMarket::remove_strings($_SERVER['REQUEST_URI'], array("/", "@"));
$check_auth = Profiles::find_profile($profile_name);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" sizes="16x16" href="https://yoworld.com/images/icon.ico">
  <title>YoMarket | @<?php echo $check_auth->username; ?></title>
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

/* Scrollbar styles */
::-webkit-scrollbar {
width: 12px;
height: 12px;
}

::-webkit-scrollbar-track {
border: 1px solid yellowgreen;
border-radius: 10px;
}

::-webkit-scrollbar-thumb {
background: yellowgreen;  
border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
background: #88ba1c;  
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
              <img src="../assets/img/bruce-mars.jpg" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
              <?php echo "@". $check_auth->username; ?>
              </h5>
              <p class="mb-0 font-weight-bold text-sm">
              <?php echo $check_auth->yoworld. " | ". $check_auth->yoworld_id; ?>
              </p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
            <div class="nav-wrapper position-relative end-0">
              <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">
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
                <li class="nav-item">
                  <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                    <svg class="text-dark" width="16px" height="16px" viewBox="0 0 40 44" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <title>document</title>
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g transform="translate(-1870.000000, -591.000000)" fill="#FFFFFF" fill-rule="nonzero">
                          <g transform="translate(1716.000000, 291.000000)">
                            <g transform="translate(154.000000, 300.000000)">
                              <path class="color-background" d="M40,40 L36.3636364,40 L36.3636364,3.63636364 L5.45454545,3.63636364 L5.45454545,0 L38.1818182,0 C39.1854545,0 40,0.814545455 40,1.81818182 L40,40 Z" opacity="0.603585379"></path>
                              <path class="color-background" d="M30.9090909,7.27272727 L1.81818182,7.27272727 C0.814545455,7.27272727 0,8.08727273 0,9.09090909 L0,41.8181818 C0,42.8218182 0.814545455,43.6363636 1.81818182,43.6363636 L30.9090909,43.6363636 C31.9127273,43.6363636 32.7272727,42.8218182 32.7272727,41.8181818 L32.7272727,9.09090909 C32.7272727,8.08727273 31.9127273,7.27272727 30.9090909,7.27272727 Z M18.1818182,34.5454545 L7.27272727,34.5454545 L7.27272727,30.9090909 L18.1818182,30.9090909 L18.1818182,34.5454545 Z M25.4545455,27.2727273 L7.27272727,27.2727273 L7.27272727,23.6363636 L25.4545455,23.6363636 L25.4545455,27.2727273 Z M25.4545455,20 L7.27272727,20 L7.27272727,16.3636364 L25.4545455,16.3636364 L25.4545455,20 Z">
                              </path>
                            </g>
                          </g>
                        </g>
                      </g>
                    </svg>
                    <div class="col-auto my-auto">
                      <div class="h-100">
                        <h5 class="mb-1">
                        Trust Level
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
                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Yoworld</strong> &nbsp; <?php echo $check_auth->yoworld. ' | '. $check_auth->yoworld_id; ?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Discord</strong> &nbsp; <?php echo $check_auth->discord. ' | '. $check_auth->discord_id; ?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Facebook:</strong> &nbsp; <?php echo $check_auth->facebook. ' | '. $check_auth->facebook_id; ?></li>
                <li class="list-group-item border-0 ps-0 pb-0">
                  <strong class="text-dark text-sm">Social:</strong> &nbsp;
                  <?php
                  if($check_auth->is_FbID()) {
                    echo '<a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0" href="https://www.facebook.com/profile.php?id='. $check_auth->facebook_id. '">';
                  } else { 
                    echo '<a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0" href="https://www.facebook.com/'. $check_auth->facebook_id. '">';
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
                <center><img width="250" height="400" src="https://yw-web.yoworld.com/user/images/yo_outfits/000/187/753/187753659/12256929.png"/></center>
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
              <ul class="list-group">
                <?php
                // var_dump($check_auth->activities);
                  if(count($check_auth->activities) > 0) {
                    foreach($check_auth->activities as $act) {
                      echo '<li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">';
                      echo '<div class="avatar me-3">';
                      echo '<img src="'. $act[3]. '" alt="kal" class="border-radius-lg shadow">';
                      echo '</div>';
                      echo '<div class="d-flex align-items-start flex-column justify-content-center">';
                      echo '<h6 class="mb-0 text-sm">'. $check_auth->username. ' '. Profile::act_to_profile($act[0]). '</h6>';
                      echo '<p class="mb-0 text-xs">'. $act[1]. '</p>';
                      echo '</div>';
                      echo '<a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>';
                      echo '</li>';
                    }
                  } else { echo '<p>'. $check_auth->username. ' has no activities</p>'; }
                ?>
              </ul>
            </div>

          </div>
        </div>

        <div class="col-12 mt-4">
          <div class="card mb-4">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-1">Investory</h6>
              <p class="text-sm">List Of <?php echo $check_auth->username; ?>'s items</p>
            </div>
            <div class="card-body p-3">
              <div class="row">
                <div class="myBox">
                  
                  <?php
                    if(count($check_auth->invo) > 0 ) {
                      // var_dump($check_auth->invo);
                      foreach($check_auth->invo as $item)
                        echo '<div class="col-xl-3 col-md-6 mb-xl-0 mb-4">';
                        echo '<div class="card card-blog card-plain">';
                        echo '<div class="position-relative">';
                        echo '<a class="d-block shadow-xl border-radius-xl">';
                        echo '<center><img width="200" height="200" src="'. $item[2]. '"></center>';
                        echo '</a>';
                        echo '</div>';
                        echo '<div class="card-body px-1 pb-0">';
                        echo '<a href="javascript:;"><h5>'. $item[0]. ' | '. $item[1]. '</h5></a>';
                        echo '<p class="mb-4 text-sm">Price: '. $item[3]. ' | Update: '. $item[4]. '</p>';
                        echo '<div class="d-flex align-items-center justify-content-between">';
                        echo '<button type="button" class="btn btn-outline-primary btn-sm mb-0">Request To Buy!</button>';
                        echo '<div class="avatar-group mt-2">';
                        echo '</div></div></div></div></div>';
                    } else { echo '<p>'. $check_auth->username. ' has no items!</p>'; }
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
              <p class="text-sm">List Of <?php echo $check_auth->username; ?>'s items</p>
            </div>
            <div class="card-body p-3">
              <div class="row">
                <div class="myBox">
                  
                  <?php
                    if(count($check_auth->fs_list) > 0 ) {
                      // var_dump($check_auth->invo);
                      foreach($check_auth->fs_list as $item)
                        echo '<div class="col-xl-3 col-md-6 mb-xl-0 mb-4">';
                        echo '<div class="card card-blog card-plain">';
                        echo '<div class="position-relative">';
                        echo '<a class="d-block shadow-xl border-radius-xl">';
                        echo '<center><img width="200" height="200" src="'. $item[2]. '"></center>';
                        echo '</a>';
                        echo '</div>';
                        echo '<div class="card-body px-1 pb-0">';
                        echo '<a href="javascript:;"><h5>'. $item[0]. ' | '. $item[1]. '</h5></a>';
                        echo '<p class="mb-4 text-sm">Price: '. $item[3]. ' | Update: '. $item[4]. '</p>';
                        echo '<div class="d-flex align-items-center justify-content-between">';
                        echo '<button type="button" class="btn btn-outline-primary btn-sm mb-0">Request To Buy!</button>';
                        echo '<div class="avatar-group mt-2">';
                        echo '</div></div></div></div></div>';
                    } else { echo '<p>'. $check_auth->username. ' has no items!</p>'; }
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
              <p class="text-sm">List Of <?php echo $check_auth->username; ?>'s items</p>
            </div>
            <div class="card-body p-3">
              <div class="row">
                <div class="myBox">
                  
                  <?php
                    if(count($check_auth->wtb_list) > 0 ) {
                      // var_dump($check_auth->invo);
                      foreach($check_auth->wtb_list as $item)
                        echo '<div class="col-xl-3 col-md-6 mb-xl-0 mb-4">';
                        echo '<div class="card card-blog card-plain">';
                        echo '<div class="position-relative">';
                        echo '<a class="d-block shadow-xl border-radius-xl">';
                        echo '<center><img width="200" height="200" src="'. $item[2]. '"></center>';
                        echo '</a>';
                        echo '</div>';
                        echo '<div class="card-body px-1 pb-0">';
                        echo '<a href="javascript:;"><h5>'. $item[0]. ' | '. $item[1]. '</h5></a>';
                        echo '<p class="mb-4 text-sm">Price: '. $item[3]. ' | Update: '. $item[4]. '</p>';
                        echo '<div class="d-flex align-items-center justify-content-between">';
                        echo '<button type="button" class="btn btn-outline-primary btn-sm mb-0">Request To Buy!</button>';
                        echo '<div class="avatar-group mt-2">';
                        echo '</div></div></div></div></div>';
                    } else { echo '<p>'. $check_auth->username. ' has no items!</p>'; }
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