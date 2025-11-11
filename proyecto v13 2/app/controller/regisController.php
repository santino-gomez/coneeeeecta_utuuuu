<?php 

//////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////

require_once '../../model/userModel.php';
require_once '../../model/db.php';
require_once '../utilities/generacionCodigo.php';
require_once '../../vendor/autoload.php';

//////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////

use SendinBlue\Client\Configuration;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\Model\SendSmtpEmail;
use GuzzleHttp\Client;

//////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////

class regisController {

private const API_KEY = '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';
private const SENDER_MAIL = 'luccapastrana123@gmail.com';
private const SENDER_NAME = 'ConectaUTU';

public function handleRegistro(array $postData) {
    $nombre = $postData["nombre_usuario"];
    $apellido = $postData["apellido_usuario"];
    $email = $postData["email_usuario"];
    $clave_usuario = $postData["clave_usuario"];
    $fecha_nacimiento = $postData["fecha_nacimiento"];
    $cedula = $postData["cedula_usuario"];

    if (!preg_match('/^[0-9]{8}$/', $cedula )) {
        throw new Exception("La cédula es incorrecta");
    }

    $hashed_password = password_hash($clave_usuario, PASSWORD_DEFAULT);

    $database = new Database();
    $userModel = new UserModel($database);

    $user_id = $userModel->insertarUsuario($nombre, $apellido, $email, $hashed_password, $fecha_nacimiento, $cedula);

    if ($user_id === false) {
        throw new Exception("Error al insertar el usuario.");
    }

    $otp_code = generate_otp_code(6);
    $expiration_time = date('Y-m-d H:i:s', time() + 900);

    $userModel->guardarCodigoVerificacion($user_id, $otp_code, $expiration_time);

    // 4. Lógica de Envío de Email con Brevo (NUEVO)
    try {
        $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', self::API_KEY);
        $apiInstance = new TransactionalEmailsApi(new GuzzleHttp\Client(), $config);

        $sendSmtpEmail = new SendSmtpEmail();
        $sendSmtpEmail->setSender(["name" => self::SENDER_NAME, "email" => self::SENDER_MAIL]);
        $sendSmtpEmail->setTo([["email" => $email]]); // Email del usuario registrado
        $sendSmtpEmail->setSubject("Tu Código de Verificación de ConectaUTU");
        
        $htmlContent = "
            <p>Gracias por registrarte en ConectaUTU. Por favor, usa el siguiente código para verificar tu cuenta:</p>
            <h1 style='color: #007bff; font-size: 32px; letter-spacing: 5px;'>{$otp_code}</h1>
            <p>Este código expira en 15 minutos.</p>
        ";
        $sendSmtpEmail->setHtmlContent($htmlContent);
        
        $apiInstance->sendTransacEmail($sendSmtpEmail);

        // 5. Redirección a la Vista de Verificación (FINAL)
        header("Location: ../view/verify_form.php?id_usuario={$user_id}");
        exit();

    } catch (Exception $e) {
        error_log('Error Brevo: ' . $e->getMessage());
        throw new Exception("Registro exitoso, pero falló el envío del email: " . $e->getMessage());
    }
} 

}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
 
    $controller = new regisController();
    
    
    try {
       
        $controller->handleRegistro($_POST);
    } catch (Exception $e) {
      
        header("Location: ../view/registrarse.php?error=" . urlencode($e->getMessage()));
        exit();
    }
} 
?>
