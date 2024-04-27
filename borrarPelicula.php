<?php
require_once("loader.php");

if ($_GET['id']) {
    $movie = $consulta->detallePelicula($bd, 'movies', 'genres', $_GET['id']);

    if (!$movie) {
        // Manejar el caso en el que la película no existe
        echo "La película no existe.";
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Eliminar primero las relaciones de la tabla actor_movie modificado
        try {
            $consulta->eliminarRelacionesActores($bd, 'actor_movie', $_GET['id']);
        } catch (PDOException $e) {
            echo "Error al eliminar las relaciones de actores: " . $e->getMessage();
            exit;
        }

        // Después de eliminar las relaciones, eliminar la película modificado
        try {
            $consulta->borrarPelicula($bd, 'movies', $_GET['id']);
            header('Location: index.php');
            exit;
        } catch (PDOException $e) {
            echo "Error al intentar eliminar la película: " . $e->getMessage();
            exit;
        }
    }
} else {
    // Manejar el caso en el que no se proporciona un ID válido
    echo "ID de película no proporcionado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Eliminar Película</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/master.css">
</head>
<body>

<?php require 'partials/header.php' ?>
<?php require 'partials/navbar.php' ?>
<div class="spacer"></div>
<h2 class="text-center">Eliminar Película</h2>
<div class="row mt-5">
    <div class="col-lg-8 offset-lg-2">
        <p>¿Estás seguro de que deseas eliminar la película <strong><?= $movie['title']; ?></strong>?</p>
        <form action="" method="post">
            <button type="submit" class="btn btn-danger">Eliminar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/7968cc1663.js" crossorigin="anonymous"></script>
</body>
</html>
