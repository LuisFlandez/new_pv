
// Toggle navbar background on scroll
window.addEventListener('DOMContentLoaded', () => {
  const nav = document.getElementById('mainNav');
  const toggleBg = () => {
    if (window.scrollY > 0) {
      nav.classList.add('bg-dark','navbar-dark');
      nav.classList.remove('bg-transparent', 'navbar-light');
    } else {
      nav.classList.add('bg-transparent', 'navbar-light');
      nav.classList.remove('bg-dark','navbar-dark');
    }
  };
  toggleBg();
  window.addEventListener('scroll', toggleBg);
});