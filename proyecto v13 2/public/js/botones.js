document.addEventListener('DOMContentLoaded', () => {
    const registro = document.getElementById('redirigirRegistro');
    if (registro) {
        registro.addEventListener('click', (event) => {
            if (registro.tagName !== 'A') {
                event.preventDefault();
            }
            window.location.href = '/registro';
        });
    }

    const inicio = document.getElementById('redirigirInicioSesion');
    if (inicio) {
        inicio.addEventListener('click', (event) => {
            if (inicio.tagName !== 'A') {
                event.preventDefault();
            }
            window.location.href = '/login';
        });
    }
});
