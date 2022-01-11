<?php

require_once("php/posts.php");

function processRequest(){
    $action = getRequestParameter("action");
    switch ($action) {
        case 'togglePostLike':
            processTogglePostLike();
            break;
        case 'togglePostBookmark':
            processTogglePostBookmark();
            break;
        case 'addNewPost':
            processAddNewPost();
            break;
        case 'addNewComment':
            processAddNewComment();
            break;
        default:
            echo(json_encode(array(
                "success" => false,
                "reason" => "Unknown action: $action"
            )));
            break;
    }
}
function processTogglePostLike(){
 $success = false;
 $reason = "";
 $id = getRequestParameter("id");
 $like = getRequestParameter("like");
 if (is_numeric($id) && is_numeric($like)) {
 togglePostLike($id, $like);
 $success = true;
 } else {
 $success = false;
 $reason = "Needs id:number; like:number";
 }
 echo(json_encode(array(
 "success" => $success,
 "reason" => $reason
 )));
}
function processTogglePostBookmark(){
    $success = false;
    $reason = "";
    $id = getRequestParameter("id");
    $bookmark = getRequestParameter("bookmark");
    if (is_numeric($id) && is_numeric($bookmark)) {
    togglePostBookmark($id, $bookmark);
    $success = true;
    } else {
    $success = false;
    $reason = "Needs id:number; bookmark:number";
    }
    echo(json_encode(array(
    "success" => $success,
    "reason" => $reason
    )));
   }
function processAddNewPost(){
    $success = false;
    $reason = "";
    $id="";
    $lokacija=getRequestParameter("Lokacija");
    $imageUrl=getRequestParameter("ImageUrl");
    $Hashtags=getRequestParameter("Hashtags");
    if($imageUrl && isset($Hashtags)){
        $id=AddNewPost($lokacija,$imageUrl,$Hashtags);
        $success = true;
    } else {
    $success = false;
    $id="";
    $reason = "Image or hashtags not set";
    }
    echo(json_encode(array(
        "id"=>$id,
    "success" => $success,
    "reason" => $reason
    )));
}


function processAddNewComment(){
    $success=true;
    $reason="";
    $postID=getRequestParameter("ID");
    $Comment=getRequestParameter("Comment");
    $Time=getRequestParameter("Time");
    if(is_numeric($postID)&&$Comment){
        addNewComment($postID,$Comment,$Time);
        $success=true;
    }
    else{
        $success=false;
        $reason="Comment not set";
    }
    echo(json_encode(array(
        "success" => $success,
        "reason" => $reason
        )));
    }
function getRequestParameter($key) {
	return isset($_REQUEST[$key]) ? $_REQUEST[$key] : "";
}

processRequest();