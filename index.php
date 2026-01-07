<?php
/**
 * Function to handle the electricity calculations
 */
function calculateElectricity($voltage, $current, $rate_sen, $hour) 
{
    $power_watt = $voltage * $current;
    $power_kw = $power_watt / 1000;
    $energy_kwh = $power_kw * $hour;
    $total_rm = $energy_kwh * ($rate_sen / 100);
    
    return 
    [
        'power_kw' => $power_kw,
        'energy_kwh' => $energy_kwh,
        'total_rm' => $total_rm,
        'rate_rm' => $rate_sen / 100
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electricity Consumption Calculator</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body 
        {
            background-color: #f4f7f9;
            font-family: 'Inter', sans-serif;
            color: #333;
        }
        .container 
        { 
            max-width: 900px; 
        }
        .card 
        {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }
        .card-header 
        {
            background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%) !important;
            padding: 2rem;
            border-bottom: none;
        }
        .form-control 
        {
            border-radius: 10px;
            padding: 1.5rem 1rem;
            border: 1px solid #e0e0e0;
        }
        .btn-calculate 
        {
            background: #2c5364;
            color: white;
            font-weight: 600;
            border-radius: 10px;
            padding: 12px;
            width: 100%;
            border: none;
        }
        .result-box 
        {
            background-color: #ffffff;
            border-left: 6px solid #2c5364;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
        }
        .result-value 
        {
            font-size: 1.25rem;
            font-weight: 600;
            color: #2c5364;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="card">
        <div class="card-header text-white text-center">
            <h3 class="mb-1">Electricity Calculator</h3>
            <p class="mb-0">Estimate your power usage and costs</p>
        </div>
        
        <div class="card-body p-4 p-lg-5">
            <form method="POST" action="">
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
                        <input type="number" step="any" name="rate" class="form-control" value="21.8" required>
                    </div>
                </div>
                <button type="submit" name="calculate" class="btn btn-calculate">Calculate Consumption</button>
            </form>

            <?php
            if (isset($_POST['calculate'])) {
                $v = (float)$_POST['voltage'];
                $i = (float)$_POST['current'];
                $r = (float)$_POST['rate'];

                // Calling the function for the summary (1st hour)
                $res = calculateElectricity($v, $i, $r, 1);

                echo "<div class='result-box mt-5'>";
                echo "<div class='row text-center'>";
                echo "  <div class='col-md-6'>";
                echo "      <small class='text-muted d-block text-uppercase'>Power Output</small>";
                echo "      <span class='result-value'>" . number_format($res['power_kw'], 5) . " kW</span>";
                echo "  </div>";
                echo "  <div class='col-md-6'>";
                echo "      <small class='text-muted d-block text-uppercase'>Current Rate</small>";
                echo "      <span class='result-value'>" . number_format($res['rate_rm'], 3) . " RM</span>";
                echo "  </div>";
                echo "</div>";
                echo "</div>";
            ?>

            <div class="table-responsive">
                <table class="table text-center">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Hour</th>
                            <th>Energy (kWh)</th>
                            <th>Total (RM)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Calling the function inside the loop for each hour
                        for ($hour = 1; $hour <= 24; $hour++) {
                            $calc = calculateElectricity($v, $i, $r, $hour);
                            
                            echo "<tr>";
                            echo "<td>$hour</td>";
                            echo "<td>$hour</td>";
                            echo "<td>" . number_format($calc['energy_kwh'], 5) . "</td>";
                            echo "<td class='text-success font-weight-bold'>" . number_format($calc['total_rm'], 2) . "</td>";
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

</body>
</html>