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
    <style>
        body {
            display: flex;
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
</body>
</html>