// Collapsible FAQ
document.querySelectorAll(".faq-question").forEach((btn) => {
  btn.addEventListener("click", () => {
    const answer = btn.nextElementSibling;
    answer.style.display = answer.style.display === "block" ? "none" : "block";
  });
});

// Popup Modal
const modal = document.getElementById("popupModal");
const trigger = document.getElementById("exploreBtn");
const closeBtn = document.getElementById("closePopup");

trigger.addEventListener("click", () => {
  modal.style.display = "flex";
});
closeBtn.addEventListener("click", () => {
  modal.style.display = "none";
});
window.addEventListener("click", (e) => {
  if (e.target === modal) {
    modal.style.display = "none";
  }
});