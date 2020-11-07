<?php
  require './vendor/autoload.php';

$client = new \Google_Client();
$client->setApplicationName('CotaiSheets');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig('./credentials.json');
$service = new Google_Service_Sheets($client);

$spreadsheetID = "1QJ7L6ipPWLLjaEdJSIHYUPNRCb7Kg_qN6ku8owJf65I";

$range = "Reporte!E2:E";

$response = $service->spreadsheets_values->get($spreadsheetID, $range);
$suma = 0;

$values = $response->getValues();
if(empty($values)){
  print "No data found.\n";
}else{
  foreach ($values as $row) {
    $suma = $suma + 1;

  }
echo $suma;
}

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = google.visualization.DataTable();
      data.addColum('string','Proyecto');
      data.addColum('int', 'Pago');
      <?php

      $range = "Presupuesto!A2:E";

      $response = $service->spreadsheets_values->get($spreadsheetID, $range);

      $values = $response->getValues();
      if(empty($values)){
        print "No data found.\n";
      }else{
        foreach ($values as $row) { ?>
          data.addRows([
            ['<?php $row[0] ?>' , '<?php $row[4] ?>']
          ]);
      <?php
        }
      }

      ?>

      var options = {
        title: 'My Daily Activities'
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart'));

      chart.draw(data, options);
    }
  </script>

 ?>
