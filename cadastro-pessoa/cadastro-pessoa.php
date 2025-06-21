<?php 
include ('../database/conexao.php');
include ('../database/protect.php');

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Cadastro de Pessoa</title>
</head>
<body>
    <header> Cadastro de Pessoa</header>
    <main>
        <form method="POST" action="processa-cadastro-pessoa.php">
            <h3>Informações Pessoais</h3>
            <div class="container">
                <div class="linha">
                    <input type="text" name="nome" id="Nome" placeholder="Nome Completo" required>
                    <input type="text" name="cpf" id="Cpf" placeholder="CPF/CNPJ" required>
                    <select name="estado_civil" id="estadoCivil" class="select-custom" required>
                        <option value="" disabled selected>Estado civil</option>
                        <option value="Solteiro">Solteiro(a)</option>
                        <option value="Casado">Casado(a)</option>
                        <option value="Divorciado">Divorciado(a)</option>
                        <option value="Viuvo">Viúvo(a)</option>
                    </select>
                </div>
                <div class="linha">
                    <input type="email" name="email" id="Email" placeholder="Email">
                    <input type="text" name="telefone" id="Telefone" placeholder="Telefone">
                    <input type="text" name="telefone_fixo" id="Fixo" placeholder="Telefone fixo">
                </div>
                <div class="linha">
                    <input type="date" name="data_nascimento" id="Data" class="date-custom" placeholder="Nascimento" >
                    <div class="Idade">
                        <label for="idade">Idade: </label>
                        <input type="number" name="idade" id="Idade">
                    </div>
                    <div class="Genero">
                        <label>Sexo:</label>
                        <input type="radio" name="sexo" id="generoMasc" value="Masculino" required>
                        <label for="generoMasc">Masculino</label>
                        <input type="radio" name="sexo" id="generoFem" value="Feminino">
                        <label for="generoFem">Feminino</label>
                        <input type="radio" name="sexo" id="generoOut" value="Outros">
                        <label for="generoOut">Outros</label>
                    </div>
                </div>
            </div>
            <h3>Endereço</h3>
            <div class="container">
                <div class="linha">
                    <input type="text" name="cep" id="Cep" placeholder="CEP">
                    <input type="text" name="endereco" id="Endereco" placeholder="Endereço">
                    <input type="text" name="estado" id="Estado" placeholder="Estado">
                    <input type="text" name="bairro" id="Bairro" placeholder="Bairro">
                </div>
                <div class="linha">
                    <input type="text" name="cidade" id="Cidade" placeholder="Cidade">
                    <input type="number" name="num_endereco" id="Residencia" placeholder="Número da residência">
                    <input type="text" name="complemento" id="Complemento" placeholder="Complemento (opcional)">
                </div>
            </div>
            <div class="botoes">
                <button type="button" class="buttonVoltar" onclick="window.location.href='../cadastro-pet/cadastro-pet.php';">Voltar</button>
                <button type="submit" class="buttonConfirmar">Confirmar</button>
            </div>
        </form>
    </main>
    <script src="Script.js"></script>
</body>
</html>