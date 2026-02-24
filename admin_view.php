<?php
include('secur.php');
include("includes/connect.php");
?>

<?php

$query = "SELECT * FROM records";
$result = $conn->query($query);

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$conn->close();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Admin</title>
        <!-- <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" /> -->
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
       <!--  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet"> -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
       <script>
    let dataTableInstance;

$(document).ready(function() {
    // Initialize DataTable with initial sorting
    initDataTable();
    
    // Set an interval to update the table every 30 seconds (adjust as needed)
    setInterval(updateTable, 2000); // 30 seconds
});

function initDataTable() {
    dataTableInstance = $('#example').DataTable({
        "order": [[0, "desc"]] // Initial sorting by Date & Time in descending order (newest to oldest)
    });
}

function updateTable() {
    // Get the current sorting settings and page
    const currentOrder = dataTableInstance.order();
    const currentPage = dataTableInstance.page();

    $.ajax({
        url: 'includes/table.php', // URL to your PHP script that fetches updated data
        type: 'GET',
        dataType: 'html',
        success: function(data) {
            // Clear the existing table data
            dataTableInstance.clear();

            // Add the new data
            dataTableInstance.rows.add($(data)).draw();

            // Reapply the current sorting settings
            dataTableInstance.order(currentOrder).draw();

            // Restore the current page
            dataTableInstance.page(currentPage).draw('page');
        },
        error: function(xhr, status, error) {
            console.error('Error fetching data:', error);
        }
    });
}

</script>

    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand ps-3">Admin</a>
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="logout.php">Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </form>
    </nav>   
</nav>
</div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <br>
                        <h1 class="mt-5">Dashboard</h1>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Flood level
                                    </div>
                                    <div class="card-body"><canvas id="myChart" width="20" height="8"></canvas>
                                    </div>

                                    <script>
                            // Define chart outside of any function to make it accessible globally
                        var chart;

                        // Function to update the chart with new data
                        function updateChart() {
                            fetch("./includes/data.php") // Replace with the URL of your PHP script that fetches new data
                                .then(response => response.json())
                                .then(data => {
                                    var labels = data.map(function (row) {
                                        return row.date_time;
                                    });

                                    var values = data.map(function (row) {
                                        return row.water_level;
                                    });

                                    // Check if chart is defined
                                    if (chart) {
                                        // Update chart data
                                        chart.data.labels = labels;
                                        chart.data.datasets[0].data = values;
                                        chart.update();
                                    }
                                })
                                // .catch(error => console.error('Error fetching data:', error));
                        }

                        // Initial chart setup
                        var ctx = document.getElementById('myChart').getContext('2d');
                        chart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: [],
                                datasets: [{
                                    label: 'Water Level',
                                    lineTension: 0.3,
                                    backgroundColor: "rgba(2,117,216,0.2)",
                                    borderColor: "rgba(2,117,216,1)",
                                    pointRadius: 5,
                                    pointBackgroundColor: "rgba(2,117,216,1)",
                                    pointBorderColor: "rgba(255,255,255,0.8)",
                                    pointHoverRadius: 5,
                                    pointHoverBackgroundColor: "rgba(2,117,216,1)",
                                    pointHitRadius: 50,
                                    pointBorderWidth: 2,
                                    data: [],
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

                        // Periodically update the chart (e.g., every 5 seconds)
                        setInterval(updateChart, 1000); // Adjust the interval as needed (in milliseconds)

                        </script>

                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Monthly Flood level
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div>

                       <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Records
                        </div>
                        <div class="card-body">
                            <table id="example" class="display" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th id="datetimeColumn" name="datetimeColumn">Date & Time</th>
                                        <th id="floodFlowColumn" name="floodFlowColumn">Flood Flow</th>
                                        <th id="floodLevelColumn" name="floodLevelColumn">Flood Level</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include("includes/table.php");
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>


                </main>
                
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script> -->
    </body>
</html>
<?
if(isset($_POST["logout"])){
    header("Location: logout.php");
}
?>