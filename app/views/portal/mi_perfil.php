<?php
  //Instancia de la session
  session_start();

  if(!isset($_SESSION["is_logged"]) || ($_SESSION["is_logged"] == true)){
    //retorna al dashboard
    if(isset($_SESSION["id_rol"])){
      if($_SESSION["id_rol"] == 128 || $_SESSION["id_rol"] == 85){
        header('Location: ../panel/dashboard.php');
        exit();
      }//end if id_rol
    }//end if isset
  }//end 
  else{
    session_destroy();
  }//end else

  print_r($_SESSION);
?>

<a href="<?= (isset($_SESSION['is_logged'])) ? '../../backend/panel/liberate_user.php' :  '../usuario/login.php' ?>"><?= (isset($_SESSION['is_logged'])) ? 'Logout' :  'Login' ?></a>