@extends('layouts.template_base')

@section('content')
<!DOCTYPE html>
<html>

    <head>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    </head>
    <body>

        <?php
            use App\Models\Produto;
            $contador = Produto::count();

            use App\Models\Categoria;
            $categorias = Categoria::all();
            $contador_cat = Categoria::count();
        ?>



        <!-- Titulo -->   
        <div style=  "padding-left: 5%; padding-right: 5%; padding-top: 2%">
            <h2 style= "padding-top: 5px">Estoque</h2>
            <br> <!-- Pula linha -->


            <!-- barra de pesquisa -->
            <head>
                <style> 
                    input[type=text] {
                        width: 100%;
                        border: 2px solid #ccc;
                        border-radius: 20px;
                        background-color: white;
                        background-image: url("images/lupa.png");
                        background-repeat: no-repeat;
                        padding: 10px 20px 10px 40px;
                    }
                    input:focus, select:focus
                    {
                        box-shadow: 0 0 0 0;
                        outline: 0;
                    }
                </style>
            </head>
<!--  ---------------------------------------------------------------------------------------------------------------    -->
<!--  ---------------------------------------------------------------------------------------------------------------    -->
    <!--                                               Barra de pesquisa                                            -->
<!--  ---------------------------------------------------------------------------------------------------------------    -->
<!--  ---------------------------------------------------------------------------------------------------------------    --> 
            <form method="POST" action="{{action('ProdutosController@buscarestoque')}}">
            {{csrf_field()}}
                <div class="form-group row" style="display: flex; justify-content: center;">

                    <div class="col-sm-2.5" style="padding-left:1%; display: flex; width: 70%">
                        <input autocomplete="off" type="text" class="typeahead form-control input-sm" id="nomebuscaestoque" name="nomebuscaestoque" placeholder="Procurar item" nullable/>
                        <button type="submit" class="btn btn-secondary"  style="background-color: #073a7d; margin-left: 10px"><i class="fas fa-search"></i></button>
                    </div>

                </div>
            </form>

            <br>

<!--  ---------------------------------------------------------------------------------------------------------------    -->
<!--  ---------------------------------------------------------------------------------------------------------------    -->
    <!--                                               Inserir filtos de tags                                             -->
<!--  ---------------------------------------------------------------------------------------------------------------    -->
<!--  ---------------------------------------------------------------------------------------------------------------    --> 
            

            <div class="row">
                <div class="form-group row" style="float:left; padding-left:2.5%">
                        <div class="col-sm-0.5">
                            <button class="btn btn-secondary dropdown-toggle" style="background-color: #073a7d; margin-right: 5px" type="button" id="dropdownMenuButtonCaixa1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Filtros
                            </button>
                            <div class="dropdown-menu" aria-labelledby="#dropdownMenuButtonCaixa1">
                                   <a class="dropdown-item" href="/public/estoque-ordem">Ordem alfabética</a>   
                                   <a class="dropdown-item" href="/public/estoque-preco">Preço</a>
                                   <a class="dropdown-item" href="/public/estoque-quantidade">Quantidade</a>
                                   <a class="dropdown-item" href="/public/estoque-validade">Data de Validade</a>
                            </div>
                        </div>
                        <!-- Botão de criar novo produto -->
                        <div class="col-sm-0.5">
                            <button type="button" class="btn btn-info" style="background-color: #073a7d" data-toggle="modal" data-target="#exampleModal">
                            Adicionar Novo Produto
                            </button>
                
                            <button type="button" class="btn btn-info" style="background-color: #073a7d" data-toggle="modal" data-target="#modalCategoria">
                                Adicionar Nova Categoria
                            </button>

                            <button type="button" class="btn btn-info" style="background-color: #073a7d" data-toggle="modal" data-target="#modalRepor">
                                Repor Produtos
                            </button>

                            <button type="button" class="btn btn-info" style="background-color: #073a7d" data-toggle="modal" data-target="#modalRetirada">
                                Retirada de Produtos
                            </button>
                        </div>
                        
                </div>
            </div>   

            <br>
