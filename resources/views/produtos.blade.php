@extends('layouts.template_base')

@section('content')
    
<?php   
  use App\Models\Produto;
  $contador = Produto::count();

  use App\Models\Categoria;
  $categorias = Categoria::all();
  $contador_cat = Categoria::count();

  use App\Models\Carrinho;
  $contadorC = Carrinho::count();
  $carrinhos = Carrinho::all();

  $entrada = 0;
  $saida = 0;
?>
<style>

    .botao {
        padding: 10px 15px;
        text-align: center;
        background-color: #00a289;
        color: white;
        margin-left: 85%;
        border-radius: 20px;
    }



</style>
    
<!-- Barra de pesquisa animada -->
<head>
  <style> 
    img {
  
      border: 5px;
      align-items: center
      
    }

    h5 {
        border: 15px;
        color: #073a7d;
        padding: 10px;
        text-align: center
    }

    h3 {
      text-align: center;
      color: #000000; 
    }

    p {
        border: 10px;
        color: #777777;
        padding: 15px;
        text-align: center
    }

    h2 {
        text-align: center;
        color: #000000; 
    }

    input[type=text] {
        width: 100%;
        box-sizing: border-box;
        border: 2px solid #ccc;
        border-radius: 20px;
        font-size: 16px;
        background-color: white;
        background-image: url("images/lupa.png");
        background-size: 23px;
        background-position: 10px 10px;
        background-repeat: no-repeat;
        padding: 10px 20px 10px 40px;
    }
    input:focus, select:focus
    {
        box-shadow: 0 0 0 0;
        outline: 0;
    }
  </style>

  <script>

    function limpar() {

      //setInterval(function(){ document.getElementById('confirmar').value=''; }, 3000);
      setInterval(function(){ $("input").val("");
        $("table").val(""); }, 3000);

    }

  </script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
</head>

    
<div style= "padding-left: 5%; padding-right:5%; padding-top:2%"> 
    <h2 style= "padding-top: 5px; padding-bottom: 8px">Produtos</h2>
  <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">

    <div style="display:flex; width: 100%; height: 30px">
      <div style="width: 100%">
        {{-- Barra de Pesquisa --}}
        <form method="POST" action="{{action('ProdutosController@Buscar')}}">
        {{csrf_field()}}
          <div class="form-group row" style="display: flex; justify-content: center;">

              <div class="col-sm-2.5" style="padding-left:1%; display: flex; width: 70%">
                  <input autocomplete="off" type="text" class="typeahead form-control input-sm" id="Busca" name="Busca" placeholder="Procurar item" nullable/>
                  <button type="submit" class="btn btn-secondary"  style="background-color: #073a7d; margin-left: 10px"><i class="fas fa-search"></i></button>
              </div>

          </div>
        </form>
        <!-- Fim da barra de pesquisa -->
      </div>
      <div style="display:flex; width: 25%; height:40px; justify-content: flex-end; align-items: center;">
        <!-- Botão do carrinho -->
        <button type="submit" class="btn btn-info" style="margin-right: 5%; float: right;" data-toggle="modal" data-target="#exampleModal2"> 
          Carrinho <i class="fas fa-shopping-cart" ></i> 
        </button>
        <!-- Fim do botão do carrinho -->

      </div>
    </div>
  </div>

  <!-- Modal do carrinho -->

  <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Carrinho</h5>
            <button type="botao" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

         <!-- colocar a tabela + saldo + finalizar compra -->
            <!-- Tabela -->

    <table class="table table-info table-striped" id='confirmar'> <!-- Esse striped é pra tabela inverter cores e o info é a cor base -->
      <thead>
        <tr> <!-- tr é o cabeçalho da tabela -->
          <th scope="col">Nome</th>
          <th scope="col">Quantidade</th>
          <th scope="col">Preço</th>
          <th scope="col"></th>
          <th scope="col"></th>
          
        <tr>
      </thead>
      <tbody>
        @if($contadorC == 0)
        <tr>
            <td>
                Nenhum produto no carrinho.
            </td>
        </tr>

        @else

          @foreach($carrinhos as $carrinho)
            <?php
              $produtoselecionado = Produto::where('id', 'LIKE', $carrinho->produtoid)->first();

              $produtoselecionado->preco = str_replace(",", ".", $produtoselecionado->preco); // replace ',' with '.'
              $entrada += floatval($produtoselecionado->preco)*floatval($carrinho->quantidade);
            ?>

            <tr>
              <td><b>{{$produtoselecionado->nome}}</b></td>
              <td>{{$carrinho->quantidade}}</td>
              <td>{{$produtoselecionado->preco}}</td>
              
                
              <td>


                <form action="{{action('CarrinhosController@update', $carrinho->id)}}" method="POST">
                  {{csrf_field()}}
                  {{method_field('PUT')}}
                  <input type="hidden" name="produtoid" value="{{$carrinho->produtoid}}">
                  
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalExemplo{{$carrinho->id}}"> Editar </button>

                  <div class="modal fade" id="modalExemplo{{$carrinho->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Editar quantidade</h5>
                          <button type="button" class="close close-ambiente" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <input type="text" name="quantidade" id="edit" value="{{$carrinho->quantidade}}">
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary close-ambiente" data-target="#modalExemplo" data-dismiss="modal" >Fechar</button>
                          <button type="submit" class="btn btn-info">Salvar mudanças</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                </form>

              </td>

              <td>    
                <form action="{{action('CarrinhosController@destroy', $carrinho->id)}}" method="POST">
                  {{csrf_field()}}
                  {{method_field('DELETE')}}
                  <button type="submit" class="btn btn-dark" onclick="return confirm('Tem certeza que deseja Excluir?')">Excluir</button>
                </form>
              </td>
     

            </tr> 
          @endforeach
        @endif
      </tbody>
    </table>
  
    <!-- Fim da tabela -->
        
  
           <!-- Dropdown formas de pagamento -->
           <div class="row">
                <div class="form-group row" style = "padding-left:5%">
                        <div class="col-sm-0.5">
                            <button class="btn btn-secondary dropdown-toggle" style="background-color: #073a7d" type="button" id="dropdownMenuButtonCaixa1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Formas de Pagamento
                            </button>
                            <div class="dropdown-menu" aria-labelledby="#dropdownMenuButtonCaixa1">
                                    <a class="dropdown-item" ></a>
                                   <a class="dropdown-item" href='#'>Crédito</a>   
                                   <a class="dropdown-item" href="#">Débito</a>
                                   <a class="dropdown-item" href="#">Dinheiro</a>
                            </div>
                        </div>
                </div>
            </div>  

            <!-- Saldo da compra -->
            <div style= "text-align: right; padding-top: 20px">
              <?php
                      $entrada = str_replace(".", ",", $entrada); // replace '.' with ','
              ?>
              <p style="color: black"><b>Saldo: {{$entrada}} R$</b></p>
            </div>

            <!-- Função comprar - finaliza a compra, reduz o estoque -->
            <form action="{{action('CarrinhosController@comprar')}}" method="POST">
              {{csrf_field()}}

              <button type="submit" class="btn btn-info" style="background-color: #073a7d" onclick="limpar()">Finalizar Compra</button> 

              

            </form>

    

        </div>
      </div>
    </div>
  </div>
      <!--fim do rodapé do modal-->
  


  <h3 style= "padding-top: 5px">Produtos Cadastrados</h3>

  <br>

