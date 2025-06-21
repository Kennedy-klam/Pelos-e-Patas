<?php 
include('../database/conexao.php');
include('../database/protect.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="style.css?v=123"/>
    <title>Cadastro de Pet</title>
</head>
<body>
    <header>Cadastro de Pet</header>
    <main>
        <form method="POST" action="processa-cadastro.php">
            <h3>Informações Pessoais</h3>
            <div class="container">
                <div class="linha">
                    <input type="text" name="NomePet" id="NomePet" placeholder="Nome do pet" required />

                    <div class="autocomplete-wrapper">
                    <input type="text" name="nomeDono" id="nomeDono" placeholder="Digite o nome do dono" required />
                    <div id="sugestoesClientes" class="sugestoes"></div>
                    </div>

                    <select name="portePet" id="portePet" class="select-custom" required>
                        <option value="" disabled selected>Porte do animal</option>
                        <option value="Pequeno">Porte Pequeno</option>
                        <option value="Medio">Porte Médio</option>
                        <option value="Grande">Porte Grande</option>
                    </select>
                </div>

                <div class="linha">
                    <input type="text" name="emailDono" id="emailDono" placeholder="Email" readonly />
                    <input type="text" name="telefonePet" id="telefonePet" placeholder="Telefone" readonly />
                    <input type="text" name="racaPet" id="racaPet" placeholder="Raça" required />
                </div>

                <div class="linha">
                    <input type="date" id="nascimentoPet" name="nascimentoPet" class="date-custom" required />
                    <div class="idadePet">
                        <label for="idadePet">Idade: </label>
                        <input type="number" name="idadePet" id="idadePet" min="0" />
                    </div>
                    <div class="generoPet">
                        <label>Sexo:</label>
                        <input type="radio" name="sexo" id="generoMasc" value="macho" required />
                        <label for="generoMasc">Macho</label>
                        <input type="radio" name="sexo" id="generoFem" value="femea" />
                        <label for="generoFem">Fêmea</label>
                    </div>
                    <div class="especie">
                        <label>Espécie:</label>
                        <input type="radio" name="especie" id="especieCanino" value="canino" required />
                        <label for="especieCanino">Canino</label>
                        <input type="radio" name="especie" id="especieFelino" value="felino" />
                        <label for="especieFelino">Felino</label>
                    </div>
                </div>
            </div>

            <h3>Data e hora da castração</h3>
            <div class="container">
                <div class="linha">
                    <div class="dataCadastro">
                        <input type="number" name="diaCadastro" id="diaCadastro" placeholder="Dia" min="1" max="31" required />
                        <label>/</label>
                        <input type="number" name="mesCadastro" id="mesCadastro" placeholder="Mês" min="1" max="12" required />
                        <label>/</label>
                        <input type="number" name="anoCadastro" id="anoCadastro" placeholder="Ano" min="1900" max="2100" required />
                    </div>
                    <input type="text" name="observacaoCastracaoPet" id="observacaoCastracaoPet" placeholder="Observações sobre a castração" />
                </div>
            </div>

            <div class="botoes">
                <button type="button" class="buttonVoltar" onclick="window.location.href='../dashboard/dash.php';">Voltar</button>
                <button type="button" class="buttonCadastro" onclick="window.location.href='../cadastro-pessoa/cadastro-pessoa.php';">Cadastro de Pessoa</button>
                <button type="submit" class="buttonConfirmar">Confirmar</button>
            </div>
        </form>
    </main>

    <script src="Script.js"></script>
    <script>
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
    // AUTOCOMPLETE DE CLIENTES
    // =========================

    document.addEventListener('DOMContentLoaded', () => {
    const inputNome = document.getElementById('nomeDono');
    const sugestoesDiv = document.getElementById('sugestoesClientes');
    const emailField = document.getElementById('emailDono');
    const telefoneField = document.getElementById('telefonePet');

    inputNome.addEventListener('input', () => {
        const nome = inputNome.value.trim();

        if (nome.length < 2) {
        sugestoesDiv.innerHTML = '';
        sugestoesDiv.style.display = 'none';
        emailField.value = '';
        telefoneField.value = '';
        emailField.readOnly = true;
        telefoneField.readOnly = true;
        return;
        }

        fetch('sugestao_cliente.php?nome=' + encodeURIComponent(nome))
        .then(res => res.json())
        .then(data => {
            sugestoesDiv.innerHTML = '';

            if (!data.length) {
            sugestoesDiv.style.display = 'none';
            emailField.value = '';
            telefoneField.value = '';
            emailField.readOnly = true;
            telefoneField.readOnly = true;
            return;
            }

            data.forEach(cliente => {
            const item = document.createElement('div');
            item.classList.add('sugestao-item');
            item.textContent = `${cliente.nome} - CPF: ${cliente.cpf}`;
            item.style.cursor = 'pointer';

            item.addEventListener('click', () => {
                inputNome.value = cliente.nome;
                emailField.value = cliente.email || '';
                telefoneField.value = cliente.telefone || '';
                emailField.readOnly = true;
                telefoneField.readOnly = true;

                sugestoesDiv.innerHTML = '';
                sugestoesDiv.style.display = 'none';

                inputNome.focus();
            });

            sugestoesDiv.appendChild(item);
            });

            sugestoesDiv.style.display = 'block';
        })
        .catch(err => {
            console.error('Erro ao buscar sugestões:', err);
            sugestoesDiv.innerHTML = '';
            sugestoesDiv.style.display = 'none';
            emailField.value = '';
            telefoneField.value = '';
            emailField.readOnly = true;
            telefoneField.readOnly = true;
        });
    });

    document.addEventListener('click', (e) => {
        if (!sugestoesDiv.contains(e.target) && e.target !== inputNome) {
        sugestoesDiv.innerHTML = '';
        sugestoesDiv.style.display = 'none';
        }
    });
    });
</script>
</body>
</html>