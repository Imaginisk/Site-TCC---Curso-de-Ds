function dropComents() {
  let comentarioLayout = document.querySelectorAll("div.row");

  comentarioLayout.forEach(function (nome, i) {
    for (let i = 0; i < comentarioLayout.length; i++) {
      comentarioLayout[i].style.visibility = "visible";
      comentarioLayout[i].style.height = "200px";
    }
  });
}
function upComents() {
  let btnVoltar = document.getElementById("BtnComentVoltar");
  let btnComent = document.getElementById("BtnComent");
  btnVoltar.style.visibility = "visible";
  btnComent.style.visibility = "visible";
  let comentarioLayout = document.querySelectorAll("div.row");
  comentarioLayout.forEach(function (nome, i) {
    for (let i = 2; i < comentarioLayout.length; i++) {
      comentarioLayout[i].style.visibility = "hidden";
      comentarioLayout[i].style.height = "20px";
      window.location.reload();
    }
  });
}
function showMesage() {
  window.alert("Obrigado pelo comentário, 10 ecopoints ganhos!");
}
