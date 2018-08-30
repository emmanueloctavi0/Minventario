
var articleTable = new Vue({
    el: '#articleTable',
    data: {
        url: window.location.href,
        urlApi: window.location.href+'api/article',
        success: false,
        areProducts: false,
        products: null,
        jwt : ""
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

            fetch(articleTable.urlApi, {
                method: 'GET',
                headers:{
                    'Authorization' : 'Bearer '+ articleTable.jwt,
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(response => {
                //En caso de que se niege el acceso
                console.log(response)

                if (typeof response.login === 'undefined') {
                    //Significa que el logeo fue correcto
                    articleTable.areProducts = response.success;
                    //mostrar los productos
                    articleTable.products = response.data;
                    console.log(response.data[0].name);

                } else if (response.login == false) {
                    location.href = this.url+'ingresar';
                }

            })
            .catch(err => console.error(err));
        },

    }
});



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
