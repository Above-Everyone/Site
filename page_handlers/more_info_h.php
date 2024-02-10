<?php
/* Reporting all errors */
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

require_once("yomarket/template.php");
require_once("yomarket/item_lib.php");
require_once("yomarket/market_lib.php");
require_once("yomarket/objects/utils.php");
require_once("yomarket/objects/response.php");

$r = new Response(ResponseType::NONE, 0);

/*
    Check to see if a user is logged in for user features 
*/
function check_for_profile(string $cookie): Profile
{
    $MORE_INFO_PAGE_PROFILE;
    if(!empty($cookie)) { 
        $MORE_INFO_PAGE_PROFILE = new Profile($cookie);
        return $MORE_INFO_PAGE_PROFILE;
    }

    return $MORE_INFO_PAGE_PROFILE;
}

function run_search_handler(string $itemID, string $ip, string $agent, string $cookie): void
{
    global $r;
    $r = new Response(ResponseType::NONE, 0);

    /* Input Sanitizing */
    if(empty($itemID)) {
        echo "[ X ] Fill out GET parameters to continue...!";
    }

    $profile = check_for_profile($cookie);
    $owner = false;
    $admin = false;

    /*
    Checking to see if user is signed in
    */
    if(in_array(Badges::ADMIN, $profile->badges)) {
        $admin = true; 
    }

    if(in_array(Badges::OWNER, $profile->badges)) {
        $owner = true;
    }
                          
    /* Item Searching */
    $items = new Items();
    $r = $items->searchItem($itemID, $ip."&agent=". $agent);

    if($r->type == ResponseType::REQ_FAILED || $r->type == ResponseType::NONE)
    {
        echo "<center><p>Error, Unable to connect to YoMarket's API. Please try again (Try using all lowercase)</p><br /><p>This is a common bug we are working on fixing....!</p><center>";
    } else if($r->type == ResponseType::EXACT)
    {
        echo  '<div class="result-box">';
        echo  '<div class="img-box">';
        echo  '<center><img width="200" height="200" src="'. $r->results->url. '"/></center>';
        echo  '</div>';

        echo  '<div class="result-gap"></div>';
        echo  '<div class="info-box">';
        echo '<center><h2>'. $r->results->name.'</h2>';
        echo '<p class="fit" id="current_item_id" name="current_item_id">Item ID: '. $r->results->id. '</p>';
        echo '<p class="fit">Price: '. $r->results->price. '</p>';
        echo '<p class="fit">In-Store: '. ($r->results->in_store == "0" ? "Yes":"No"). '</p>';
        echo '<p class="fit">Store Price: '. ($r->results->store_price == "" ? "N/A" : $r->results->store_price). '</p>';
        echo '<p class="fit">Gender: '. ($r->results->gender == "" ? "N/A" : $r->results->gender). '</p>';
        echo '<p class="fit">XP: '. ($r->results->xp == "" ? "N/A" : $r->results->xp). '</p>';
        echo '<p class="fit">Category: '. ($r->results->category == "" ? "N/A" : $r->results->category). '</p>';
        echo '<form method="post"><div class="mb-3"><input type="text" class="form-control" style="width: 400px;padding: 10px;" placeholder="Price (ex: 2m)" aria-label="Name" aria-describedby="email-addon" id="new_price" name="new_price"></div>';

        echo '<div class="form-group mb-4" style="margin-right:16px;display: inline-block;"><div class="col-sm-12">';
        if($admin) {
            echo '<input style="width: 200px;" type="submit" class="fit btn btn-success" id="price_btn" name="price_btn" value="Change Price"/>';
        } else {
            echo '<input style="width: 200px;" type="submit" class="fit btn btn-success" id="price_btn" name="price_btn" value="Suggest"/>';
        }
        echo '<input style="margin-left:16px;width: 200px;" type="submit" class="fit btn btn-success" id="add2template" name="add2template" value="Add To Template"/>';
        echo '<input style="margin-left:16px;width: 200px;" type="submit" class="fit btn btn-success" id="#" name="#" value="Request Price Check"/></div></div>';

        echo '<br/><div class="form-group mb-4" style="margin-right:16px;display: inline-block;"><div class="col-sm-12">';
        echo '<input style="margin-left:16px;width: 200px;" type="submit" class="fit btn btn-success" id="add_to_invo" name="add_to_invo" value="Add To Invo"/>';
        echo '<input style="margin-left:16px;width: 200px;" type="submit" class="fit btn btn-success" id="add_to_fs" name="add_to_fs" value="Add To FS"/>';
        echo '<input style="margin-left:16px;width: 200px;" type="submit" class="fit btn btn-success" id="add_to_wtb" name="add_to_wtb" value="Add To WTB"/></div></div>';

        echo '<br/><div class="form-group mb-4" style="margin-right:16px;display: inline-block;"><div class="col-sm-12">';
        echo '<input style="margin-left:16px;width: 200px;" type="submit" class="fit btn btn-success" id="rm_from_invo" name="rm_from_invo" value="Remove From Invo"/>';
        echo '<input style="margin-left:16px;width: 200px;" type="submit" class="fit btn btn-success" id="rm_from_fs" name="rm_from_fs" value="Remove From FS"/>';
        echo '<input style="margin-left:16px;width: 200px;" type="submit" class="fit btn btn-success" id="rm_from_wtb" name="rm_from_wtb" value="Remove From WTB"/></div></div>';
        echo '</center></div>';
        echo '</div></form>';
    } else {
        echo "[ X ] Error, No item was found...!";
    }
}

