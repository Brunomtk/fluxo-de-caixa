var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {

    type: 'line',
    data: {
        labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril'],
        datasets: [{
            label: "Dataset",
            backgroundColor: 'rgb(255,90,132)',
            borderColor: 'rgb(255,99,132)',
            data: [0,10,5,2]
        }]
    },

    options: {}
});