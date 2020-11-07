<?php

require './vendor/autoload.php';

$client = new \Google_Client();
$client->setApplicationName('CotaiSheets');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig('./credentials.json');
$service = new Google_Service_Sheets($client);

$spreadsheetIDMain = "1gT6VKB_h7NfE4ms_7sgxHj1bl5Xvegg0OmnQEMZQWcc";
$id = $_POST['id'];
$vinculo = $_POST['vinculo'];

$spreadsheetID = $vinculo;

$range = "Entes!A2:H";

$response = $service->spreadsheets_values->get($spreadsheetIDMain, $range);

$values = $response->getValues();
if(empty($values)){
  print "No data found.\n";
}else{
  foreach ($values as $row) {
  /*  switch($row[0]){
      case 0: $spreadsheetID = "1QJ7L6ipPWLLjaEdJSIHYUPNRCb7Kg_qN6ku8owJf65I";
        break;
      case 1: $spreadsheetID = "";
        break;
      case 2: $spreadsheetID = "";
        break;
      case 3: $spreadsheetID = "";
        break;
      case 4: $spreadsheetID = "";
        break;
      case 5: $spreadsheetID = "";
        break;
      case 6: $spreadsheetID = "";
        break;
      case 7: $spreadsheetID = "";
        break;
      case 8: $spreadsheetID = "";
        break;
      case 9: $spreadsheetID = "";
        break;
      case 10: $spreadsheetID = "";
        break;
      case 11: $spreadsheetID = "";
        break;
      case 12: $spreadsheetID = "";
        break;
      case 13: $spreadsheetID = "";
        break;
      case 14: $spreadsheetID = "";
        break;
      case 15: $spreadsheetID = "";
        break;
      case 16: $spreadsheetID = "";
        break;
      case 17: $spreadsheetID = "";
        break;
      case 18: $spreadsheetID = "";
        break;
      case 19: $spreadsheetID = "";
        break;
    } */
    if($id == $row[0]){
      $nombre = $row[1];
      $imagen = $row[6];
    }
  }
}



?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="css/chart.css" type="text/css">
    <link rel="stylesheet" href="css/ente.css" type="text/css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
  <title>Ente</title>

</head>

<body>

  <!-- Image and text -->
  <nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="index.php">
      <img src="https://cotai.org.mx/wp-content/uploads/2020/02/COTAI_OK_alta_beta.png" alt="img nav">
      Transparencia ante la Contingencia
    </a>
  </nav>

  <!--BEGIN: Main-->
  <main>
    <!--Jumbotron datos generales Ente-->
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <div class="row">
          <div class="col-md-5 text-center">
            <h1 class="display-3"><?php echo $nombre; ?></h1>
          </div>
        </div>
        <div class="row">
          <div class="col-md-5 text-center">
            <!--BEGIN: Chart-->
            <img src="<?php echo $imagen ?>" width="75%" alt="">
            <!--END: Chart-->
          </div>
            <div class="col-md-4">
              <h2>Presupuesto</h2>
              <p class="lead">$
                <?php
                  $range = "Presupuesto!G2";

                  $response = $service->spreadsheets_values->get($spreadsheetID, $range);
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
                $range = "Reporte!E3:E";

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

                 ?>
              </p>
            </div>
            <div class="col-md-3">
              <h2>Pagos</h2>
              <p class="lead">$
                <?php
                  $range = "Pagos!K2";

                  $response = $service->spreadsheets_values->get($spreadsheetID, $range);
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

    <div class="container">

      <h1>Proyectos de la entidad de <?php echo $nombre; ?></h1>
      <p class="simple">En la siguiente sección se encontrará la información individual de cada proyecto realizado por esta institución pública para hacer frente a la contingencia sanitaria.
