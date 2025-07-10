
window.addEventListener('DOMContentLoaded', () => {
  const nav = document.getElementById('mainNav');
  const toggleBg = () => {
    if (window.scrollY > 0) {
      nav.classList.add('bg-dark');
      nav.classList.remove('bg-transparent');
    } else {
      nav.classList.add('bg-transparent');
      nav.classList.remove('bg-dark');
    }
  };
  toggleBg();
  window.addEventListener('scroll', toggleBg);
});