<!-- rolagem horizontal -->

  <!DOCTYPE html>
  <html>
    <head>
      <title>Exemplo</title>
      <meta charset="utf-8">
      <style type="text/css">
        .conteudo{
          display: flex;
          flex-direction: row;
          justify-content: center;
          align-items: center;
          width: 100%;
        }
        .card{
          background-color: #f1f1f1;
          min-width: 250px;
          margin: 10px; 
          height: 200px;
          text-align: center;

        }
        .botao {
          padding: 10px 15px;
          text-align: center;
          background-color: #073A7D;
          color: white;
          margin-left: 75%;
          border-radius: 5px;
        }

        
        }
      </style>
    </head>
    
    
    @if($contador>0)
      <div style="display: grid;grid-template-columns: 1fr 1fr 1fr;">
      @foreach($produtos as $produto)

      <a data-toggle="modal" href="#configuracoes{{$produto->id}}">

        <div style= "margin: 2.5%; width: 20%; float: left">
          <div class="card">
            <i class="card-img-top fas fa-wine-bottle" style="padding-top: 15px; font-size:40px;"></i>
            <div class="card-body">
              <h5 class="card-title">{{$produto->nome}}</h5>
              <p class="card-text">R$<?php echo number_format($produto->preco, 2, ',', '.'); ?></p>
            </div>
          </div>
        </div>

      </a>


      <div class="modal fade" id="configuracoes{{$produto->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title container" id="exampleModalLabel">{{$produto->nome}}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body ">

              Preço: R$<?php echo number_format($produto->preco, 2, ',', '.'); ?><br>
              Quantidade: {{$produto->quantidade}}<br>
              <div>Categoria: {{$produto->categoria}}</div>

              <form action="{{action('CarrinhosController@store')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" name="produtoid" value="{{$produto->id}}">
                <input  type="number" id="qtd_compra" max="{{$produto->quantidade}}" min="1" name="quantidade">
                <button type="submit" class="btn btn-info">Adicionar</button>
              </form>


              {{-- Script para impedir compra negativa/maior que o estoque --}}
              <script>
                  var fieldElement=document.getElementById('qtd_compra');
                  function onBlurHandler(event){
                    var field = event.target;
                    if(!!field.validity) {
                      if(!!field.validity.rangeOverflow){
                        // Try setting a range over 20
                        field.setCustomValidity("A quantidade solicitada é maior que a do estoque.");
                      } else if(!!field.validity.rangeUnderflow){
                        // Try setting a range over 20
                        field.setCustomValidity("A quantidade solicitada deve ser no mínimo 1.");
                      }
                      else {
                        field.setCustomValidity(""); // Has to be an empty string
                      }
                    } else {
                      // Legacy validation
                    }
                    //console.log(field.validity);
                  }
                  fieldElement.addEventListener('blur', onBlurHandler, false);
              </script>

            </div>
           
          </div>
        </div>
      </div>

      @endforeach
      </div>
    @endif
    <?php
      $contador_js = $carrinhos->count();
    ?>
    @if($contador_js > 0)
    @foreach($carrinhos as $carrinho)
      <script>
        $('.close-ambiente').click(function() { 
          $('#modalExemplo{{$carrinho->id}}').modal('hide');
        }); 
      </script>
    @endforeach
    @endif
    
    <script>
        var path = "{{ route('autocomplete')  }}";
        $('input.typeahead').typeahead({
            source:  function (query, process) {
            return $.get(path, { term: query }, function (data) {
                    return process(data);
                });
            }
        });
    </script>
    
  </html>
</div>
<!-- Botão conselt -->

<div class="btn-group "style="width: 75rem; margin-top: 1.25%;">
  <a href="https://conselt.com.br" class="btn btn-outline-primary" aria-current="page">Feito com amor por CONSELT</a>

</div>

@endsection