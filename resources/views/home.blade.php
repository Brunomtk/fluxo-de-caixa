@extends('layouts.template_base')

@section('content')

<!-- foto do perfil -->
<div class="card  mb-3 shadow-none topo">
    <img src="image/fundoconselt0.jpg" class="card-img-top shadow-none" alt="...">
    <div class="card mb-3" style="max-width: 540px; card shadow-none" >
</div>
    <div class="row no-gutters card-perfil" style="opacity:0.75;">
    <div class="col-md-4 card" style="margin-top: 4.25%" >
      <div class="card-body">
        <h5 class="card-title" style="color:#000;">{{ Auth::user()->name }}</h5>
        <p class="card-text" style="color:#000;"><i class="fa fa-envelope-o"style="margin-left: 1.25%"></i> {{ Auth::user()->email }}</p>
      </div>
    </div>
  </div>

  <!-- Divisoria  -->
  <div class="divisoria"></div>


        <!--  TEXTO Sobre as Casas -->

        <h1 class = "topo" style="text-align:center; margin-top: 2.25%; color= #fff">Gerenciar Fluxo de Caixa<span class="badge bg-secondary"></span></h1>

        <!--  Escolha sua casa bruxo  -->
        <div class="card-group topo">
            <!-- Card Grifinória  -->
          <div class="card topo borda">
                <img src="image/icones/7.png" class="card-img-top" alt="..." style="height: 300px; width: 300px;">
                <div class="card-body">
                    <h1 class="card-title" style= "text-align: center;" >Caixa</h1>
                    <p class="card-text "style= "text-align: center;">Venha conferir o caixa</p>
                    <a href="caixa" style="margin-left: 31%;" class="btn btn-outline-danger">ENTRAR</a>
                </div>
          </div>
          <!-- Card Sonserina  -->
          <div class="card topo borda">
            <img src="image/icones/8.png" class="card-img-top" alt="..." style="height: 300px; width: 300px;">
                <div class="card-body">
                    <h1 class="card-title " style= "text-align: center;">Produtos</h1>
                    <p class="card-text" style= "text-align: center;">Venha conferir nossos produtos</p>
                    <a href="produtos" style="margin-left: 31%;" class="btn btn-outline-success">ENTRAR</a>
                </div>
          </div>
          <!-- Card Corvinal  -->
          <div class="card topo borda">
                <img src="image/icones/9.png" class="card-img-top" alt="..." style="height: 300px; width: 300px;">
                <div class="card-body">
                    <h1 class="card-title" style= "text-align: center;">Estoque</h1>
                    <p class="card-text" style= "text-align: center;">Venha conferir nosso estoque</p>
                    <a href="estoque" style="margin-left: 31%;" class="btn btn-outline-info">ENTRAR</a>
                </div>        
         </div>
          <!-- Card Lufa-lufa -->
         <div class="card topo borda">
            <img src="image/icones/10.png" class="card-img-top" alt="..." style="height: 300px; width: 300px;">
                <div class="card-body">
                    <h1 class="card-title " style= "text-align: center;">Graficos</h1>
                    <p class="card-text " style= "text-align: center;">Venha visualizar nossos graficos</p>
                    <a href="graficos" style="margin-left: 31%;" class="btn btn-outline-warning">ENTRAR</a>
                </div>

            </div>
        </div>

    


        <!-- Divisoria  -->
        <div class="divisoria"></div>


        <!--  TEXTO Sobre as capacitações  -->

        <h1 class = "topo" style="text-align:center; margin-top: 2.25%;">Sobre o fluxo de caixa<span class="badge bg-secondary"></span></h1>

        <!--  Videos  -->

        <div class="carousel-item active carrosel">
                    <img src="image/Fluxodecaixa1.gif" class="d-block carroselimg topo" alt="...">
                </div>
         <!--  card de texto  -->
         <div class="card text-center topo textoRigth " style="margin-top: -33rem; margin-left:52rem; ">
                <div class="card-body borda">
                    <h2 class="card-title fonteAlfa">Sobre o fluxo de caixa </h2>
                    <p class="card-text fonteAlfa">Em Finanças, o fluxo de caixa refere-se ao fluxo do dinheiro no caixa da empresa, ou seja, ao montante
                         de caixa recolhido e gasto por uma empresa durante um período de tempo definido, algumas vezes ligado a 
                         um projeto específico.Usando a funcionalidade de fluxo de caixa, você tem controle sobre os recebimentos e despesas mensais da sua loja e cadastra suas contas bancárias para acompanhar as movimentações diárias.

                    </p> 
                    <a href="https://drive.google.com/drive/u/0/folders/1Gn_DWuUZC7xTFR757SO02vDMX767O92Z" class="btn btn-outline-success" style="margin-top: 10px; ">SAIBA MAIS</a>
                    
                </div>
            </div>
        
            <!-- Divisoria  -->
        <div class="divisoria"></div>

         
         <!--  Imagens  -->
         <h1 class = "topo" style="text-align:center; margin-top: 2.25%;">Manual de Utilização<span class="badge bg-secondary"></span></h1>
        <div class="carousel-item active carrosel">
                    <img src="image/Manual.gif" class="d-block carroselimg" alt="...">
                </div>
         <!--  card de texto  -->
         <div class="card text-center topo textoRigth " style="margin-top: -33rem; margin-left:52rem; ">
                <div class="card-body borda">
                    <h2 class="card-title fonteAlfa">MANUAL</h2>
                    <p class="card-text fonteAlfa">O case consistirá em criar um projeto de software básico, sendo
                                                    que o mesmo deverá estar online no Heroku, com todos os tópicos
                                                    mínimos abaixo funcionando. Sendo que os tópicos serão divididos em
                                                    sprints, ou seja, existiram entregas parciais.
                                                    Neste projeto de software básico sugerimos que realizem a
                                                    capacitação conforme “produtos” que desenvolvemos dentro da
                                                    empresa. Portanto, caso tenham ideias de produtos, realizem de acordo
                                                    com o conceito criado. Como exemplos: aprimoramento do nosso atual
                                                    prontuário, software para autoescolas, para cadastros e controle de
                                                    estudantes, etc.

                    </p> 
                    <a href="https://drive.google.com/drive/u/0/folders/1Gn_DWuUZC7xTFR757SO02vDMX767O92Z" class="btn btn-outline-info" style="margin-top: 10px; ">MANUAL</a>
                    
                </div>
            </div>
         
        

        

        <!-- Divisoria  -->
        <div class="divisoria"></div>



        <!-- Botão conselt -->

        <div class="btn-group topo"style="width: 75rem; margin-top: 1.25%;">
          <a href="https://conselt.com.br" class="btn btn-outline-primary" aria-current="page">Feito com amor por CONSELT</a>

        </div>

