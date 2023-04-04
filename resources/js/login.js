
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
    else alert(respuesta.data);
})