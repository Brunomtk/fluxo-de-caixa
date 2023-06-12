<?php

namespace App\Http\Controllers;

use App\Models\Caixa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class CaixaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //rota de pesquisa do banco de dados do caixa
    {
        $produtos=Caixa::all();
        $view= Route::currentRouteName();

        if(strval($view) === 'caixa.index'){
            return view('caixa')->with('produtos',$produtos);
        }

        if(strval($view) === 'graficos.index'){
            $maisvendidos = Caixa::all()->where('operacao', 'Venda')->take(5);
            
            $entradas = Caixa::all()
            ->where('operacao', 'Venda')
            ->sum(\DB::raw('preco * quantidade'));

            $saidas = Caixa::all()
            ->where('operacao', 'Compra')
            ->sum(\DB::raw('preco * quantidade')) * -1;

            return view('graficos')->with(compact('maisvendidos', 'entradas', 'saidas'));
        }
        if(strval($view)==='produtos.index'){
            return view('produtos')->with('caixa',$produtos);
        }
        else{
            return view('caixas')->with('produtos',$produtos);
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
        $produtos= new Caixa();
        $produtos->nome = $request->input('nome');
        $produtos->quantidade = $request->input('quantidade');
        $produtos->preco = $request->input('preco');
        $produtos->categoria = $request->input('categoria');
        $produtos->save();
        return redirect('/caixa'); 
    }

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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $produtos = Caixa::find($id);

        $produtos->nome = $request->input('nome');
        $produtos->quantidade = $request->input('quantidade');
        $produtos->preco = $request->input('preco');
        $produtos->categoria = $request->input('categoria');

        $produtos->save();

        return redirect('/caixa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produto = Caixa::find($id);
        $produto->delete();
        return redirect('/caixa');
    }

    public function buscarcaixa(Request $request)
    {
        $nomebuscacaixa = $request->input('nomebuscacaixa');
        $from = $request->input('fromcaixa');
        $to = $request->input('tocaixa');

        if($nomebuscacaixa)
        {
            $produtos= DB::table('caixas')
                            ->where('nome', 'LIKE', '%'.$nomebuscacaixa.'%')
                            ->where('created_at','>=',$from)
                            ->where('created_at','<=',$to)
                            ->paginate();    
        }
        else
        {
            $produtos = Caixa::where('created_at','>=',$from)
                            ->where('created_at','<=',$to)
                            ->paginate();  
        }
                        
        return view('caixa')->with('produtos', $produtos);  
    }

    public function filtroCategorias(Request $request)
    {
        if($request->input('categoria') == "all"){
            $produtos = Caixa::all();
            return view('caixa')->with('produtos',$produtos);
        }
        else{
            $produtos = Caixa::where('categoria','LIKE', $request->input('categoria'))->get();
            return view('caixa')->with('produtos',$produtos);
        }
    }

    public function filtroOperacao(Request $request)
    {
        if($request->input('operacao') == "all"){
            $produtos = Caixa::all();
            return view('caixa')->with('produtos',$produtos);
        }
        else{
            $produtos = Caixa::where('operacao','LIKE', $request->input('operacao'))->get();
            return view('caixa')->with('produtos',$produtos);
        }
    }

    public function filtrocomidas()
    {
        
        $produtos= Caixa::where('categoria','LIKE', 'comidas')->get();

        return view('caixa')->with('produtos',$produtos); // pode ser tambem ,compact('produtos', 'comidas'));
    }

    public function filtrobebidas()
    {
        
        $bebidas= Caixa::where('categoria','LIKE', 'bebidas')->get();

        return view('caixa')->with('produtos',$bebidas); // pode ser tambem ,compact('produtos', 'bebidas'));
    }

    public function buscargraficos(Request $request)
    {
        $result = sscanf($request->input('mes'), '%d-%d');

        $maisvendidos = Caixa::whereMonth('created_at', $result[1])
                        ->whereYear('created_at', $result[0])
                        ->where('operacao', 'Venda')
                        ->orderBy('quantidade', 'desc')
                        ->get();

        $entradas = Caixa::whereMonth('created_at', $result[1])
                    ->whereYear('created_at', $result[0])
                    ->where('operacao', 'Venda')
                    ->sum(\DB::raw('preco * quantidade'));

        $saidas = Caixa::whereMonth('created_at', $result[1])
                    ->whereYear('created_at', $result[0])
                    ->where('operacao', 'Compra')
                    ->sum(\DB::raw('preco * quantidade')) * -1;
                    
        return view('graficos')->with(compact('maisvendidos', 'entradas', 'saidas'));
          
    }

    /*public function maisvendidosgrafico()
    {
        $duplicatas = DB::table('caixas')
        ->select('id','nome','quantidade')
        ->selectRaw('count(`nome`) as `ocorrencias`')
        ->selectRaw('sum(`quantidade`) as `quantidade`')
        ->having('ocorrencias', '>', 1)
        ->groupBy('nome')
        ->orderBy('quantidade','desc')
        ->get();

        $unicos = DB::table('caixas')
        ->select('id','nome', 'quantidade')
        ->selectRaw('count(`nome`) as `ocorrencias`')
        ->having('ocorrencias', '=', 1)
        ->groupBy('nome')
        ->orderBy('quantidade','desc')
        ->get();



        $maisvendidosgrafico= [];

        array_push($maisvendidosgrafico,$duplicatas);
        array_push($maisvendidosgrafico,$unicos);

        
        $produtotabela = [];

        //para cada ID encontrado, buscar o produto associado
        foreach($maisvendidosgrafico as $obj) {
            $produto = Caixa::find($obj->id);
           array_push($produtotabela, $produto);
        }

        $produto1= $produtotabela[0]->quantidade;
        $produto2= $produtotabela[1]->quantidade;
        $produto3= $produtotabela[2]->quantidade;
        $produto4= $produtotabela[3]->quantidade;
        
        dd($maisvendidosgrafico);
        return view('graficos')->with('produtotabela' , $maisvendidosgrafico);

        //FUNÇÃO AINDA NÃO ESTA COMPLETA

    }*/

}
