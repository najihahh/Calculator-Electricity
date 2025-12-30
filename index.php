<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electricity Consumption Calculator</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #f4f7f9;
            font-family: 'Inter', sans-serif;
            color: #333;
        }

        .container {
            max-width: 900px;
        }

        /* Modern Card Styling */
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%) !important;
            padding: 2rem;
            border-bottom: none;
        }

        .card-header h3 {
            font-weight: 600;
            letter-spacing: -0.5px;
        }

        /* Form Styling */
        .form-control {
            border-radius: 10px;
            padding: 1.5rem 1rem;
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(44, 83, 100, 0.1);
            border-color: #2c5364;
        }

        label {
            font-weight: 600;
            font-size: 0.9rem;
            color: #555;
            margin-bottom: 0.5rem;
        }

        /* Button Styling */
        .btn-calculate {
            background: #2c5364;
            background: linear-gradient(to right, #2c5364, #203a43);
            border: none;
            color: white;
            font-weight: 600;
            border-radius: 10px;
            padding: 12px;
            margin-top: 10px;
            transition: all 0.3s ease;
        }

        .btn-calculate:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            color: #fff;
        }

        /* Result Summary Box */
        .result-box {
            background-color: #ffffff;
            border-left: 6px solid #2c5364;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        }

        .result-value {
            font-size: 1.25rem;
            font-weight: 600;
            color: #2c5364;
        }

        /* Table Styling */
        .table {
            background: white;
            border-radius: 12px;
        }

        .table thead th {
            border: none;
            background-color: #f8f9fa;
            color: #6c757d;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 15px;
        }

        .table td {
            vertical-align: middle;
            padding: 15px;
            border-top: 1px solid #f1f1f1;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="card">
        <div class="card-header text-white text-center">
            <h3 class="mb-1">Electricity Calculator</h3>
            <p class="mb-0 opacity-75">Estimate your power usage and costs</p>
        </div>
        
        <div class="card-body p-4 p-lg-5">
            <form method="POST" action="">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="voltage">Voltage (V)</label>
                        <input type="number" step="any" name="voltage" id="voltage" class="form-control" placeholder="e.g. 19" value="<?php echo isset($_POST['voltage']) ? $_POST['voltage'] : ''; ?>" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="current">Current (A)</label>
                        <input type="number" step="any" name="current" id="current" class="form-control" placeholder="e.g. 3.24" value="<?php echo isset($_POST['current']) ? $_POST['current'] : ''; ?>" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="rate">Rate (sen/kWh)</label>
                        <input type="number" step="any" name="rate" id="rate" class="form-control" placeholder="e.g. 21.8" value="<?php echo isset($_POST['rate']) ? $_POST['rate'] : ''; ?>" required>
                    </div>
                </div>
                <button type="submit" name="calculate" class="btn btn-calculate btn-block">Calculate Consumption</button>
            </form>

            <?php
            if (isset($_POST['calculate'])) {
                // Get inputs from user
                $voltage = (float)$_POST['voltage'];
                $current = (float)$_POST['current'];
                $rate_sen = (float)$_POST['rate'];

                // Logic: Power (kW) = (V * A) / 1000
                $power_w = $voltage * $current;
                $power_kw = $power_w / 1000;
                
                // Logic: Rate (RM) = sen / 100
                $rate_rm = $rate_sen / 100;

                echo "<div class='result-box mt-5'>";
                echo "<div class='row text-center'>";
                echo "  <div class='col-md-6 mb-3 mb-md-0'>";
                echo "      <small class='text-muted d-block text-uppercase font-weight-bold'>Power Output</small>";
                echo "      <span class='result-value'>" . number_format($power_kw, 5) . " kW</span>";
                echo "  </div>";
                echo "  <div class='col-md-6'>";
                echo "      <small class='text-muted d-block text-uppercase font-weight-bold'>Current Rate</small>";
                echo "      <span class='result-value'>" . number_format($rate_rm, 3) . " RM</span>";
                echo "  </div>";
                echo "</div>";
                echo "</div>";
            ?>

            <div class="table-responsive">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Hour</th>
                            <th>Energy (kWh)</th>
                            <th>Total (RM)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Generate calculation for 24 hours
                        for ($hour = 1; $hour <= 24; $hour++) {
                            $energy = $power_kw * $hour;
                            $total_cost = $energy * $rate_rm;
                            
                            echo "<tr>";
                            echo "<td><span class='badge badge-light p-2 text-muted'>$hour</span></td>";
                            echo "<td>$hour</td>";
                            echo "<td class='font-weight-bold'>" . number_format($energy, 5) . "</td>";
                            echo "<td class='text-success font-weight-bold'>" . number_format($total_cost, 2) . "</td>";
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

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>