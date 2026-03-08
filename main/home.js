const slides = document.querySelectorAll(".slide");
let currentIndex = 0;

setInterval(() => {
  slides[currentIndex].classList.remove("active");
  currentIndex = (currentIndex + 1) % slides.length;
  document.querySelector(".slider").style.transform = `translateX(-${
    currentIndex * 100
  }%)`;
  slides[currentIndex].classList.add("active");
}, 4000);

//for json part
fetch("home.json")
  .then((res) => res.json())
  .then((data) => {
    const container = document.getElementById("highlight-events");
    data.highlights.forEach((item) => {
      const card = document.createElement("div");
      card.className = "highlight-card";
      card.innerHTML = `
        <h4>${item.title}</h4>
        <p><strong>📅 Date:</strong> ${item.date}</p>
        <p><strong>📍 Location:</strong> ${item.location}</p>
      `;
      container.appendChild(card);
    });
  })
  .catch((err) => {
    console.error("Failed to load highlights:", err);
  });
