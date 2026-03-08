// Toggle FAQ answers
document.querySelectorAll(".faq-question").forEach((btn) => {
  btn.addEventListener("click", () => {
    const answer = btn.nextElementSibling;
    const expanded = answer.style.display === "block";
    answer.style.display = expanded ? "none" : "block";
  });
});

// Load experiences from JSON
fetch("culture.json")
  .then((res) => res.json())
  .then((data) => {
    // === Experiences ===
    const experienceContainer = document.getElementById("culture-experiences");

    data.experiences.forEach((experience) => {
      const card = document.createElement("div");
      card.className = "highlight-card";
      card.innerHTML = `
        <h4>${experience.title}</h4>
        <p>${experience.description}</p>
      `;
      experienceContainer.appendChild(card);
    });
  });
