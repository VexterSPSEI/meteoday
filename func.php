<?php 
function getTrend($temperature, $humidity, $pressure) {
  $trend_temp = "neznámý";
  $trend_humidity = "neznámý";
  $trend_pressure = "neznámý";
  for ($i = 0; $i < count($temperature) - 1; $i++) {
    if ($temperature[$i + 1] > $temperature[$i]) {
      $trend_temp = "stoupající";
    } else if ($temperature[$i + 1] < $temperature[$i]) {
      $trend_temp = "klesající";
    } else {
      $trend_temp = "stálý";
    }

    if ($humidity[$i + 1] > $humidity[$i]) {
      $trend_humidity = "stoupající";
    } else if ($humidity[$i + 1] < $humidity[$i]) {
      $trend_humidity = "klesající";
    } else {
      $trend_humidity = "stálý";
    }

    if ($pressure[$i + 1] > $pressure[$i]) {
      $trend_pressure = "stoupající";
    } else if ($pressure[$i + 1] < $pressure[$i]) {
      $trend_pressure = "klesající";
    } else {
      $trend_pressure = "stálý";
    }
  }

  return array(
    "temperature" => $trend_temp,
    "humidity" => $trend_humidity,
    "pressure" => $trend_pressure
  );
}

/*function getMaxTempDay($temperature) {
  return(max($temperature));
  $query = $con->query("
    SELECT MAX(temperature) as max_temp, DATE_FORMAT(data_date, '%H:%i') as time
    FROM sensor
    WHERE data_date >= CURDATE() AND data_date < CURDATE() + INTERVAL 1 DAY;
  ");
}*/

/*function getMaxTempDay($temperature) {
  return max($temperature);
}

function getMaxHumDay($humidity) {
  return max($humidity);
}

function getMaxPresDay($pressure) {
  return max($pressure);
}*/

?>
