<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include_once("../yomarket/market_lib.php");

    $ym_user = $_POST['ym_username'] ?? "";
    $ym_passwd = $_POST['ym_password'] ?? "";
    $ip = $_SERVER["HTTP_CF_CONNECTING_IP"] ?? $_SERVER['REMOTE_ADDR'];

    if(array_key_exists("ym_login", $_POST))
    {
        if(empty($ym_user) || empty($ym_passwd))
        {
            echo '<center><p>Missing fields!</p></center>';
            return;
        }
        $profile_eng = new Profiles($ym_user);
        $r = $profile_eng->LoginAuth($ym_user, $ym_passwd, $ip);

        if($r->type == ResponseType::LOGIN_SUCCESS) {
            setcookie("ym_user_info", $r->results->raw_data, time() + (600 * 30), "/", null, false, true);
            header('Location: https://yomarket.info/index.php', true, 302);
            exit();
        } else if($r->type == ResponseType::INVALID_INFO) {
            echo '<center><p>Invalid Information Provided</p></center>';
            return;
        } else if($r->type == ResponseType::LOGIN_FAILED || $r->type == ResponseType::NONE)
        {
            echo '<center><p>An error has occured while attempting to sign in</p></center>';
            return;
        }
    } else {
        header('Location: https://yomarket.info/', true, 302);
        exit();
    }
?>