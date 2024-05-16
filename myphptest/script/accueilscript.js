// Ouvrir la superposition modale lorsqu'on clique sur le lien "Sing in"
document.querySelector(".singin").addEventListener("click", function() {
    document.getElementById("modal").style.display = "block";
});

// Fermer la superposition modale lorsqu'on clique sur le bouton de fermeture
document.querySelector(".close").addEventListener("click", function() {
    document.getElementById("modal").style.display = "none";
});

// Fermer la superposition modale lorsqu'on clique en dehors de celle-ci
window.onclick = function(event) {
    var modal = document.getElementById("modal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

document.querySelectorAll('.more').forEach(button => {
    button.addEventListener('click', function() {
        var articleId = this.getAttribute('data-articleid');
        window.location.href = "article.php?IdArticle=" + articleId;
    });
});

document.querySelector('.accueil').addEventListener("click",function(){
    window.location.href="accueil.php";
});


document.getElementById("searchInput").addEventListener("keyup", function(event) {
    if (event.key === "Enter") {
        this.closest("form").submit();
    }
});