<!--  ---------------------------------------------------------------------------------------------------------------    -->
<!--  ---------------------------------------------------------------------------------------------------------------    -->
    <!--                                               Início tabela                                             -->
<!--  ---------------------------------------------------------------------------------------------------------------    -->
<!--  ---------------------------------------------------------------------------------------------------------------    --> 


            <!-- Início tabela -->
            <table>
                <thead>
                    <tr> <!-- Tr Linha -->
                        <!-- Th Cabecalho -->
                        <th class="coluna1">Item</th>
                        <th class="coluna2">Quantidade</th>
                        <th class="coluna3">Preço</th>
                        <th class="coluna3">Data de Compra</th>
                        <th class="coluna3">Data de Validade</th>
                        <th class="coluna3">Editar</th>
                        <th class="coluna3">Deletar</th>
                    </tr>
                </thead>
                <tbody>
                    @if($contador == 0)
                        <tr>
                            <td>
                                Nenhum produto cadastrado.
                            </td>
                        </tr>
                    @else
                        @foreach($produtos as $produto)
                        <tr>
                            <td class="coluna1">{{$produto->nome}}</b></td>
                            <td class="coluna2">{{$produto->quantidade}}</td>
                            <td class="coluna3">R$<?php echo number_format($produto->preco, 2, ',', '.'); ?></td>
                            @if($produto->datacompra == null)
                                <td class="coluna3">Sem data de compra</td>
                                <td class="coluna2">Sem data de validade</td>
                            @else
                                <td class="coluna3">{{Carbon\Carbon::parse($produto->datacompra)->format('d/m/Y')}}</td>
                                <td class="coluna2">{{Carbon\Carbon::parse($produto->dataval)->format('d/m/Y')}}</td>
                            @endif
                            <td class="borda" style="text-align: center;">                        
                                <button type="button" class="btn btn-info"  data-toggle="modal" data-target="#modaleditprodutos{{$produto->id}}">EDITAR</button>  
                            </td>
                            <td class="borda" style="text-align: center;">
                                <form method="post" action="{{action([App\Http\Controllers\ProdutosController::class, 'destroy'] ,$produto->id)}}">
                                    {{csrf_field()}} {{method_field('DELETE')}}
                                    <button onclick="return confirm('Tem certeza que deseja excluir?')" class="btn btn-danger" type="submit">DELETAR</button>
                                </form>
                            </td>
                        </tr>
                                        <!-- Modal de Editar Produtos -->
                                            <div class="modal fade" id="modaleditprodutos{{$produto->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Editar Novo Produto</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                
                                                        <p>Produtos cadastrados: <?php echo $contador;?></p>
                                                
                                                        <form action="{{action([App\Http\Controllers\ProdutosController::class, 'update'] ,$produto->id)}}" method="POST" enctype="multipart/form-data">
                                                            {{csrf_field()}}
                                                            {{method_field('PUT')}}        
                                                            <div class="form-group">
                                                                <label>Nome</label>
                                                                <input type="text" required class="form-control typeahead" name="nome" autocomplete="off" value="{{$produto->nome}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Preço</label>
                                                                <input type="number" required step=".01" class="form-control" name="preco" value="{{$produto->preco}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Categoria</label>
                                                                @if($contador_cat == 0)
                                                
                                                                <input type="text" disabled class="form-control is-invalid" name="categoria" value="{{$produto->categoria}}">
                                                                <div id="tooltip" class="invalid-feedback">
                                                                    É preciso ter ao menos uma categoria para adicionar um produto. Clique em "Adicionar Nova Categoria" para adicioná-la!
                                                                </div>
                                                
                                                                @else
                                                
                                                                <select class="custom-select" class="form-control" name="categoria" required>
                                                                    <option selected>Selecione...</option>
                                                
                                                                    @foreach($categorias as $categoria)
                                                                        <option value={{$categoria->nome}}>{{$categoria->nome}}</option>
                                                                    @endforeach
                                                                </select>
                                                
                                                                @endif
                                                
                                                            </div>
                                                            <label>Possui validade?</label>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" id="inlineRadio1" value="a" name="inlineRadio1">
                                                                <label class="form-check-label" for="inlineRadio1">Sim</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" id="inlineRadio2" value="b" name="inlineRadio1">
                                                                <label class="form-check-label" for="inlineRadio2">Não</label>
                                                            </div>

                                                            <div class="form-group div-hidden" style="display:none;">
                                                                <label>Data de Compra do Produto</label>
                                                                <input type="date" name="datacompra" class="form-control" name="quantidade" value="{{$produto->datacompra}}">
                                                            </div>
                                                            <div class="form-group div-hidden" style="display:none;">
                                                                <label>Data de Validade</label>
                                                                <input type="date" name="dataval" class="form-control" name="quantidade" value="{{$produto->dataval}}" >
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Quantidade</label>
                                                                <input type="number" class="form-control" name="quantidade" value="{{$produto->quantidade}}" required>
                                                            </div>
                                                            
                                                            <button type="submit"  style="margin-left: 75%;" class="botao">Salvar</button>

                                                        </form>
                                                        </div>
                                                        
                                                    </div>
                                                    </div>
                                                    
                                            </div>

                        @endforeach
                    @endif

                </tbody>
            </table>
            <!-- Final tabela -->
        </div>

