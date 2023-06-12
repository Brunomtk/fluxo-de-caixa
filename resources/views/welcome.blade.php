<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
@extends('layouts.login')

@section('content')
        <title>CONSELT</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    </head>
    <body class="background">
    
    <div>
   
              
              <div class=" container  card-body btnlogin   ">
                        <h1 class="flex-center "  style="margin-left:-26.75rem; margin-top:-5rem; "> FLUXO DE CAIXA </h1>
                          @if (Route::has('login'))
                          @auth
                              <button  style="margin-left:13rem;  margin-top:2rem; " type= "button" class="btn btn-primary flex-center"><a href="{{ url('/home') }}" style = "color:#fff" >AREA DO FLUXO DE CAIXA</a></button>
                          @else
                              <button style="margin-left:14rem;  margin-top:2rem;" type= "button" class="btn btn-primary"><a href="{{route('login')}}" style = "color:#fff" >LOGIN</a></button>
                  
                          @if (Route::has('register'))
                              <button style="margin-rigth:10rem;  margin-top:2rem;" type= "button" class="btn btn-primary"><a href="{{route('register')}} "style = "color:#fff ">REGISTRAR</a></button>
                  
                          @endif
                          @endauth
                          @endif

                      
              </div>
          </div>
            
    </body>
</html>

<!-- Styles -->
<style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }
            .imagenslogo{
                height: 100px;
                width: 100px;
                margin-top:-630px;
                
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #000;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .cabecalho {
                background: #0e72be
            }
            .background{
                background: url("image/fundowelcome.png");
                background-attachment: fixed;
                background-size:100%;
                background-color:#000;
                background-repeat:no-repeat;
            }
            .btnlogin{

                margin-top:600px;
                margin-right:-88px;
                justify-content: center;
            }
            .borda {
             border: double;

            }
        </style>
@endsection