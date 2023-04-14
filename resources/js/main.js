const btnAddContacto = document.querySelector('#btnAddNumber');
const divContact = document.querySelector('.others_contacts');
const formContacto = document.querySelector('#formContact')
const btnSalir = document.querySelector('.btn-salir')

let contador = 1;

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

btnAddContacto.addEventListener('click', () => {
    contador++;
    const fragmento = document.createDocumentFragment()
    const card = document.createElement('DIV');
    const contInputNombre = document.createElement('DIV');
    const contInputGrado = document.createElement('DIV');
    const contInputTelefono = document.createElement('DIV');
    const btnRemoveContact = document.createElement('A');
    const textRemoveContact = document.createTextNode('Quitar');

    const groupInput = document.createElement('DIV');
    const labelNombre = document.createElement('LABEL');
    const labelNombreText = document.createTextNode('Nombre');
    const inputNombre = document.createElement('INPUT');
    const inputGrado = document.createElement('INPUT');
    const inputTelefono = document.createElement('INPUT');

    const labelGrado = document.createElement('LABEL');
    const labelGradoText = document.createTextNode('Grado');
    const labelTelefono = document.createElement('LABEL');
    const labelTelefonoText = document.createTextNode('Telefono');

    card.classList.add('card')
    btnRemoveContact.classList.add('btnRemoveContact')
    btnRemoveContact.appendChild(textRemoveContact)
    btnRemoveContact.setAttribute('onclick', `removeContact(${contador})`)
    card.setAttribute('id', `card-${contador}`)
    contInputNombre.classList.add('cont-input')
    contInputGrado.classList.add('cont-input')
    contInputTelefono.classList.add('cont-input')
    groupInput.classList.add('group-input')
    labelNombre.setAttribute('for', `nombreOtro${contador}`);
    labelNombre.appendChild(labelNombreText)
    labelGrado.appendChild(labelGradoText)
    labelTelefono.appendChild(labelTelefonoText)
    inputNombre.setAttribute('type', 'text')
    inputNombre.setAttribute('name', `nombreOtro${contador}`)
    inputNombre.classList.add('nameOthers')
    inputGrado.setAttribute('type', 'text')
    inputGrado.setAttribute('name', `gradoOtro${contador}`)
    inputGrado.classList.add('gradoOthers')
    inputTelefono.setAttribute('type', 'tel')
    inputTelefono.setAttribute('name', `telefonoOtro${contador}`)
    inputTelefono.classList.add('phone')
    inputTelefono.classList.add('phoneOthers')

    contInputGrado.appendChild(labelGrado)
    contInputGrado.appendChild(inputGrado)
    contInputTelefono.appendChild(labelTelefono)
    contInputTelefono.appendChild(inputTelefono)
    groupInput.appendChild(contInputGrado)
    groupInput.appendChild(contInputTelefono)
    contInputNombre.appendChild(labelNombre)
    contInputNombre.appendChild(inputNombre)
    card.appendChild(contInputNombre)
    card.appendChild(groupInput)
    card.appendChild(btnRemoveContact)
    fragmento.appendChild(card);
    divContact.appendChild(fragmento)
})

function removeContact(idContact) {
    document.getElementById(`card-${idContact}`).remove()
}
formContacto.addEventListener('submit', async (e) => {
    e.preventDefault()
    let cantDivs = document.getElementsByClassName('card').length;
    let otherContacts = [];
    for (let i = 0; i < cantDivs; i++) {
        let otherContact = {};
        const nombre = document.querySelectorAll('.nameOthers')[i].value;
        const telefono = document.querySelectorAll('.phoneOthers')[i].value;
        const grado = document.querySelectorAll('.gradoOthers')[i].value;
        otherContact.nombre = `${nombre}`;
        otherContact.phone = `${telefono}`;
        otherContact.grado = `${grado}`;
        otherContacts.push(otherContact);
    }
    const datos = new FormData(formContacto);
    datos.append("accion", "REGISTRAR_CONTACTOS");
    datos.append("otros", JSON.stringify(otherContacts));
    const retorno = await postData(datos);
    console.log(retorno)
    if (retorno.rpta === 'Ok') msgAlert('success', 'Se registró correctamente', retorno.mensaje)
    else msgAlert('error', 'Ocurrió un inconveniente', retorno.mensaje)
})

/* APP */
async function postData(data) {
    const response = await fetch("App/controllers/controller.php", {
        method: "POST",
        body: data,
    }).then((res) => res.json());
    return await response;
}
const isNumber = (e) => {
    if (e.keyCode < 48 || e.keyCode > 57) return false;
};
const isSpace = (e) => {
    if (e.keyCode == 32) return false;
};
$(document).on("keypress", ".phone", (e) => { return isNumber(e); });
$(document).on("keypress", "#correoIpress", (e) => { return isSpace(e); });

/* REGISTRO */
btnSalir.addEventListener('click', async () => {
    const datos = new FormData();
    datos.append("accion", "LOGOUT");
    const respuesta = await postData(datos);
    if (respuesta.rpta == 'logout') location.assign('login.php');
})
async function cargarDirectorio() {
    const tb = document.querySelector('#tb-directorio');
    const datos = new FormData();
    datos.append("accion", "CARGAR_DIRECTORIO");
    const respuesta = await postData(datos);
    console.log(respuesta.data)
    tb.innerHTML = respuesta.data;

}