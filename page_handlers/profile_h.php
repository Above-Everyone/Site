<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);
require_once("yomarket/market_lib.php");
require_once("yomarket/objects/utils.php");
require_once("yomarket/objects/profile.php");

function add_display_badges(Response $display_profile): void 
{
    if(count($display_profile->results->badges) > 0)
    {
      if(in_array(Badges::VERIFIED, $display_profile->results->badges))
      {
        echo '<li class="nav-item">';
        echo '<a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="true">';
        echo '<img src="https://images-ext-1.discordapp.net/external/YhFGXZGaJHeKrXgPM1GUYC2lZMHOJNQnrAMwumJK0WM/https/puu.sh/K0a7Q/eab17f939a.png" alt="Verified Image" class="text-dark" width="70x" height="70px">';
        echo '<div class="col-auto my-auto"><div class="h-100">';
        echo '</div></div>';
        echo '</a></li>';
      } 
      
      if(in_array(Badges::TRUSTED, $display_profile->results->badges))
      {
        echo '<li class="nav-item">';
        echo '<a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="true">';
        echo '<img style="padding-top: 10px" src="https://yomarket.info/t.png" alt="Verified Image" class="text-dark" width="140x" height="65px">';
        echo '<div class="col-auto my-auto"><div class="h-100">';
        echo '</div></div>';
        echo '</a>';
        echo '</li>';
      }
    }
}

function list_activities(Response $display_profile): void 
{
    if(count($display_profile->results->activities) > 0) {
        $n = array_reverse($display_profile->results->activities);
        foreach($n as $act) {
        echo '<li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">';
        echo '<div class="avatar me-3">';

        if(empty($act->item))
            { echo '<img src="https://yomarket.info/page_handlers/cropped_avi_h.php?URL=https://yw-web.yoworld.com/user/images/yo_avatars/000/'. substr($display_profile->results->yoworld_id, 0, 3). "/". substr($display_profile->results->yoworld_id, 3, 3)."/". $display_profile->results->yoworld_id. ".png" .'" alt="kal" class="border-radius-lg shadow">'; }
            else { echo '<img src="'. $act->item->url. '" alt="kal" class="border-radius-lg shadow">'; }

            echo '</div>';
            echo '<div class="d-flex align-items-start flex-column justify-content-center">';
            echo '<h6 class="mb-0 text-sm">'. $display_profile->results->username. ' '. Activity_T::type2humanstr($act->act_t);

            if($act->act_t == Activity_T::item_sold || $act->act_t == Activity_T::item_bought) {
                echo ' for '. $act->price; }
            else if($act->act_t == Activity_T::price_change) {
                echo ' price the of '. $act->item->id. " to ". $act->price; }
            else if($act->act_t == Activity_T::fs_posted) {
                echo " ". $act->item->name. " for ". $act->price; }
            else if($act->act_t == Activity_T::wtb_posted) {
                echo " ". $act->item->name. "!"; }
            else if($act->act_t == Activity_T::invo_posted) {
                echo " ". $act->item->name. " to their inventory"; }
            else if($act->act_t == Activity_T::item_viewed) {
                echo " ". $act->item->name; }
            
            echo '</h6>';
            echo '<p class="mb-0 text-xs">'. $act->timestamp. '</p>';
        }
    } else { 
        echo '<p>'. $display_profile->results->username. ' has no activities</p>'; 
    }
}

function list_invo(Response $display_profile): void 
{
    if(count($display_profile->results->invo) > 0 ) {
        echo '<div class="result_box" style="margin-left: 0px">';
        echo '<div class="grid-container">';
        foreach($display_profile->results->invo as $item) {
            echo '<div class="grid-item">';
            echo '<p class="item-name bg-gradient-primary" style="font-size: 15px; color: #000000"><b>'. $item->name. '</b></p>';
            echo '<img style="padding-top: 20px;" width="100" height="100" src="'. $item->url. '" />';
            echo '<p style="font-size: 15px;color: #ff0000">#'. $item->id. '<br/>Price: '. ($item->price == "" ? "N/A" : $item->price). '<br />Update: '. ($item->update == "" ? "N/A" : $item->update). '</p>';
            echo '<div class="form-group mb-4"><div class="col-sm-12"><a class="fit btn btn-success" href="https://yomarket.info/more_info.php?iid='. $item->id. '">More Info</a></div></div>';
            echo '</div>';
        }
        echo '</div>';
        echo '</div>';
    } else { 
        echo '<p>'. $display_profile->results->username. ' has no items!</p>'; 
    }
}

function list_fs(Response $display_profile): void 
{
    if(count($display_profile->results->fs_list) > 0 ) {
        echo '<div class="result_box" style="margin-left: 0px">';
        echo '<div class="grid-container">';
        foreach($display_profile->results->fs_list as $item) {
            echo '<div class="grid-item">';
            echo '<p class="item-name bg-gradient-primary" style="font-size: 15px; color: #000000"><b>'. $item->item->name. '</b></p>';
            echo '<img style="padding-top: 20px;" width="100" height="100" src="'. $item->item->url. '" />';
            echo '<p style="font-size: 15px;color: #ff0000">#'. $item->item->id. '<br />Selling for: '. ($item->fs_price == "" ? "N/A" : $item->fs_price). '<br />Posted: '. ($item->posted_timestamp == "" ? "N/A" : $item->posted_timestamp). '</p>';
            echo '<div class="form-group mb-4"><div class="col-sm-12"><a class="fit btn btn-success" href="https://yomarket.info/more_info.php?iid='. $item->item->id. '">More Info</a></div></div>';
            echo '</div>';
        }
        echo '</div>';
        echo '</div>';
    } else { echo '<p>'. $display_profile->results->username. ' has no items!</p>'; }
}

function list_wtb(Response $display_profile): void 
{
    if(count($display_profile->results->wtb_list) > 0 ) {
        echo '<div class="result_box" style="margin-left: 0px">';
        echo '<div class="grid-container">';
        foreach($display_profile->results->wtb_list as $item) {
            echo '<div class="grid-item">';
            echo '<p class="item-name bg-gradient-primary" style="font-size: 15px; color: #000000"><b>'. $item->item->name. '</b></p>';
            echo '<img style="padding-top: 20px;" width="100" height="100" src="'. $item->item->url. '" />';
            echo '<p style="font-size: 15px;color: #ff0000">#'. $item->item->id. '</p>';
            echo '<p style="font-size: 15px;color: #ff0000">Offering: '. ($item->wtb_price == "" ? "N/A" : $item->wtb_price). '<br />Posted: '. ($item->posted_timestamp == "" ? "N/A" : $item->posted_timestamp). '</p>';
            echo '<div class="form-group mb-4"><div class="col-sm-12"><a class="fit btn btn-success" href="https://yomarket.info/more_info.php?iid='. $item->item->id. '">More Info</a></div></div>';
            echo '</div>';
        }
        echo '</div>';
        echo '</div>';
    } else { 
        echo '<p>'. $display_profile->results->username. ' has no items!</p>'; 
    }
}

?>