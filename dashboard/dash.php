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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="public/css/all.css?v=123">
    <link rel="stylesheet" href="public/css/bootstrap.min.css?v=123">
    <link rel="stylesheet" href="public/css/style.css?v=123">
    <script src="public/js/chart.js"></script>

</head>

<body>
    <div class="container-fluid">

        <header class="headers">
            <nav class="nav">
                <div class="logo">
                    <a href="#"><img src="public/images/logo.png" alt=""></a>
                </div>
                <form action="" class="form-group">
                    <div class="rows">
                        <input type="text" name="seach" id="" placeholder="Procurar opcao do menu..."
                            class="form-control">
                        <i class="fa-solid fa-search search"></i>
                    </div>
                </form>
                <ul>
                    <li><a href="../fila/fila.php"><span><i class="fa-solid fa-calendar-alt"></i></span> Fila de castração</a></li>
                    <li><a href="../cadastro-pet/cadastro-pet.php"><span><i class="fa-solid fa-address-card"></i></span> Cadastro de Pet</a></li>
                    <li><a href="../login/logout.php"><span><i class="fa-solid fa-right-from-bracket"></i></span> Logout</a></li>
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
                        <p> <?php echo "Bem vindo " . htmlspecialchars($nomeDaClinica);?></p>
                    </button>
                </div>
            </div>
            <div class="cards">
                <div class="cards-header">
                    <div class="cardheader color1">
                        <div class="cards-value">
                            <p class="values">1.021,25</p>
                            <p class="descriptio">Vendas Hoje</p>
                        </div>
                        <div class="cards-icons">
                            <i class="fa-solid fa-cart-shopping colors1"></i>
                        </div>
                    </div>
                    <div class="cardfooter colorfooter1">
                        <p class="ticket">Ticket Medio $255.31 - Ref. 4 vendas(s)</p>
                    </div>
                </div>

                <!-- card 2 -->
                <div class="cards-header">
                    <div class="cardheader color2">
                        <div class="cards-value">
                            <p class="values">1.021,25</p>
                            <p class="descriptio">Vendas Periodicas</p>
                        </div>
                        <div class="cards-icons">
                            <i class="fa fa-bar-chart colors2"></i>
                        </div>
                    </div>
                    <div class="cardfooter colorfooter2">
                        <p class="ticket">Ticket Medio $255.31 - Ref. 4 vendas(s)</p>
                    </div>
                </div>


                <!-- card 3 -->
                <div class="cards-header">
                    <div class="cardheader color3">
                        <div class="cards-value">
                            <p class="values">1.021,25</p>
                            <p class="descriptio">Receber Hoje</p>
                        </div>
                        <div class="cards-icons">
                            <i class="fa fa-bar-chart colors3"></i>
                        </div>
                    </div>
                    <div class="cardfooter colorfooter3">
                        <p class="ticket">Ticket Medio $255.31 - Ref. 4 vendas(s)</p>
                    </div>
                </div>
                <div class="cards-header">
                    <div class="cardheader color1">
                        <div class="cards-value">
                            <p class="values">1.021,25</p>
                            <p class="descriptio">Vendas Hoje</p>
                        </div>
                        <div class="cards-icons">
                            <i class="fa-solid fa-cart-shopping colors1"></i>
                        </div>
                    </div>
                    <div class="cardfooter colorfooter1">
                        <p class="ticket">Ticket Medio $255.31 - Ref. 4 vendas(s)</p>
                    </div>
                </div>
            </div>
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

                <div class="charts">
                    <div class="Chart-Titles">
                        <p class="vendasChart">Animais por Sexo e Espécie</p>
                    </div>
                    <canvas style="width: 500px; height: 500px;" id="myChart"></canvas>
                </div>
            </div>
        </main>
    </div>

    <script src="public/js/nav.js"></script>

 <script>
        fetch('dados_chart.php')
            .then(response => response.json())
            .then(data => {
                const labels = data.map(item => `${item.especie} - ${item.sexo}`);
                const valores = data.map(item => item.total);

                const ctx = document.getElementById('myChart').getContext('2d');

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Total de animais',
                            data: valores,
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
            })
            .catch(error => {
                console.error("Erro ao carregar os dados do gráfico:", error);
            });
    </script>
</body>

</html>