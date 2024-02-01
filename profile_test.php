<?php

require_once("yomarket/market_lib.php");

$profiles = new Profiles("gg");
// $profile = $profiles->searchProfile("billy", "5.5.5.5");
$profile = $profiles->createProfile("test", "gay", "5.5.5.5", "56563");

var_dump($profile);
?>
