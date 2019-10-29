<?php

  include 'FootballData.php';

  $api = new FootballData();

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Sergio González Ruano - API - football-data.org</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet"
    type="text/css">

  <!-- Custom styles for this template -->
  <link href="css/landing-page.min.css" rel="stylesheet">

</head>

<body>

  <!-- Masthead -->
  <header class="masthead text-white text-center">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-xl-9 mx-auto">
          <h1 class="mb-5">Desarrollo Api - Liga BBVA - Mostrar jugadores por equipo</h1>
        </div>
        <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
          <div class="form-inline d-flex justify-content-around">
            <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="mostrar">
              <select class="form-control form-control-sm id=" equipo" name="equipo">
                <option value="" selected="selected">Seleccione un equipo</option>

                <?php 
                    foreach ($api->findStandingsByCompetition(2014)->standings as $standing) { 
                        if ($standing->type == 'TOTAL') { 
                            foreach ($standing->table as $standingRow) { ?>

                <option value="<?php echo $standingRow->team->id; ?>"><?php echo $standingRow->team->name; ?>
                </option>
                <?php }}}  ?>

                <input class="btn btn-primary" type="submit" value="Buscar">

              </select>
            </form>
          </div>
        </div>
      </div>
    </div>
  </header>


  <section class="features-icons bg-light text-center">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <?php      
            
            $mensaje = '';
            
            if(!empty($_GET['equipo'])){
    
              $id = $_GET['equipo'];
              $team = $api->findTeamById($id);
    
              echo "<h3>Jugadores del ".$team->name."</h3>"; ?>

                <table class="table table-sm">
                  <tr>
                    <th>Nombre</th>
                    <th>Posición</th>
                    <th>Dorsal</th>
                    <th>Fecha de nacimiento</th>
                  </tr>

              <?php foreach ($team->squad as $player) { 
                    echo "<tr>
                            <td>".$player->name."</td>
                            <td>".$player->position."</td>                    
                            <td>".$player->shirtNumber."</td>
                            <td>".$player->dateOfBirth."</td>
                         </td>";
                    }

                }if(empty($_GET['equipo'])){

                    $mensaje = 'No has seleccionado ningun equipo';
                }
        ?>

          </table>

          <div class="container">
            <div class="row d-felx justify-content-center">

              <?php if(!empty($mensaje)): ?>

              <div class="alert alert-danger" role="alert">
                <?php echo $mensaje; ?>
              </div>

              <?php endif; ?>

            </div>
          </div>

        </div>
      </div>
    </div>
  </section>


  <footer class="footer bg-light" style="bottom:0;">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
          <p class="text-muted small mb-4 mb-lg-0">&copy; Sergio González Ruano @2019 - Api Liga BBVA. All Rights
            Reserved.</p>
        </div>
        <div class="col-lg-6 h-100 text-center text-lg-right my-auto">
          <ul class="list-inline mb-0">
            <li class="list-inline-item mr-3">
              <a href="https://www.linkedin.com/in/sergio-gonz%C3%A1lez-ruano/" target="blank">
                <i class="fab fa-linkedin fa-2x fa-fw"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="https://github.com/sergio-gonzalez11" target="blank">
                <i class="fab fa-github fa-2x fa-fw"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
