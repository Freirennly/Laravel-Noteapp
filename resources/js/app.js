document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('hamburger-btn');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    const line1 = document.getElementById('line1');
    const line2 = document.getElementById('line2');
    const line3 = document.getElementById('line3');

    // Hamburger initial position
    line1.style.top = "0.5rem";
    line2.style.top = "1.25rem";
    line3.style.top = "2rem";

    const toggleSidebar = () => {
        const isOpen = sidebar.classList.contains('translate-x-0');
        if (isOpen) {
            sidebar.classList.remove('translate-x-0');
            sidebar.classList.add('-translate-x-full');
            overlay.classList.remove('opacity-100', 'pointer-events-auto');
            overlay.classList.add('opacity-0', 'pointer-events-none');
        } else {
            sidebar.classList.remove('-translate-x-full');
            sidebar.classList.add('translate-x-0');
            overlay.classList.remove('opacity-0', 'pointer-events-none');
            overlay.classList.add('opacity-100', 'pointer-events-auto');
        }

        // Morph hamburger
        line1.classList.toggle('rotate-45');
        line1.classList.toggle('top-5');
        line3.classList.toggle('-rotate-45');
        line3.classList.toggle('top-5');
        line2.classList.toggle('opacity-0');
    };

    btn.addEventListener('click', toggleSidebar);
    overlay.addEventListener('click', toggleSidebar);
});