Cada proyecto incluye un resumen de las seis etapas del proceso de contratación, mostrando información relevante. Si se desea visualizar la información completa .</p>

      <div class="accordion" id="accordionExample">

        <?php

        $range = "Reporte!A3:BP";
        $response = $service->spreadsheets_values->get($spreadsheetID, $range);
        $range2 = "Pagos!A2:G";

        $response2 = $service->spreadsheets_values->get($spreadsheetID, $range2);

        $values2 = $response2->getValues();

        $values = $response->getValues();
        if(empty($values)){
          print "No data found.\n";
        }else{
          $mask = "%10s %-10s %s\n";
          foreach ($values as $row) {

            //Proveedor
            $stringProvedor = " ";

            if($row[19] != 'No Dato'){
              $stringProvedor .= $row[19];
            }
            if($row[20] != 'No Dato'){
              $stringProvedor .= $row[20];
            }
            if($row[21] != 'No Dato'){
              $stringProvedor .= $row[21];
            }
            if($row[22] != 'No Dato'){
              $stringProvedor .= $row[22];
            }

            //Monto de pago
            $montoPago = 0;

            if(empty($values2)){
              print 'No data found.\n';
            }else{
              foreach ($values2 as $row2) {
                if($row[55] == $row2[0]){
                  $montoPago = $row2[4];
                }
              }
            }

            //FISCALIZACIÓN
            if($row[59] == "No Dato"){
              $fechaContrato = "Fiscalización en el periodo que se informa no
               se han realizado auditorias por la Contraloria y
               Tranparencia Municipal, ya que se realizará
               auditorias conforme al Reglamento Organico de la
               Administración Publica Municipal de Apodaca, Nuevo
               León.";
            }else{
              $fechaContrato = $row[59];
            }
            if($row[60] == "No Dato"){
              $montoSin = "Fiscalización en el periodo que se informa no
               se han realizado auditorias por la Contraloria y
               Tranparencia Municipal, ya que se realizará
               auditorias conforme al Reglamento Organico de la
               Administración Publica Municipal de Apodaca, Nuevo
               León.";
            }else{
              $montoSin = $row[60];
            }
            if($row[61] == "No Dato"){
              $montoImpuestos = "Fiscalización en el periodo que se informa no
               se han realizado auditorias por la Contraloria y
               Tranparencia Municipal, ya que se realizará
               auditorias conforme al Reglamento Organico de la
               Administración Publica Municipal de Apodaca, Nuevo
               León.";
            }else{
              $montoImpuestos = $row[61];
            }

            if($row[62] == "No Dato"){
              $objetivoAuditoria = "Fiscalización en el periodo que se informa no
               se han realizado auditorias por la Contraloria y
               Tranparencia Municipal, ya que se realizará
               auditorias conforme al Reglamento Organico de la
               Administración Publica Municipal de Apodaca, Nuevo
               León.";
            }else{
              $objetivoAuditoria = $row[62];
            }


            if($row[63] == "No Dato"){
              $objetoContrato = "Fiscalización en el periodo que se informa no
               se han realizado auditorias por la Contraloria y
               Tranparencia Municipal, ya que se realizará
               auditorias conforme al Reglamento Organico de la
               Administración Publica Municipal de Apodaca, Nuevo
               León.";
            }else{
              $objetoContrato = $row[63];
            }

            echo "<!--Procedimiento $row[0]-->
            <div class='card'>
              <div class='card-header' id='heading$row[0]'>
                <h2 class='mb-0'>
                  <button class='btn btn-link btn-block text-left' type='button' data-toggle='collapse' data-target='#collapse$row[0]' aria-expanded='true' aria-controls='collapseOne'>
                    Procedimiento $row[0] | $row[4]
                  </button>
                </h2>
              </div>
              <div id='collapse$row[0]' class='collapse' aria-labelledby='headingOne' data-parent='#accordionExample'>
                <div class='card-body'>
                  <!--BEGIN: ListGroup Planeación-->
                  <h3 class='heading' class='heading'> Planeación</h3>
                  <div class='list-group'>
                    <a  class='list-group-item list-group-item-action'>
                      <div class='d-flex w-100 justify-content-between'>
                        <h5 class='mb-1'>Justificación del proyecto</h5>
                      </div>
                      <p class='mb-1'> $row[5] </p>
                    </a>
                    <a  class='list-group-item list-group-item-action'>
                      <div class='d-flex w-100 justify-content-between'>
                        <h5 class='mb-1'>Fuente de financiamiento</h5>
                      </div>
                      <p class='mb-1'>$row[6].</p>
                    </a>
                    <a  class='list-group-item list-group-item-action'>
                      <div class='d-flex w-100 justify-content-between'>
                        <h5 class='mb-1'>Origen de los recursos</h5>
                      </div>
                      <p class='mb-1'>$row[7].</p>
                    </a>
                    <a  class='list-group-item list-group-item-action'>
                      <div class='d-flex w-100 justify-content-between'>
                        <h5 class='mb-1'>Población o necesidad que responde a la contratación</h5>
                      </div>
                      <p class='mb-1'>$row[9].</p>
                    </a>
                  </div>
                  <!--END: ListGroup Planeación-->
                  <!--BEGIN: ListGroup Licitación-->
                  <h3 class='heading'> Licitación</h3>
                  <div class='list-group'>
                    <!--BEGIN: GroupItem Tipo -->
                    <a  class='list-group-item list-group-item-action'>
                      <div class='d-flex w-100 justify-content-between'>
                        <h5 class='mb-1'>Tipo de procedimiento de contratación</h5>
                      </div>
                      <p class='mb-1'>$row[11].</p>
                    </a>
                    <!--END: GroupItem Tipo -->
                    <!--BEGIN: GroupItem Descripción -->
                    <a  class='list-group-item list-group-item-action'>
                      <div class='d-flex w-100 justify-content-between'>
                        <h5 class='mb-1'>Descripción de las obras, bienes o servicios a contratar</h5>
                      </div>
                      <p class='mb-1'>$row[15].</p>
                    </a>
                    <!--END: GroupItem Descripción -->
                  </div>
                  <!--END: ListGroup Licitación-->
                  <!--BEGIN: ListGroup Adjudicación-->
                  <h3 class='heading'> Adjudicación</h3>
                  <div class='list-group'>
                    <!--BEGIN: GroupItem Proveedor -->
                    <a  class='list-group-item list-group-item-action'>
                      <div class='d-flex w-100 justify-content-between'>
                        <h5 class='mb-1'>Proveedor</h5>
                      </div>
                      <p class='mb-1'>
                        $stringProvedor
                      </p>
                    </a>
                    <!--END: GroupItem Proveedor -->
                  </div>
                  <!--END: ListGroup Adjudicación-->
                  <!--BEGIN: ListGroup Contratación-->
                  <h3 class='heading'> Contratación</h3>
                  <div class='list-group'>
                    <!--BEGIN: GroupItem Fecha Contrato -->
                    <a  class='list-group-item list-group-item-action'>
                      <div class='d-flex w-100 justify-content-between'>
                        <h5 class='mb-1'>Fecha del contrato</h5>
                      </div>
                      <p class='mb-1'> $row[46].</p>
                    </a>
                    <!--END: GroupItem Fecha Contrato -->
                    <!--BEGIN: GroupItem Monto S/Impuestos -->
                    <a  class='list-group-item list-group-item-action'>
                      <div class='d-flex w-100 justify-content-between'>
                        <h5 class='mb-1'>Monto del contrato sin impuestos</h5>
                      </div>
                      <p class='mb-1'>$row[47].</p>
                    </a>
                    <!--END: GroupItem Monto S/Impuestos -->
                    <!--BEGIN: GroupItem Monto C/Impuestos -->
                    <a  class='list-group-item list-group-item-action'>
                      <div class='d-flex w-100 justify-content-between'>
                        <h5 class='mb-1'>Monto total del contrato con impuestos incluidos</h5>
                      </div>
                      <p class='mb-1'>$row[48].</p>
                    </a>
                    <!--END: GroupItem Monto C/Impuestos -->
                    <!--BEGIN: GroupItem Forma de pago -->
                    <a  class='list-group-item list-group-item-action'>
                      <div class='d-flex w-100 justify-content-between'>
                        <h5 class='mb-1'>Forma de pago</h5>
                      </div>
                      <p class='mb-1'>$row[49]</p>
                    </a>
                    <!--END: GroupItem Forma de pago -->
                    <!--BEGIN: GroupItem Objeto Contrato -->
                    <a  class='list-group-item list-group-item-action'>
                      <div class='d-flex w-100 justify-content-between'>
                        <h5 class='mb-1'>Objeto del contrato</h5>
                      </div>
                      <p class='mb-1'>$row[50].</p>
                    </a>
                    <!--END: GroupItem Objeto Contrato -->
                  </div>
                  <!--END: ListGroup Contratación-->
                  <!--BEGIN: ListGroup Implementación-->
                  <h3 class='heading'> Implementación</h3>
                  <div class='list-group'>
                    <!--BEGIN: GroupItem Monto de pago -->
                    <a  class='list-group-item list-group-item-action'>
                      <div class='d-flex w-100 justify-content-between'>
                        <h5 class='mb-1'>Monto de pago</h5>
                      </div>
                      <p class='mb-1'>
                        $montoPago
                      </p>
                    </a>
                    <!--END: GroupItem Monto de pago -->
                    <!--BEGIN: GroupItem Descripción -->
                    <a  class='list-group-item list-group-item-action'>
                      <div class='d-flex w-100 justify-content-between'>
                        <h5 class='mb-1'>Descripción del destino de las obras, bienes y/o servicios contratados</h5>
                      </div>
                      <p class='mb-1'>$row[57]</p>
                    </a>
                    <!--END: GroupItem Descripción -->
                  </div>
                  <!--END: ListGroup Implementación-->
                  <!--BEGIN: ListGroup Fiscalización-->
                  <h3> Fiscalización</h3>
                  <div class='list-group'>
                    <!--BEGIN: GroupItem Fecha Contrato -->
                    <a  class='list-group-item list-group-item-action'>
                      <div class='d-flex w-100 justify-content-between'>
                        <h5 class='mb-1'>Rubro</h5>
                      </div>
                      <p class='mb-1'>
                      $fechaContrato
                      .</p>
                    </a>
                    <!--END: GroupItem Fecha Contrato -->
                    <!--BEGIN: GroupItem Monto S/Impuestos -->
                    <a  class='list-group-item list-group-item-action'>
                      <div class='d-flex w-100 justify-content-between'>
                        <h5 class='mb-1'>Tipo de auditoría</h5>
                      </div>
                      <p class='mb-1'>
                      $montoSin
                      .</p>
                    </a>
                    <!--END: GroupItem Monto S/Impuestos -->
                    <!--BEGIN: GroupItem Monto C/Impuestos -->
                    <a  class='list-group-item list-group-item-action'>
                      <div class='d-flex w-100 justify-content-between'>
                        <h5 class='mb-1'>Órgano que realizó la auditoría</h5>
                      </div>
                      <p class='mb-1'>
                      $montoImpuestos
                      </p>
                    </a>
                    <!--END: GroupItem Monto C/Impuestos -->
                    <!--BEGIN: GroupItem Forma de pago -->
                    <a  class='list-group-item list-group-item-action'>
                      <div class='d-flex w-100 justify-content-between'>
                        <h5 class='mb-1'>Objetivo de la realización de la auditoría</h5>
                      </div>
                      <p class='mb-1'>
                      $objetivoAuditoria
                      </p>
                    </a>
                    <!--END: GroupItem Forma de pago -->
                    <!--BEGIN: GroupItem Objeto Contrato -->
                    <a href='#' class='list-group-item list-group-item-action'>
                      <div class='d-flex w-100 justify-content-between'>
                        <h5 class='mb-1'>Rubros sujetos a revisión</h5>
                      </div>
                      <p class='mb-1'>
                      $objetoContrato
                      </p>
                    </a>
                    <!--END: GroupItem Objeto Contrato -->
                  </div>
                  <!--END: ListGroup Fiscalización-->
                </div>
              </div>
            </div>";
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
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="js/chart.js"></script>
</body>

</html>
