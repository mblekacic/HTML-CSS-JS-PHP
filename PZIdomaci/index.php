<!DOCTYPE html> 
<html>
	<head> 
		<meta charset="utf-8">
    <title>Domaci rad</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link rel="stylesheet" href="font-awesome.min.css"/>
    <link rel="stylesheet" href="style.css"/>
	</head>	

	<body> 
		<header>
      <div class="ikone-lijevo">
			  <img id="logo-slika" src="slike/instagram.jpg"/>
        <img id="logo-text" src="slike/instagram1.png"/>
      </div>
			<div id="search-container">
			  <i class="fa fa-search search-icon"></i>
			  <input type="text" id="search-box" placeholder="Traži"/>
      </div>
      <div class="ikone-desno">  
        <i class="fa fa-heart-o heart-icon clickable-icon" id="srce1"></i>
        <i class="fa fa-user-o user_icon clickable-icon" id="korisnik"></i>
      </div>
    
    </header>
    
    <main class="container">
      <div class="prvi-stupac">
      <button id="botun-dodaj">Dodaj novu objavu! :)</button>
        
      <?php 
          require_once("php/posts.php");
          echo(generatePostsHtml());
        ?>

      </div>
      <div class="drugi-stupac">
        <div class="korisnik">
          <img class ="profilna" src="slike/ja.jpg" alt="ja">
          <div class="informacije">
            <strong>Mica0202</strong>
            <p>Mica Maca</p>
          </div>
        </div>
        <div class="o-meni">
          <p>O meni:</p>
          <p>
          
        <i class="fa fa-user user_icon" id="korisnik"></i>
            : 
            <span id="Pratim"> 52 </span>
          </p>
          <p>
            <i class="fa fa-heart heart-icon" id="srce"></i>
              :  
              <span class="svida-mi-se"> 402 </span>
          </p>
          <p>
              <i class="fa fa-bookmark bookmark_icon" id="bookmark"></i> 
              :  
              <span class="bookmark"> 42 </span>
          </p>
        </div>

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

      </div>

      <template id="template">
        <hr>
  <div class="objava">
    <div class="objava-korisnika">
      <img src="slike/ja.jpg" class="profilna">
      <div class="informacije">
        <strong>Rozita021</strong>
        <p id="lokacija">Trogir, Croatia</p>
      </div>
    </div>
    <div class="slika">
      <img src="slike/ja.jpg">
    </div>
    <div class="ispod-objave">
      <div class="ikone-ispod-objave">
        <div class="ikone-ispod-objave-lijevo">
            <i class="fa fa-heart-o heart-icon clickable-icon" id="srce"></i>
            <i class="fa fa-comment-o comment_icon clickable-icon" id="komentar"></i>
            <i class="fa fa-share share_icon" id="komentar"></i>
        </div>
        <div class="ikone-ispod-objave-desno">
            <i class="fa fa-bookmark-o bookmark_icon clickable-icon" id="bookmark"></i>
        </div>
      </div>
      <div class="lajk">
        <p>Svida mi se: 
          <span class="broj-lajkova"> 0 </span>
        </p>
        <div class="link"> </div>
      </div>
      <div class="komentari">
        <p> 
          <strong></strong> 
        </p>
        <hr>
      </div>
      <input class="komentiraj" placeholder="Komentiraj...">
    </div>
  </div>
</div>
</template>
      <script src="java.js"></script>
    </main>
  </body>
  
  
</html>
