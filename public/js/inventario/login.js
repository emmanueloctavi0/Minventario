const emailLogin = document.getElementById('emailLogin');
const passwordLogin = document.getElementById('passwordLogin');
const rememberMe = document.getElementById('rememberMe');
const btnLogin = document.getElementById('btnLogin');
const loginHelp = document.getElementById('loginHelp');

btnLogin.onclick = function () {

    let url = 'http://localhost:8000/api/auth/login';
    let data = {
        email : emailLogin.value,
        password : passwordLogin.value,
        remember_me : rememberMe.checked,
    }
    console.log(data);
    fetch(url, {
        method: 'POST', // or 'PUT'
        body: JSON.stringify(data), // data can be `string` or {object}!
        headers:{
            'Content-Type': 'application/json'
        }
    })
    .then(res => res.json())
    .then(response => {

        if (response.success){

            let d = new Date();
            d.setTime(d.getTime() + (30*24*60*60*1000));
            let expires = "expires="+ d.toUTCString();
            document.cookie = 'jwt=' + response.data.access_token + ";" + expires + ";path=/";
            location.href = 'http://localhost:8000/';
        } else {
            loginHelp.innerHTML = response.message;
        }

    })
    .catch(error => console.log(error));
}
