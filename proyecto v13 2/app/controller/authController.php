<?php
// app/controllers/AuthController.php


class AuthController {
    private $userModel;

  
    public function __construct(Database $db) {
      
        $this->userModel = new UserModel($db);
    }

    public function procesarLogin() {
        session_start(); 

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
 
            $identificador = $_POST["email_usuario"] ?? $_POST["cedula_usuario"]; 
            $clave_usuario = $_POST["clave_usuario"];

     
            $usuario = $this->userModel->verificarCredenciales($identificador, $clave_usuario);

            if ($usuario) {

                $_SESSION['id_usuario'] = $usuario['id_usuario'];
                header("Location: view/comunitario.php"); 
                exit;
            } else {
       
                echo "Usuario no encontrado o contraseña incorrecta."; 
            }
        }
    }
}