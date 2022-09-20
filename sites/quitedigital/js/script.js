const CPF_API = "https://api.cpfcnpj.com.br";
const TOKEN = "5ae973d7a997af13f0aaf2bf60e65803";
const PACKAGE = 1;

function search_cpf(event) {
  event.preventDefault();

  $("#loadingModal").modal({
    backdrop: "static",
    keyboard: false,
    show: true,
  });

  const cpf = $("#cpf").val();
  const headers = new Headers();
  const init = {
    method: "GET",
    headers: headers,
    mode: "no-cors",
    cache: "default",
  };
  const url = `${CPF_API}/${TOKEN}/${PACKAGE}/${cpf}`;
  const request = new Request(url, headers);

  setTimeout(function () {
    fetch(request).then((response) =>
      response.json().then((json) => {
        if (json.status == 0) {
          $("#notFoundModal").modal();
        } else {
          const name = "Fulano";
          const modal = $("#cpfFoundModal");
          $(".modal .cpf-name").text(name);
          $("#loadingModal").modal("hide");
          modal.modal();
        }
      })
    );
  }, 1000);
}

function main() {
  // $("#cpfForm").submit(search_cpf);
  // $("#cpfFormAgain").submit(search_cpf);
  $(".modalist-form").submit(search_cpf);
  $("#contactForm").submit((e) => e.preventDefault());
}

$(main);
