<?php
       echo 'Validating...';

    //Importar libreria modelo
    require_once '../../models/Tabla_usuarios.php';

    //Inciar la sesion
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $data = array();

        //Instancia del modelo
        $tabla_usuario = new Tabla_usuarios();

        if( isset($_POST["password"]) && isset($_POST["repassword"])){
            $pass = $_POST["password"];
            $repass = $_POST["repassword"];
            if($pass != $repass){
                $_SESSION['message'] = array(
                                "type" => "error", 
                                "description" => "La contraseñas no son iguales ...",
                                "title" => "¡ERROR!"
                            );

                header('Location: ../../views/panel/perfil.php');
                exit();
            }//end if
            else{
                if(!empty($pass) && (!empty($repass))){
                    $data['password_usuario'] = $pass;

                    print_r($data);
                    //STAMENT QUERY - UPDATE
                    if($tabla_usuario->updateUser($_SESSION["id_usuario"], $data)){
                        $_SESSION['message'] = array(
                                        "type" => "success", 
                                        "description" => "El usuario ha actualizado de manera correcta su contraseña...",
                                        "title" => "¡Edición Éxitosa!"
                                    );
                        header('Location: ../../views/panel/perfil.php');
                        exit();
                    }//end if
                    else{
                        $_SESSION['message'] = array(
                                        "type" => "warning", 
                                        "description" => "Error al intentar actualizar la contraseña...",
                                        "title" => "¡Ocurrio Error!"
                                    );
                        header('Location: ../../views/panel/perfil.php');
                        exit();
                    }//end else
                }
                else{
                    $_SESSION['message'] = array(
                                        "type" => "warning", 
                                        "description" => "Error al intentar actualizar la contraseña...",
                                        "title" => "¡Ocurrio Error!"
                                    );
                        header('Location: ../../views/panel/perfil.php');
                        exit();
                }
            }//end else
        }//end if
        else{
            $_SESSION['message'] = array(
                                "type" => "error", 
                                "description" => "Ocurrio un error al procesar la información...",
                                "title" => "¡ERROR!"
                            );

            header('Location: ../../views/panel/perfil.php');
            exit();
        }//end else
    }//end REQUEST_METHOD
    else {
        $_SESSION['message'] = array(
                                "type" => "error", 
                                "description" => "Ocurrio un error al procesar la información...",
                                "title" => "¡ERROR!"
                            );

        header('Location: ../../views/panel/perfil.php');
        exit();
    }//end else 
