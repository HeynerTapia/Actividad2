<?php
  require_once('loader.php');

  // Controlar si se debe listar las películas en función de la búsqueda del usuario o simplemente cuando carga la página
  if ($_GET && !empty(trim($_GET['busqueda']))) {
    $peliculas = $consulta->buscarPelicula($bd, 'movies', $_GET['busqueda']);
  } else {
    $peliculas = $consulta->listarPeliculas($bd, 'movies');
  }  
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Películas</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/master.css">
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
</head>
<body>
    <?php require 'partials/header.php' ?>
    <?php require 'partials/navbar.php' ?>
    <div class="spacer"></div>
    <div class="container">
        <h2 class="text-center text-primary">¡Listado de Películas!</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="" method="get" class="form-inline justify-content-center">
                    <input type="text" name="busqueda" class="form-control mr-sm-2" placeholder="Buscar película">
                    <button class="btn btn-primary" type="submit">Buscar</button>
                </form>
            </div>
        </div>
    </div>
    <div class="spacer"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Ver</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($peliculas as $pelicula) : ?>
                            <tr>
                                <td><?= $pelicula['id']; ?></td>
                                <td><?= $pelicula['title']; ?></td>
                                <td><a href="detallePelicula.php?id=<?= $pelicula['id']; ?>"><ion-icon name="eye" class="ver-icon"></ion-icon></a></td>
                                <td><a href="editarPelicula.php?id=<?= $pelicula['id']; ?>"><ion-icon name="create" class="editar-icon"></ion-icon></a></td>
                                <td><a href="borrarPelicula.php?id=<?= $pelicula['id']; ?>"><ion-icon name="trash" class="eliminar-icon"></ion-icon></a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
