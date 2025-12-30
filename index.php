<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Electricity Calculator</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0 text-center">Calculate Electricity Bill</h4>
                </div>
                <div class="card-body p-4">
                    <form method="POST">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Voltage (V)</label>
                                <input type="number" step="any" name="voltage" class="form-control" value="19" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Current (A)</label>
                                <input type="number" step="any" name="current" class="form-control" value="3.24" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Rate (sen/kWh)</label>
                                <input type="number" step="any" name="rate" class="form-control" value="21.80" required>
                            </div>
                        </div>
                        <button type="submit" name="calculate" class="btn btn-success btn-block mt-3">Calculate</button>
                    </form>

                    <?php
                    if (isset($_POST['calculate'])) {
                        // Retrieve input data
                        $v = (float)$_POST['voltage'];
                        $i = (float)$_POST['current'];
                        $rate_sen = (float)$_POST['rate'];

                        // Calculate Power & Rate (following formulas in prompt)
                        $power_w = $v * $i;
                        $power_kw = $power_w / 1000;
                        $rate_rm = $rate_sen / 100;

                        echo "<div class='mt-4 p-3 bg-light border rounded text-center'>";
                        echo "<p class='mb-1'><strong>POWER:</strong> " . number_format($power_kw, 5) . "kW</p>";
                        echo "<p class='mb-0'><strong>RATE:</strong> " . number_format($rate_rm, 3) . "RM</p>";
                        echo "</div>";
                    ?>

                    <div class="table-responsive mt-4">
                        <table class="table table-striped table-bordered text-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Hour</th>
                                    <th>Energy (kWh)</th>
                                    <th>TOTAL (RM)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                for ($h = 1; $h <= 24; $h++) {
                                    $energy = $power_kw * $h;
                                    $total = $energy * $rate_rm;
                                    echo "<tr>";
                                    echo "<td>$h</td>";
                                    echo "<td>$h</td>";
                                    echo "<td>" . number_format($energy, 5) . "</td>";
                                    echo "<td>" . number_format($total, 2) . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>