<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormRequestProduto;
use App\Models\Componentes;
use App\Models\Produto;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    private $produto;

    public function __construct(Produto $produto)
    {
        $this->produto = $produto;
    }
   // public function index(){
  //      $findProduto = Produto::all();  //pode colocar where tbm
  //      dd($findProduto); // vai debugar e morrer, melhor pq dá para navegar
  //      return "produtos";
  //  }

  public function index(Request $request)
    {
        $pesquisar = $request->pesquisar; //acessando o name
        $findProduto = $this->produto->getProdutosPesquisarIndex(search: $pesquisar ?? ''); // se for null

        return view('pages.produtos.paginacao', compact('findProduto'));
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $buscaRegistro = Produto::find($id);
        $buscaRegistro->delete();

        return response()->json(['success' => true]);
    }

   // public function cadastrarProduto(Request $request)
   // {
    //    if($request->method()=="POST"){
     //       //cria
     //       $data =$request->all();
    //        Produto::create($data);

    //        return redirect()->route('produto.index');
   //     }
   //     return view('pages.clientes.create');
   // }

    public function cadastrarProduto(FormRequestProduto $request) // precisa do @csrf para gerar o token
    {
        if ($request->method() == "POST") {
            $data = $request->all();
            $componentes = new Componentes();
            $data['valor'] = $componentes->formatacaoMascaraDinheiroDecimal($data['valor']);
            Produto::create($data);

            Toastr::success('Dados gravados com sucesso.');
            return redirect()->route('produto.index');
        }
        // mostrar os dados
        return view('pages.produtos.create');
    }

    public function atualizarProduto(FormRequestProduto $request, $id)
    {
        if ($request->method() == "PUT") {
            $data = $request->all();
            $componentes = new Componentes();
            $data['valor'] = $componentes->formatacaoMascaraDinheiroDecimal($data['valor']);
            $buscaRegistro = Produto::find($id);
            $buscaRegistro->update($data);

            Toastr::success('Dados atualizados com sucesso.');
            return redirect()->route('produto.index');
        }
        $findProduto = Produto::where('id', '=', $id)->first(); // pega o id

        return view('pages.produtos.atualiza', compact('findProduto')); // compact é uma função que passa do back para o front
    }
}