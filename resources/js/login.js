
const formLogin = document.querySelector('#frm-login')
const ipress = document.querySelector('#unidad')
/* APP */
async function postData(data) {
    const response = await fetch("App/controllers/controller.php", {
        method: "POST",
        body: data,
    }).then((res) => res.json());
    return await response;
}
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
window.addEventListener("load", async () => {
    const data = new FormData();
    data.append("accion", "LISTAR_UNIDADES");
    const cargarUnidades = await postData(data);
    const unidadesList = cargarUnidades.map((unidad) => `<option value=${unidad.idIpress}>${unidad.nombreIpress}</option>`).join('');
    ipress.innerHTML = unidadesList
});

formLogin.addEventListener('submit', async (e) => {
    e.preventDefault()
    const data = new FormData(formLogin);
    data.append('accion', 'LOGIN');
    const respuesta = await postData(data);
    console.log(respuesta.rpta)
    if (respuesta.rpta === 'success') location.assign('index.php');
    else msgAlert('warning', 'Error de acceso', 'La contraseña no coincide');
})

