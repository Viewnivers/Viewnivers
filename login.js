import { users } from './users.js';

document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.getElementById('login-form'); // Assuming you add an ID to your login form in index.html

    if (loginForm) { // Check if the form exists on the page
        loginForm.addEventListener('submit', (event) => {
            event.preventDefault();

            const usernameInput = loginForm.querySelector('input[type="text"]');
            const passwordInput = loginForm.querySelector('input[type="password"]');

            const username = usernameInput.value;
            const password = passwordInput.value;

            const user = users.find(u => u.username === username && u.password === password);

            if (user) {
                // Store the role in local storage
                localStorage.setItem('userRole', user.role);

                // Hide the login form and update UI (handled by script.js)
                // No redirection needed here

            }
 else {
                alert('Invalid username or password.');
            }
        });
    }
});