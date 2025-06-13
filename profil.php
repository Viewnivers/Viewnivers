php
<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['userRole'])) {
    header('Location: login.php');
    exit();
}

$userRole = $_SESSION['userRole'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- favicon -->
    <link rel="shortcut icon" href="./assets/images/logo.png" type="image/svg+xml">
</head>
<body id="top">

    <!-- HEADER -->
    <header class="header" data-header>
        <div class="container">
            <div class="overlay" data-overlay></div>
            <a href="./index.html" class="logo">
                <img src="./assets/images/logo.png" alt="Image" style="width:65px;height:60px;">
            </a>
            <div class="header-actions">
                <button class="search-btn" onclick="toggleSearchBar()">
                    <ion-icon name="search-outline"></ion-icon>
                </button>
                <div class="search-bar" id="searchBar">
                    <input type="text" id="searchInput" placeholder="Rechercher..." oninput="searchMovies()">
                    <div class="suggestions" id="suggestions"></div>
                </div>
                <div class="lang-wrapper">
                    <label for="language">
                        <ion-icon name="globe-outline"></ion-icon>
                    </label>
                    <select name="language" id="language">
                        <option value="fr">FR</option>
                    </select>
                </div>
                <a href="#" class="btn btn-primary" id="loginLogoutButton">
                    <span id="loginButtonLabel">Se connecter</span>
                </a>
                <script src="script.js"></script>
            </div>
            <button class="menu-open-btn" data-menu-open-btn>
                <ion-icon name="reorder-two"></ion-icon>
            </button>
            <nav class="navbar" data-navbar>
                <div class="navbar-top">
                    <a href="./index.html" class="logo">
                        <img src="./assets/images/logo.png" alt="Filmlane logo" style="width:65px;height:60px;">
                    </a>
                    <button class="menu-close-btn" data-menu-close-btn>
                        <ion-icon name="close-outline"></ion-icon>
                    </button>
                </div>
                <ul class="navbar-list">
                    <li><a href="./index.html" class="navbar-link">Home</a></li>
                    <li><a href="Movie.html" class="navbar-link">Movie</a></li>
                    <li><a href="Serie.html" class="navbar-link">Serie</a></li>
                    <li><a href="Anime.html" class="navbar-link">Anime</a></li>
                    <li><a href="tv.html" class="navbar-link">Tv</a></li>
                    <li id="profilNavItem" style="display: none;">
                        <a href="/profil.php" class="navbar-link">Profil</a>
                    </li>
                </ul>
                <ul class="navbar-social-list">
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <article>
            <section class="section">
                <div class="container">
                    <h1 class="h1">User Profile</h1>
                    <p>Welcome to your profile page.</p>
                    <p>Your role: <?php echo htmlspecialchars($userRole); ?></p>

                    <?php if ($userRole === 'vendeur'): ?>
                        <p>
                            <a href="vendeur.php" class="btn btn-primary">Vendeur Panel</a>
                        </p>
                    <?php endif; ?>

                    <!-- Add more profile information here if needed -->

                </div>
            </section>
        </article>
    </main>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="footer-top">
            <div class="container">
                <div class="footer-brand-wrapper">
                </div>
                <ul class="quicklink-list">
                    <li><a href="#" class="quicklink-link">Faq</a></li>
                    <li><a href="#" class="quicklink-link">Help center</a></li>
                    <li><a href="#" class="quicklink-link">Terms of use</a></li>
                    <li><a href="#" class="quicklink-link">Privacy</a></li>
                </ul>
                <ul class="social-list">
                    <li><a href="#" class="social-link"><ion-icon name="logo-facebook"></ion-icon></a></li>
                    <li><a href="#" class="social-link"><ion-icon name="logo-twitter"></ion-icon></a></li>
                    <li><a href="#" class="social-link"><ion-icon name="logo-pinterest"></ion-icon></a></li>
                    <li><a href="#" class="social-link"><ion-icon name="logo-linkedin"></ion-icon></a></li>
                </ul>
            </div>
        </div>
    </footer>

    <!-- GO TO TOP -->
    <a href="#top" class="go-top" data-go-top>
        <ion-icon name="chevron-up"></ion-icon>
    </a>

    <!-- custom js link -->
    <script src="./assets/js/script.js"></script>

    <!-- ionicon link -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>
</html>