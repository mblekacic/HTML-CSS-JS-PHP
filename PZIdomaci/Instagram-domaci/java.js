/*Zadatak 1: Toggle srce on/off */
//a) Dohvati sve srca u karticama
let heartIcons = document.querySelectorAll(".heart-icon");
for (let i = 1; i < heartIcons.length; i++) {
    let heartIcon = heartIcons[i];
    //b) Za svako srce registiraj funkciju koja će se pokrenuti na klik
    heartIcon.addEventListener("click", handleHeartIconClick);
}

async function handleHeartIconClick(e) {
    //c) Promini klase fa-heart fa-heart-o za efekt punog/praznog srca
    let heartIcon = e.currentTarget; //Srce na koje smo sad klikli
    let post = e.target.parentElement.parentElement.parentElement;
    let brojLajkova = post.querySelector(".broj-lajkova");
    let mojasvidanja = document.querySelector(".svida-mi-se");
    let postId = parentPost.getAttribute("post-id");   
   let isCurrentlyLiked = heartIcon.classList.contains("fa-heart");
 
  try {   
    let serverResponse = await 
    fetch(`API.php?action=togglePostLike&id=${postId}&like=${isCurrentlyLiked ? 0 : 1}&likeCount=${encodeURIComponent(postLike.innerText)}`);             
    let responseData = await serverResponse.json(); 
 
    if(!responseData.success){    
        alert(`Error liking card: ${responseData.reason}`);       
        return;     
    } 
 
    if(!isCurrentlyLiked){       
        heartIcon.classList.remove("fa-heart-o");       
        heartIcon.classList.add("fa-heart");     
        postLike.textContent++;
        globalLike.textContent++;
    }     
    else {       
        heartIcon.classList.remove("fa-heart");       
        heartIcon.classList.add("fa-heart-o");
        postLike.textContent--;
        globalLike.textContent--;     
    }   
}   
catch(e) {     
    alert("Error when liking card");   
}
}

//dodaj novu objavu
let newPost = document.querySelector("#botun-dodaj").addEventListener("click", e => {
    let location = prompt("Unesi lokaciju", "Trogir, Croatia");
    if (!location) return;
    let imageUrl = prompt("Unesi sliku", "slike/ja.jpg");
    if (!imageUrl) return;
    let tags = prompt("Unesi heshtagove", "maca");
    if (!tags) return;
    else {
        tags = tags.split(" ").join(" #");
    }
    let postTemplate = document.querySelector("#template");
    let postElement = document.importNode(postTemplate.content, true);
    postElement.querySelector(".slika img").src = imageUrl;
    postElement.querySelector("#lokacija").textContent = location;
    postElement.querySelector(".link").textContent = "#" + tags;
    postElement.querySelector(".heart-icon").addEventListener("click", handleHeartIconClick);
    postElement.querySelector("#komentar").addEventListener("click", handleCommentIcon)
    postElement.querySelector(".komentiraj").addEventListener("change", handleCommentSubmit);

    let prvistupac = document.querySelector(".prvi-stupac");
    prvistupac.appendChild(postElement);
});

/*
   const commentIcons = document.querySelectorAll(".fa-comment");
    commentIcons.forEach(comment => {
        comment.addEventListener("click",handleCommentIcon)   
          });*/
function handleCommentIcon(e) {
    const selectPost = e.target.parentElement.parentElement.parentElement;
    selectPost.querySelector(".komentiraj").focus();
}

const commentBox = document.querySelectorAll(".komentiraj");
commentBox.forEach(comment => {
    comment.addEventListener("change", handleCommentSubmit);
})

//dodavanje komentara
function handleCommentSubmit(e) {
    let commentText = e.target.value;
    let com = document.createElement("div");
    com.innerHTML = `<p><strong>Mica0202:</strong> ${commentText}</p>`;
    e.target.parentElement.querySelector(".komentari").appendChild(com);
    e.target.value = "";
}

//izbrisi prijedlog

const delIcons = document.querySelectorAll(".del_icon");
delIcons.forEach(icon => {
    icon.addEventListener("click", e => {
        const user = e.target.parentElement;
        user.classList.add("hidden"); //sakrij korisnika kojeg ne zelis pratit
        userClass = user.classList.item(1); //pozicija user klase u htmlu
        const predlozen = document.querySelector(`.predlozen.${userClass}`);
        predlozen.classList.add("hidden");
    });
});


