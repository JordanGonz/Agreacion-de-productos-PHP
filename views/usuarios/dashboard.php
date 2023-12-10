<?php
require '../../includes/_db.php';

$query = "SELECT * FROM productos";
$conexion = mysqli_connect("localhost", "root", "", "tienda");
$result = mysqli_query($conexion, $query);


if (!$result) {
    die("Error in query: " . mysqli_error($conexion));
}

$chartQuery = "SELECT categorias, COUNT(*) as count FROM productos GROUP BY categorias";
$chartResult = mysqli_query($conexion, $chartQuery);
$chartData = [];
while ($chartRow = mysqli_fetch_assoc($chartResult)) {
    $chartData[$chartRow['categorias']] = $chartRow['count'];
}
?>

<!DOCTYPE html>
<html lang="en">
<?php require '../../includes/_header.php' ?>

<body>
    <div class="container">
        <h2>Product Dashboard</h2>


        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Color</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Cantidad Mínima</th>
                    <th>Categoria</th>
                </tr>
            </thead>
           
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td>
                            <?php echo $row['id']; ?>
                        </td>
                        <td>
                            <?php echo $row['nombre']; ?>
                        </td>
                        <td>
                            <?php echo $row['descripcion']; ?>
                        </td>
                        <td>
                            <?php echo $row['color']; ?>
                        </td>
                        <td>
                            <?php echo $row['precio']; ?>
                        </td>
                        <td>
                            <?php echo $row['cantidad']; ?>
                        </td>
                        <td>
                            <?php echo $row['cantidad_min']; ?>
                        </td>
                        <td>
                            <?php echo $row['categorias']; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>


        <canvas id="categoryChart" width="400" height="200"></canvas>
        <div class="mb-3">
        <canvas id="categoryDoughnutChart" width="400" height="400"></canvas>

        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            //Grafico de Barras
            var ctx = document.getElementById('categoryChart').getContext('2d');
            var chartData = <?php echo json_encode($chartData); ?>;

            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: Object.keys(chartData),
                    datasets: [{
                        label: 'Numero de los Productos',
                        data: Object.values(chartData),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            //grafico de Rosquilla
            var doughnutCtx = document.getElementById('categoryDoughnutChart').getContext('2d');
            var doughnutChart = new Chart(doughnutCtx, {
                type: 'doughnut',
                data: {
                    labels: Object.keys(chartData),
                    datasets: [{
                        data: Object.values(chartData),
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.8)',
                            'rgba(54, 162, 235, 0.8)',
                            'rgba(255, 206, 86, 0.8)',
                            'rgba(75, 192, 192, 0.8)',
                            'rgba(153, 102, 255, 0.8)',
                            'rgba(255, 159, 64, 0.8)',
                            'rgba(255, 255, 0, 0.8)',
                            'rgba(0, 255, 0, 0.8)',
                            'rgba(0, 0, 255, 0.8)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                     maintainAspectRatio: false
                }
            });
        </script>
</body>

<?php require '../../includes/_footer.php' ?>

</html>
<?php
mysqli_close($conexion);
?>