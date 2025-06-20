// script.js
window.onload = function() {
    checkLoginStatus(); // Check login status on page load
    var firstName = localStorage.getItem("firstName");
    if (firstName) {
        document.getElementById("loginButtonLabel").textContent = "Bienvenue, " + firstName; // Afficher le prénom dans le bouton de connexion
    }
};

function saveName() {
    var firstName = document.getElementById("firstName").value;
    localStorage.setItem("firstName", firstName); // Enregistrer le prénom dans le stockage local
    window.location.href = "index.html"; // Rediriger vers la page d'accueil après la connexion
}

function deleteName() {
    localStorage.removeItem("firstName"); // Supprimer le nom d'utilisateur du stockage local
    window.location.href = "index.html"; // Rediriger vers la page d'accueil après avoir supprimé le nom d'utilisateur
}

// Fonction pour basculer l'état du favori
function toggleFavorite() {
    var isFavorite = localStorage.getItem("isFavorite");
    if (isFavorite && isFavorite === "true") {
        // Si déjà marqué comme favori, retirez-le des favoris
        localStorage.setItem("isFavorite", "false");
    } else {
        // Si non marqué comme favori, ajoutez-le aux favoris
        localStorage.setItem("isFavorite", "true");
    }
    updateFavoriteButton();
}

// Fonction pour mettre à jour l'apparence du bouton favori en fonction de son état
function updateFavoriteButton() {
    var isFavorite = localStorage.getItem("isFavorite");
    var favoriteButton = document.querySelector(".favorite-btn");
    if (isFavorite && isFavorite === "true") {
        favoriteButton.innerHTML = '<ion-icon name="heart"></ion-icon>'; // Changement de l'icône du bouton en forme de cœur plein
    } else {
        favoriteButton.innerHTML = '<ion-icon name="heart-outline"></ion-icon>'; // Changement de l'icône du bouton en forme de cœur vide
    }
}

// Appel de la fonction updateFavoriteButton pour mettre à jour l'apparence du bouton lors du chargement de la page
updateFavoriteButton();

function checkLoginStatus() {
    const loginLogoutButton = document.getElementById('loginLogoutButton');
    const profilNavItem = document.getElementById('profilNavItem');
    const userRole = localStorage.getItem('userRole');

    if (userRole) {
        loginLogoutButton.textContent = 'Se déconnecter';
        profilNavItem.style.display = 'block';
    } else {
        loginLogoutButton.textContent = 'Se connecter';
        profilNavItem.style.display = 'none';
    }
}

// Add this event listener after the checkLoginStatus function
document.addEventListener('DOMContentLoaded', () => {
    const loginLogoutButton = document.getElementById('loginLogoutButton');

    if (loginLogoutButton) {
        loginLogoutButton.addEventListener('click', () => {
            if (loginLogoutButton.textContent === 'Se déconnecter') {
                localStorage.removeItem('userRole');
                window.location.href = 'index.html';
            }
        });
    }
});


// Call checkLoginStatus on page load
checkLoginStatus();