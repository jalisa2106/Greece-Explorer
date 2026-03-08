// Load and display customer profiles
fetch("spots.json")
  .then((res) => res.json())
  .then((data) => {
    const customerContainer = document.getElementById("customer-profiles");

    data.customerProfiles.forEach((profile) => {
      const profileCard = document.createElement("div");
      profileCard.className = "highlight-card";
      profileCard.innerHTML = `
        <h4>${profile.name} from ${profile.country}</h4>
        <p><strong>Visited:</strong> ${profile.cityVisited}</p>
        <p><em>"${profile.review}"</em></p>
      `;
      customerContainer.appendChild(profileCard);
    });
  })
  .catch((err) => {
    console.error("Failed to load customer data: ", err);
  });