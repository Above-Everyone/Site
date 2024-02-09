<!-- Navbar -->
<?php

require_once("yomarket/market_lib.php");
require_once("yomarket/template.php");

$info = $_COOKIE['ym_user_info'] ?? "";
$profile;
$admin = false;

if(!empty($info)) { 
  $profile = new Profile($info);
  if(in_array(Badges::ADMIN, $profile->badges)) {
    $admin = true; }
}
?>
<style>
.nav_option {
  position: relative;
  display: inline-block;
  width: 150px;
  height: 40px;
  color: #cb0c9f;
  background-color: transparent;
  border-radius: 5px;
  border-style: solid;
  border-width: 1px;
  border-color: #cb0c9f;
  text-align: center;
  padding: 5px;
}
.nav_gap {
  width: 10px;
  background-color: transparent;
}
.dropdown {
  position: relative;
  display: inline-block;
  background-color: transparent;
  width: 150px;
  height: 40px;
  color: #cb0c9f;
  border-radius: 5px;
  border-style: solid;
  border-width: 1px;
  border-color: #cb0c9f;
  text-align: center;
  padding: 5px;
}

.dropdown-gap {
  width: 100mw;
  height: 2px;
  background-color: #cb0c9f;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  border-style: solid;
  border-color: #cb0c9f;
  border-width: 1px;
  min-width: 200px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  padding: 12px 16px;
  z-index: 1;
}

.dropdown:hover .dropdown-content {
  display: block;
}

</style>

<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3" style="padding-right: 10%;">
        <nav aria-label="breadcrumb" style="padding-right: 30px;">
          <h1>YoMarket</h1>
            <p class="text-sm">The #1 Price Guide For Yoworld!</p>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">

          
          <a href="index.php"><input type="submit" class="nav_option" value="Home"/></a>

          <div class="nav_gap"></div>

          <ul class="navbar-nav justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <div class="dropdown">
                <span>Item Search Tools</span>
                <div class="dropdown-content">
                  <a href="search.php">Item Search</a><br />
                  <div class="dropdown-gap"></div>
                  <a href="recent.php">Recent Items Updated</a><br />
                  <div class="dropdown-gap"></div>
                  <a href="template.php">Template Generator</a>
                </div>
              </div>
            </li>
          </ul>

          <div class="nav_gap"></div>

          <ul class="navbar-nav justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <div class="dropdown">
                <span>Profiles</span>
                <div class="dropdown-content">
                  <?php if(!empty($info)) echo '<a href="https://yomarket.info/@'. $profile->username. '">View My Profile</a><div class="dropdown-gap"></div>'; ?>
                  <a href="find_profile.php">Search Profile (NEW)</a>
                  <div class="dropdown-gap"></div>
                  <?php if(!empty($info)) {
                    echo '<a href="market.php">Market Place (NEW) </a>'; }
                  ?>
                </div>
              </div>
            </li>
          </ul>
          

          <div class="nav_gap"></div>
          <!-- <ul class="navbar-nav  justify-content-end" style="padding-left: 15px">
            <li class="nav-item d-flex align-items-center">
              <a href="search.php"><input type="submit" class="btn btn-outline-primary btn-sm mb-0 me-3" target="_blank" value="Item Search"/></a>
            </li>
          </ul>

          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a href="recent.php"><input type="submit" class="btn btn-outline-primary btn-sm mb-0 me-3" target="_blank" value="Recent Items Updated"/></a>
            </li>
          </ul> -->

          <?php
          if($admin) {
            // echo '<ul class="navbar-nav justify-content-end">';
            // echo '<li class="nav-item d-flex align-items-center">';
            // echo '<div class="dropdown">';
            // echo '<button class="dropbtn btn btn-outline-primary btn-sm mb-0 me-3" onclick="toggleGGDropdown()">Lulz</button>';
            // echo '<div class=".ggdropdown-content" id="gg">';
            // echo '<a href="admin_index.php"><input type="submit" class="btn btn-outline-primary btn-sm mb-0 me-3" target="_blank" value="Suggested Prices"/></a>';
            // echo '<a href="https://api.yomarket.info/save"><input type="submit" class="btn btn-outline-primary btn-sm mb-0 me-3" target="_blank" value="Save DB"/></a>';
            // echo '</div></div>';
            // echo '</li>';
            // echo '</ul>';
            // echo '<ul class="navbar-nav  justify-content-end">';
            // echo '<li class="nav-item d-flex align-items-center">';
            // echo '<a href="admin_index.php"><input type="submit" class="btn btn-outline-primary btn-sm mb-0 me-3" target="_blank" value="Suggested Prices"/></a>';
            // echo '</li>';
            // echo '</ul>';
            // echo '<ul class="navbar-nav  justify-content-end">';
            // echo '<li class="nav-item d-flex align-items-center">';
            // echo '<a href="https://api.yomarket.info/save"><input type="submit" class="btn btn-outline-primary btn-sm mb-0 me-3" target="_blank" value="Save DB"/></a>';
            // echo '</li>';
            // echo '</ul>';
          }
          ?>

          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a href="https://discord.gg/Uu6RRmw7HW"><input type="submit" class="nav_option" target="_blank" value="Discord Server"/></a>
            </li>
          </ul>
        </div>

        
        <?php
          if(empty($info)) {
            echo '<ul class="navbar-nav  justify-content-end">';
            echo '<li class="nav-item d-flex align-items-center">';
            echo '  <a href="login.php" class="nav-link text-body font-weight-bold px-0">';
            echo '    <i class="fa fa-user me-sm-1"></i>';
            echo '    <span class="d-sm-inline d-none">Sign In</span>';
            echo '  </a>';
            echo '</li>';
            echo '</ul>';
          } else {
            
            echo '<ul class="navbar-nav  justify-content-end" style="padding-right: 20px;" >';
            echo '<li class="nav-item d-flex align-items-center">';
            echo '  <a href="https://yomarket.info/@'. $profile->username. '" class="nav-link text-body font-weight-bold px-0">';
            echo '    <i class="fa fa-user me-sm-1"></i>';
            echo '<p class="d-sm-inline d-none"> Welcome Back: '. $profile->username. '!</p>';
            echo '  </a>';
            echo '</li>';
            echo '</ul>';

            echo '<ul class="navbar-nav  justify-content-end">';
            echo '<li class="nav-item d-flex align-items-center">';
            echo '  <a href="sign_out.php" class="nav-link text-body font-weight-bold px-0">';
            echo '    <i class="fa fa-user me-sm-1"></i>';
            echo '    <span class="d-sm-inline d-none">Sign Out</span>';
            echo '  </a>';
            echo '</li>';
            echo '</ul>';
          }
          ?>
      </div>
    </nav>

    <script>
  function toggleDropdown() {
    var dropdown = document.getElementById("myDropdown");
    dropdown.style.display = (dropdown.style.display === "block") ? "none" : "block";
  }

  
  function toggleGGDropdown() {
    var dropdown = document.getElementById("gg");
    dropdown.style.display = (dropdown.style.display === "block") ? "none" : "block";
  }

  // Close the dropdown if the user clicks outside of it
  window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
      var dropdowns = document.getElementsByClassName("dropdown-content");
      for (var i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.style.display === "block") {
          openDropdown.style.display = "none";
        }
      }
    }
  }
</script>
    <!-- End Navbar -->