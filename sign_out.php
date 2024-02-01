<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    setcookie("ym_user_info", "", time() + (600 * 30), "/", null, false, true);
    header('Location: https://yomarket.info/index.php', true, 302);
    exit();
?>