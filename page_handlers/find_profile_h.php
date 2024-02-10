<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);
include_once("yomarket/market_lib.php");
include_once("yomarket/objects/response.php");
include_once("yomarket/objects/profile.php");

/*
    Profile search handler
*/
function search_profile_handler(string $profile_q): void
{
    if(empty($profile_q)) {
        echo '<center><p>No user was found with <b>'. $profile_q. '</b></p></center>';
        return;
    }

    // Find Profiles
}

function list_users(): void 
{
    $r = Profiles::list_users();

    if($r->type == ResponseType::REQ_FAILED)
    {
        echo "<p>Error, Unable to connect to YoMarket's API. Please try again (Try using all lowercase)</p><br /><p>This is a common bug we are working on fixing....!</p>";
    } else if($r->type == ResponseType::NONE) {
        echo "<center><p>No user was found with <b>$";
    } else if($r->type == ResponseType::REQ_SUCCESS)  {
        /*
            List all owners
        */
        echo '<center><p>Owners</p></center>';
        foreach($r->results[0] as $owner) {
            if(in_array($owner, array("[@OWNER]", "[@ADMINS]", "[@USERS]"))) continue;
            $profile_eng = new Profiles();
            $prof = $profile_eng->searchProfile(trim($owner), "5.5.5.5");

            if($prof->type == ResponseType::REQ_SUCCESS) {
                $p = $prof->results;
                echo '<div class="profile-box">';
                echo '<div class="profile-pic">';
                echo '<a href="http://yomarket.info/@'. $owner. '"><img src="https://yomarket.info/page_handlers/cropped_avi_h.php?URL=https://yw-web.yoworld.com/user/images/yo_avatars/000/187/753/187753659.png" alt="Profile Picture"></a>';
                echo '</div>';
                echo '<div class="profile-info">';
                echo '<h2>@'. $owner. '</h2>';
                echo '<div class="badges">';
                
                /*
                    Set Badge On User's View Card 
                */
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


        /* 
            List All Admins 
        */
        echo '<br /><br /><center><p>Admins</p></center><br />';
        foreach($r->results[1] as $admin) {
            if(in_array($admin, array("[@OWNER]", "[@ADMINS]", "[@USERS]", ""))) continue;
            $profile_eng = new Profiles();
            $prof = $profile_eng->searchProfile(trim($admin), "5.5.5.5");

            if($prof->type == ResponseType::REQ_SUCCESS) {
                $p = $prof->results;
                echo '<div class="profile-box">';
                echo '<div class="profile-pic">';
                echo '<a href="http://yomarket.info/@'. $admin. '"><img src="https://yomarket.info/page_handlers/cropped_avi_h.php?URL=https://yw-web.yoworld.com/user/images/yo_avatars/000/'. substr($p->yoworld_id, 0, 3). "/". substr($p->yoworld_id, 3, 3)."/". $p->yoworld_id. '.png" alt="profile_image" class="w-100 border-radius-lg shadow-sm"></a>';
                echo '</div>';
                echo '<div class="profile-info">';
                echo '<h2>'. $admin. '</h2>';
                echo '<div class="badges">';

                /*
                    Set Badge On User's View Card 
                */
                if(in_array(Badges::VERIFIED, $p->badges)) {
                    echo '<img class="verified_badge" src="https://puu.sh/K0a7Q/eab17f939a.png" alt="Badge 1"/>'; }
                if(in_array(Badges::ADMIN, $p->badges)) {
                    echo '<img class="admin_badge" src="https://puu.sh/K0ttu/941ecd1542.png" alt="Badge 2"/>'; }
                
                if(in_array(Badges::TRUSTED, $p->badges)) {
                    echo '<img class="trusted_badge" src="https://yomarket.info/t.png" alt="Badge 2"/>'; }
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '<div style="height: 10px;"background-color: transparent;"></div>';
            }
        }

        /*
            List All Users
        */
        echo '<br /><br /><center><p>Users</p></center><br />';
        foreach($r->results[2] as $user) {
            if(in_array($user, array("[@OWNER]", "[@ADMINS]", "[@USERS]", ""))) continue;
            $profile_eng = new Profiles();
            $prof = $profile_eng->searchProfile(trim($user), "5.5.5.5");
            
            if($prof->type == ResponseType::REQ_SUCCESS) {
                $p = $prof->results;
                echo '<div class="profile-box">';
                echo '<div class="profile-pic">';
                echo '<a href="http://yomarket.info/@'. $user. '"><img src="https://yomarket.info/page_handlers/cropped_avi_h.php?URL=https://yw-web.yoworld.com/user/images/yo_avatars/000/'. substr($p->yoworld_id, 0, 3). "/". substr($p->yoworld_id, 3, 3)."/". $p->yoworld_id. '.png" alt="profile_image" class="w-100 border-radius-lg shadow-sm"></a>';
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
}

?>