<!--  ---------------------------------------------------------------------------------------------------------------    -->
<!--  ---------------------------------------------------------------------------------------------------------------    -->
    <!--                                               MODALS                                             -->
<!--  ---------------------------------------------------------------------------------------------------------------    -->
<!--  ---------------------------------------------------------------------------------------------------------------    --> 




<!-- Modal de Cadastro de Novos Produtos -->

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Adicionar Novo Produto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
            
                    <p>Produtos cadastrados: <?php echo $contador;?></p>
            
                    <form action="{{action('ProdutosController@store')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}        
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" required class="form-control typeahead" name="nome" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label>Preço</label>
                            <input type="number" required step=".01" class="form-control" name="preco">
                        </div>
                        <div class="form-group">
                            <label>Categoria</label>
                            @if($contador_cat == 0)
            
                            <input type="text" disabled class="form-control is-invalid" name="categoria">
                            <div id="tooltip" class="invalid-feedback">
                                É preciso ter ao menos uma categoria para adicionar um produto. Clique em "Adicionar Nova Categoria" para adicioná-la!
                            </div>
            
                            @else
            
                            <select class="custom-select" class="form-control" name="categoria" required>
                                <option selected>Selecione...</option>
            
                                @foreach($categorias as $categoria)
                                    <option value="{{$categoria->nome}}">{{$categoria->nome}}</option>
                                @endforeach
                            </select>
            
                            @endif
            
                        </div>
                        <label>Possui validade?</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="inlineRadio1" value="a" name="inlineRadio1">
                            <label class="form-check-label" for="inlineRadio1">Sim</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="inlineRadio2" value="b" name="inlineRadio1">
                            <label class="form-check-label" for="inlineRadio2">Não</label>
                        </div>

                        <div class="form-group div-hidden" style="display:none;">
                            <label>Data de Compra do Produto</label>
                            <input type="date" name="datacompra" class="form-control" name="quantidade">
                        </div>
                        <div class="form-group div-hidden" style="display:none;">
                            <label>Data de Validade</label>
                            <input type="date" name="dataval" class="form-control" name="quantidade">
                        </div>

                        <div class="form-group">
                            <label>Quantidade</label>
                            <input type="number" class="form-control" name="quantidade" required>
                        </div>
                        
                        <button type="submit"  style="margin-left: 75%;" class="botao">Adicionar</button>

                    </form>
                    </div>
                    
                </div>
                </div>
                
        </div>


