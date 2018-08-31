const selectPie = document.getElementById('selectPie');
const optionsTag = document.getElementsByTagName("option");

selectPie.onchange = function () {
    // Load the Visualization API and the corechart package.
    google.charts.load('current', {'packages':['corechart']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart.bind(null,selectPie.value,optionsTag[selectPie.value].text));
}

// Load the Visualization API and the corechart package.
google.charts.load('current', {'packages':['corechart']});

// Set a callback to run when the Google Visualization API is loaded.
google.charts.setOnLoadCallback(drawChart.bind(null,0,optionsTag[0].text));

// Callback that creates and populates a data table,
// instantiates the pie chart, passes in the data and
// draws it.
function drawChart(option, title) {

    // Create the data table.

    let data = createData(option)
    // Set chart options

    var options = {
        'title':title,
        'width':600,
        'height':420
    };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
    chart.draw(data, options);
}

function createData(option) {

    let data = new google.visualization.DataTable();
    let prods = articleTable.products;
    let row;
    let rows = [];

    switch (option) {
        case '0':
            for (let pro in prods) {
                row = [prods[pro].name , prods[pro].amount]
                rows.push(row);
            }

            data.addColumn('string', 'Producto');
            data.addColumn('number', 'Cantidad');

            data.addRows(rows);
            break;
        case '1':
            for (let pro in prods) {
                row = [prods[pro].name , parseFloat(prods[pro].price)]
                rows.push(row);
            }

            data.addColumn('string', 'Producto');
            data.addColumn('number', 'Precio unitario');

            data.addRows(rows);
            break;

        case '2':

            for (let pro in prods) {
                row = [prods[pro].name , parseFloat(prods[pro].price) * prods[pro].amount]
                rows.push(row);
            }

            data.addColumn('string', 'Producto');
            data.addColumn('number', 'Precio total');

            data.addRows(rows);

            break;
        default:
            for (let pro in prods) {
                row = [prods[pro].name , prods[pro].amount]
                rows.push(row);
            }

            data.addColumn('string', 'Producto');
            data.addColumn('number', 'Cantidad');

            data.addRows(rows);

    }
    
    return data;
}
