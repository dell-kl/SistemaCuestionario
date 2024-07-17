document.addEventListener("DOMContentLoaded", (e) => {
    opciones();
});

function opciones()
{
    let comprobar = window.location.search.indexOf("opciones");
    let formulario = window.location.search.indexOf("id");

    if ( comprobar !== -1 && formulario !== -1)
    {
        ModalFormulario();
    }
}

function ModalFormulario()
{
    let botonCancelar = document.getElementById("CerrarFormularioFinal");
    botonCancelar.onclick = () => { window.location.href = `${window.location.origin}${window.location.pathname}?accion=opciones&estado=false`; };

    let botonGuardarCambios = document.getElementsByClassName("btn-guardarCambiosFormulario")[0];
    botonGuardarCambios.onclick = () => {
        //le damos click al btn del formulario para poder enviar los cambios correspondientes
        //estos cambios iran a nuestro apartado del /accion=actualizarFormulario
        document.getElementById('btn-formularioFinal').click();
    };
}

