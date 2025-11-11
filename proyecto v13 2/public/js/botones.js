document.addEventListener('DOMContentLoaded', function() {
    const boton = document.getElementById('redirigirRegistro');

    boton.addEventListener('click', function() {
        window.location.href = '../app/view/registrarse.php'; 
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const boton = document.getElementById('redirigirInicioSesion');

    boton.addEventListener('click', function() {
        window.location.href = '../app/view/inicioSesion.php'; 
    });
});