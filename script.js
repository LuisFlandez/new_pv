

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




let expandido = false;

function toggleCard() {
  const contenido = document.getElementById('contenidoExtendido');
  const card = document.getElementById('contenidoCard');
  const btn = event.target;

  if (!expandido) {
    contenido.style.display = 'block';
    card.classList.add('card-expandida');
    btn.innerText = 'Ver menos';
    expandido = true;
  } else {
    contenido.style.display = 'none';
    card.classList.remove('card-expandida');
    btn.innerText = 'Ver más';
    expandido = false;
  }
}

// Encuesta de satisfacción
document.addEventListener('DOMContentLoaded', () => {
  const stars = document.querySelectorAll('#starRating i');
  const ratingInput = document.getElementById('ratingInput');
  const form = document.getElementById('surveyForm');
  let currentRating = 0;

  const setRating = (rating) => {
    currentRating = rating;
    ratingInput.value = rating;
    stars.forEach((star, idx) => {
      star.classList.toggle('bi-star-fill', idx < rating);
      star.classList.toggle('bi-star', idx >= rating);
      star.classList.toggle('selected', idx < rating);
    });
  };

  stars.forEach((star, idx) => {
    star.addEventListener('mouseenter', () => setRating(idx + 1));
    star.addEventListener('click', () => setRating(idx + 1));
  });

  const starContainer = document.getElementById('starRating');
  if (starContainer) {
    starContainer.addEventListener('mouseleave', () => setRating(currentRating));
  }

  if (form) {
    form.addEventListener('submit', (e) => {
      e.preventDefault();
      form.innerHTML = '<div class="alert alert-success" role="alert">\u00a1Gracias por compartir tu opini\u00f3n!</div>';
    });
  }
});
