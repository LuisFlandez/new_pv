
// Toggle navbar background on scroll
window.addEventListener('DOMContentLoaded', () => {
  const nav = document.getElementById('mainNav');
  const toggleBg = () => {
    if (window.scrollY > 1) {
      nav.classList.add('bg-white', 'navbar-light');
      nav.classList.remove('bg-transparent', 'navbar-dark');
    } else {
      nav.classList.add('bg-transparent', 'navbar-dark');
      nav.classList.remove('bg-white', 'navbar-light');
    }
  };


  const adjustPosition = () => {
    if (window.scrollY > 0) {
      nav.classList.remove('position-absolute');
      nav.classList.add('position-fixed', 'top-0');
    } else {
      nav.classList.add('position-absolute');
      nav.classList.remove('position-fixed','top-0');
    }
  };
  const onScroll = () => {
    toggleBg();
    adjustPosition();
  };

  onScroll();
  window.addEventListener('scroll', onScroll);
});