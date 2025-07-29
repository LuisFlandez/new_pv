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

const btnSoyAbogado = document.getElementById('btnSoyAbogado');
const btnNoAbogado = document.getElementById('btnNoAbogado');
if (btnSoyAbogado && btnNoAbogado) {
  const modalAbogado = new bootstrap.Modal(document.getElementById('modalAbogado'));
  const modalNoAbogado = new bootstrap.Modal(document.getElementById('modalNoAbogado'));

  btnSoyAbogado.addEventListener('click', () => modalAbogado.show());
  btnNoAbogado.addEventListener('click', () => modalNoAbogado.show());
}

const btnAtencionCliente = document.getElementById('btnAtencionCliente');
const btnAtencionCorreo = document.getElementById('btnAtencionCorreo');
if (btnAtencionCliente && btnAtencionCorreo) {
  const modalICAValdivia = new bootstrap.Modal(document.getElementById('modalICAValdivia'));
  const modalCorreo = new bootstrap.Modal(document.getElementById('modalCorreo'));

  btnAtencionCliente.addEventListener('click', () => modalICAValdivia.show());
  btnAtencionCorreo.addEventListener('click', () => modalCorreo.show());
}


