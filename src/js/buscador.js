document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();
});

function iniciarApp() {
    buscarFecha();
}

function buscarFecha() {
    document.addEventListener("input", function(e) {
        const fechaSeleccionada = e.target.value;

        window.location = `?fecha=${fechaSeleccionada}`;
    })
}