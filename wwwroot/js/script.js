let codigo = ['a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U', '0', '1', '2', '3', '4', '5'];

document.addEventListener("DOMContentLoaded", (e) => {
    app();
});

function app()
{
    validarFormularioTemaCuestionario();
    verificarAgregarPregunta();  
    verificarAgregarRespuesta();
    verificarEliminarRespuesta();
}

function validarFormularioTemaCuestionario()
{
    document.getElementById("guardarTemaCuestionario")
        .addEventListener("click", (e) => {
            let temaCampo = document.querySelector("#descripcionTema").value.trim();
            let mensajeCampo = document.getElementsByClassName("mensajes")[0];
            const myModal = document.getElementById('guardarTemaCuestionario');

            if ( temaCampo !== "" )
            {
                //eliminamos el mensaje de error.
                mostrarMensajeAlerta("", mensajeCampo, false);
                myModal.setAttribute("data-bs-dismiss", "modal");
                myModal.click();

                document.getElementById("TemaCuestionario").value = temaCampo;
            }
            else 
            {
                mostrarMensajeAlerta("Debes insertar un tema para el cuestionario.", mensajeCampo, true);
                myModal.setAttribute("data-bs-dismiss", "");
            }
        });
}


function generarCodigoAleatorio()
{
    let c = "";
    for( let i = 0; i < 30; i++)
    {
        let numero = Math.floor(Math.random() * 10);	
        c+=codigo[numero];
    }
    return c;
}

function mostrarMensajeAlerta(mensaje, mensajeCampo, mostrar = false)
{
    if ( !mostrar )
    {
        mensajeCampo.innerHTML = ``;
        mensajeCampo.classList.add("ocultarMensaje");
        mensajeCampo.classList.remove("mensajeError");
    }
    else 
    {
        mensajeCampo.innerHTML = mensaje;
        mensajeCampo.classList.add("mensajeError");
        mensajeCampo.classList.remove("ocultarMensaje");
    }
}

function verificarEliminarRespuesta()
{
    let botonEliminar = document.querySelectorAll(".botonEliminarRespuesta");
    botonEliminar.forEach(btn => {
        btn.onclick = (e) => {
            let codigoCampo = e.target.parentNode.value;
            let nodeCampo = document.getElementsByClassName(codigoCampo)[0];
            nodeCampo.remove();
            verificarAgregarRespuesta();
        };
    });
}

function verificarAgregarRespuesta()
{
    let botones = document.querySelectorAll(".formulario .pregunta_seccion .botonAgregarRespuesta");

    botones.forEach(boton => {

        boton.onclick = (e) => {
            let contenedorRespuestas = document.getElementsByClassName(e.target.id)[0];

            let nRespuesta = (document.querySelectorAll(".pregunta_seccion").length);

            let codigoAleatorio = generarCodigoAleatorio();

            let campo = document.createElement("DIV");
            campo.classList.add("campo", `campo_${codigoAleatorio}`);
            campo.innerHTML = `
                <label for="respuesta${nRespuesta}" class="fw-light pb-2 pt-2">Ingresa tu respuesta</label>
                <div class="campo_seccion">
                    <input type="text" id="respuesta${nRespuesta}" name="pregunta_${nRespuesta}_respuesta_${codigoAleatorio}" class="form-control" placeholder="Ingresa la respuesta para la pregunta">    
                    <button type="button" value="campo_${codigoAleatorio}" class="botonEliminarRespuesta"><i style="font-size:25px;color:red;" class="bi bi-x-circle-fill"></i></button>
                </div>
            `;

            contenedorRespuestas.appendChild(campo);
            verificarEliminarRespuesta();
        }

       
    });
}

function verificarAgregarPregunta()
{
    document.getElementById("agregarPregunta")
        .addEventListener("click", (e) => {
            let contenedorRespuestas = document.getElementsByClassName("formulario")[0];

            let nRespuesta = (document.querySelectorAll(".pregunta_seccion").length + 1);
            let codigoAleatorio = generarCodigoAleatorio();

            let campo = document.createElement("DIV");
            campo.classList.add("pregunta_seccion", "pt-2");
            campo.innerHTML = `
                <div class="acciones d-flex align-items-center justify-content-between">
                    <div>
                        <button type="button" id="agregarRespuesta-${nRespuesta}" class="btn btn-primary mt-2 d-inline mb-2 botonAgregarRespuesta">
                            <i class="bi bi-plus-circle-fill"></i>
                            Agregar Respuesta
                        </button>
                    </div>
                </div>
                <div class="tabla ajustar-tabla">
                    <div class="campo-pregunta">
                        <label for="pregunta${nRespuesta}" class="fw-light pb-2">Ingresa tu pregunta</label>
                        <input type="text" id="pregunta${nRespuesta}" name="pregunta_${nRespuesta}" class="form-control" placeholder="Ingresa primera pregunta para el cuestionario">
                    </div>
                    <div class="campo-respuestas agregarRespuesta-${nRespuesta}">
                        <div class="campo campo_${codigoAleatorio}">
                            <label for="respuesta${nRespuesta}" class="fw-light pb-2">Ingresa tu respuesta</label>
                            <div class="campo_seccion">
                                <input type="text" id="respuesta${nRespuesta}" name="pregunta_${nRespuesta}_respuesta_00001" class="form-control respuesta respuesta_00001" placeholder="Ingresa la respuesta para la pregunta">                        
                                <button type="button" value="campo_${codigoAleatorio}" class="botonEliminarRespuesta"><i style="font-size:25px;color:red;" class="bi bi-x-circle-fill"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            contenedorRespuestas.appendChild(campo);
            verificarAgregarRespuesta();
            verificarEliminarRespuesta();
    });
}

