// Toggle navbar background on scroll
window.addEventListener('DOMContentLoaded', () => {
  const nav = document.getElementById('mainNav');
  const toggleBg = () => {
    if (window.scrollY > 0) {
      nav.classList.add('bg-light', 'navbar-light');
      nav.classList.remove('bg-transparent', 'navbar-dark');
    } else {
      nav.classList.add('bg-transparent', 'navbar-dark');
      nav.classList.remove('bg-light', 'navbar-light');
    }
  };
  toggleBg();
  window.addEventListener('scroll', toggleBg);
});