/*
    Add To Template Functionality 
*/
function add2template_handler(string $itemID = "", string $n_price = ""): void
{
    if(empty($itemID) || empty($n_price)) {
        echo "Missing fields...!";
        return;
    }

    echo TemplateGenerator::addItem2Template($itemID, $n_price);
}

/*
    Price Change Handler & Profile Event Handler
*/
function price_change_handler(string $itemID, string $n_price, string $info, string $ip, string $agent): void
{
    if(empty($itemID) || empty($itemID)) {
        echo "[ X ] Fill out GET parameters to continue...!";
        return;
    }

    $items = new Items();
    $r = $items->searchItem($itemID, $ip."&agent=". $agent);

    if(empty($info)) {
        echo "<center><p>Error, You must be signed in to suggest a price!</p></center>";
        return;
    }

    $MORE_INFO_PAGE_PROFILE = check_for_profile($info);

    if(!in_array(Badges::ADMIN, $MORE_INFO_PAGE_PROFILE->badges) && !in_array(Badges::OWNER, $MORE_INFO_PAGE_PROFILE->badges)) {
        echo "<center><p>Error, You Aren't an admin to change prices! </p><center>";
        return;
    }

    if($r->type != ResponseType::EXACT) {
        echo "<center><p>Error, Unable to find item!<br />Something went wrong. Contact an admin!</p><center>";
        return;
    }

    $change_r = $items->changePrice($r->results, $n_price, $MORE_INFO_PAGE_PROFILE->username, $ip);

    if($change_r->type == ResponseType::ITEM_UPDATED)
    {
        // $format = YoGuide::format_change_log($ip, $itemID, $r->result->price, $n_price);
        // YoGuide::send_post_req((new YoGuide())->CHANGE_LOG_URL, $format);
        echo "<center><p>Item ". $r->results->name. " successfully updated....!</p><center>";
        return;
    }
}

function add2fs_handler(string $itemID, string $n_price, string $info, string $ip): void
{
    if(empty($itemID) || empty($n_price)) {
        echo "<center><p>[ X ] You must enter a price...!</p></center>";
        return;
    }

    if(empty($info)) {
        echo "<center><p>Error, You must be signed in to use this!</p></center>";
        return;
    }
    
    $MORE_INFO_PAGE_PROFILE = check_for_profile($info);
    $action_check = (new Profiles($MORE_INFO_PAGE_PROFILE->username))->addItem($MORE_INFO_PAGE_PROFILE->username, $MORE_INFO_PAGE_PROFILE->password, $ip, $itemID, $n_price, Settings_T::add_to_fs);

    if($action_check->type != ResponseType::REQ_SUCCESS) {
        echo "<center><p>Action Failed<br />Contact an admin for more info!</p></center>";
        return; 
    }
    
    echo "<center><p>Item has been added to your FS list!</p></center>";
    return;
}

/*
    Remove item from FS Handler
*/
function rmfromfs_handler(string $itemID, string $info, string $ip) 
{
    if(empty($itemID)) {
        echo "<center><p>[ X ] Fill out GET parameters to continue...!</p></center>";
        return;
    }

    if(empty($info)) {
        echo "<center><p>Error, You must be signed in to use this!</p></center>";
        return;
    }

    $MORE_INFO_PAGE_PROFILE = check_for_profile($info);
    $action_check = (new Profiles($MORE_INFO_PAGE_PROFILE->username))->rmItem($MORE_INFO_PAGE_PROFILE->username, $MORE_INFO_PAGE_PROFILE->password, $ip, $itemID, Settings_T::rm_from_fs);
    var_dump($action_check);
    if($action_check->type != ResponseType::REQ_SUCCESS) {
        echo "<center><p>Action Failed<br />Contact an admin for more info!</p></center>";
        return; 
    }

    echo "<center><p>Item has been removed from your FS list!</p></center>";
    return;
}

