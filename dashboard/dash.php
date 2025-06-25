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
    <link rel="stylesheet" href="public/css/style.css" />
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
                            ><span><i class="fa-solid fa fa-paw"></i></span> Cadastro de Pet</a
                        >
                    </li>
                    <li>
                        <a href="../cadastro-pessoa/cadastro-pessoa.php"
                            ><span><i class="fa-solid fa-address-card"></i></span> Cadastro de Pessoa</a
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
            <!-- Cards de Castrações de Hoje -->
            <div class="cards">
                <?php include 'dados_cards.php'; ?>

                <!-- Card 1 - Confirmadas -->
                <div class="cards-header">
                    <div class="cardheader color1">
                        <div class="cards-value">
                            <p class="values"><?= $confirmadas_hoje ?></p>
                            <p class="descriptio">Castrações Confirmadas</p>
                        </div>
                        <div class="cards-icons">
                            <i class="fa fa-check colors1"></i>
                        </div>
                    </div>
                    <div class="cardfooter colorfooter1">
                        <p class="ticket"><?= $confirmadas_hoje ?> castração(ões) confirmada(s) hoje</p>
                    </div>
                </div>

                <!-- Card 2 - Canceladas -->
                <div class="cards-header">
                    <div class="cardheader color2">
                        <div class="cards-value">
                            <p class="values"><?= $canceladas_hoje ?></p>
                            <p class="descriptio">Castrações Canceladas</p>
                        </div>
                        <div class="cards-icons">
                            <i class="fa fa-ban colors2"></i>
                        </div>
                    </div>
                    <div class="cardfooter colorfooter2">
                        <p class="ticket"><?= $canceladas_hoje ?> castração(ões) cancelada(s) hoje</p>
                    </div>
                </div>

                <!-- Card 3 - Pendentes -->
                <div class="cards-header">
                    <div class="cardheader color3">
                        <div class="cards-value">
                            <p class="values"><?= $pendentes_hoje ?></p>
                            <p class="descriptio">Castrações Pendentes</p>
                        </div>
                        <div class="cards-icons">
                            <i class="fa fa-clock colors3"></i>
                        </div>
                    </div>
                    <div class="cardfooter colorfooter3">
                        <p class="ticket"><?= $pendentes_hoje ?> castração(ões) pendente(s) hoje</p>
                    </div>
                </div>
            </div>
            <div class="conteiner">
                <div class="list-pays">
                    <table class="table table-sm text-left">
                    <thead>
                        <tr>
                            <th colspan="3" style="white-space: nowrap;">Castrações últimos 30 dias:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include 'dados_tabela.php'; ?>
                        <tr>
                            <td>Total Castrações</td>
                            <td><?= $total ?></td>
                        </tr>
                        <tr>
                            <td>Machos</td>
                            <td><?= $machos ?></td>
                        </tr>
                        <tr>
                            <td>Fêmeas</td>
                            <td><?= $femeas ?></td>
                        </tr>
                        <tr>
                            <td>Canceladas</td>
                            <td><?= $canceladas ?></td>
                        </tr>
                    </tbody>
                </table>
                    <div class="grafico-box">
                        <h3>Pets Cadastrados</h3>
                        <canvas id="graficoPizza"></canvas>
                    </div>
                </div>
                <div class="charts-wrapper">
                    <div class="charts" style="display:flex; gap: 40px; flex-wrap: wrap;">
                        <div style="flex: 1 1 0px; background-color:white; border-radius: 4px; padding: 15px;">
                            <h3>Caninos Castrados</h3>
                            <canvas id="chartCaninos" style="width: 150%; height: 600px;"></canvas>
                        </div>
                        <div style="flex: 1 1 0px; background-color:white; border-radius: 4px; padding: 15px; margin-left: -15px;">
                            <h3>Felinos Castrados</h3>
                            <canvas id="chartFelinos" style="width: 150%; height: 600px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="public/js/nav.js"></script>

