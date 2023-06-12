@extends('layouts.template_base')

@section('content')
<!DOCTYPE html>
<html>
    <head>
    <style>
        table {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }

        button {
        background-color: #073a7d; /* Blue */
        border: none;
        color: white;
        padding: 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        outline: none !important;
        }
        .coluna1{
            min-width: 30%;
            height: 40px;
        }
        .adjust{
            width: 100%;
            display: flex;
            flex-direction: column;
            flex-wrap: wrap;
            align-content: stretch;
            align-items: center;
            justify-content: space-evenly;
        }

        .coluna2{
            min-width: 30%;
            height: 40px;
        }

        .coluna3{
            min-width: 10%;
            height: 40px;
        }

        .center {
            margin: auto;
            padding: 10px;
        }

        .coluna4{
            min-width: 10%;
            height: 40px;
        }

        .coluna5{
            min-width: 20%;
            text-align: center;
            height: 40px;

        }

        .button1 {
            border-radius: 50%;
        }

        td, th {
        border: 1px solid #000000;
        text-align: left;
        padding: 8px;
        color: #000000;
        }

        tr:nth-child(even) {
        background-color: #073a7d;
        }

        h2 {
            text-align: center;
            color: #000000;   
        }

        label{
            text-align: right; 
            padding-top: 20px;
            color: #000000;
        }

    </style>       
    </head>
    <body>
        
        <!-- Fim gráfico de barras -->

        <!-- declaração de variaveis em php -->
        <?php
            use App\Models\Caixa;
            $contador = Caixa::count();
            $saldo = $entradas + $saidas;
        ?>

        <div style=  "padding-left: 5%; padding-right: 5%; padding-top: 2%">

            <h2 style= "padding-top: 5px">Gráficos</h2>

            <br>    <!-- Essa função é como se fosse um ENTER, pula uma linha -->

            <!-- função contador, autoexplicativa -->

            <!-- Barra de Pesquisa -->
            <form action="{{action('CaixaController@buscargraficos')}}" method="POST">
                {{csrf_field()}}
                <div class="row" style="display: flex;text-align: center;align-content: stretch;flex-direction: column;align-items: center;">
                    <div class="form-group row" style="float:left; padding-left:2.5%">
                        <label for="date" class="col-form-label col-sm-0.5" style="padding-left:1%">Mês Selecionado:</label>
                        <div class="col-sm-2.5" style="padding-left:1%">
                            <input type="month" onchange="console.log(event);" class="form-control input-sm" id="mes" name="mes" required/>
                        </div>
                        <div class="col-sm">
                            <button type="submit" class="btn rounded-pill" title="search" style= "color:black">Buscar</button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Fim da barra de pesquisa -->

            <br>
            <br>

            <div class= "center adjust" >
                <div id="columnchart_values" style="padding: 20px;"></div> <!-- Chama o grafico de colunas, la embaixo -->
                <div id="piechart" style="padding:20px; "></div> <!-- Chama o grafico de pizzas, la embaixo -->
            </div>
            
            <!-- Inserir Saldo e forms do saldo-->
            <div style= "text-align: right; padding-top: 20px">
                <p style= "color:black"><b>Saldo: {{$saldo}} R$</b></p>
            </div>
        </div>



        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Para utilizar gráficos do chart.js -->
        
        <!-- GRÁFICO DE BARRAS -->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">

            var jobs = <?php echo json_encode($maisvendidos) ?>;
            console.log(jobs);

            google.charts.load("current", {packages:['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var dados = [['Nome', 'Quantidade', { role: 'style' }]];
                var i = 0;
                
                if(window.location.pathname.includes('graficos')){
                    dados.push(['Selecione um Mês', 1, '#3366cc']);
                }
                else{
                    for (; i < jobs.length; i++) {
                        dados.push([jobs[i].nome, jobs[i].quantidade, '#3366cc']);
                    }
                }
                console.log(dados)
                

                var data = google.visualization.arrayToDataTable(dados);

                var view = new google.visualization.DataView(data);
                view.setColumns([0, 1,
                {   calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation" },
                2]);

                var options = {
                    title: "Produtos mais vendidos do mês",
                    width: 600,
                    height: 400,
                    bar: {groupWidth: "95%"},
                    legend: { position: "none" },
                };

                var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
                chart.draw(view, options);
            }
        </script> 
        <!--  FIM GRAFICO DE BARRAS -->
          
          
        <!-- GRAFICO DE PIZZA -->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                
            var entradas = {{$entradas}}
            var saidas = {{$saidas}}

            if(entradas == 0 || saidas == 0){
                entradas = 50;
                saidas = 50;
            }

            var data = google.visualization.arrayToDataTable([
                ['Tipo', 'Valor'],
                ['Entradas', entradas],
                ['Saidas', saidas],
            ]);

            var options = {
                title: 'Fluxo de caixa do mês escolhido',
                width: 600,
                height: 400,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
        </script>
        
    </body>
</html>
@endsection