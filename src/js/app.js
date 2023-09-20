let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

document.addEventListener("DOMContentLoaded", function() {
    iniciarApp();
});

const citas = {
    id: '',
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

    idCliente(); // Añade el id del cliente al objeto de citas
    nombreCliente(); // Añade el nombre del cliente al objeto de citas
    seleccionarFecha(); // Añade la fecha al objeto de citas
    seleccionarHora(); // Añade la hora al objeto de citas

    mostrarResumen(); // Muestra el resumen de la cita
}

/* MOSTRAR SECCION */
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

/* TABS */
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

/* BOTONES PAGINADOR */
function botonesPaginador() {
    const btnPrevio = document.getElementById('anterior');
    const btnSiguiente = document.getElementById('siguiente');

    if (paso === 1) {
        btnPrevio.classList.add('ocultar');
        btnSiguiente.classList.remove('ocultar');
    } else if (paso === 3) {
        btnPrevio.classList.remove('ocultar');
        btnSiguiente.classList.add('ocultar');
        mostrarResumen();
    } else {
        btnPrevio.classList.remove('ocultar');
        btnSiguiente.classList.remove('ocultar');
    }
    mostrarSeccion();
}

/* PAG ANT */
function paginaAnterior() {
    const paginaAnterior = document.getElementById("anterior");
    paginaAnterior.addEventListener('click', function() {
        if(paso <= pasoInicial) return;

        paso--;
        botonesPaginador();

    });
}

/* PAG SIG */
function paginaSiguiente() {
    const paginaSiguiente = document.getElementById("siguiente");
    paginaSiguiente.addEventListener('click', function() {
        if(paso >= pasoFinal) return;

        paso++;
        botonesPaginador();
    });
}

/* CONSULTAR API */
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

/* MOSTRAR SERVICIO */
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

/* SELECCIONAR SERVICIO */
function seleccionarServicio(servicio) {
    const { servicios } = citas;
    const { id } = servicio;

    // Verificar si el servicio ya está en el arreglo
    const existeServicio = servicios.findIndex(servicio => servicio.id === id);

    if (existeServicio === -1) { // Si el servicio no está en el arreglo, lo agrega
        citas.servicios = [...servicios, servicio];
    } else { // Si el servicio ya está, lo elimina
        servicios.splice(existeServicio, 1);
    }

    const divServicio = document.querySelector(`[data-id-servicio="${id}"]`);
    divServicio.classList.toggle("seleccionado");
}

/* NOMBRE CLIENTE */
function nombreCliente() {
    const nombreCliente = document.getElementById('nombre').value;
    citas.nombre = nombreCliente;
}

/* ID CLIENTE */
function idCliente() {
    const idCliente = document.getElementById('id').value;
    citas.id = idCliente;
}

/* SELECCIONAR FECHA */
function seleccionarFecha() {
    const inputFecha = document.getElementById('fecha');
    
    inputFecha.addEventListener('input', function(e) {
        
        const dia = new Date(e.target.value).getUTCDay();
        if( [0, 6].includes(dia) ) {
            mostrarAlerta('Sábados y Domingos No Disponible', 'error', '.formulario');
            e.target.value = "";
        } else {
            citas.fecha = e.target.value;
        }
    })
}

/* SELECCIONAR HORA */
function seleccionarHora() {
    const inputHora = document.getElementById('hora');
    
    inputHora.addEventListener('input', function(e) {
        citas.hora = e.target.value;
        const horaValor = citas.hora.split(":")[0];
        
        if((horaValor > 8 && horaValor < 13 ) || (horaValor > 17 && horaValor < 23 )) {
            citas.hora = e.target.value;
        } else {
            e.target.value = "";
            mostrarAlerta('Horarios de atención (9:00 a 12:00 y 18:00 a 22:00)', 'error', '.formulario');
        }
    })
}

/* MOSTRAR ALERTA */
function mostrarAlerta(mensaje, tipo, elemento, time = true) {

    // Previene que se genere mas de 1 alerta
    const alertaPrevia = document.querySelector(".alerta");
    if(alertaPrevia) {
        alertaPrevia.remove();
    };

    // Scripting para crear la alerta
    const alerta = document.createElement("DIV");
    alerta.classList.add("alerta", tipo);
    alerta.innerHTML = mensaje;

    const referencia = document.querySelector(elemento);
    referencia.appendChild(alerta);

    if(time) {
        setTimeout(() => {
            alerta.remove();
        }, 4000);
    }
}

