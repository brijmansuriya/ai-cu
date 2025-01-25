class Sidebar {
    constructor() {
        this.initializeSidebar();
        this.initializeResponsive();
    }

    initializeSidebar() {
        // Handle sidebar toggle button
        const toggleButton = document.querySelector('[data-sidebar-toggle]');
        const sidebar = document.querySelector('[data-sidebar]');
        const backdrop = document.querySelector('[data-sidebar-backdrop]');

        if (toggleButton && sidebar) {
            toggleButton.addEventListener('click', () => {
                sidebar.classList.toggle('-translate-x-full');
                backdrop?.classList.toggle('hidden');
            });
        }

        // Handle backdrop click
        if (backdrop) {
            backdrop.addEventListener('click', () => {
                sidebar?.classList.add('-translate-x-full');
                backdrop.classList.add('hidden');
            });
        }

        // Handle close button
        const closeButton = document.querySelector('[data-sidebar-close]');
        if (closeButton) {
            closeButton.addEventListener('click', () => {
                sidebar?.classList.add('-translate-x-full');
                backdrop?.classList.add('hidden');
            });
        }
    }

    initializeResponsive() {
        // Handle responsive behavior
        const mediaQuery = window.matchMedia('(min-width: 1024px)');
        
        const handleResize = (e) => {
            const sidebar = document.querySelector('[data-sidebar]');
            const backdrop = document.querySelector('[data-sidebar-backdrop]');
            
            if (e.matches) {
                // Large screen
                sidebar?.classList.remove('-translate-x-full');
                backdrop?.classList.add('hidden');
            } else {
                // Small screen
                sidebar?.classList.add('-translate-x-full');
            }
        };

        mediaQuery.addListener(handleResize);
        handleResize(mediaQuery);
    }
}

export default new Sidebar(); 