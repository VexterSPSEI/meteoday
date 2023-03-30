<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="script.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Meteostanice</title>
</head>
<body>

<?php
    require_once 'header.php';
    require_once 'func.php';
    $trend = getTrend($temperature, $humidity, $pressure);

    function findMaxValues($values) {
        $max = max($values);
        $index = array_search($max, $values);
        return array("max" => $max,"index" => $index);
    }

    function findMinValues($values) {
        $min = min($values);
        $index = array_search($min, $values);
        return array("min" => $min,"index" => $index);
    }

    $tempMax = findMaxValues($temperature);
    $humMax = findMaxValues($humidity);
    $presMax = findMaxValues($pressure);

    $tempMin = findMinValues($temperature);
    $humMin = findMinValues($humidity);
    $presMin = findMinValues($pressure);
?>

<div class="container-fluid">
    <div class="row" id="now">
        <h1>Aktuálně</h1>

        <div class="col-sm-3" id="temp">
            <div class="row">
                <h2>Teplota <img src="./icons/Temp.svg" alt="temp_icon" class="icons"></h2>
            </div>
            <h3><?php echo(end($temperature) . " | ");
                echo($trend["temperature"]); ?></h3>
            <div class="row" id="maxMinTemp">
                <div class="col-6">
                    <p>Min: <?php echo($hour[$tempMin["index"]]);?></p>
                    <p><?php echo($tempMin["min"]);?></p>
                </div>
                <div class="col-6">
                    <p>Max: <?php echo($hour[$tempMax["index"]]);?></p>
                    <p><?php echo($tempMax["max"]);?></p>
                </div>
            </div>
        </div>

        <div class="col-sm-3" id="hum">
            <div class="row">
                <h2>Vlhkost <img src="./icons/Humi.svg" alt="temp_icon" class="icons"></h2>
            </div>
            <h3><?php echo(end($humidity) . " | ");
                echo($trend["humidity"]) ?></h3>
            <div class="row" id="maxMinHum">
                <div class="col-6">
                    <p>Min: <?php echo($hour[$humMin["index"]]);?></p>
                    <p><?php echo($humMin["min"]);?></p>
                </div>
                <div class="col-6">
                    <p><?php echo($hour[$humMax["index"]]);?></p>
                    <p><?php echo($humMax["max"]);?></p>
                </div>
            </div>
        </div>

        <div class="col-sm-3" id="press">
            <div class="row">
                <h2>Tlak <img src="./icons/Pres.svg" alt="temp_icon" class="icons"></h2>
            </div>
            <h3><?php echo(end($pressure) . " | ");
                echo($trend["pressure"]) ?></h3>
            <div class="row" id="maxMinPress">
                <div class="col-6">
                    <p>Min: <?php echo($hour[$presMin["index"]]);?></p>
                    <p><?php echo($presMin["min"]);?></p>
                </div>
                <div class="col-6">
                    <p>Max: <?php echo($hour[$presMax["index"]]);?></p>
                    <p><?php echo($presMax["max"]);?></p>
                </div>
            </div>
        </div>

        <div class="col-sm-3" id="records">
            <h2>Rekordy</h2>
            <div class="row">
                <h3>Teplota:</h3>
                <p>Max: <?php echo $maxTempTime . " " . $maxTemp ?></p>
                <p>Min: <?php echo $minTempTime . " " . $minTemp ?></p>
            </div>
            <div class="row">
                <h3>Tlak:</h3>
                <p>Max: <?php echo $maxPressTime . " " . $maxPress ?></p>
                <p>Min: <?php echo $minPressTime . " " . $minPress ?></p>
            </div>
        </div>
    </div>

    <br>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4"><canvas id="chartTemperature"></canvas></div>
            <div class="col-md-4"><canvas id="chartHumidity"></canvas></div>
            <div class="col-md-4"><canvas id="chartPressure"></canvas></div>
        </div>
    </div>
</div>
<script>
const ctx = document.getElementById('chartTemperature');
const ctx2 = document.getElementById('chartHumidity');
const ctx3 = document.getElementById('chartPressure');

const charTemp = new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($hour) ?>,
        datasets: [{
            label: 'Teplota',
            data: <?php echo json_encode($temperature) ?>,
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            pointStyle: 'circle',
            pointRadius: 4,
            pointHoverRadius: 8
        }]
    }
});

const chartHum = new Chart(ctx2, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($hour) ?>,
        datasets: [{
            label: 'Vlhkost',
            data: <?php echo json_encode($humidity) ?>,
            backgroundColor: 'rgb(62, 141, 214)',
            borderColor: 'rgb(62, 141, 214)',
            pointStyle: 'circle',
            pointRadius: 4,
            pointHoverRadius: 8
        }]
    }
});

const presTemp = new Chart(ctx3, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($hour) ?>,
        datasets: [{
            label: 'Tlak',
            data: <?php echo json_encode($pressure) ?>,
            backgroundColor: 'rgb(52, 22, 128)',
            borderColor: 'rgb(52, 22, 128)',
            pointStyle: 'circle',
            pointRadius: 4,
            pointHoverRadius: 8
        }]
    }
});
</script>

</body>
</html>