handleComments = post => {
    post
        .querySelector(".komentiraj")
        .addEventListener("click", handleCommentFocus);
    post
        .querySelector(".komentiraj")
        .addEventListener("change", handleCommentSubmit);
};
handleCommentFocus = e => {
    e.target.classList.toggle("focused");
};

const posts = document.querySelectorAll(".objava");
posts.forEach(post => {
    handleComments(post);
});

//pritisak na ikonu komentiraj
const commentIcons = document.querySelectorAll(".comment_icon");
commentIcons.forEach(comment => {
    comment.addEventListener("click", e => {
        const opis = e.target.parentElement.parentElement.parentElement;
        console.log(opis);
        opis.querySelector(".komentiraj").focus();
    });
});

//povecaj broj pratitelja
const prati = document.querySelectorAll(".prati");
prati.forEach(folover => {
    folover.addEventListener("click", e => {
        const card = e.target.parentElement;
        userClass = card.classList.item(1);
        const predlozeni = document.querySelectorAll(`.${userClass}`);
        predlozeni.forEach(user => user.classList.add("hidden"));
        document.querySelector("#Pratim").textContent++;
    });
});


//pretrezi rijec
//1. Reagirati na keyup event u search inputu
document.querySelector("#search-box").addEventListener("keyup", e => {
    //2. Pročitati koja se trenutno vrijednost nalazi u search input (e.currentTarget.value)
    let query = e.currentTarget.value;

    //3. Dohvatiti sve kartice i za svaku karticu
    let posts = document.querySelectorAll(".objava");
    for (let i = 0; i < posts.length; i++) {
        let post = posts[i];
        if (post.textContent.indexOf(query) >= 0) { //sadrži -> kartica ne smi biti skrivena
            post.style.display = "";
        }
        else {//ne sadrži -> kartica treba biti skrivena
            post.style.display = "none";
        }
    }
    //Dohvatiti tekst te kartice (card.textContent)

    //Korisiti indexOf metodu za provjeriti da li se search text nalazi u kartici
    //(.textContent.indexOf(query) >= 0) -> sadrži query u sebi
    //Ako kartica sadrži tekst makni joj klasu hidden (classList.remove..)
    //Ako kartica NE sadrži tekst, dodaj joj klasu hidden (classList.add)
});


document.querySelector("#korisnik").addEventListener("click", e => {
    const posts = document.querySelectorAll(".objava");
    if (e.target.classList.contains("fa-user-o")) {
        posts.forEach(post => {
            if (!post.textContent.includes("Maca0202")) post.classList.add("hidden");
        });
    } else {
        posts.forEach(post => {
            post.classList.remove("hidden");
        });
    }
});
let userIcons = document.querySelectorAll(".user_icon");
for (let i = 0; i < userIcons.length; i++) {
    let userIcon = userIcons[i];
    //b) Za svako srce registiraj funkciju koja će se pokrenuti na klik
    userIcon.addEventListener("click", handleUserIconClick);
}

function handleUserIconClick(e) {
    //c) Promini klase fa-heart fa-heart-o za efekt punog/praznog srca
    let userIcon = e.currentTarget; //Srce na koje smo sad klikli
    let post = e.target.parentElement.parentElement.parentElement;
    if (userIcon.classList.contains("fa-user")) { //"prazno" srce
        userIcon.classList.remove("fa-user");
        userIcon.classList.add("fa-user-o")
    }

    else {
        userIcon.classList.remove("fa-user-o");
        userIcon.classList.add("fa-user");
    }
}


document.getElementById("srce1").addEventListener("click", e => {
    let heartIcon = e.currentTarget; //Srce na koje smo sad klikli
    let posts = document.querySelectorAll(".objava");

    if (heartIcon.classList.contains("fa-heart")) {

        heartIcon.classList.remove("fa-heart");
        heartIcon.classList.add("fa-heart-o");
        posts.forEach(post => post.classList.remove("hidden"));

    }
    else {
        heartIcon.classList.remove("fa-heart-o");
        heartIcon.classList.add("fa-heart");
        posts.forEach(post => {
            let heart = post.querySelector(".heart-icon");
            if (heart.classList.contains("fa-heart-o")) {
                post.classList.add("hidden");

            }

        });
    }
});




