<?php
    require_once('loader.php');
    if($_POST){
        // Obtener los datos del formulario agregue
        $titulo = $_POST['title'];
        $rating = $_POST['rating'];
        $awards = $_POST['awards'];
        $fecha_lanzamiento = $_POST['release_date'];
        $duracion = $_POST['length'];
        $genero_id = $_POST['genre_id'];
        $imagen = $_FILES['imagen']['name']; // Nombre de la imagen subida
        $descripcion = $_POST['descripcion'];

        // Guardar la imagen en el servidor
        $ruta_imagen = 'images/' . $imagen;
        move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_imagen);

        // Crear una nueva película con los datos proporcionados
        $pelicula = new Pelicula($titulo, $rating, $awards, $fecha_lanzamiento, $duracion, $genero_id, $ruta_imagen, $descripcion);
        
        // Validar la película
        $errores = $validar->ValidadorPelicula($pelicula);
        
        // Si no hay errores, guardar la película en la base de datos
        if (count($errores) == 0){
            $consulta->guardarPelicula($bd, 'movies', $pelicula);
        }
    }

    // Obtener la lista de géneros
    $generos = $consulta->listarGeneros($bd, 'genres');
?>
<!DOCTYPE html>
<html lang="es">
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Registro de Peliculas - Daniel</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="css/master.css">

    </head>
    <body>

        <?php require 'partials/header.php' ?>
        <?php require 'partials/navbar.php' ?>
        <div class="spacer"></div>
        <h2 class="text-center">Agregar Película</h2>
       <div class="row mt-5">
            <div class="col-lg-8 offset-lg-2">
                <?php if(isset($errores)):?>
                    <ul class="alert alert-danger">
                        <?php foreach ($errores as  $error) :?>
                            <li><?=$error ;?></li>
                        <?php endforeach;?>
                    </ul>
                <?php endif; ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nombrePelicula">Nombre</label>
                        <input type="text" class="form-control" name="title" id="nombrePelicula">
                    </div>
                    <div class="form-group">
                        <label for="ratingPelicula">Rating</label>
                        <input type="number" class="form-control" name="rating" id="ratingPelicula">
                    </div>
                    <div class="form-group">
                        <label for="awards">Awards</label>
                        <input type="number" class="form-control" name="awards" id="awards">
                    </div>
                    <div class="form-group">
                        <label for="release-date">Release Date</label>
                        <input type="date" class="form-control" name="release_date" id="release-date">
                    </div>
                    <div class="form-group">
                        <label for="duracionPelicula">Duración</label>
                        <input type="number" class="form-control" name="length" id="duracionPelicula">
                    </div>
                    <div class="form-group">
                        <label for="imagenPelicula">Imagen</label>
                        <input type="file" class="form-control-file" name="imagen" id="imagenPelicula">
                    </div>
                    <div class="form-group">
                        <label for="generos">Género de la Película</label>
                        <select class="form-control" name="genre_id" id="generos">
                            <option value="#" disabled>Seleccione género...</option>
                            <?php foreach ($generos as $key => $value) :?>
                                <option value="<?=$value['id'];?>"><?=$value['name'];?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="descripcionPelicula">Descripción</label>
                        <textarea class="form-control" name="descripcion" id="descripcionPelicula" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar Película</button>
                </form>
                <a href="index.php" class="btn btn-danger">Volver</a>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    </body>
</html>