{{-- <!--  ---------------------------------------------------------------------------------------------------------------    -->
<!--  ---------------------------------------------------------------------------------------------------------------    -->
    <!--                                              Modal da Categoria                                              -->
<!--  ---------------------------------------------------------------------------------------------------------------    -->
<!--  ---------------------------------------------------------------------------------------------------------------    -->
 --}}


        {{-- Modal da Categoria --}}
        <div class="modal fade" id="modalCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Nova Categoria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form action="{{action('CategoriasController@store')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}        
                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" required class="form-control" name="nome" autocomplete="off">
                        
                    </div>
                    <button type="submit"  style="margin-left: 75%;" class="botao">Adicionar</button>
                </form>
                    <!-- Divisoria  -->
               
                    <div class="divisoria"></div>
                    <h5 class="bordas" style= "display: flex;  justify-content: center;" >Tabela de Categorias</h5>
        <body>

        <!-- Tabela  -->
        
        <div id="container">
            <div id="tabela">
                <table class="table borda">
                    <thead id="barra-titulo2">
                        <tr>
                            <th class="borda" scope="col">Categoria</th>
                            <th class="borda" style="text-align: center; width: 4%;" scope="col">Editar</th>
                            <th class="borda" style="text-align: center; width: 4%;" scope="col">Excluir</th>
                        </tr>
                    </thead>

                    <tbody>

                      @foreach($categorias as $categorias)
                        <tr>
                            <td style="text-align: center;" class="borda">{{$categorias->nome}}</td>
                            <td class="borda" style="text-align: center;">                        
                                <button type="button" class="btn btn-info"  data-toggle="modal" data-target="#modaledit{{$categorias->id}}">EDITAR</button>
                        </td>
                        <td class="borda" style="text-align: center;">
                            <form method="post" action="{{action([App\Http\Controllers\CategoriasController::class, 'destroy'] ,$categorias->id)}}">
                                {{csrf_field()}} {{method_field('DELETE')}}
                                <button onclick="return confirm('Tem certeza que deseja excluir?')" class="btn btn-danger" type="submit">DELETAR</button>
                            </form>
                        </td>
                        </tr>
                                    {{-- <!--  ---------------------------------------------------------------------------------------------------------------    -->
                                    <!--  ---------------------------------------------------------------------------------------------------------------    -->
                                        <!--                                              Modal da EDITAR                                              -->
                                    <!--  ---------------------------------------------------------------------------------------------------------------    -->
                                    <!--  ---------------------------------------------------------------------------------------------------------------    -->  --}}

                                    <!-- Modal de editar de Novos Produtos -->
                                    <div class="modal fade modaleditar2" id="modaledit{{$categorias->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                    <div class="modal-content" style="background-color:#f2f2f2;">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel" style= "color:#000;">Editar o Categoria</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                
                                                        
                                                
                                                        
                                                        <form method="post" action="{{action([App\Http\Controllers\CategoriasController::class, 'update'] ,$categorias->id)}}">
                                                            {{csrf_field()}}
                                                            {{method_field('PUT')}}        
                                                            <div class="form-group">
                                                                <label style= "color:#000;">Nome</label>
                                                                <input style= "color:#000;" type= "text" class= "form-control" name="nomecat" value="{{$categorias->nome}}">
                                                            </div>
                                                            
                                                            <button type="submit"  style="margin-left: 75%;" class="botao">Salvar</button>

                                                        </form>
                                                        </div>
                                                        
                                                    </div>
                                                    </div>
                                                    
                                            </div>
                      @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
        </body>  
                </form>
                </div>
                
            </div>
            </div>
        </div>
{{-- <!--  ---------------------------------------------------------------------------------------------------------------    -->
<!--  ---------------------------------------------------------------------------------------------------------------    -->
    <!--                                              Modal da Reposição                                              -->
<!--  ---------------------------------------------------------------------------------------------------------------    -->
<!--  ---------------------------------------------------------------------------------------------------------------    --> --}}


        <div class="modal fade" id="modalRepor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Repor Produtos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{action('ProdutosController@repor')}}">
                        {{csrf_field()}}
                                    <div class="form-group">
                                        <input autocomplete="off" type="text" class="typeahead form-control input-sm" id="busca_repor" name="busca_repor" placeholder="Procurar item" nullable required/>
                                    </div>
                                    <div class="form-group">
                                        <label>Quantidade Recebida</label>
                                        <input type="number" class="form-control" name="qtd_repor" required>
                                    </div>
                                    <div class="form-group">
                                            <label>Preço Unitário</label>
                                            <input type="number" required step=".01" class="form-control" name="preco_repor">
                                    </div>

                                    <button type="submit" class="btn btn-secondary"  style="background-color: #073a7d; margin-left: 10px">Adicionar</button>
                        </form>
                    </div>
                    
                </div>
                </div>
        </div>  
        
        
{{-- <!--  ---------------------------------------------------------------------------------------------------------------    -->
<!--  ---------------------------------------------------------------------------------------------------------------    -->
    <!--                                              Modal da Retirada                                              -->
<!--  ---------------------------------------------------------------------------------------------------------------    -->
<!--  ---------------------------------------------------------------------------------------------------------------    -->         --}}




        <div class="modal fade" id="modalRetirada" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Retirada de Produtos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{action('ProdutosController@retirar')}}">
                    {{csrf_field()}}
                                    <div class="form-group">
                                        <input autocomplete="off" type="text" class="typeahead form-control input-sm" id="busca_repor" name="busca_retirada" placeholder="Procurar item" nullable required/>
                                    </div>
                                    <div class="form-group">
                                        <label>Quantidade Retirada</label>
                                        <input type="number" class="form-control" name="qtd_retirada" required>
                                    </div>

                                    <button type="submit" class="btn btn-secondary"  style="background-color: #073a7d; margin-left: 10px">Adicionar</button>
                        </form>
                    </div>
                    
                </div>
                </div>
        </div>   











