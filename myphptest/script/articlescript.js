document.querySelector('.accueil').addEventListener("click",function(){
    window.location.href="accueil.php";
});
document.querySelector('.svghome').addEventListener('click', function() {
    window.location.href = "accueil.php";
});





// Ajoutez des écouteurs d'événements pour gérer le survol
searchInput.addEventListener("mouseover", function() {
    this.classList.add("hovered");
});

searchInput.addEventListener("mouseout", function() {
    this.classList.remove("hovered");
});

