document.addEventListener("DOMContentLoaded", function () {
  function validarCpfCnpj(value) {
    return value.length === 11 || value.length === 14;
  }

  function aplicarMascara(input, mascara) {
    input.addEventListener("input", function () {
      let value = input.value.replace(/\D/g, "");
      let i = 0;
      input.value = mascara.replace(/#/g, () => value[i++] || "");
    });
  }

  aplicarMascara(document.querySelector("#Cpf"), "###.###.###-##");
  aplicarMascara(document.querySelector("#Telefone"), "(##) #####-####");
  aplicarMascara(document.querySelector("#Fixo"), "(##) ####-####");
  aplicarMascara(document.querySelector("#Cep"), "#####-###");

  document.querySelector(".buttonConfirmar").addEventListener("click", function () {
    let camposObrigatorios = document.querySelectorAll("input:not(#Complemento), select");
    for (let campo of camposObrigatorios) {
      if (campo.type === "radio") continue;
      if (campo.value.trim() === "") {
        alert("Todos os campos obrigatórios devem ser preenchidos!");
        return;
      }
    }

    const cpfCnpj = document.querySelector("#Cpf").value.replace(/\D/g, "");
    const email = document.querySelector("#Email").value.trim();
    const idade = document.querySelector("#Idade").value.trim();

    if (!validarCpfCnpj(cpfCnpj)) {
      alert("CPF ou CNPJ inválido! Digite corretamente.");
      return;
    }

    if (!email.includes("@") || !email.includes(".")) {
      alert("E-mail inválido!");
      return;
    }

    if (idade < 1) {
      alert("Idade inválida!");
      return;
    }

    if (!confirm("Deseja finalizar seu Cadastro?")) {
      return;
    }

    alert("Cadastro enviado com sucesso!");
    // Envio real de dados pode ser implementado aqui com fetch()
  });

  document.querySelector(".buttonVoltar").addEventListener("click", function () {
    if (confirm("Tem certeza que deseja voltar? As informações preenchidas serão perdidas.")) {
      window.history.back();
    }
  });
});
