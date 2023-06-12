<?php

namespace App\Http\Controllers;
use App\Models\Produto;
use App\Models\Caixa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class ProdutosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos=Produto::all();
        $view= Route::currentRouteName();

        if(strval($view)==='produtos.index'){
            return view('produtos')->with('produtos',$produtos);
        }

        if(strval($view)==='caixa.index'){
            return view('caixa')->with('produtos',$produtos);
        }

        if(strval($view)==='estoque.index'){
            return view('estoque')->with('produtos',$produtos);
        }
        else{
            return view('produtos')->with('produtos',$produtos);
        }
        
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produtos= new Produto;
        $produtos->nome = $request->input('nome');
        $produtos->quantidade = $request->input('quantidade');
        $produtos->preco = $request->input('preco');
        $produtos->categoria = $request->input('categoria');
        $produtos->datacompra = $request->input('datacompra');
        $produtos->dataval = $request->input('dataval');
        $produtos->save();
        
        return redirect('/produtos'); 
    }
    

/* Função buscar os cards na barra de pesquisa PRODUTOS*/
    public function Buscar(Request $request)
    {
       $Busca = $request->input('Busca');

        if($Busca){

            $produtos = Produto::where('nome','LIKE', '%'.$Busca.'%')->get();

        }
        else{
            $produtos = Produto::all();
        }
    
        return view('produtos')->with('produtos', $produtos);  
    }

    /* Fim da Função buscar os cards na barra de pesquisa PRODUTOS*/

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function repor(Request $request)
    {
        $produtos = Produto::where('nome', $request->input('busca_repor'))->get();   
        $produtos[0]->quantidade += $request->input('qtd_repor');
        $produtos[0]->save();

        $caixa = new Caixa;
        $caixa->nome = $produtos[0]->nome;
        $caixa->quantidade = $request->input('qtd_repor');
        $caixa->preco = ($request->input('preco_repor') * -1);
        $caixa->categoria = $produtos[0]->categoria;
        $caixa->operacao = "Compra";
        $caixa->save();

        return redirect('/estoque');
    }

    public function retirar(Request $request)
    {
        $produtos = Produto::where('nome', $request->input('busca_retirada'))->get();   
        $produtos[0]->quantidade -= $request->input('qtd_retirada');
        $produtos[0]->save();

        return redirect('/estoque');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $produtos = Produto::find($id);

        $produtos->nome = $request->input('nome');
        $produtos->quantidade = $request->input('quantidade');
        $produtos->preco = $request->input('preco');
        $produtos->categoria = $request->input('categoria');

        $produtos->save();

        return redirect('/estoque');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produto = Produto::find($id);
        $produto->delete();
        return redirect('/estoque');
    }


    public function buscarestoque(Request $request)
    {
        $nomebuscaestoque = $request->input('nomebuscaestoque');

        if($nomebuscaestoque)
        {
            $produtos = Produto::where('nome', 'LIKE', '%'.$nomebuscaestoque.'%')
                            ->get();    
        }
        else
        {
            $produtos = Produto::all();
        }
                        
        return view('estoque')->with('produtos', $produtos);  
    }

    public function filtroestoquequantidade()
    {
        $filtro= DB::table('produtos')//enviaria aqui uma quantidade que gostaria que aparecesse dos mais vendidos
        ->orderBy('quantidade','desc')
        ->get();

        return view('estoque')->with('produtos',$filtro); // pode ser tambem ,compact('produtos', 'comidas'));
    }

    public function filtroestoqueordem()
    {
        $filtro= DB::table('produtos')//enviaria aqui uma quantidade que gostaria que aparecesse dos mais vendidos
        ->orderBy('nome','asc')
        ->get();

        return view('estoque')->with('produtos',$filtro); // pode ser tambem ,compact('produtos', 'comidas'));
    }

    public function filtroestoquepreco()
    {
        $filtro= DB::table('produtos')//enviaria aqui uma quantidade que gostaria que aparecesse dos mais vendidos
        ->orderBy('preco','asc')
        ->get();

        return view('estoque')->with('produtos',$filtro); // pode ser tambem ,compact('produtos', 'comidas'));
    }

    public function filtroestoquedataval()
    {
        $filtro= DB::table('produtos')//enviaria aqui uma quantidade que gostaria que aparecesse dos mais vendidos
        ->orderBy('dataval', 'asc')
        ->get();

        return view('estoque')->with('produtos',$filtro); // pode ser tambem ,compact('produtos', 'comidas'));
    }

    public function autocomplete(Request $request)
    {
        return Produto::select('nome')
        ->where('nome', 'like', "%{$request->term}%")
        ->pluck('nome');
    }
}