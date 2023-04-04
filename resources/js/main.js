const btnAddContacto = document.querySelector('#btnAddNumber');
const divContact = document.querySelector('.others_contacts');
const formContacto = document.querySelector('#formContact')

let contador = 1;

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
    const datos = new FormData();
    datos.append("accion", "PRUEBA");
    datos.append("otros", JSON.stringify(otherContacts));
    const retorno = await postData(datos);
    console.log(retorno)
})

/* APP */
async function postData(data) {
    const response = await fetch("App/controllers/controller.php", {
        method: "POST",
        body: data,
    }).then((res) => res.json());
    return await response;
}

/* window.addEventListener("load", async () => {
    const datos = new FormData();
    datos.append("accion", "LISTAR_UNIDADES");
    const cargarUnidades = await postData(datos);
    const unidadesList = cargarUnidades.map((unidad) => unidad.nombreIpress);
    CargarAutocompletado(unidadesList, cargarUnidades);
});

function CargarAutocompletado(list, unidades) {
    $("#nombreIpress").autocomplete({
        source: list,
        select: (e, item) => {
            let unidad = item.item.value;
            let position = list.indexOf(unidad);
            idIpress = unidades[position].idIpress;
            alert(idIpress)
        },
    });
} */
const isNumber = (e) => {
    if (e.keyCode < 48 || e.keyCode > 57) return false;
};
const isSpace = (e) => {
    if (e.keyCode == 32) return false;
};
$(document).on("keypress", ".phone", (e) => { return isNumber(e); });
$(document).on("keypress", "#correoIpress", (e) => { return isSpace(e); });

