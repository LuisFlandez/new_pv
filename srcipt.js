window.addEventListener('DOMContentLoaded', () => {
  const header = document.getElementById('mainHeader');
  function toggleHeader() {
    if (window.scrollY > 50) {
      header.classList.add('scrolled');
      header.classList.remove('transparent');
    } else {
      header.classList.remove('scrolled');
      header.classList.add('transparent');
    }
  }

  toggleHeader();
  window.addEventListener('scroll', toggleHeader);
});

$(document).ready(function() {
  $(window).scroll(function() {
    if($(this).scrollTop() < $("#green").height()){
       $(".navbar").removeClass("bg-dark");
    }
    else{
       $(".navbar").addClass("bg-dark");
    }
  });
});