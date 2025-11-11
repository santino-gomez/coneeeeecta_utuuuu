<form action="/login/procesar" method="POST" class="formRegistro">
    <span class="contenido1">
        <p>Iniciar sesión</p>
    </span>

    <p>Correo Electrónico:</p>
    <input type="email" name="email_usuario" placeholder="Correo electrónico" required>

    <div class="godFace">
        <p>Contraseña:</p>
        <span class="cicada3301">
            <input type="checkbox" id="togglePassword">Mostrar contraseña</input>
        </span>
    </div>
    <input type="password" id="passwordField" name="clave_usuario" placeholder="Contraseña" required>

    <p>Cédula:</p>
    <input type="text" name="cedula_usuario" placeholder="Cédula" required>
    
    <br>

    
    <span class="contenido1" style="margin-left: 60px; margin-right: 60px;">
        <p>¿Olvidaste tu contraseña? Hacé click acá:<a href="https://www.youtube.com/shorts/yhH_V5l7SuI"><br>Olvidé mi contraseña</a></p>
        
        <br>
        
        <p> ¿No tenés cuenta? <br>
        <a href="registrarse.php" style="color: #7865e4; text-decoration: underline;">Registrate acá</a>
    </p>

    <br>
    
    <span class="botones">
        <button type="submit">Iniciar sesión</button>
    </span>
</span>
</form>

<p style="margin-bottom: 10vh; text-align: center;">Recomendamos usar llaves de acceso, <br> también se recomienda para usuarios <br> pero sobretodo para empresas.</p>