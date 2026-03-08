// Image Slider Logic
let currentSlide = 0;
const slides = document.querySelectorAll('.slide');
const totalSlides = slides.length;

document.querySelector('.next').addEventListener('click', () => {
  changeSlide(currentSlide + 1);
});

document.querySelector('.prev').addEventListener('click', () => {
  changeSlide(currentSlide - 1);
});

function changeSlide(index) {
  slides[currentSlide].classList.remove('active');
  currentSlide = (index + totalSlides) % totalSlides;
  slides[currentSlide].classList.add('active');
}

// Auto-slide every 6 seconds
setInterval(() => changeSlide(currentSlide + 1), 3000);

// Collapsible FAQ Logic
const questions = document.querySelectorAll('.faq-question');

questions.forEach(q => {
  q.addEventListener('click', () => {
    q.classList.toggle('active');
    const answer = q.nextElementSibling;
    if (answer.style.display === "block") {
      answer.style.display = "none";
    } else {
      answer.style.display = "block";
    }
  });
});

  const imgs = document.querySelectorAll(".slider img");
  let current = 0;

  function showSlide(i) {
    imgs.forEach((img, idx) => img.classList.toggle("active", idx === i));
  }

  showSlide(current);
  setInterval(() => {
    current = (current + 1) % imgs.length;
    showSlide(current);
  }, 4000);