function add2wtb_handler(string $itemID, string $n_price, string $info, string $ip): void
{
    if(empty($itemID) || empty($n_price)) {
        echo "<center><p>[ X ] Fill out GET parameters to continue...!</p></center>";
        return;
    }

    if(empty($info)) {
        echo "<center><p>Error, You must be signed in to use this!</p></center>";
        return;
    }

    $MORE_INFO_PAGE_PROFILE = check_for_profile($info);
    $action_check = (new Profiles($MORE_INFO_PAGE_PROFILE->username))->addItem($MORE_INFO_PAGE_PROFILE->username, $MORE_INFO_PAGE_PROFILE->password, $ip, $itemID, $n_price, Settings_T::add_to_wtb);
                        // 
    if($action_check->type != ResponseType::REQ_SUCCESS) {
        echo "<center><p>Action Failed<br />Contact an admin for more info!</p></center>";
        return; 
    }

    echo "<center><p>Item has been added to your WTB list!</p></center>";
    return;
}

/*
    Remove item from FS Handler
*/
function rmfromwtb_handler(string $itemID, string $info, string $ip): void
{
    if(empty($itemID)) {
        echo "<center><p>[ X ] Fill out GET parameters to continue...!</p></center>";
        return;
    }

    if(empty($info)) {
        echo "<center><p>Error, You must be signed in to use this!</p></center>";
        return;
    }
    
    $MORE_INFO_PAGE_PROFILE = check_for_profile($info);
    $action_check = (new Profiles($MORE_INFO_PAGE_PROFILE->username))->rmItem($MORE_INFO_PAGE_PROFILE->username, $MORE_INFO_PAGE_PROFILE->password, $ip, $itemID, Settings_T::rm_from_wtb);

    if($action_check->type != ResponseType::REQ_SUCCESS) {
        echo "<center><p>Action Failed<br />Contact an admin for more info!</p></center>";
        return; 
    }

    echo "<center><p>Item has been removed from your WTB list!</p></center>";
    return;
}

function add2invo_handler(string $itemID, string $info, string $ip): void 
{
    if(empty($itemID)) {
        echo "<center><p>[ X ] Fill out GET parameters to continue...!</p></center>";
        return;
    }

    if(empty($info)) {
        echo "<center><p>Error, You must be signed in to use this!</p></center>";
        return;
    }

    $MORE_INFO_PAGE_PROFILE = check_for_profile($info);
    $action_check = (new Profiles($MORE_INFO_PAGE_PROFILE->username))->addItem($MORE_INFO_PAGE_PROFILE->username, $MORE_INFO_PAGE_PROFILE->password, $ip, $itemID, "", Settings_T::add_to_invo);

    if($action_check->type != ResponseType::REQ_SUCCESS) {
        echo "<center><p>Action Failed<br />Contact an admin for more info!</p></center>";
        return; 
    }

    echo "<center><p>Item has been added to your inventory!</p></center>";
    return;
}

function rmfrominvo_handler(string $itemID, string $info, string $ip): void 
{
    $ip = $_SERVER["HTTP_CF_CONNECTING_IP"] ?? $_SERVER['REMOTE_ADDR'];
    $n_price = $_POST['new_price'] == "" ? "0": $_POST['new_price'];
    
    if(empty($itemID)) {
        echo "<center><p>[ X ] Fill out GET parameters to continue...!</p></center>";
        return;
    }
    
    if(empty($info)) {
        echo "<center><p>Error, You must be signed in to use this!</p></center>";
        return;
    }

    $MORE_INFO_PAGE_PROFILE = check_for_profile($info);
    $action_check = (new Profiles($MORE_INFO_PAGE_PROFILE->username))->rmItem($MORE_INFO_PAGE_PROFILE->username, $MORE_INFO_PAGE_PROFILE->password, $ip, $itemID, Settings_T::rm_from_invo);

    if($action_check->type != ResponseType::REQ_SUCCESS) {
        echo "<center><p>Action Failed<br />Contact an admin for more info!</p></center>";
        return; 
    }

    echo "<center><p>Item has been removed from your inventory list!</p></center>";
    return;
}

/*
    Listing yoworld.info prices!
*/
function list_yw_info_price()
{
    global $r;
    if($r->type == ResponseType::EXACT)
    {
        echo '<br />';
        echo '<center><div style="width: 500px"><p>Please keep in mind that these prices below are not the suggested prices that Yoworld.Info. Suggested prices on Yoworld.Info are Unapproved prices. These prices below are approved and previous prices to the specific item which are hidden on their website!</p></div></center>';
        echo '<div style="height: 50px;"></div>';
        echo '<div class="log-box">';
        echo '<center><h1>Yoworld.Info\'s Price Change History</h1>';
        foreach($r->results->ywinfo_prices as $price) 
        {
            echo '<div stlye="display: inline-block">';
            echo '<p class="fit-price">Price: '. $price->price. ' | </p>';
            echo '<p class="fit-price">Update: '. $price->timestamp. ' | </p>';
            echo '<p class="fit-price">Approved: '. $price->approve. ' | </p>';
            echo '<p class="fit-price">Approved By: '. $price->approved_by. ' | </p>';
            echo '</div>';
        }
        echo '</center></div>';
        echo '</div>';
    }
}

?>