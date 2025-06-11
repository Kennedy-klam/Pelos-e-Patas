<?php 
include('../database/conexao.php');
include('../database/protect.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="teste.css?v=123" />
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
                    <input type="text" name="nomeDono" id="nomeDono" placeholder="Digite o nome do dono" onblur="buscarCliente()" required />
                    <select name="portePet" id="portePet" class="select-custom" required>
                        <option value="" disabled selected>Porte do animal</option>
                        <option value="Pequeno">Porte Pequeno</option>
                        <option value="Medio">Porte Médio</option>
                        <option value="Grande">Porte Grande</option>
                    </select>
                </div>
                <div class="linha">
                    <input type="email" name="emailDono" id="emailDono" placeholder="Email" />
                    <input type="number" name="telefonePet" id="telefonePet" placeholder="Telefone" />
                    <input type="text" name="racaPet" id="racaPet" placeholder="Raça" required />
                </div>
                <div class="linha">
                    <input type="date" id="nascimentoPet" class="date-custom" required />
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

            <h3>Data e hora do cadastro</h3>
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
                <button type="submit" class="buttonConfirmar">Confirmar</button>
                <button type="button" class="buttonExcluir" onclick="window.location.href='../cadastro-pessoa/cadastro-pessoa.php';">Cadastro de Pessoa</button>
                <button type="button" class="buttonVoltar" onclick="window.location.href='../dashboard/dash.php';">Voltar</button>
            </div>
        </form>
    </main>
    <script src="Script.js"></script>
</body>
</html>