
var articleTable = new Vue({
    el: '#articleTable',
    data: {
        url: 'https://minventario-test.herokuapp.com/',
        urlApi: 'https://minventario-test.herokuapp.com/api/article/',
        success: false,
        areProducts: false,
        userName: "",
        products: null,
        jwt : "",
        productId: null
    },
    mounted: function () {
        this.$nextTick(function () {
            //Comprobamos si existe la cookie de logeo
            this.jwt = getCookie('jwt');
            //Redirecciona a ingresar si no existe el token
            if (this.jwt == "") {
                location.href = this.url+'ingresar';
            }

            this.getArticles();
        })
    },
    methods: {
        getArticles: function () {

            fetch(this.urlApi, {
                method: 'GET',
                headers:{
                    'Authorization' : 'Bearer '+ articleTable.jwt,
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(response => {
                //En caso de que se niege el acceso

                if (typeof response.login === 'undefined') {
                    //Significa que el logeo fue correcto
                    articleTable.areProducts = response.success;
                    //mostrar los productos y el nombre del usuario
                    articleTable.products = response.data.products;
                    articleTable.userName = response.data.user_name;

                } else if (response.login == false) {
                    location.href = this.url+'ingresar';
                }

            })
            .catch(err => console.error(err));
        },
        deleteProduct: function (productId) {
            //Se manda la peticion para eliminar un producto

            fetch(this.urlApi + productId,{
                method: 'DELETE',
                headers:{
                    'Authorization' : 'Bearer '+ articleTable.jwt,
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(response => {
                //Eliminar tambien de articleTable.products
                articleTable.getArticles();

            })
            .catch(err => console.error(err));
        },
        downloadFile: async function () {
            const response = await fetch(this.url+'api/download', {
                method: 'GET',
                headers: {
                    Authorization: 'Bearer '+articleTable.jwt
                }
            });
            const doc = await response.blob();
            let url = window.URL.createObjectURL(doc);
            let link = document.createElement('a');
            link.href = url;
            link.setAttribute('download', 'misProductos.xlsx');
            document.body.appendChild(link);
            link.click();
        }


    }
});

const logout = document.getElementById('logout');
logout.onclick = function () {
    fetch(this.url+ '/api/auth/logout',{
        method: 'GET',
        headers:{
            'Authorization' : 'Bearer '+ articleTable.jwt,
            'Content-Type': 'application/json'
        }
    })
    .then(resp => resp.json())
    .then(json => {
        location.href = window.location.origin;
    })
    .catch(err => console.error(err))
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
