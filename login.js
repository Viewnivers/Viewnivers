import { users } from './users.js';

document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.querySelector('form');

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

            // Redirect based on role
            switch (user.role) {
                case 'ViewTV':
                case 'VODnivers':
                case 'ALLNivers':
                    window.location.href = 'index.html';
                    break;
                case 'vendeur':
                    window.location.href = 'vendeur.html';
                    break;
                default:
                    // Redirect to a default page or display an error
                    window.location.href = 'index.html';
                    break;
            }
        } else {
            alert('Invalid username or password.');
        }
    });
});