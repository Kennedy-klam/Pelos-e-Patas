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

