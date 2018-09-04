
const URL = window.location.origin;
var articleTable = new Vue({
    el: '#articleTable',
    data: {
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
                location.href = URL+'/ingresar';
            }

            this.getArticles();
        })
    },
    methods: {
        getArticles: function () {

            fetch(URL+'/api/article', {
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
                    location.href = URL+'/ingresar';
                }

            })
            .catch(err => {
                location.href = URL+'/ingresar';                
            });
        },
        deleteProduct: function (productId) {
            //Se manda la peticion para eliminar un producto

            fetch(URL+'/api/article/' + productId,{
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
            const response = await fetch(URL+'/api/download', {
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
        },
        uploadFile: function() {
            const inputExcel = document.querySelector('.inputExcel.my-2');

            if(inputExcel.files[0] != undefined) {
                //Si hay un archivo envía el archivo
                let formData = new FormData();
                formData.append('archivo', inputExcel.files[0]);

                $.ajax({
                    type: "POST",
                    url: URL+'/api/importExcel',
                    cache: false,
                    processData: false,
                    contentType: false,
                    headers: { Authorization: 'Bearer '+ articleTable.jwt },
                    data: formData,
                    success: function(resp){
                        // resp = JSON.parse( resp );
                        if(resp.success == true) {
                            articleTable.getArticles();
                            inputExcel.value = '';
                        }
                    }
                });
            }

        },
        exportPDF: function () {
            var columns = ["ID", "Nombre", "Descripción", "Cantidad", "Precio unitario", "Precio total"];

            var rows = [];
            articleTable.products.forEach(element => {
                rows.push([
                    element.article_id,
                    element.name,
                    element.description,
                    element.amount,
                    '$'+element.price,
                    '$'+element.price * element.amount
                ]);
            });
            
            var doc = new jsPDF('p', 'pt');
            doc.autoTable(columns, rows);
            doc.save('misProductos.pdf');
                        
        }
    }
});

const logout = document.getElementById('logout');
logout.onclick = function () {
    fetch(URL+'/api/auth/logout',{
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
