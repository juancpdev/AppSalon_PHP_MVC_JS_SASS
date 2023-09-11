let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

document.addEventListener("DOMContentLoaded", function() {
    iniciarApp();
});

const citas = {
    nombre: '',
    fecha: '',
    hora: '',
    servicios: []
}

function iniciarApp() {
    tabs(); // Cambia la seccion cuando se presionen los tabs
    botonesPaginador();  // Agrega o quita los botones del paginador
    paginaAnterior();
    paginaSiguiente();

    consultarAPI(); // Consulta API en el backend de PHP

    nombreCliente(); // Añade el nombre del cliente al objeto de citas
    seleccionarFecha(); // Añade la fecha al objeto de citas
    seleccionarHora(); // Añade la hora al objeto de citas
}

function mostrarSeccion() {
    const seccionAnterior = document.querySelector(".mostrar");
    seccionAnterior.classList.remove("mostrar");

    const pasoSelector = `#paso-${paso}`;
    const seccion = document.querySelector(pasoSelector);
    seccion.classList.add("mostrar");

    // Quita la clase de actual al tab anterior
    const tabAnterior = document.querySelector(".actual");
    tabAnterior.classList.remove("actual");

    // Resalta el tab actual
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add("actual");
}

function tabs() {
    const botones = document.querySelectorAll(".tabs button");
    
    botones.forEach(boton => {
        boton.addEventListener("click", function(e) {
            paso = parseInt( e.target.dataset.paso );

            mostrarSeccion();
            botonesPaginador();
        })
    });
}

function botonesPaginador() {
    const btnPrevio = document.getElementById('anterior');
    const btnSiguiente = document.getElementById('siguiente');

    if (paso === 1) {
        btnPrevio.classList.add('ocultar');
        btnSiguiente.classList.remove('ocultar');
    } else if (paso === 3) {
        btnPrevio.classList.remove('ocultar');
        btnSiguiente.classList.add('ocultar');
    } else {
        btnPrevio.classList.remove('ocultar');
        btnSiguiente.classList.remove('ocultar');
    }
    mostrarSeccion();
}


function paginaAnterior() {
    const paginaAnterior = document.getElementById("anterior");
    paginaAnterior.addEventListener('click', function() {
        if(paso <= pasoInicial) return;

        paso--;
        botonesPaginador();

    });
}

function paginaSiguiente() {
    const paginaSiguiente = document.getElementById("siguiente");
    paginaSiguiente.addEventListener('click', function() {
        if(paso >= pasoFinal) return;

        paso++;
        botonesPaginador();
    });
}

async function consultarAPI() {

    try {
        const url = 'http://localhost:3000/api/servicios';
        const resultado = await fetch(url);
        const servicios = await resultado.json();
        mostrarServicios(servicios);

    } catch (error) {
        console.log(error);
    }
}

function mostrarServicios(servicios) {
    servicios.forEach( servicio => {
        const { id, nombre, precio} = servicio;
        
        const nombreServicio = document.createElement("P");
        nombreServicio.classList.add("nombre-servicio");
        nombreServicio.textContent = nombre;
        
        const precioServicio = document.createElement("P");
        precioServicio.classList.add("precio-servicio");
        precioServicio.textContent = `$${precio}`;

        const servicioDiv = document.createElement("DIV");
        servicioDiv.classList.add("servicio");
        servicioDiv.dataset.idServicio = id;
        servicioDiv.onclick = function() {
            seleccionarServicio(servicio);
        };

        servicioDiv.appendChild(nombreServicio);
        servicioDiv.appendChild(precioServicio);
        
        document.querySelector("#servicios").appendChild(servicioDiv);
    });
}

function seleccionarServicio(servicio) {
    const { servicios } = citas;
    const { id } = servicio;

    citas.servicios = [...servicios, servicio];
    const divServicio = document.querySelector(`[data-id-servicio="${id}"]`);
    divServicio.classList.toggle("seleccionado");
    console.log(citas) ;
}

function nombreCliente() {
    const nombreCliente = document.getElementById('nombre').value;
    citas.nombre = nombreCliente;
}

function seleccionarFecha() {
    const inputFecha = document.getElementById('fecha');
    
    inputFecha.addEventListener('input', function(e) {
        
        const dia = new Date(e.target.value).getUTCDay();

        if( [0, 6].includes(dia) ) {
            mostrarAlerta('Sábados y Domingos No Disponible', 'error');
        } else {
            citas.fecha = e.target.value;
        }
    })
}

function seleccionarHora() {
    const inputHora = document.getElementById('hora');
    
    inputHora.addEventListener('input', function(e) {
        citas.hora = e.target.value;
        const horaValor = citas.hora.split(":")[0];
        
        if((horaValor > 8 && horaValor < 13 ) || (horaValor > 17 && horaValor < 23 )) {
            citas.hora = e.target.value;
            console.log(citas);
        } else {
            e.target.value = "";
            mostrarAlerta('Horarios de atención (9:00 a 12:00 y 18:00 a 22:00)', 'error');
        }
    })
}

function mostrarAlerta(mensaje, tipo) {
    const alertaPrevia = document.querySelector(".alerta");
    if(alertaPrevia) return;

    const alerta = document.createElement("DIV");
    alerta.classList.add("alerta", tipo);
    alerta.innerHTML = mensaje;

    const paso2 = document.getElementById("paso-2");
    paso2.appendChild(alerta);

    setTimeout(() => {
        alerta.remove();
    }, 4000);
}

