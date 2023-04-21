const filtro = document.querySelector('#nombreIpress')
const tb = document.querySelector('#tb-directorio');
const btnSalir = document.querySelector('.btn-salir')
const contador = document.querySelector('#contador')

const msgAlert = (icono, titulo, texto) => {
    Swal.fire({
        position: "top-end",
        icon: icono,
        title: titulo,
        text: texto,
        showConfirmButton: false,
        timer: 2000,
    });
};

/* APP */
async function postData(data) {
    const response = await fetch("App/controllers/controller.php", {
        method: "POST",
        body: data,
    }).then((res) => res.json());
    return await response;
}
async function cargarDirectorio() {

    const datos = new FormData();
    datos.append("accion", "LISTADO_DIRECTORIO");
    datos.append("filtro", '');
    const respuesta = await postData(datos);
    tb.innerHTML = respuesta.data;
    contador.innerHTML = `${respuesta.total} /82`;

}

filtro.addEventListener('keyup', async () => {
    let inpfiltro = filtro.value
    const datos = new FormData();
    datos.append("accion", "LISTADO_DIRECTORIO");
    datos.append("filtro", inpfiltro);
    const respuesta = await postData(datos);
    tb.innerHTML = respuesta.data;
})
btnSalir.addEventListener('click', async () => {
    const datos = new FormData();
    datos.append("accion", "LOGOUT");
    const respuesta = await postData(datos);
    if (respuesta.rpta == 'logout') location.assign('login.php');
})