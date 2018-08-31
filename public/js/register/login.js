//Constantes para iniciar sesion
const emailLogin = document.getElementById('emailLogin');
const passwordLogin = document.getElementById('passwordLogin');
const rememberMe = document.getElementById('rememberMe');
const btnLogin = document.getElementById('btnLogin');
const loginHelp = document.getElementById('loginHelp');

//Iniciar sesion al dar click al boton
btnLogin.onclick = function () {

    let url = window.location.origin+'/api/auth/login';
    let data = {
        email : emailLogin.value,
        password : passwordLogin.value,
        remember_me : rememberMe.checked,
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

        if (json.success){
            //Creamos cookie de JWT
            let d = new Date();
            d.setTime(d.getTime() + (30*24*60*60*1000));
            let expires = "expires="+ d.toUTCString();
            document.cookie = 'jwt=' + json.data.access_token + ";" + expires + ";path=/";
            location.href = 'http://localhost:8000/';
        } else {
            if (json.success == false) {
                let data = json.data;
                let nodeText;
                loginHelp.innerHTML = json.message;
                for (var mess in data) {
                    nodeText = document.createTextNode(' '+data[mess][0]);
                    loginHelp.appendChild(nodeText);
                }
            }
        }
    })
    .catch(error => console.log(error));
}

//Constantes para registrar a un usuario
