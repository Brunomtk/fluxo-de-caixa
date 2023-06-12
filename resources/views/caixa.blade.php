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

        .coluna2{
            min-width: 30%;
            height: 40px;
        }

        .coluna3{
            min-width: 10%;
            height: 40px;
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
            display:block;
            border-radius: 50%;
            height: 50px;
            width: 50px;
            text-align: center;
        }

        td, th {
        border: 2px solid #073a7d;
        text-align: left;
        padding: 8px;
        color: #000000;
        }

        th{
            background-color: #1983e6; 
        }

        tr:nth-child(even) {
        background-color: #1983e6;
        }

        th:tr:nth-child(odd) {
        background-color: #ffffff;
        }

        h2 {
            text-align: center;
            color: #000000;   
        }

        label{
            text-align: right; 
            padding-top: 20px;
            color: #073a7d;
        }

    </style>

    </head>
    
    <body>


        <?php
            use App\Models\Categoria;            
            use App\Models\Caixa;
            $contador = Caixa::count();
            $categorias = Categoria::all();
            $contador_cat = Categoria::count();
            $entrada = 0;
            $saida=0;
        ?>

        <div style=  "padding-left: 5%; padding-right: 5%; padding-top: 2%"> <!-- Todo o conteudo ta dentro dessa div que deixa ajeitadinho -->

            <h2 style= "padding-top: 5px">Caixa</h2>

            <br>    <!-- Essa função é como se fosse um ENTER, pula uma linha -->

            <!-- Barra de Pesquisa -->
            <form action="{{action('CaixaController@buscarcaixa')}}" method="POST">
                {{csrf_field()}}
                <div class="row">
                    <div class="form-group row" style="float:left; padding-left:2.5%">
                        <label for="text" class="col-form-label col-sm-0.5">Pesquisar</label>
                        <div class="col-sm-2.5" style="padding-left:1%">
                            <input type="text" autocomplete="off" class="form-control input-sm" id="nomebuscacaixa" name="nomebuscacaixa" nullable/>
                        </div>
                        <label for="date" class="col-form-label col-sm-0.5" style="padding-left:1%">de</label>
                        <div class="col-sm-2.5" style="padding-left:1%">
                            <input type="date" class="form-control input-sm" id="fromcaixa" name="fromcaixa" required/>
                        </div>
                        <label for="date" class="col-form-label col-sm-0.5" style="padding-left:1%">até</label>
                        <div class="col-sm-2.5" style="padding-left:1%">
                            <input type="date" class="form-control input-sm" id="tocaixa" name="tocaixa" required/>
                        </div>
                        <div class="col-sm">
                            <button type="submit" class="btn rounded-pill" name="buscarcaixa" title="search" style= "background-color: #1983e6 ;color: white">Buscar</button>
                        </div>
                    </div>
                </div>
            </form>

            <br>
            <!-- Fim da barra de pesquisa -->

            <!-- Filtros de tags-->
            <div class= "container">
                <div class="row">
                    <div class="form-group row" style="float:left; width: 100%;">
                        @if($contador_cat > 0)
                            <div class="col-sm-0.5" style="
                            display: flex; flex-direction: column; align-items: center;">
                                <label>Filtragem por Categoria</label>
                                <form action="{{action('CaixaController@filtroCategorias')}}" method="POST">
                                        {{csrf_field()}}
                                        <select name="categoria" class="btn btn-secondary dropdown-toggle" id="selectcats" onchange="this.form.submit()" style="background-color: #1983e6; color:white">
                                            <option selected>Selecione...</option>
                                            <option value="all">Todas</option>
                                            @foreach($categorias as $categoria)
                                                <option value={{$categoria->nome}}>{{$categoria->nome}}</option>
                                            @endforeach
                                        </select>
                                </form>                                    
                            </div>
                        @endif
                        <div class="col-sm-0.5" style="padding-left: 4%;  display: flex; flex-direction: column; align-items: center; ">
                                <label>Filtragem por Operação</label>
                                <form action="{{action('CaixaController@filtroOperacao')}}" method="POST">
                                        {{csrf_field()}}
                                        <select name="operacao" class="btn btn-secondary dropdown-toggle" id="selectcats" onchange="this.form.submit()" style="background-color: #1983e6; color:white">
                                            <option selected>Selecione...</option>
                                            <option value="all">Todas</option>
                                            <option value="Compra">Compra</option>
                                            <option value="Venda">Venda</option>
                                        </select>
                                </form>  
                        </div>
                        <div class="col-sm-0.5" style="padding-left: 4%;  display: flex; flex-direction: column; align-items: center; ">
                            <label>Gráficos</label>
                            <a class="nav-link" href="{{asset('graficos')}}">  <!-- href deve ser o nome da rota que esta em web.php -->
                                <i class="bi bi-pie-chart-fill"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fim filtro de tags -->

            <br>

            <!-- função contador, autoexplicativa -->
            @if($contador==0) 
            <p style= "text-align: center">Nenhum produto foi cadastrado</p>
            @else
            
            <!-- Tabela -->
            <table id="tabela">
                <thead>
                    <tr>
                        <th class="coluna1">Data e Hora</th>
                        <th class="coluna2">Item</th>
                        <th class="coluna3">Operação</th>
                        <th class="coluna3">Quantidade</th>
                        <th class="coluna4">Preço</th>
                    </tr>
                </thead>
                <tbody>
                     @foreach($produtos as $produto)
                    <?php 
                        $entrada += floatval($produto->preco)*floatval($produto->quantidade); ?>
                    <tr>
                        <td class="coluna1"><b>{{$produto->created_at}}</b></td>
                        <td class="coluna2"><b>{{$produto->nome}}</b></td>
                        <td class="coluna3"><b>{{$produto->operacao}}</b></td>
                        <td class="coluna3"><b>{{$produto->quantidade}}</b></td>
                        <td class="coluna4"><b>R$<?php echo number_format($produto->preco, 2, ',', '.'); ?></b></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Fim tabela -->
            @endif

            <!-- SALDO-->
            <div style= "text-align: right; padding-top: 20px">
                <?php
                        $entrada = str_replace(".", ",", $entrada); // replace '.' with ','
                ?>
                <p style="color: black"><b>Saldo em caixa: {{$entrada}} R$</b></p>
            </div>
        </div>
    </body>
    

</html>


@endsection