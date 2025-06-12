// Função para mudar a cor do select do porte e da raça depois de ser selecionada
const selects = document.querySelectorAll('.select-custom');

selects.forEach(select => {
  select.addEventListener('change', function () {
    if (this.value) {
      this.classList.add('selected');
    }
  });
});

const nascimentoPet = document.querySelectorAll('.date-custom');
nascimentoPet.forEach(field => {
  field.addEventListener('change', function () {
    if (this.value) {
      this.classList.add('selected');
    } else {
      this.classList.remove('selected');
    }
  });
});

function buscarCliente() {
  const nome = document.getElementById('nomeDono').value.trim();

  const emailField = document.getElementById('emailDono');
  const telefoneField = document.getElementById('telefonePet');

  if (nome === '') {
    // Se o campo nomeDono estiver vazio, limpa e habilita os campos
    emailField.value = '';
    telefoneField.value = '';
    emailField.readOnly = false;
    telefoneField.readOnly = false;
    return;
  }

  fetch('buscar-cliente.php?nome=' + encodeURIComponent(nome))
    .then(response => {
      if (!response.ok) throw new Error('Erro na requisição');
      return response.json();
    })
    .then(data => {
      if (data.found) {
        emailField.value = data.email || '';
        telefoneField.value = data.telefone || '';
        emailField.readOnly = true;
        telefoneField.readOnly = true;
      } else {
        emailField.value = '';
        telefoneField.value = '';
        emailField.readOnly = false;
        telefoneField.readOnly = false;

        if (confirm("Cliente não encontrado. Deseja cadastrar?")) {
          window.location.href = "../cadastro-pessoa/cadastro-pessoa.php";
        }
      }
    })
    .catch(error => {
      console.error('Erro ao buscar cliente:', error);
      alert('Ocorreu um erro ao buscar o cliente. Tente novamente.');
    });
}

// =========================
// NOVAS FUNÇÕES: AUTOCOMPLETE
// =========================

function buscarSugestoesCliente() {
  const nome = document.getElementById('nomeDono').value.trim();
  if (nome === '') return;

  fetch('sugestao_cliente.php?nome=' + encodeURIComponent(nome))
    .then(response => response.json())
    .then(data => {
      const lista = document.getElementById('listaClientes');
      lista.innerHTML = '';

      data.forEach(cliente => {
        const option = document.createElement('option');
        option.value = cliente.nome;
        lista.appendChild(option);
      });
    })
    .catch(error => {
      console.error('Erro ao buscar sugestões de cliente:', error);
    });
}

function buscarClienteSelecionado() {
  buscarCliente(); // Reaproveita a função já existente
}