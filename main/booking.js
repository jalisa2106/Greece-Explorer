function validateTripForm() {
  const name = document.getElementById("name").value.trim();
  const email = document.getElementById("email").value.trim();
  const phone = document.getElementById("phone").value.trim();
  const country = document.getElementById("country").value.trim();
  const preferences = document.getElementById("preferences").value.trim();

  if (name === "") {
    alert("Please enter your full name.");
    return false;
  }

  const emailPattern = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;
  if (!emailPattern.test(email)) {
    alert("Please enter a valid email address.");
    return false;
  }

  if (phone !== "") {
    const phonePattern = /^[0-9+\-\s()]{7,15}$/;
    if (!phonePattern.test(phone)) {
      alert("Please enter a valid phone number.");
      return false;
    }
  }

  if (/\d/.test(country)) {
    alert("Country name should not contain numbers.");
    return false;
  }

  if (preferences.length > 250) {
    alert("Preferences input is too long. Please limit to 250 characters.");
    return false;
  }

  return true; // allow form submission
}

// Close modal
document.addEventListener("DOMContentLoaded", () => {
    // FAQ toggle
  const faqBtn = document.querySelector(".faq-toggle");
  const faqContent = document.querySelector(".faq-content");
  faqBtn.addEventListener("click", () => {
    faqContent.style.display = (faqContent.style.display === "block" ? "none" : "block");
  });
});