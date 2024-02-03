<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include_once("yomarket/market_lib.php");

    $ym_uname   = $_POST['ym_new_username'] ?? "";
    $ym_passwd  = $_POST['ym_new_pw'] ?? "";
    $ym_ywid    = $_POST['ym_new_id'] ?? "";
    $ip         = $_SERVER["HTTP_CF_CONNECTING_IP"];

    if(array_key_exists("sign_up_btn", $_POST))
    {
        if(!array_key_exists("ym_new_username", $_POST) || 
           !array_key_exists("ym_new_pw", $_POST) || 
           !array_key_exists("ym_new_id", $_POST))
        {
            echo '<center><p>Missing fields!</p></center>';
            return;
        }

        if(!ctype_alpha($ym_uname) || !(int)$ym_uname > 0)
        {
            echo '<center><p>Invalid info provided!<br />'. $ym_uname. ' | '. $ym_passwd. ' | '. $ym_ywid. '</p></center>';
            return;
        }

        $ym_eng = new Profiles("gg");
        $create_check = $ym_eng->createProfile($ym_uname, $ym_passwd, $ip, $ym_ywid);

        if($create_check->type == ResponseType::REQ_SUCCESS) {
            unset($_COOKIE['ym_user_info']);
            setcookie("ym_user_info", $new_profile->results, time() + (600 * 30), "/", null, false, true);
            header('Location: https://yomarket.info/index.php', true, 302);
            exit();
        } else if($create_check->type == ResponseType::INVALID_INFO) {
            echo '<center><p>Invalid Information Provided</p></center>';
            return;
        } else if($create_check->type == ResponseType::LOGIN_FAILED || $create_check->type == ResponseType::NONE)
        {
            echo '<center><p>An error has occured while attempting to sign in</p></center>';
            return;
        }
    } else {
        header('Location: https://yomarket.info/', true, 302);
        exit();
    }
?>