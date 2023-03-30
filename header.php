<?php 
  if (isset($_POST["zadejKolik"])) {
    if (!empty($_POST["zadejKolik"])) {
      $mnozstviZaznamu = $_POST["zadejKolik"];
    }
  } else {
    $mnozstviZaznamu = 100;
  }

  // připojení do db a odeslání dotazu data
  $GLOBALS["con"] = new mysqli("", "", "", "");

  if (!$con) {
    die("Připojení selhalo: " . $con->connect_error);
}

$today = date("Y-m-d H:i:s", strtotime("-24 hours"));

  $query = $con->query("
    SELECT timestamp, temperature, humidity, pressure
    FROM meteo_data
    WHERE DATE_FORMAT(timestamp, '%Y-%m-%d %H:%i:%s') >= '$today'
    ORDER BY id DESC
    LIMIT $mnozstviZaznamu;
  ");

  $result = $query->fetch_all(MYSQLI_ASSOC);

  foreach($result as $row) {
    $hourTimeStamp = strtotime("{$row["timestamp"]}");
    $hour[] = date("H:i", $hourTimeStamp);
    $temperature[] = (float)$row["temperature"];
    $humidity[] = (float)$row["humidity"];
    $pressure[] = (float)$row["pressure"];
  }

  $hour = array_reverse($hour);
  $temperature = array_reverse($temperature);
  $humidity = array_reverse($humidity);
  $pressure = array_reverse($pressure);

  // Dotaz pro získání max. teploty a jejího času za celkovou dobu
  $query = $con->query("
    SELECT MAX(temperature) as maxTemp, timestamp
    FROM meteo_data;
  ");
  // Uložení max. teploty a jejího času záznamu
  $result = $query->fetch_all(MYSQLI_ASSOC);
  $maxTemp = $result[0]["maxTemp"];
  $maxTempTime = $result[0]["timestamp"];

  // Dotaz pro získání min. teploty a jejího času za celkovou dobu
  $query = $con->query("
    SELECT MIN(temperature) as minTemp, timestamp
    FROM meteo_data;
  ");
  // Uložení min. teploty a jejího času záznamu
  $result = $query->fetch_all(MYSQLI_ASSOC);
  $minTemp = $result[0]["minTemp"];
  $minTempTime = $result[0]["timestamp"];

  // Dotaz pro získání max. tlaku a jeho času za celkovou dobu
  $query = $con->query("
    SELECT MAX(pressure) as maxPress, timestamp
    FROM meteo_data;
  ");
  // Uložení max. tlaku a jeho času záznamu
  $result = $query->fetch_all(MYSQLI_ASSOC);
  $maxPress = $result[0]["maxPress"];
  $maxPressTime = $result[0]["timestamp"];

    // Dotaz pro získání min. tlaku a jeho času za celkovou dobu
  $query = $con->query("
    SELECT MIN(pressure) as minPress, timestamp
    FROM meteo_data;
  ");
  // Uložení min. tlaku a jeho času záznamu
  $result = $query->fetch_all(MYSQLI_ASSOC);
  $minPress = $result[0]["minPress"];
  $minPressTime = $result[0]["timestamp"];

/*  $today = date("Y-m-d", time());
  $query = $con->query("
    SELECT timestamp
    FROM meteo_data
    WHERE DATE_FORMAT(timestamp, '%Y-%m-%d') = '$today'
    ORDER BY id DESC;
  ");
  
  $result = $query->fetch_all(MYSQLI_ASSOC);
  foreach($query as $date) {
    $hourTimeStamp = strtotime("{$date["timestamp"]}"); // formátování času
    $hour[] = date("H:i", $hourTimeStamp);
  }

  $hour = array_reverse($hour);
  
  // odeslání dotazu teploty
  $query = $con->query("
    SELECT temperature
    FROM meteo_data
    WHERE DATE_FORMAT(timestamp, '%Y-%m-%d') = '$today'
    ORDER BY id DESC
  ");

  $result = $query->fetch_all(MYSQLI_ASSOC);
  foreach($result as $temp) {
    $temperature[] = (float)$temp["temperature"];
  }
  $temperature = array_reverse($temperature);

  // odeslání dotazu vlhkost  
  $query = $con->query("
    SELECT humidity
    FROM meteo_data
    WHERE DATE_FORMAT(timestamp, '%Y-%m-%d') = '$today'
    ORDER BY id DESC
  ");

  $result = $query->fetch_all(MYSQLI_ASSOC);
  foreach($query as $hum) {
    $humidity[] = (float)$hum["humidity"];
  }
  $humidity = array_reverse($humidity);

  // odeslání dotazu tlaku  
  $query = $con->query("
    SELECT pressure
    FROM meteo_data
    WHERE DATE_FORMAT(timestamp, '%Y-%m-%d') = '$today'
    ORDER BY id DESC
  ");

  $result = $query->fetch_all(MYSQLI_ASSOC);
  foreach($query as $pres) {
    $pressure[] = (float)$pres["pressure"];
  }
  $pressure = array_reverse($pressure);
  */


 

?>