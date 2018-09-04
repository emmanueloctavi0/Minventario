const URL = window.location.origin;
//Buscamos la cookie para saber si el usuario está logeado
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

const articleId = document.getElementById('articleId');
const nameAdd = document.getElementById('nameAdd');
const descriptionAdd = document.getElementById('descriptionAdd');
const amountAdd = document.getElementById('amountAdd');
const priceAdd = document.getElementById('priceAdd');

//Validamos la cookie consultando el dato a actualizar
fetch(URL + '/api/article/' + articleId.value, {
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
    } else if(json.success == false) {
        location.href = URL;
    } else if (json.success == true) {
        //Establecemos los datos extraidos
        nameAdd.value = json.data.name;
        descriptionAdd.value = json.data.description;
        amountAdd.value = json.data.amount;
        priceAdd.value = json.data.price;
    }
})
.catch(err => console.log(err));

const sendData = document.getElementById('sendData');
const addHelp = document.getElementById('addHelp');

sendData.onclick = function () {
    data = {
        name : nameAdd.value,
        description : descriptionAdd.value,
        amount : amountAdd.value,
        price : priceAdd.value
    }
    //mandamos los datos a modificar
    fetch(URL + '/api/article/' + articleId.value, {
        method: 'PATCH',
        body: JSON.stringify(data),
        headers:{
            'Authorization' : 'Bearer '+ name,
            'Content-Type': 'application/json'
        }
    })
    .then(res => res.json())
    .then(json => {
        console.log(json)

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
    })
    .catch(err => console.log(err));

}