<canvas id="chartCaninos"></canvas>
<canvas id="chartFelinos"></canvas>

<script>
fetch('dados_chart.php')
    .then(response => response.json())
    .then(rawData => {
        // Converte idades e totais para número
        const data = rawData.map(item => ({
            ...item,
            idade: parseInt(item.idade),
            total: parseInt(item.total)
        }));

        const idades = [1, 2, 3, 4, 5, 6, 7];

        function getValoresPorIdade(array, idades) {
            return idades.map(idade => {
                const item = array.find(i => i.idade === idade);
                return item ? item.total : 0;
            });
        }

        // ===== CANINOS =====
        const caninos = data.filter(i => i.especie === 'canino');
        const caninoMacho = caninos.filter(i => i.sexo === 'macho');
        const caninoFemea = caninos.filter(i => i.sexo === 'femea'); // era 'fêmea', agora normalizado para 'femea'

        const dadosCaninoMacho = getValoresPorIdade(caninoMacho, idades);
        const dadosCaninoFemea = getValoresPorIdade(caninoFemea, idades);

        const ctxCanino = document.getElementById('chartCaninos').getContext('2d');
        new Chart(ctxCanino, {
            type: 'bar',
            data: {
                labels: idades,
                datasets: [
                    {
                        label: 'Macho',
                        data: dadosCaninoMacho,
                        backgroundColor: 'rgba(37, 160, 158, 0.7)'
                    },
                    {
                        label: 'Fêmea',
                        data: dadosCaninoFemea,
                        backgroundColor: 'rgba(255, 99, 132, 0.7)'
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Idade (anos)'
                        },
                        categoryPercentage: 1.5, 
                        barPercentage: 1.0 
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            callback: value => Number.isInteger(value) ? value : null
                        }
                    }
                }
            }
        });

        // ===== FELINOS =====
        const felinos = data.filter(i => i.especie === 'felino');
        const felinoMacho = felinos.filter(i => i.sexo === 'macho');
        const felinoFemea = felinos.filter(i => i.sexo === 'femea');

        const dadosFelinoMacho = getValoresPorIdade(felinoMacho, idades);
        const dadosFelinoFemea = getValoresPorIdade(felinoFemea, idades);

        const ctxFelino = document.getElementById('chartFelinos').getContext('2d');
        new Chart(ctxFelino, {
            type: 'bar',
            data: {
                labels: idades,
                datasets: [
                    {
                        label: 'Macho',
                        data: dadosFelinoMacho,
                        backgroundColor: 'rgba(56, 108, 203, 0.7)'
                    },
                    {
                        label: 'Fêmea',
                        data: dadosFelinoFemea,
                        backgroundColor: 'rgba(132, 0, 255, 0.7)'
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Idade (anos)'
                        },
                        categoryPercentage: 0.5, // espaço entre idades
                        barPercentage: 1.0       // colunas coladas
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            callback: value => Number.isInteger(value) ? value : null
                        }
                    }
                }
            }
        });

    })
    .catch(error => {
        console.error('Erro ao carregar os dados do gráfico:', error);
    });

            // Gráfico de Pizza - Distribuição de Pets por Espécie
            fetch('dados_pizza.php')
                .then(response => response.json())
                .then(data => {
                    const labels = data.map(item => item.especie);
                    const valores = data.map(item => item.total);

                    const cores = ['#09A6A3', '#b5af9d']

                    const ctx = document.getElementById('graficoPizza').getContext('2d');
                    new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: labels,
                            datasets: [{
                                data: valores,
                                backgroundColor: cores,
                                borderColor: '#fff',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'bottom'
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            let total = context.dataset.data.reduce((a, b) => Number(a) + Number(b), 0);
                                            let value = Number(context.parsed);
                                            let percent = ((value / total) * 100).toFixed(1);
                                            return `${context.label}: ${value} (${percent}%)`;
                                        }
                                    }
                                }
                            }
                        }
                    });
                });
    </script>
</body>
</html>