</div>


 <!-- Styles-->
<style>

    .topo {
        background-color: #dadada;;
        
    }
    .botão_principal{

        float: right;
        margin-bottom:30px;
    }
    .myBackground {
     background-image:"images/jornal.png";
     
     
    }
    .divisoria{
                height: 5px;
                width: 100%;
                background: rgb(246,246,246);
                background: linear-gradient(90deg, rgba(246,246,246,1) 0%,#073A7D, rgba(246,246,246,1) 100%);
                margin-bottom: 30px;
                margin-top: 50px;
            }
    .video{

        height: 480px;
        width: 820px;
        margin-top: 30px;


    }
    .carrosel {

        height: 500px;
        width: 800px;
        border: double;


    }
    .carroselright {
        margin-top:2rem;
        float: right;
        height: 500px;
        width: 800px;
        border: double;


    }

    .carroselimg {

        height: 100%;
        width: 100%;
            


    }
    .fonteAlfa{
        font-variant: small-caps;
        font-family: "Alfa Slab One";
    }
    .textoRigth{
        
        margin-top:-31.25rem;
        margin-left:51rem;
        width: 20rem;
       
        
    }
    .textoleft{
        
        margin-top:1.25rem;
        margin-left:2rem;
        width: 20rem;
       
        
    }
    .borda {
        border: double;

    }

    .textonome{

    text-align: center;
    margin-top:-20px;


    }


    }
    .fotoperfil{
    height: 2px;
    width: 2px;
    }
    .card-img-top{
    height: 320px;
    width: 1170px;

    }
    .card-perfil{
    margin-top: -175px;

    }

 

</style>

@endsection
