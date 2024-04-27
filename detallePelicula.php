<?php
require_once('loader.php');

// Obtener el ID de la película seleccionada
$id_pelicula = $_GET['id'];

// Obtener los detalles de la película seleccionada
$pelicula = $consulta->detallePelicula($bd, 'movies', 'genres', $id_pelicula);

// Definir un array asociativo que mapee el ID de la película con el nombre de la imagen modificado 
$imagenes = array(
    1 => "Avatar.jpg",
    2 => "Titanic.jpeg",
    3 => "La Guerra de las galaxias: Episodio VI.jpg",
    4 => "La Guerra de las galaxias: Episodio VII.jpeg",
    5 => "Parque Jurasico.jpg",
    6 => "Harry Potter y las Reliquias de la Muerte - Parte 2.jpg",
    7 => "Transformers: el lado oscuro de la luna.jpeg",
    8 => "Harry Potter y la piedra filosofal.jpg",
    9 => "Harry Potter y la cámara de los secretos.jpeg",
    10 => "El rey león.jpeg",
    11 => "Alicia en el país de las maravillas.jpg",
    12 => "Buscando a Nemo.jpg",
    13 => "Toy Story.jpg",
    14 => "Toy Story 2.jpg",
    15 => "La vida es bella.jpeg",
    16 => "Mi pobre angelito.jpeg",
    17 => "Intensamente.jpeg",
    18 => "Carrozas de fuego.jpg",
    19 => "Big.jpg",
    20 => "I am Sam.jpg",
    21 => "Hotel Transylvania.jpeg",
    // Agrega más películas con sus respectivas imágenes si es necesario
);

// Obtener el nombre de la imagen de la película seleccionada
$imagen_pelicula = $imagenes[$id_pelicula];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $pelicula['title'] ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/master.css">
</head>
<body>
    <?php require 'partials/header.php' ?>
    <?php require 'partials/navbar.php' ?>
    <div class="spacer"></div>
    <h2 class="text-center">Detalle de la Película</h2>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <img class="card-img-top" src="images/<?= $imagen_pelicula ?>" alt="<?= $pelicula['title'] ?>">
                    <div class="card-body">
                        <h5 class="card-title text-center"><?= $pelicula['title'] ?></h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Calificación:</strong> <?= $pelicula['rating'] ?></li>
                            <li class="list-group-item"><strong>Premios:</strong> <?= $pelicula['awards'] ?></li>
                            <li class="list-group-item"><strong>Fecha de Creación:</strong> <?= date('d-m-Y', strtotime($pelicula['release_date'])) ?></li>
                            <li class="list-group-item"><strong>Duración:</strong> <?= $pelicula['length'] ?></li>
                            <li class="list-group-item"><strong>Género:</strong> <?= $pelicula['name'] ?></li>
                        </ul>
                    </div>
                </div>
                <div class="mt-3 text-center">
                    <a href="index.php" class="btn btn-danger">Volver</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>

