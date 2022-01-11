<?php
require_once("DatabaseAccess.php");

function getPostsFromDb(){
    return getDbAccess()->executeQuery("SELECT * FROM `Posts`  ORDER BY `Posts`.`ID` DESC;");
}
function getCommentsFromDb($postID){
  return getDbAccess()->executeQuery("SELECT * FROM `Comments` WHERE `Comments`.`Post_ID`=$postID ");
}
function togglePostLike($id, $liked){
  if($liked==0){
    getDbAccess()->executeQuery("UPDATE Posts
    SET Total_likes = Total_likes -1 WHERE
  ID='$id';");
  }
  else{
    getDbAccess()->executeQuery("UPDATE Posts
    SET Total_likes = Total_likes + 1 WHERE
  ID='$id';");
  }
 getDbAccess()->executeQuery("UPDATE
Posts SET Liked='$liked' WHERE
ID='$id';");
 
}
function togglePostBookmark($id, $bookmarked){
  if($bookmarked==0){
    getDbAccess()->executeQuery("UPDATE Posts
    SET Total_bookmarks = Total_bookmarks -1");
  }
  else{
    getDbAccess()->executeQuery("UPDATE Posts
    SET Total_bookmarks = Total_bookmarks + 1");
  }
 getDbAccess()->executeQuery("UPDATE
Posts SET Bookmarked='$bookmarked' WHERE
ID='$id';");
}
function addNewPost($lokacija,$imageUrl,$hashtags){
  getDbAccess()->executeQuery("INSERT INTO `Posts` (`ID`, `Ime_Korisnika`, `Lokacija`,`ProfileImageUrl`,`ImageUrl`, `Liked`, `Total_likes`,`Bookmarked`,`Total_bookmarks`,`Hashtags`) VALUES
  (default, 'marijetablekacic', '$lokacija', 'slike/ja.jpg', '$imageUrl', 0,0,0,0,'$hashtags');");
  return getDbAccess()->executeQuery("SELECT `ID` FROM `Posts` ORDER BY `ID` DESC LIMIT 1");
}

function addNewComment($postID,$Comment,$Time){
  getDbAccess()->executeQuery("INSERT INTO `Comments` (`ID`, `Ime_Korisnika`, `Comment`,`Post_ID`, `Time`) VALUES
  (default, 'marijetablekacic', '$Comment','$postID','$Time');");
}


function generatePostsHtml(){
    $html = "";

    $posts = getPostsFromDb();
    
    $i=-1;
    foreach($posts as $post){
        $id = $post[0];
        $Ime_korisnika = $post[1];
        $Lokacija=$post[2];
        $ProfileImageUrl=$post[3];
        $ImageUrl = $post[4];
        $Liked = $post[5];
        $Total_likes=$post[6];
        $Bookmarked=$post[7];
        $Total_bookmarks=$post[8];
        $Hashtags=$post[9];
        $comments=getCommentsFromDb($id);
        $i++;
        $heartClass = $Liked == '1' ? "fas" : "far";
        $bookmarkClass=$Bookmarked =='1'?"fas": "far";
        
        if($i==2){
          $html.='
          
        <div class="Predlozeno">
        <p> Mi predlazemo: </p>
        <div class="predlozeni-korisnik1">
            <img src="slike/maca3.jpg" class="profilna-predlozenog" alt="maca4">
            <p>Maca3</p>
            <button class="prati">Prati</button>
        </div>
        <div class="predlozeni-korisnik1">
            <img src="slike/maca4.jpg" class="profilna-predlozenog" alt="maca5">
            <p>Maca4</p>
            <button class="prati">Prati</button>
        </div>
        <div class="predlozeni-korisnik1">
            <img src="slike/maca5.jpg" class="profilna-predlozenog" alt="maca6">
            <p>Maca5</p>
            <button class="prati">Prati</button>
        </div>
      </div>

    </div>';
        }
        $html .= "<div class='objava' post-id='$id'>
        <div class='objava-korisnika'>
          <img src='$ProfileImageUrl'class="profilna">
          <div class="informacije">
            <strong>$Ime_korisnika</strong>
            <p id='$Lokacija'>ZOO France</p>
          </div>
        </div>
        <div class='slika'>
          <img src='$imageUrl'>
        </div>
        <div class='ispod-objave'>
          <div class='ikone-ispod-objave'>
            <div class='ikone-ispod-objave-lijevo'>
              <i class='$heartClass fa-heart heart_icon'></i>
              <i class='far fa-comment comment_icon'></i>
            </div>
            <div class='ikone-ispod-objave-desno'>
            <i class='$bookmarkClass fa-bookmark bookmark_icon' style='float:right'></i>
            </div>
          </div>
          <div class='lajk'>
            <p>Svida mi se: 
              <span class='broj-lajkova'> $Total_likes </span>
            </p> 
          </div>
          <div class='link'>$Hashtags</div>
          <div class='komentari'>";
        if(!empty($comments)){
           foreach($comments as $comment){
                $CommentPoster=$comment[1];
                $Comment=$comment[2];
                $CommentTime=$comment[4];
                $html.=" <div class='komentari'>
                <p> 
                  <strong>$CommentPoster</strong> $Comment
                </p>
              <hr>
              </div>";
              }
            }
            $html.="  </p>
            <hr>
            </div>
            <input class='komentiraj' placeholder='Komentiraj...'>
          </div>
        </div>
";
    }

    return $html;
}