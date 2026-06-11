function renderTeams() {
  const container = document.getElementById("teams");

  Object.keys(teams).forEach(teamName => {

    const teamDiv = document.createElement("div");
    teamDiv.innerHTML = `<h2>${teamName}</h2>`;

    const players = teams[teamName];

    const grid = document.createElement("div");
    grid.style.display = "grid";
    grid.style.gridTemplateColumns = "repeat(auto-fit, minmax(120px, 1fr))";
    grid.style.gap = "10px";

    players.forEach(p => {
      const card = document.createElement("div");
      card.style.background = "white";
      card.style.padding = "10px";
      card.style.textAlign = "center";

      card.innerHTML = `
        <img src="${p.photo}" style="width:80px;height:80px;border-radius:50%">
        <p><strong>${p.number}</strong></p>
        <p>${p.name}</p>
      `;

      grid.appendChild(card);
    });

    teamDiv.appendChild(grid);
    container.appendChild(teamDiv);
  });
}

renderTeams();