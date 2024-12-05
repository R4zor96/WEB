<?php
//TUPU
//Instancia de la session
session_start();

if (!isset($_SESSION["is_logged"]) || ($_SESSION["is_logged"] == true)) {
  //retorna al dashboard
  if (isset($_SESSION["id_rol"])) {
    if ($_SESSION["id_rol"] == 128 || $_SESSION["id_rol"] == 85) {
      header('Location: ../panel/dashboard.php');
      exit();
    }//end if id_rol
  }//end if isset
}//end 
else {
  session_destroy();
}//end else
?>

Aquí tendran que colocar su página principal donde hablan sobre el sistema de mtvaward
Para ello, se solicita que deben contener lo siguiente
<ul>
  <li>Inicio</li>
  <li>Información del evento (información libre)</li>
  <li>Generos</li>
  <li>Artista</li>
  <li><a href="./app/views/portal/mi_perfil.php">Mi perfil</a></li>
  <li>Votar (Se muestra cuando esta inciiado la asesión)</li>
  <li><a
      href="<?= (isset($_SESSION['is_logged'])) ? './app/backend/panel/liberate_user.php' : './app/views/usuario/login.php' ?>"><?= (isset($_SESSION['is_logged'])) ? 'Logout' : 'Login' ?></a>
  </li>
  <ul>
    <!-- * Inicio
* Información sobre el evento
* Generos
  Mostrar todos los generos disponibles y habilitados
  - Al seleccionar deben de mostrar los detalles del genero
  Artistas que pertenezcan al genero
    - Cuando se vea los detalles pueden visualizar información del artista 
    - Visualizar los albunes dispoibles
      * Cuando se de clic en detalles del album su debe de visualizar las canciones disponibles
* Artistas
* Votar 
  Aqui tienen que realizar una clasificacion de los votos ya sean por album o por artista y deben de mostrar el count de ello
* Login
  Aqui debe de estar la opción de redireccioanmiento del login, recordando si es un administrador o artista se redirecciona al panel administrable en caso contrario al portal -->