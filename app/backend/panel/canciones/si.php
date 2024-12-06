<?php
echo 'Validating...';

// Importar librerías
require_once '../../../models/Tabla_canciones.php';
require_once '../../../models/Tabla_artista.php'; // Para manejar la relación usuarios-artistas


// Iniciar la sesión
session_start();

$tabla_cancion = new Tabla_canciones();
    $tabla_artista = new Tabla_artista();

    // Obtener id_artista relacionado con el usuario actual
    $id_usuario = $_SESSION['id_usuario'];
    
$artista = $tabla_artista->getArtistaByUsuario($id_usuario);
    if (!$artista) {
        echo "No se encontró un artista relacionado con este usuario.";
        exit();
    }
    echo "<pre>";
    print_r($artista);
    echo "</pre>";