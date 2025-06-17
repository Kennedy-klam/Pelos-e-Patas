<?php 
include ('../database/conexao.php');
include ('../database/protect.php');

if (!isset($_SESSION['id_clinica'])) {
    header("Location: ../login/login.php"); // Ajuste o caminho se necessário
    exit();
}

$nomeDaClinica = $_SESSION['nomeclinica'];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="public/css/all.css?v=123" />
    <link rel="stylesheet" href="public/css/bootstrap.min.css?v=123" />
    <link rel="stylesheet" href="public/css/style.css?v=123" />
    <script src="public/js/chart.js"></script>
</head>

<body>
    <div class="container-fluid">
        <header class="headers">
            <nav class="nav">
                <div class="logo">
                    <a href="#"><img src="public/images/logo.png" alt="" /></a>
                </div>
                <form action="" class="form-group">
                    <div class="rows">
                        <input
                            type="text"
                            name="seach"
                            placeholder="Procurar opcao do menu..."
                            class="form-control"
                        />
                        <i class="fa-solid fa-search search"></i>
                    </div>
                </form>
                <ul>
                    <li>
                        <a href="../fila/fila.php"
                            ><span><i class="fa-solid fa-calendar-alt"></i></span> Fila de castração</a
                        >
                    </li>
                    <li>
                        <a href="../cadastro-pet/cadastro-pet.php"
                            ><span><i class="fa-solid fa-address-card"></i></span> Cadastro de Pet</a
                        >
                    </li>
                    <li>
                        <a href="../login/logout.php"
                            ><span><i class="fa-solid fa-right-from-bracket"></i></span> Logout</a
                        >
                    </li>
                </ul>
            </nav>
        </header>
        <main class="main">
            <div class="menu-top">
                <div class="menu-hmbr">
                    <button class="btn btn-bars">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <p>Painel</p>
                </div>
                <div class="users">
                    <button class="btn btn-users">
                        <p><?php echo "Bem vindo " . htmlspecialchars($nomeDaClinica); ?></p>
                    </button>
                </div>
            </div>

            <!-- Seus cards e tabelas aqui ... -->

            <div class="conteiner">
                <div class="list-pays">
                    <table class="table table-sm">
                        <thead class="text-center">
                            <tr>
                                <th>Cliente</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr>
                                <td>Chester</td>
                                <td>80,0</td>
                                <td><button class="btn rounded-0">VENDA</button></td>
                            </tr>
                            <tr>
                                <td>Macoda</td>
                                <td>180,0</td>
                                <td><button class="btn rounded-0">VENDA</button></td>
                            </tr>
                            <tr>
                                <td>Nogar</td>
                                <td>800,0</td>
                                <td><button class="btn rounded-0">VENDA</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="charts" style="display:flex; gap: 40px; flex-wrap: wrap;">
                    <div style="flex: 1 1 400px;">
                        <h3>Caninos Castrados (Machos e Fêmeas)</h3>
                        <canvas id="chartCaninos" style="width: 100%; height: 400px;"></canvas>
                    </div>
                    <div style="flex: 1 1 400px;">
                        <h3>Felinas Castradas (Somente Fêmeas)</h3>
                        <canvas id="chartFelinas" style="width: 100%; height: 400px;"></canvas>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="public/js/nav.js"></script>

    <script>
        fetch('dados_chart.php')
            .then(response => response.json())
            .then(data => {
                // Como no PHP já filtramos apenas os castrados (estado = "confirmado")

                // Filtra dados para caninos (todos os sexos)
                const caninos = data.filter(item => item.especie === 'canino');

                // Filtra dados para felinas (somente fêmeas)
                const felinas = data.filter(item => item.especie === 'felino' && item.sexo === 'femea');

                // Labels para caninos: "Idade: X - sexo"
                const labelsCaninos = caninos.map(item => `Idade: ${item.idade} - ${item.sexo}`);
                const valoresCaninos = caninos.map(item => item.total);

                // Labels para felinas: "Idade: X"
                const labelsFelinas = felinas.map(item => `Idade: ${item.idade}`);
                const valoresFelinas = felinas.map(item => item.total);

                // Função para criar gráficos com o mesmo estilo
                function criarGrafico(ctx, labels, dados, titulo) {
                    return new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: titulo,
                                data: dados,
                                backgroundColor: 'rgba(37, 160, 158, 0.7)',
                                borderColor: 'rgba(37, 160, 158, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }

                // Renderiza gráficos
                const ctxCaninos = document.getElementById('chartCaninos').getContext('2d');
                criarGrafico(ctxCaninos, labelsCaninos, valoresCaninos, 'Caninos Castrados');

                const ctxFelinas = document.getElementById('chartFelinas').getContext('2d');
                criarGrafico(ctxFelinas, labelsFelinas, valoresFelinas, 'Felinas Castradas');
            })
            .catch(error => {
                console.error('Erro ao carregar os dados do gráfico:', error);
            });
    </script>
</body>
</html>
