<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
?>


<?php
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

<div class="now">
    <h1>Aktuálně</h1>
<div class="cards-container">
  <div class="card temp">
    <h2>Teplota</h2>
    <h3>Aktuální teplota: <?php echo(end($temperature) . " | ");
                              echo($trend["temperature"]); ?></h3>
    <h4>Max: <?php echo($tempMax["max"]);?></h4>
    <h4>Čas: <?php echo($hour[$tempMax["index"]]);?></h4>
    <h4>Min: <?php echo($tempMin["min"]);?></h4>
    <h4>Čas: <?php echo($hour[$tempMin["index"]]);?></h4>
  </div>
  <div class="card hum">
    <h2>Vlhkost</h2>
    <h3>Aktuální vlhkost: <?php echo(end($humidity) . " | ");
                              echo($trend["humidity"]) ?></h3>
    <h4>Max: <?php echo($humMax["max"]);?></h4>
    <h4>Čas: <?php echo($hour[$humMax["index"]]);?></h4>
    <h4>Min: <?php echo($humMin["min"]);?></h4>
    <h4>Čas: <?php echo($hour[$humMin["index"]]);?></h4>
  </div>
  <div class="card pres">
    <h2>Tlak</h2>
    <h3>Aktuální tlak: <?php echo(end($pressure) . " | ");
                            echo($trend["pressure"]) ?></h3>
    <h4>Max: <?php echo($presMax["max"]);?></h4>
    <h4>Čas: <?php echo($hour[$presMax["index"]]);?></h4>
    <h4>Min: <?php echo($presMin["min"]);?></h4>
    <h4>Čas: <?php echo($hour[$presMin["index"]]);?></h4>
  </div>
</div>
<div class="records-container">
  <div class="records-card">
    <h2>Rekordy</h2>
    <div class="record">
      <h3>Teplota:</h3>
      <h4>Max: <?php echo $maxTempTime . " " . $maxTemp ?></h4>
      <h4>Min: <?php echo $minTempTime . " " . $minTemp ?></h4>
    </div>
    <div class="record">
      <h3>Tlak:</h3>
      <h4>Max: <?php echo $maxPressTime . " " . $maxPress ?></h4>
      <h4>Min: <?php echo $minPressTime . " " . $minPress ?></h4>
    </div>
  </div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4"><canvas id="chartTemperature"></canvas></div>
        <div class="col-md-4"><canvas id="chartHumidity"></canvas></div>
        <div class="col-md-4"><canvas id="chartPressure"></canvas></div>
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
    },
    options: {
        layout: {
           // padding: 100
        }
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
    },
    options: {
        layout: {
            //padding: 100
        }
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
    },
    options: {
        layout: {
            //padding: 100
        }
    }
});
</script>

</body>
</html>