<!--  ---------------------------------------------------------------------------------------------------------------    -->
<!--  ---------------------------------------------------------------------------------------------------------------    -->
    <!--                                              FIM DOS MODALS                                           -->
<!--  ---------------------------------------------------------------------------------------------------------------    -->
<!--  ---------------------------------------------------------------------------------------------------------------    --> 








        <script>
            var path = "{{ route('autocomplete')  }}";
            $('input.typeahead').typeahead({
                source:  function (query, process) {
                return $.get(path, { term: query }, function (data) {
                        return process(data);
                    });
                }
            });

            $("input[name='inlineRadio1']").click(function () {
                $('.div-hidden').css('display', ($(this).val() === 'a') ? 'block':'none');
            });

        </script>

    </body>







</html>
{{-- <!--  ---------------------------------------------------------------------------------------------------------------    -->
<!--  ---------------------------------------------------------------------------------------------------------------    -->
    <!--                                               STYLE                                             -->
<!--  ---------------------------------------------------------------------------------------------------------------    -->
<!--  ---------------------------------------------------------------------------------------------------------------    --> --}}

        <style>

            table {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                border-collapse: collapse;
                width: 100%;
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
                color: #000000    
            }

            form{
                padding-right: 5px;
            }

            .botao {
                padding: 10px 15px;
                text-align: center;
                background-color: #073A7D;
                color: white;
                margin-left: 75%;
                border-radius: 5px;
            }
            .divisoria{
                height: 5px;
                width: 100%;
                background: rgb(246,246,246);
                background: linear-gradient(90deg, rgba(246,246,246,1) 0%,#073a7d, rgba(246,246,246,1) 100%);
                margin-bottom: 30px;
                margin-top: 50px;
            }    
            .modaleditar2{
                padding:100px;
                
                

            }         

        </style>
@endsection