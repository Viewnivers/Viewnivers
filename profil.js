document.addEventListener('DOMContentLoaded', () => {
    const userRole = localStorage.getItem('userRole');
    const vendeurButton = document.getElementById('vendeur-panel-button'); // Assuming the button has this ID

    if (!userRole) {
        // No user logged in, redirect to index.html
        window.location.href = 'index.html';
    } else {
        // User is logged in, check for 'vendeur' role to show the button
        if (userRole === 'vendeur') {
            if (vendeurButton) {
                vendeurButton.style.display = 'block'; // Or whatever display style you prefer
            }
        } else {
            if (vendeerButton) {
                 vendeurButton.style.display = 'none';
            }
        }
        // You can add code here to display user information on the profile page
        // based on the userRole or other data stored in local storage if needed.
    }
});