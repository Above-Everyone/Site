<?php


require_once("yomarket/template.php");
require_once("yomarket/objects/response.php");

$iid = $_GET['id'] ?? "";
$price = $_GET['price'] ?? "";

if(empty($iid) || empty($price))
    die("Missing fields...!");

if($price === "reset") {
    TemplateGenerator::rmTemplateCookie();
    die("Template successfully reset!");
}

echo TemplateGenerator::addItem2Template($iid, $price);
echo $_COOKIE['ym_template_info'];
header('Location: https://yomarket.info/more_info.php?iid='. $iid);
die($_COOKIE['ym_template_info']);