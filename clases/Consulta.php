<?php
class Consulta {
    // Método para listar todas las películas
    public function listarPeliculas($bd, $movies){
        $sql = "SELECT * FROM $movies";
        $query = $bd->prepare($sql);
        $query->execute();
        $peliculas = $query->fetchAll(PDO::FETCH_ASSOC);
        return $peliculas;
    }
    // Método para listar los géneros
    public function listarGeneros($bd, $genres){
        $sql = "SELECT * FROM $genres";
        $query = $bd->prepare($sql);
        $query->execute();
        $generos = $query->fetchAll(PDO::FETCH_ASSOC);
        return $generos;
    }
    // Método para agregar una nueva película
    public function guardarPelicula($bd, $movies, $pelicula){
        $sql = "INSERT INTO $movies (title, rating, awards, release_date, length, genre_id) VALUES (:title, :rating, :awards, :release_date, :length, :genre_id)";
        $query = $bd->prepare($sql);
        $query->bindValue(':title', $pelicula->getTitle());
        $query->bindValue(':rating', $pelicula->getRating());
        $query->bindValue(':awards', $pelicula->getAwards());
        $query->bindValue(':release_date', $pelicula->getReleaseDate());
        $query->bindValue(':length', $pelicula->getLength());
        $query->bindValue(':genre_id', $pelicula->getGenre());
        $query->execute();
        header('Location: index.php');
    }
    // Método para mostrar el detalle de una película
    public function detallePelicula($bd, $movies, $genres, $id){
        $sql = "SELECT $movies.*, $genres.name FROM $movies, $genres WHERE $movies.genre_id = $genres.id AND $movies.id = :id";
        $query = $bd->prepare($sql);
        $query->bindParam(':id', $id);
        $query->execute();
        $pelicula = $query->fetch(PDO::FETCH_ASSOC);
        return $pelicula;
    }
    // Método para buscar películas
    public function buscarPelicula($bd, $tabla, $busqueda){
        $sql = "SELECT * FROM $tabla WHERE title LIKE :busqueda";
        $query = $bd->prepare($sql);
        $query->bindValue(':busqueda', "%".$busqueda."%");
        $query->execute();
        $peliculas = $query->fetchAll(PDO::FETCH_ASSOC);
        return $peliculas;
    }

    // Método para borrar una película y sus relaciones
    public function borrarPelicula($bd, $movies, $id_pelicula){
        try {
            // Eliminar las relaciones de la tabla actor_movie para esta película
            $stmt = $bd->prepare("DELETE FROM actor_movie WHERE movie_id = :id_pelicula");
            $stmt->bindParam(':id_pelicula', $id_pelicula);
            $stmt->execute();

            // Después de eliminar las relaciones, eliminar la película
            $stmt = $bd->prepare("DELETE FROM $movies WHERE id = :id_pelicula");
            $stmt->bindParam(':id_pelicula', $id_pelicula);
            $stmt->execute();
            header('Location: index.php');
        } catch(PDOException $e) {
            echo "Error al intentar eliminar la película: " . $e->getMessage();
        }
    }

    // Método para actualizar una película
    public function actualizarPelicula($bd, $movies, $pelicula, $id){
        $sql = "UPDATE $movies SET title = :title, rating = :rating, awards = :awards, release_date = :release_date, length = :length, genre_id = :genre_id WHERE id = :id";
        $query = $bd->prepare($sql);
        $query->bindValue(':title', $pelicula->getTitle());
        $query->bindValue(':rating', $pelicula->getRating());
        $query->bindValue(':awards', $pelicula->getAwards());
        $query->bindValue(':release_date', $pelicula->getReleaseDate());
        $query->bindValue(':length', $pelicula->getLength());
        $query->bindValue(':genre_id', $pelicula->getGenre());
        $query->bindValue(':id', $id);
        $query->execute();
        header('Location: index.php');
    }

    // Método para eliminar las relaciones de actores antes de eliminar una película
    public function eliminarRelacionesActores($bd, $id_pelicula) {
        try {
            $stmt = $bd->prepare("DELETE FROM actor_movie WHERE movie_id = :id_pelicula");
            $stmt->bindParam(':id_pelicula', $id_pelicula);
            $stmt->execute();
        } catch(PDOException $e) {
            echo "Error al eliminar las relaciones de actores: " . $e->getMessage();
        }
    }
}
?>