/* MOSTRAR RESUMEN */
function mostrarResumen() {
    const resumen = document.querySelector(".contenido-resumen");

    // Limpiar el contenido de Resumen
    while(resumen.firstChild){
        resumen.removeChild(resumen.firstChild);
    };
    
    if(Object.values(citas).includes("") || citas.servicios.length === 0) {
        mostrarAlerta("Faltan completar datos", "error", '.contenido-resumen', false);
        return;
    }
    
    // Formatear el div de resumen
    const {nombre, fecha, hora, servicios} = citas;

    // Agregamos titulo a resumen servicios
    const tituloServicios = document.createElement("H3");
    tituloServicios.textContent = "Resumen de Servicios";
    resumen.appendChild(tituloServicios);

    // Total de precio
    let precioFinal = 0;
    
    // Servicios agregados del cliente
    servicios.forEach( servicio => {
        const { nombre, precio} = servicio;
    
        const contenedorServicios = document.createElement("DIV");
        contenedorServicios.classList.add("contenedor-servicios");

        const nombreServicio = document.createElement("P");
        nombreServicio.classList.add("nombre-servicios");
        nombreServicio.innerHTML = nombre;
    
        const precioServicio = document.createElement("P");
        precioServicio.classList.add("precio-servicios");
        precioServicio.innerHTML = "<span>Precio:</span>" + " $" + precio;

        // Sumamos el precio final
        let precioNumber = Number(precio);
        precioFinal += precioNumber;

        contenedorServicios.appendChild(nombreServicio);
        contenedorServicios.appendChild(precioServicio);
        resumen.appendChild(contenedorServicios);
    });

    // Datos de la cita en resumen
    const tituloCita = document.createElement("H3");
    tituloCita.innerHTML = "Resumen Cita";

    const nombreCliente = document.createElement("P");
    nombreCliente.innerHTML = "<span>Nombre: </span> " + nombre;

    // Formatear fecha en español
    const fechaObj = new Date(fecha + ' 00:00');
    const opciones = {weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'}
    const fechaFormateada = fechaObj.toLocaleDateString('es-AR', opciones); 

    const fechaCliente = document.createElement("P");
    fechaCliente.innerHTML = "<span>Fecha: </span>" + fechaFormateada;

    const horaCliente = document.createElement("P");
    horaCliente.innerHTML = "<span>Hora: </span>" + hora + " hs";

    const precioTotal = document.createElement("P");
    precioTotal.innerHTML = "<span>Total: </span>" + " $" + precioFinal;

    const contenedorResumen = document.createElement("DIV");
    contenedorResumen.classList.add("contenedor-cita");

    // Boton para crear una Cita
    const divBotonReservar = document.createElement("DIV");
    divBotonReservar.classList.add("reservar-contenedor");
    const botonReservar = document.createElement("BUTTON");
    botonReservar.classList.add("btn-verde-chico");
    botonReservar.textContent = "Reservar Cita";
    botonReservar.onclick = reservarCita;
    divBotonReservar.appendChild(botonReservar);

    contenedorResumen.appendChild(tituloCita);
    contenedorResumen.appendChild(nombreCliente);
    contenedorResumen.appendChild(fechaCliente);
    contenedorResumen.appendChild(horaCliente);
    contenedorResumen.appendChild(precioTotal);
    contenedorResumen.appendChild(divBotonReservar);

    resumen.appendChild(contenedorResumen);
}

/* BOTON RESERVA */
async function reservarCita() {

    const { fecha, hora, id, servicios} = citas;
    const idServicios = servicios.map( servicio => servicio.id);
    
    const datos = new FormData();
    datos.append('fecha', fecha);
    datos.append('hora', hora);
    datos.append('usuarioId', id);
    datos.append('servicios', idServicios);
    
    try {
        const url = 'http://localhost:3000/api/citas';
        const respuesta = await fetch(url, {
            method: 'POST',
            body: datos
        });

        const resultado = await respuesta.json();
        
        if(resultado.resultado) {
            Swal.fire({
                icon: 'success',
                title: 'Cita Creada',
                text: 'Su cita fue creada correctamente!',
                button: 'OK'
            }).then( () => {
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            })
        }
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Hubo un error al crear su cita',
            button: 'OK'
        })
    }

}
