<?php

include 'php/conexion.php';

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email_usuario = $_POST["email_usuario"];
        $clave_usuario = $_POST["clave_usuario"];
        $cedula_usuario = $_POST["cedula_usuario"];

        $sql ="SELECT id_usuario, clave_usuario from usuario where email_usuario = ? OR cedula_usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email_usuario, $cedula_usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashed_password = $row['clave_usuario'];

            if (password_verify($clave_usuario, $hashed_password)) {
                $_SESSION['id_usuario'] = $row['id_usuario'];
                header("Location: comunitario.php");
            } else {
                echo "Algo salió mal, intenta nuevamente.";
            }
        } else { echo "Usuario no encontrado, intenta registrarte.";

        }
    $stmt->close();
    $conn->close();
}

?>