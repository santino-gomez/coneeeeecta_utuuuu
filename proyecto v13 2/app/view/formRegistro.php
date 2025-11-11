<form action="../../app/controller/regisController.php" method="POST" class="formRegistro">
    <span class="contenido1">
        <p>Registrarse</p>
    </span>    

    <p>Nombre:</p>
    <input type="text" name="nombre_usuario" placeholder="Ingrese su nombre" required>

    <p>Apellido:</p>
    <input type="text" name="apellido_usuario" placeholder="Ingrese su apellido" required>

    <p>Correo Electrónico:</p>
    <input type="email" name="email_usuario" placeholder="Ej: direccion@correo.com" required>

    <div class="godFace">
        <p>Contraseña:</p>
        <span class="cicada3301">
            <input type="checkbox" id="togglePassword">Mostrar contraseña</input>
        </span>
    </div>
    <input type="password" id="passwordField" name="clave_usuario" placeholder="Contraseña" required>

    <p>Cédula de Identidad:</p>
    <input type="text" id="cedula_usuario" name="cedula_usuario" placeholder="Sin puntos ni guiones. (Ej: 12345678)" required>

    <p>Fecha de Nacimiento:</p>
    <input type="text" id="fecha_nacimiento" name="fecha_nacimiento" placeholder="Ej: 04/10/2007" required>

    <br>

    <span class="contenido1">
        <p>Al registrarte, aceptas nuestros <br>
            <a href="#" style="color: #e46565ff; text-decoration: underline;">Términos y condiciones</a>
            y la <a href="#" style="color: #e46565ff; text-decoration: underline;">Política de privacidad</a>.
        </p>

        <br>

        <p>¿Todo listo? 👇</p>
    
        <span class="botones">
            <button type="submit">Registrarme</button>
        </span>

        <br>

        <p> ¿Ya tenés cuenta? <br>
            <a href="inicioSesion.php" style="color: #7865e4; text-decoration: underline;">Iniciá sesión acá</a>
        </p>    
    </span>
</form>