function validateFeedback() {
  const name = document.getElementById("name").value.trim();
  const country = document.getElementById("country").value.trim();

  if (name === "") {
    alert("Please enter your name");
    return false;
  }

  if (/\d/.test(country)) {
    alert("Country name should not contain any number");
    return false;
  }

  const modal = document.getElementById("popupModal");
  modal.style.display = "block";
  return false; // Prevent actual submission for demo
}

document.querySelector(".close-button").addEventListener("click", () => {
  document.getElementById("popupModal").style.display = "none";
});

// FAQ toggle
document.querySelectorAll(".faq-question").forEach((question) => {
  question.addEventListener("click", () => {
    question.classList.toggle("active");
    const answer = question.nextElementSibling;
    if (answer.style.display === "block") {
      answer.style.display = "none";
    } else {
      answer.style.display = "block";
    }
  });
});

let currentSlide = 0;
const testimonials = document.querySelectorAll(".testimonial");

function showSlide(index) {
  testimonials.forEach((t, i) => {
    t.classList.toggle("active", i === index);
  });
}

document.getElementById("prevBtn").onclick = () => {
  currentSlide = (currentSlide - 1 + testimonials.length) % testimonials.length;
  showSlide(currentSlide);
};

document.getElementById("nextBtn").onclick = () => {
  currentSlide = (currentSlide + 1) % testimonials.length;
  showSlide(currentSlide);
};

showSlide(currentSlide);

// load and display user feedbacks
fetch("feedback.json")
  .then((res) => res.json())
  .then((data) => {
    const list = document.getElementById("feedback-list");

    data.forEach((entry) => {
      const item = document.createElement("div");
      item.className = "feedback-card";
      item.innerHTML = `
        <p><strong>${entry.name}</strong> (${entry.country})</p>
        <p>⭐️ Rating: ${"★".repeat(entry.rating)}${"☆".repeat(
        5 - entry.rating
      )}</p>
        <p>"${entry.feedback}"</p>
        <hr>
      `;
      list.appendChild(item);
    });
  })
  .catch((err) => {
    console.error("Failed to load user feedback: ", err);
  });