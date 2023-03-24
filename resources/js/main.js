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
    inputGrado.setAttribute('type', 'text')
    inputGrado.setAttribute('name', `gradoOtro${contador}`)
    inputTelefono.setAttribute('type', 'tel')
    inputTelefono.setAttribute('name', `telefonoOtro${contador}`)

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
formContacto.addEventListener('submit', (e) => {
    e.preventDefault()
    let cantDivs = document.getElementsByClassName('card').length;
    alert(`form enviado con ${cantDivs} divs`)
})