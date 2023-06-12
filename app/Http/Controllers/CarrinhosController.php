<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Carrinho;

use App\Models\Produto;

use App\Models\Caixa;

class CarrinhosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $produtos= new Carrinho;
        $produtos->produtoid = $request->input('produtoid');
        $produtos->quantidade = $request->input('quantidade');
        $produtos->save();
        return redirect('/produtos'); 
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
        $produtos = Carrinho::find($id);

        $produtos->produtoid = $request->input('produtoid');
        $produtos->quantidade = $request->input('quantidade');

        $produtos->save();

        return redirect('/produtos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produto = Carrinho::find($id);
        $produto->delete();
        return redirect('/produtos');
    }

    public function comprar(Request $request)
    {
        // Essa função vai atualizar o estoque: tirar os produtos que estão sendo comprados
        $carrinhos = Carrinho::all();
        foreach ($carrinhos as $carrinho)
        {
            $produto = Produto::where('id', 'LIKE', $carrinho->produtoid)->first();
            $produto->quantidade = strval(intval($produto->quantidade) - intval($carrinho->quantidade));
            $produto->save();
    
            $caixa = new Caixa;
            $caixa->nome = $produto->nome;
            $caixa->quantidade = $carrinho->quantidade;
            $caixa->preco = $produto->preco;
            $caixa->categoria = $produto->categoria;
            $caixa->operacao = "Venda";
            $caixa->save();

        }
        Carrinho::truncate();


        return redirect('/produtos');
    }


        
}



