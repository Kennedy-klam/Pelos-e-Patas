<?php 
include ('../database/conexao.php');
include ('../database/protect.php');

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=123">
    <title>Cadastro de Pessoa</title>
</head>
<body>
    <header> Cadastro de Pessoa</header>
    <main>
        <h3>Informações Pessoais</h3>
        <div class="container">
            <div class="linha">
                <input type="text" id="Nome" placeholder="Nome Completo">
                <input type="text" id="Cpf" placeholder="CPF/CNPJ">
                <select name="estadoCivil" id="estadoCivil" class="select-custom">
                    <option value="" disabled selected>Estado civil</option>
                    <option value="Solteiro">Solteiro(a)</option>
                    <option value="Casado">Casado(a)</option>
                    <option value="Divorciado">Divorciado(a)</option>
                    <option value="Viuvo">Viúvo(a)</option>
                </select>
            </div>
            <div class="linha">
                <input type="email" id="Email" placeholder="Email">
                <input type="text" id="Telefone" placeholder="Telefone">
                <input type="text" id="Fixo" placeholder="Telefone fixo">
            </div>
            <div class="linha">
                <input type="date" id="Data" class="date-custom" placeholder="Nascimento" >
                <div class="Idade">
                    <label for="input-idade">Idade: </label>
                    <input type="number" id="Idade">
                </div>
                <div class="Genero">
                    <label for="radio-genero">Sexo:</label>
                    <input type="radio" name="sexo" id="generoMasc">
                    <label for="radio-masculino">Masculino</label>
                    <input type="radio" name="sexo" id="generoFem">
                    <label for="radio-Feminino">Feminino</label>
                    <input type="radio" name="sexo" id="generoOut">
                    <label for="radio-Feminino">Outros</label>
                </div>
            </div>
        </div>
        <h3>Endereço</h3>
        <div class="container">
            <div class="linha">
                    <input type="text" id="Cep" placeholder="CEP">
                    <input type="text" id="Endereco" placeholder="Endereço">
                    <input type="text" id="Estado" placeholder="Estado">
                    <input type="text" id="Bairro" placeholder="Bairro">
            </div>
            <div class="linha">
                    <input type="text" id="Cidade" placeholder="Cidade">
                    <input type="number" id="Residencia" placeholder="Número da residência">
                    <input type="text" id="Complemento" placeholder="Complemento (opcional)">
            </div>
        </div>
        <div class="botoes">
            <button type="submit" class="buttonConfirmar">Confirmar</button>
            <button type="submit" class="buttonHome" onclick="window.location.href='../dashboard/dash.php';">Tela inicial</button>
            <button type="submit" class="buttonVoltar" onclick="window.location.href='../cadastro-pet/cadastro-pet.php';">Voltar</button>
        </div>
    </main>
    <script src="Script.js"></script>
</body>
</html>