<?php
require_once("yomarket/market_lib.php");
require_once("yomarket/objects/response.php");

$r = (new Profiles())->searchProfile("billy", "5.5.5.5");
var_dump($r);
?>