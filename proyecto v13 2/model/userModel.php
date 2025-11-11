<?php
class UserModel {
    private $db;

    public function __construct(Database $db) {
        // Obtiene el objeto de conexión MySQLi de la clase Database
        $this->db = $db->getConection(); 
    }

    public function verificarCredenciales($identificador, $clave_usuario) {
        
        $sql = "SELECT id_usuario, clave_usuario from usuario where email_usuario = ? OR cedula_usuario = ?";
        
        $stmt = $this->db->prepare($sql);
        
        $stmt->bind_param("ss", $identificador, $identificador);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $hashed_password = $row['clave_usuario'];
            
            if (password_verify($clave_usuario, $hashed_password)) {
                $stmt->close();
                return ['id_usuario' => $row['id_usuario']]; 
            }
        }
        
        $stmt->close();
        return false;
    }

  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function insertarUsuario($nombre,$apellido,$email,$clave_usuario,$fecha_nacimiento,$cedula) {
$sql = "INSERT INTO usuario (nombre_usuario, apellido_usuario, email_usuario, clave_usuario, fecha_nacimiento, cedula_usuario, codigo_verificado)
VALUES (?, ?, ?, ?, ?, ?, 0)";

$stmt = $this->db->prepare($sql); 
$stmt->bind_param("ssssss", $nombre,$apellido,$email,$clave_usuario,$fecha_nacimiento,$cedula);

if ($stmt->execute()) { 
    $user_id = $this->db->insert_id;
    $stmt->close();
    return $user_id; 
} else {
    $stmt->close();
    return false; 
}
    }
  
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  public function guardarCodigoVerificacion(int $user_id, string $otp_code, string $expiration_time): bool {
    $sql = 'UPDATE usuario SET codigo_verificacion = ?, codigo_expira = ? WHERE id_usuario = ?';
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("ssi", $otp_code, $expiration_time, $user_id);

    $exito = $stmt->execute();
    $stmt->close(); 
    return $exito;
  }

  //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

public function verificarCodigo(int $user_id, string $input_code): string {
    $now = date ('Y-m-d H:i:s'); 
$stmt = $this->db->prepare("SELECT  codigo_verificacion, codigo_expira FROM usuario WHERE id_usuario = ? AND codigo_verificacion = ? AND codigo_verificado = 0");
$stmt->bind_param("is", $user_id, $input_code);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if($user) {
    if ($user['codigo_expira'] < $now) {
        return 'codigo_expirado';
    }

    $update_stmt = $this->db->prepare("UPDATE usuario SET codigo_verificado = 1, codigo_verificacion = NULL, codigo_expira = NULL WHERE id_usuario = ?");
 $update_stmt->bind_param("i", $user_id);
 $update_stmt->execute();
 $update_stmt->close();
 return 'verificado_con_exito';
} else {
    return 'codigo_incorrecto';



    
}

}

}