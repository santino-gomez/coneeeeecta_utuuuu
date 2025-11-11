document.addEventListener('DOMContentLoaded', function() {
    
    const inputFecha = document.getElementById('fecha_nacimiento');
        inputFecha.addEventListener('input', function(e) {

        let valor = e.target.value.replace(/\D/g,''); //Solo permite digitos

        if (valor.length > 2) {
            valor = valor.substring(0, 2) + '/' + valor.substring(2); //Primera barra (DD/)
        }
        if (valor.length > 5) {
            valor = valor.substring(0, 5) + '/' + valor.substring(5, 9); //Segunda barra (MM/)
        }
    e.target.value = valor;
    });
});