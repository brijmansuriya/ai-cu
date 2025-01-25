class Header {
    constructor() {
        this.initializeDropdowns();
        this.initializeNotifications();
    }

    initializeDropdowns() {
        // User dropdown functionality
        const userMenuButton = document.getElementById('user-menu-button');
        if (userMenuButton) {
            userMenuButton.addEventListener('click', () => {
                const dropdown = document.querySelector('[data-dropdown="user-menu"]');
                if (dropdown) {
                    dropdown.classList.toggle('hidden');
                }
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', (event) => {
                if (!userMenuButton.contains(event.target)) {
                    const dropdown = document.querySelector('[data-dropdown="user-menu"]');
                    if (dropdown && !dropdown.contains(event.target)) {
                        dropdown.classList.add('hidden');
                    }
                }
            });
        }
    }

    initializeNotifications() {
        // Add notification functionality here
        const notificationButton = document.querySelector('[data-notification-button]');
        if (notificationButton) {
            notificationButton.addEventListener('click', () => {
                // Handle notifications
            });
        }
    }
}

export default new Header(); 