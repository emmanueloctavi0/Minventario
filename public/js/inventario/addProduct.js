//Buscamos la cookie para saber si el usuario está logeado
const URL = window.location.origin;
let name = 'jwt' + "=";
let ca = document.cookie.split(';');
for(var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
        c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
        name = c.substring(name.length, c.length);
    }
}
//Si no existe la cookie redirecciona
if (name == 'jwt=') {
    location.href = URL + '/ingresar';
}

//Validamos la cookie
fetch(URL + '/api/auth/user', {
    method: 'GET',
    headers:{
        'Authorization' : 'Bearer '+ name,
        'Content-Type': 'application/json'
    }
})
.then(res => res.json())
.then(json => {
    //Si no existe tal dato, está logeado
    if(typeof json.login !== 'undefined') {
        location.href = URL+'/ingresar';
    }
})
.catch(err => console.log(err));

// Enviar datos
// Datos a enviar
const nameAdd = document.getElementById('nameAdd');
const descriptionAdd = document.getElementById('descriptionAdd');
const amountAdd = document.getElementById('amountAdd');
const priceAdd = document.getElementById('priceAdd');
const sendData = document.getElementById('sendData');
const addHelp = document.getElementById('addHelp');

sendData.onclick = function () {
    data = {
        name : nameAdd.value,
        description : descriptionAdd.value,
        amount : amountAdd.value,
        price : priceAdd.value
    }

    fetch(URL + '/api/article', {
        method : 'POST',
        body : JSON.stringify(data),
        headers : {
            'Authorization' : 'Bearer '+ name,
            'Content-Type': 'application/json'
        }
    })
    .then(res => res.json())
    .then(json => {
        if (json.success == false) {
            let data = json.data;
            let nodeText;
            addHelp.innerHTML = "";
            for (var mess in data) {
                nodeText = document.createTextNode(' '+data[mess][0]);
                addHelp.appendChild(nodeText);
            }
        } else {
            location.href = URL;
        }
        console.log(json)
    })
    .catch(err => console.log(err));
}
