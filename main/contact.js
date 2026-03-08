function validateContact() {
  const name = document.getElementById("name").value.trim();
  const email = document.getElementById("email").value.trim();
  const country = document.getElementById("country").value.trim();
  const msg = document.getElementById("message").value.trim();

  if (name === "") {
    alert("Please enter your name");
    return false;
  }

  const emailPattern = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;
  if (!emailPattern.test(email)) {
    alert("Please enter a valid email address");
    return false;
  }

  if (/\d/.test(country)) {
    alert("Country should not contain any number");
    return false;
  }

  if (msg === "") {
    alert("Message field cannot be empty");
    return false;
  }

  // Show modal popup instead of alert
  document.getElementById("popupOverlay").style.display = "block";
  return false; // prevent actual form submission
}

function closePopup() {
  document.getElementById("popupOverlay").style.display = "none";
}

// FAQ toggle logic
document.addEventListener("DOMContentLoaded", () => {
  const faqs = document.querySelectorAll(".faq-question");
  faqs.forEach((button) => {
    button.addEventListener("click", () => {
      const answer = button.nextElementSibling;
      const isOpen = answer.style.display === "block";
      document
        .querySelectorAll(".faq-answer")
        .forEach((a) => (a.style.display = "none"));
      answer.style.display = isOpen ? "none" : "block";
    });
  });
});