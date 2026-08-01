// Adds a "scrolled" state to the navbar once the page scrolls past 40px,
// used purely for the compact/blurred navbar style.
window.addEventListener('DOMContentLoaded', () => {
    const nav = document.querySelector('.navbar');
    if (!nav) return;

    window.addEventListener('scroll', () => {
        nav.classList.toggle('scrolled', window.scrollY > 40);
    });
});
