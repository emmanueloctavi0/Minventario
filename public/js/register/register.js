//Constantes input

const nameRegister = document.getElementById('nameRegister');
const emailRegister = document.getElementById('emailRegister');
const passwordRegister = document.getElementById('passwordRegister');
const passwordRegisterC = document.getElementById('passwordRegisterC');
const btnCreate = document.getElementById('btnCreate');
const registerHelp = document.getElementById('registerHelp');

//Al dar click se tienen que validar los datos y crear la cuenta
btnCreate.onclick = function () {
    let url = window.location.origin+'/api/auth/signup';
    let data = {
        name : emailRegister.value,
        email : emailRegister.value,
        password : passwordRegister.value,
        password_confirmation : passwordRegisterC.value
    }
    //console.log(data);
    fetch(url, {
        method: 'POST',
        body: JSON.stringify(data),
        headers:{
            'Content-Type': 'application/json'
        }
    })
    .then(res => res.json())
    .then(json => {

        //Si hubo un error muestra los errores
        if (json.success == false) {
            let data = json.data;
            let nodeText;
            registerHelp.innerHTML = "";
            for (var mess in data) {
                nodeText = document.createTextNode(' '+data[mess][0]);
                registerHelp.appendChild(nodeText);
            }
        } else if (json.success == true) {
            //Se creo la cuenta correctamente
            //Se debe logear automaticamente
            let d = new Date();
            d.setTime(d.getTime() + (30*24*60*60*1000));
            let expires = "expires="+ d.toUTCString();
            document.cookie = 'jwt=' + json.data + ";" + expires + ";path=/";
            location.href='http://localhost:8000/';
        }
    })
    .catch(err => console.error(err))
}
