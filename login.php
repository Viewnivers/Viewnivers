php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
 <!-- favicon -->
 <link rel="shortcut icon" href="./assets/images/logo.png" type="image/svg+xml">

    <style>
        body {
            display: flex; /* Assuming your index.html body has display: flex */
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: var(--background);
            color: var(--white);
        }
        .login-container {
            background-color: var(--eerie-black-4);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            text-align: center;
        }
        .login-container h2 {
            margin-bottom: 20px;
            color: var(--white);
        }
        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid var(--eerie-black-3);
            border-radius: 5px;
            background-color: var(--eerie-black-3);
            color: var(--white);
        }
        .login-form button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: var(--royal-blue);
            color: var(--white);
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .login-form button:hover {
            background-color: var(--bluish);
        }
        .error-message {
            color: red;
            margin-top: 15px;
        }
    </style>
</head>
<body>

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

 <a href="/login.php" class="btn btn-primary">
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
 <li><a href="/profil.html" class="navbar-link" id="profilLink" style="display: none;">Profil</a></li>
 </ul>

 <ul class="navbar-social-list">
 </ul>
 </nav>
 </div>
 </header>

 <main>
 <article>

 <!-- Assuming your main content is wrapped in a section -->
 <section class="section">
    <div class="login-container">
        <h2>Login</h2>
        <form action="login.php" method="post" class="login-form">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <?php
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $username = $_POST['username'] ?? '';
                $password = $_POST['password'] ?? '';

                // Start session
                session_start();

                // Read user data from users.js
                $users_js_content = file_get_contents('/mnt/data/users.js');

                // Extract the array part from the JS file content
                // This is a basic approach and might need refinement based on the exact users.js format
                $users_array_string = preg_replace('/^\s*export\s+const\s+users\s*=\s*/', '', $users_js_content);
                $users_array_string = preg_replace('/;\s*$/', '', $users_array_string);

                $users = json_decode($users_array_string, true);

                $authenticated_user = null;
                if ($users) {
                    foreach ($users as $user) {
                        if ($user['username'] === $username && $user['password'] === $password) {
                            $authenticated_user = $user;
                            break;
                        }
                    }
                }

                if ($authenticated_user) {
                    $_SESSION['userRole'] = $authenticated_user['role'];
                    header('Location: /index.html'); // Redirect to index.html
                    exit();
                } else {
                    echo '<p class="error-message">Invalid username or password.</p>';
                }
            }
        ?>
    </div>
 </section>

 </article>
 </main>


  <!-- \n
    - #FOOTER
  -->

 <footer class="footer">

 <div class="footer-top">
 <div class="container">

 <div class="footer-brand-wrapper">

 </div>


 <ul class="quicklink-list">

 <li>
 <a href="#" class="quicklink-link">Faq</a>
 </li>

 <li>
 <a href="#" class="quicklink-link">Help center</a>
 </li>

 <li>
 <a href="#" class="quicklink-link">Terms of use</a>
 </li>

 <li>
 <a href="#" class="quicklink-link">Privacy</a>
 </li>

 </ul>

 <ul class="social-list">

 <li>
 <a href="#" class="social-link">
 <ion-icon name="logo-facebook"></ion-icon>
 </a>
 </li>

 <li>
 <a href="#" class="social-link">
 <ion-icon name="logo-twitter"></ion-icon>
 </a>
 </li>

 <li>
 <a href="#" class="social-link">
 <ion-icon name="logo-pinterest"></ion-icon>
 </a>
 </li>

 <li>
 <a href="#" class="social-link">
 <ion-icon name="logo-linkedin"></ion-icon>
 </a>
 </li>

 </ul>

 </div>

 </div>
 </div>


 </footer>


  <!-- \n
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>