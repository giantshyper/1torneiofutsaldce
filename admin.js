function renderAdmin() {
  const container = document.getElementById("admin");

  matches.forEach(match => {
    const div = document.createElement("div");

    div.innerHTML = `
      <h3>${match.home} vs ${match.away}</h3>

      <input id="h${match.id}" placeholder="Golos ${match.home}">
      <input id="a${match.id}" placeholder="Golos ${match.away}">

      <button onclick="save(${match.id})">Guardar</button>

      <hr>
    `;

    container.appendChild(div);
  });
}

function save(id) {
  const match = matches.find(m => m.id === id);

  match.homeGoals = parseInt(document.getElementById("h" + id).value);
  match.awayGoals = parseInt(document.getElementById("a" + id).value);

  console.log("Atualizado:", matches);
}

renderAdmin();