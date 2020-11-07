<?php
require './vendor/autoload.php';

$client = new \Google_Client();
$client->setApplicationName('CotaiSheets');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig('./credentials.json');
$service = new Google_Service_Sheets($client);

$spreadsheetIDMain = "1gT6VKB_h7NfE4ms_7sgxHj1bl5Xvegg0OmnQEMZQWcc";
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="./css/styles.css">
  <link rel="stylesheet" href="./css/index.css" type="text/css">
  <title>Transparencia ante la contingencia</title>
</head>

<body>

  <!-- Image and text -->
  <nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="#">
      <img src="https://cotai.org.mx/wp-content/uploads/2020/02/COTAI_OK_alta_beta.png" alt="img nav">
      Transparencia ante la Contingencia
    </a>
  </nav>

  <!--BEGIN: Main-->
  <main>
    <!--Jumbotron Información General-->
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-3">Información General</h1>
        <div class="row">
          <div class="col-5">
            <!--BEGIN: Chart-->
            <img src="https://cotai.org.mx/wp-content/uploads/2020/02/COTAI_OK_alta_beta.png" class="card-img-top" alt="...">
            <!--END: Chart-->
          </div>
            <div class="col-4">
              <h2>Presupuesto</h2>
              <p class="lead">
                <?php
                  $range = "Entes!K3";

                  $response = $service->spreadsheets_values->get($spreadsheetIDMain, $range);
                  $suma = 0;

                  $values = $response->getValues();
                  if(empty($values)){
                    print "No data found.\n";
                  }else{
                    foreach ($values as $row) {
                      echo $row[0];
                    }
                  }

                 ?>
              </p>
              <h2>Procedimientos</h2>
              <p class="lead">
                <?php
                  $range = "Entes!K4";

                  $response = $service->spreadsheets_values->get($spreadsheetIDMain, $range);
                  $suma = 0;

                  $values = $response->getValues();
                  if(empty($values)){
                    print "No data found.\n";
                  }else{
                    foreach ($values as $row) {
                      echo $row[0];
                    }
                  }

                 ?>
              </p>
            </div>
            <div class="col-3">
              <h2>Pagos</h2>
              <p class="lead">
                <?php
                  $range = "Entes!K3";

                  $response = $service->spreadsheets_values->get($spreadsheetIDMain, $range);
                  $suma = 0;

                  $values = $response->getValues();
                  if(empty($values)){
                    print "No data found.\n";
                  }else{
                    foreach ($values as $row) {
                      echo $row[0];
                    }
                  }

                 ?>
              </p>
              <h2>Entes Participantes</h2>
              <p class="lead">
                <?php
                  $range = "Entes!K5";

                  $response = $service->spreadsheets_values->get($spreadsheetIDMain, $range);
                  $suma = 0;

                  $values = $response->getValues();
                  if(empty($values)){
                    print "No data found.\n";
                  }else{
                    foreach ($values as $row) {
                      echo $row[0];
                    }
                  }

                 ?>
              </p>
            </div>

          </div>
        </div>
      </div>
    </div>
    <!--Contenedor de Entes-->
    <div class="container">
      <!--BEGIN: Municipios-->
      <h2 class="subtitle">Municipios</h2>
      <!--Cards-->
      <div class="row">
          <?php
          $range = "Entes!A2:H";

          $response = $service->spreadsheets_values->get($spreadsheetIDMain, $range);

          $values = $response->getValues();
          if(empty($values)){
            print "No data found.\n";
          }else{
            foreach ($values as $row) {
              if($row[2] === "Municipal"){
                echo
                "<div class='col-lg-4'>
                  <div class='flip text-center'>
                    <div class='front' style='background-image: url($row[6])'>
                       <div class='layer'>

                       </div>
                    </div>
                    <div class='back' >
                       <div class='white-layer'>
                         <h2 class='heading'>$row[1]</h2>
                         <p class='principal'>Presupuesto: $row[3].</p>
                         <p class='principal'>Procedimientos: $row[5].</p>
                         <p class='principal'>Pagos: $row[4].</p>
                         <form class='' action='ente.php' method='post'>
                           <input type='hidden' name='id' value='$row[0]' />
                           <input type='hidden' name='vinculo' value='$row[7]' />
                           <input class='btn btn-success' type='submit' name='enviar' value='Más información' />
                         </form>
                       </div>
                    </div>
                  </div>
                </div>";
              }
            }
          }
           ?>
</div>
      <!--END: Municipios-->

      <!--BEGIN: Organizaciones gubernamentales-->
      <h2 class="subtitle second">Organizaciones gubernamentales</h2>
      <!--Cards-->
      <div class="row">

        <?php
        $range = "Entes!A2:H";

        $response = $service->spreadsheets_values->get($spreadsheetIDMain, $range);

        $values = $response->getValues();
        if(empty($values)){
          print "No data found.\n";
        }else{
          foreach ($values as $row) {
            if($row[2] === "Gubernamental"){
              echo
              "<div class='col-lg-4'>
                <div class='flip text-center'>
                  <div class='front' style='background-image: url($row[6])'>
                     <div class='layer'>

                     </div>
                  </div>
                  <div class='back' >
                     <div class='white-layer'>
                       <h2 class='heading'>$row[1]</h2>
                       <p class='principal'>Presupuesto: $row[3].</p>
                       <p class='principal'>Procedimientos: $row[5].</p>
                       <p class='principal'>Pagos: $row[4].</p>
                       <form class='' action='ente.php' method='post'>
                         <input type='hidden' name='id' value='$row[0]' />
                         <input type='hidden' name='vinculo' value='$row[7]' />
                         <input class='btn btn-success' type='submit' name='enviar' value='Más información' />
                       </form>
                     </div>
                  </div>
                </div>
              </div>";
            }
          }
        }
         ?>
       </div>
</div>

  </main>
  <!--END: Main-->

  <footer>
    <div class="container">
      <div class="row">
        <div class="col-4">
          <img src="https://cotai.org.mx/wp-content/uploads/2019/12/COTAI_OK_blanco_beta-2048x1583.png" alt="img footr">
        </div>
        <div class="col-4">
          <div class="container">
            <h3>Síguenos</h3>
              <ul>
                <li><a href="">Facebook</a></li>
                <li><a href="">Youtube</a></li>
                <li><a href="">Twitter</a></li>
                <li><a href="">Instagram</a></li>
              </ul>
          </div>
        </div>
        <div class="col-4">
          <div class="container">
            <h3>Visítanos</h3>
            <div class="horario">
              <p>Lunes a Viernes
              <p>9:00 AM - 5:00 PM
            </div>
            <div class="direccion">
              <p>Av. Constitución 1465-1 Centro
              <p>Monterrey, Nuevo León, México
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>



  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>

</html>
