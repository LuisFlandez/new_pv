
// Toggle navbar background on scroll
window.addEventListener('DOMContentLoaded', () => {
  const nav = document.getElementById('mainNav');
  const toggleBg = () => {
    if (window.scrollY > 0) {
      nav.classList.add('bg-dark','navbar-dark');
      nav.classList.remove('bg-transparent', 'navbar-light');
    } else {
      nav.classList.add('bg-transparent', 'navbar-light');
      nav.classList.remove('bg-dark', 'navbar-dark');
    }
  };

  const adjustPosition = () => {
    if (window.scrollY > 0) {
      nav.classList.remove('position-absolute');
      nav.classList.add('position-fixed', 'top-0', 'w-100');
    } else {
      nav.classList.add('position-absolute');
      nav.classList.remove('position-fixed', 'top-0', 'w-100');
    }
  };
  const onScroll = () => {
    toggleBg();
    adjustPosition();
  };

  onScroll();
  window.addEventListener('scroll', onScroll);
});