document.addEventListener('DOMContentLoaded', () => {
    // Check if user has 'vendeur' role
    const userRole = localStorage.getItem('userRole');
    if (userRole !== 'vendeur') {
        window.location.href = 'index.html'; // Redirect if not authorized
        return;
    }

    const userForm = document.getElementById('user-form');
    const userTableBody = document.getElementById('user-table-body');
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');
    const roleSelect = document.getElementById('role');
    const userIdInput = document.getElementById('user-id');

    let users = []; // This will hold our user data

    // Function to load users from users.js (simulated dynamic load)
    function loadUsers() {
        // In a real application, you'd use fetch to load from a server endpoint
        // For this simulation, we'll directly access the users array
        users = window.users || []; // Assuming users.js exposes a global 'users' array
        renderUsers();
    }

    // Function to render users in the table
    function renderUsers() {
        userTableBody.innerHTML = '';
        users.forEach((user, index) => {
            const row = userTableBody.insertRow();
            row.innerHTML = `
                <td>${user.username}</td>
                <td>${user.role}</td>
                <td>
                    <button class="edit-btn" data-id="${index}">Edit</button>
                    <button class="delete-btn" data-id="${index}">Delete</button>
                </td>
            `;
        });
        addEventListeners();
    }

    // Function to add event listeners to edit and delete buttons
    function addEventListeners() {
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', (e) => {
                const userId = e.target.dataset.id;
                editUser(userId);
            });
        });

        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', (e) => {
                const userId = e.target.dataset.id;
                deleteUser(userId);
            });
        });
    }

    // Function to handle form submission (add or update user)
    userForm.addEventListener('submit', (e) => {
        e.preventDefault();

        const username = usernameInput.value;
        const password = passwordInput.value;
        const role = roleSelect.value;
        const userId = userIdInput.value;

        if (userId === '') {
            // Add new user
            users.push({ username, password, role });
        } else {
            // Update existing user
            users[userId].username = username;
            if (password) { // Only update password if provided
                users[userId].password = password;
            }
            users[userId].role = role;
        }

        // Simulate saving back to users.js (in a real app, this would be a server call)
        window.users = users;

        userForm.reset();
        userIdInput.value = ''; // Clear hidden ID
        renderUsers();
    });

    // Function to populate form for editing
    function editUser(id) {
        const user = users[id];
        usernameInput.value = user.username;
        // passwordInput.value = user.password; // Do not pre-fill password for security
        roleSelect.value = user.role;
        userIdInput.value = id;
    }

    // Function to delete a user
    function deleteUser(id) {
        users.splice(id, 1);
        // Simulate saving back to users.js
        window.users = users;
        renderUsers();
    }

    // Load users on page load
    loadUsers();
});